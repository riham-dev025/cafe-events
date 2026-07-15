<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminStaffController extends Controller
{
    public function index(Request $request)
    {
        $query = Staff::with('user');

        if ($request->filled('search')) {
            $searchTerm = trim(strtolower($request->search)) . '%';
            
            $query->whereHas('user', function($q) use ($searchTerm) {
                $q->whereRaw('LOWER(name) LIKE ?', [$searchTerm]);
            });
        }

        $staff = $query->latest()->get();

        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'html' => view('admin.staff.partials.table-rows', compact('staff'))->render()
            ]);
        }

        return view('admin.staff.index', compact('staff'));
    }

    public function store(Request $request)
    {
        Log::info('Incoming Staff Request Data:', $request->all());
       $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:20',
            'position' => 'required|string|max:100',
            'status' => 'required|string|max:20',
        ]);

        // 2. Wrap creation in a transaction to guarantee both tables insert successfully
        DB::transaction(function () use ($validated) {
            
            // Find the ID of your 'staff' role in the roles table
            $staffRole = Role::whereRaw('LOWER(name) = ?', ['staff'])->first();
            $roleId = $staffRole ? $staffRole->id : 2; // Default to ID 2 (or change to your actual staff role ID)

            // Create the user account first (mapping 'password' input to 'password_hash')
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'role_id' => $roleId,
                'password_hash' => Hash::make($validated['password']), // Maps to your customized column
            ]);

            // Create the matching Staff profile details (No 'role' column used here, as it belongs to the User)
            Staff::create([
                'user_id' => $user->id,
                'position' => $validated['position'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.staff.index')->with('success', 'Staff member added successfully!');
    }

    public function destroy($id)
    {
        $staffMember = Staff::findOrFail($id);

        DB::transaction(function() use ($staffMember) {
            // Delete the associated user account (this cascades/deletes staff if foreign keys are setup,
            // but we'll clean up manually here to be completely safe!)
            if ($staffMember->user) {
                $staffMember->user->delete();
            }
            $staffMember->delete();
        });

        return redirect()->route('admin.staff.index')->with('success', 'Staff member successfully removed.');
    }
}