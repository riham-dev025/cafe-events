<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit()
{
    $bookings = auth()->user()
        ->bookings()
        ->with([
            'service',
            'resource',
            'staff.user',
        ])
        ->latest('booking_start')
        ->get();


    $orders = auth()->user()
        ->orders()
        ->with([
            'items.product'
        ])
        ->latest()
        ->get();


    return view('profile.edit', compact(
        'bookings',
        'orders'
    ));
}

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
        'phone' => 'nullable|string|max:20',
    ]);

    auth()->user()->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
    ]);

    return back()->with('success', 'Profile updated successfully!');

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required'],
        'password' => ['required', 'confirmed', Password::defaults()],
    ]);

    $user = auth()->user();

    if (! Hash::check($request->current_password, $user->password)) {
        return back()->withErrors([
            'current_password' => 'Your current password is incorrect.',
        ]);
    }

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return back()->with('password_success', 'Password updated successfully!');
}
}
