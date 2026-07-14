<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Resource;
use App\Models\Service;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = auth()->user()->bookings()
        ->with(['service', 'resource'])
        ->latest('booking_start')
        ->get();

    // 2. Fetch the active services so the catalog can render
    $services = Service::where('status', 'active')->get();

    // 3. Send both variables to your view
    return view('bookings.index', compact('bookings', 'services'));
    }

    public function create(Request $request)
    {
        $services = Service::where('status', 'active')->get();
        $selectedServiceId = $request->query('service_id');

        return view('bookings.create', compact('services', 'selectedServiceId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'seats_reserved' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
        ]);

        $service = Service::findOrFail($request->service_id);
        $seatsReserved = $request->seats_reserved;
        $bookingStart = Carbon::parse($request->booking_date . ' ' . $request->start_time);
        $bookingEnd = $bookingStart->copy()->addMinutes($service->duration_minutes);
        $activeStatuses = ['pending', 'confirmed'];

        return DB::transaction(function () use ($service, $seatsReserved, $bookingStart, $bookingEnd, $activeStatuses, $request) {

            // Lock candidate resources so a second concurrent request waits here,
            // not races past this check
            $candidates = Resource::where('type', $service->required_resource_type)
                ->where('status', 'active')
                ->lockForUpdate()
                ->get();

            if ($candidates->isEmpty()) {
                return back()->withErrors(['error' => 'No suitable space is configured for this experience.']);
            }

            if ($service->required_resource_type === 'table') {
                $assignedResource = null;

                foreach ($candidates->where('capacity', '>=', $seatsReserved)->sortBy('capacity') as $table) {
                    $overlap = Booking::where('resource_id', $table->id)
                        ->whereIn('booking_status', $activeStatuses)
                        ->where('booking_start', '<', $bookingEnd)
                        ->where('booking_end', '>', $bookingStart)
                        ->exists();

                    if (! $overlap) {
                        $assignedResource = $table;
                        break;
                    }
                }

                if (! $assignedResource) {
                    return back()->withErrors(['error' => 'No tables with sufficient capacity are free at that time.']);
                }
            } else {
                $assignedResource = $candidates->first();

                // Block a DIFFERENT session from double-booking this room/stage/venue
                $conflictingOtherSession = Booking::where('resource_id', $assignedResource->id)
                    ->whereIn('booking_status', $activeStatuses)
                    ->where('booking_start', '<', $bookingEnd)
                    ->where('booking_end', '>', $bookingStart)
                    ->where(function ($q) use ($service, $bookingStart) {
                        $q->where('service_id', '!=', $service->id)
                          ->orWhere('booking_start', '!=', $bookingStart);
                    })
                    ->exists();

                if ($conflictingOtherSession) {
                    return back()->withErrors(['error' => 'This space is already reserved for a different booking at that time.']);
                }

                // Same session — just check remaining seats
                $seatsTaken = Booking::where('service_id', $service->id)
                    ->where('resource_id', $assignedResource->id)
                    ->where('booking_start', $bookingStart)
                    ->whereIn('booking_status', $activeStatuses)
                    ->sum('seats_reserved');

                if (($seatsTaken + $seatsReserved) > $service->capacity) {
                    $spotsLeft = max($service->capacity - $seatsTaken, 0);
                    return back()->withErrors(['error' => "Only {$spotsLeft} spots left for this session."]);
                }
            }

            $busyStaffIds = Booking::whereIn('booking_status', $activeStatuses)
                ->where('booking_start', '<', $bookingEnd)
                ->where('booking_end', '>', $bookingStart)
                ->whereNotNull('staff_id')
                ->pluck('staff_id');

            $availableStaff = Staff::where('status', 'active')
                ->whereNotIn('id', $busyStaffIds)
                ->first();

            if (! $availableStaff) {
                return back()->withErrors(['error' => 'All staff are already booked at this time.']);
            }

            Booking::create([
                'user_id' => auth()->id(),
                'service_id' => $service->id,
                'resource_id' => $assignedResource->id,
                'staff_id' => $availableStaff->id,
                'booking_start' => $bookingStart,
                'booking_end' => $bookingEnd,
                'seats_reserved' => $seatsReserved,
                'booking_status' => 'pending',
                'payment_method' => 'pay_at_shop',
                'payment_status' => 'unpaid',
                'notes' => $request->notes,
            ]);

            return redirect()->route('bookings.index')->with('success', 'Your booking request has been received.');
        });
    }
}