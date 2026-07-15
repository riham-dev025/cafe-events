@extends('layouts.app')

@section('content')


<div class="flex min-h-screen bg-[#FDF8F6]">


    {{-- SIDEBAR --}}
    @include('admin.sidebar')



    {{-- MAIN CONTENT --}}
    <main class="flex-1 flex flex-col overflow-y-auto">



        {{-- TOP BAR --}}
        <header class="h-16 bg-white border-b border-peony/20 px-8 flex items-center justify-between shrink-0">

            <div class="flex items-center gap-4 w-1/3">

                <span class="text-espresso/40 text-lg">
                    🔍
                </span>

                <input 
                    type="text" 
                    placeholder="Search anything..." 
                    class="w-full text-sm outline-none bg-transparent placeholder-espresso/30 text-espresso"
                />

            </div>



            <div class="flex items-center gap-6 text-sm font-medium">

                <div class="flex items-center gap-2">

                    <div class="w-8 h-8 rounded-full bg-peony/30 flex items-center justify-center">
                        ☕
                    </div>

                    <span class="text-espresso/80">
                        N&P Barista
                    </span>

                </div>

            </div>


        </header>





        {{-- BOOKINGS CONTENT --}}
        <div class="p-8 space-y-8 max-w-[1600px] w-full mx-auto">



            {{-- PAGE TITLE --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">

                <div>

                    <h1 class="text-2xl font-bold text-espresso tracking-tight">
                        Bookings Management
                    </h1>

                    <p class="text-sm text-espresso/50 mt-1">
                        Monitor appointments, filter by status, and manage user schedules.
                    </p>

                </div>

            </div>





            {{-- STATUS COUNTS --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">

                @foreach($counts as $key => $count)

                    <div class="bg-white p-5 rounded-2xl border border-peony/10 shadow-sm">

                        <span class="text-xs font-semibold text-espresso/40 uppercase tracking-wider">
                            {{ $key }} Bookings
                        </span>

                        <h3 class="text-2xl font-bold text-espresso mt-1">
                            {{ $count }}
                        </h3>

                    </div>

                @endforeach

            </div>







            {{-- BOOKINGS TABLE --}}
            <div class="bg-white rounded-2xl border border-peony/10 shadow-sm overflow-hidden">



                {{-- FILTERS --}}
                <div class="p-6 border-b border-peony/10 flex flex-col md:flex-row justify-between items-center gap-4">


                    <div class="flex bg-peony/10 p-1 rounded-xl">

                        @foreach(['All', 'Pending', 'Confirmed', 'Cancelled'] as $tab)

                            <a href="{{ route('admin.bookings.index', [
                                'status' => $tab,
                                'search' => request('search')
                            ]) }}"
                            class="px-4 py-2 text-xs font-medium rounded-lg transition-all 
                            {{ $status === $tab ? 'bg-white text-espresso shadow-sm' : 'text-espresso/60 hover:text-espresso' }}">

                                {{ $tab }}

                            </a>

                        @endforeach

                    </div>





                    <form method="GET" action="{{ route('admin.bookings.index') }}" class="w-full md:w-80 flex gap-2">


                        <input type="hidden" name="status" value="{{ $status }}">


                        <input 
                            type="text" 
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search customer or ID..."
                            class="w-full text-sm rounded-xl border border-peony/20 focus:border-peony focus:ring-peony/20 placeholder-espresso/30"
                        >


                        <button 
                            type="submit"
                            class="px-4 py-2 bg-espresso text-white rounded-xl text-xs font-semibold hover:bg-espresso/90 transition">

                            Search

                        </button>


                    </form>


                </div>







                {{-- TABLE --}}
                <div class="overflow-x-auto">


                    <table class="w-full text-left border-collapse">


                        <thead>

                            <tr class="bg-peony/5 text-espresso/60 text-xs font-semibold uppercase tracking-wider border-b border-peony/10">

                                <th class="p-4 pl-6">
                                    ID
                                </th>

                                <th class="p-4">
                                    Customer
                                </th>

                                <th class="p-4">
                                    Event / Service
                                </th>

                                <th class="p-4">
                                    Date & Time
                                </th>

                                <th class="p-4 text-center">
                                    Status
                                </th>

                                <th class="p-4 pr-6 text-right">
                                    Actions
                                </th>

                            </tr>

                        </thead>




                        <tbody class="divide-y divide-peony/10 text-sm text-espresso/70">


                            @forelse($bookings as $booking)


                                <tr class="hover:bg-peony/5 transition">


                                    <td class="p-4 pl-6 font-mono text-espresso/40">

                                        #{{ $booking->id }}

                                    </td>




                                    <td class="p-4">

                                        <div class="font-semibold text-espresso">
                                            {{ $booking->user->name }}
                                        </div>

                                        <div class="text-xs text-espresso/40">
                                            {{ $booking->user->email }}
                                        </div>

                                    </td>





                                    <td class="p-4 font-medium text-espresso">

                                        {{ $booking->service->name ?? 'Custom Session' }}

                                    </td>





                                    <td class="p-4">

                                        {{ $booking->booking_date ?? 'N/A' }}

                                        <span class="block text-xs text-espresso/40">

                                            {{ $booking->booking_time ?? '' }}

                                        </span>

                                    </td>






                                    <td class="p-4 text-center">


                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold

                                            {{ $booking->booking_status === 'Confirmed' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : '' }}

                                            {{ $booking->booking_status === 'Pending' ? 'bg-amber-50 text-amber-700 border border-amber-100' : '' }}

                                            {{ $booking->booking_status === 'Cancelled' ? 'bg-rose-50 text-rose-700 border border-rose-100' : '' }}

                                        ">

                                            {{ $booking->booking_status }}

                                        </span>


                                    </td>






                                    <td class="p-4 pr-6 text-right">


                                        @if($booking->booking_status !== 'Cancelled')


                                            <form 
                                                action="{{ route('admin.bookings.cancel', $booking->id) }}" 
                                                method="POST" 
                                                onsubmit="return confirm('Cancel this booking?')"
                                                class="inline-block">

                                                @csrf
                                                @method('PATCH')


                                                <button 
                                                    type="submit"
                                                    class="text-xs text-rose-600 font-semibold hover:underline">

                                                    Cancel Booking

                                                </button>


                                            </form>


                                        @else


                                            <span class="text-xs text-espresso/40 italic">
                                                No Actions
                                            </span>


                                        @endif


                                    </td>



                                </tr>



                            @empty


                                <tr>

                                    <td colspan="6" class="p-8 text-center text-espresso/40">

                                        No bookings found.

                                    </td>

                                </tr>


                            @endforelse


                        </tbody>


                    </table>


                </div>







                {{-- PAGINATION --}}
                @if($bookings->hasPages())

                    <div class="p-6 border-t border-peony/10">

                        {{ $bookings->links() }}

                    </div>

                @endif





            </div>



        </div>


    </main>


</div>


@endsection