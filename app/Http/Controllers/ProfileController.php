<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

//User Profile ni dere

    public function editUser(Request $request): View
    {
        return view('user.profile.edit', [
            'user' => $request->user(),
        ]);
    }

//Sa image rani na part atong profile

    public function updateUserImage(Request $request, $userId): RedirectResponse
    {
        $request->validate([
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        //E check una ang user
        if ($user->id != $userId) {
            return Redirect::route('user.profile.edit')->withErrors(['user' => 'Unauthorized action.']);
        }

        //Usa mo kuha sa image nya e delete ang current picture usa e add ang bag o sa public 
        if ($request->hasFile('user_image')) {
            if ($user->user_image) {
                Storage::delete($user->user_image);
            }
            $user->user_image = $request->file('user_image')->store('user_images', 'public');
        }

        $user->save(); 

        return Redirect::route('user.profile.edit')->with('status', 'Profile image updated successfully.');
    }

    /**
     * Update the user's profile information.
     */
    public function updateUser(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('user.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroyUser(Request $request): RedirectResponse
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

//Admin Profile ni dere

 public function editAdmin(Request $request): View
    {
        return view('barangay.profile.edit', [
            'user' => $request->user(),
        ]);
    }

//Sa image rani na part atong profile

    public function updateAdminImage(Request $request, $userId): RedirectResponse
    {
        $request->validate([
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        //E check una ang user
        if ($user->id != $userId) {
            return Redirect::route('barangay.profile.edit')->withErrors(['user' => 'Unauthorized action.']);
        }

        //Usa mo kuha sa image nya e delete ang current picture usa e add ang bag o sa public 
        if ($request->hasFile('user_image')) {
            if ($user->user_image) {
                Storage::delete($user->user_image);
            }
            $user->user_image = $request->file('user_image')->store('user_images', 'public');
        }

        $user->save(); 

        return Redirect::route('barangay.profile.edit')->with('status', 'Profile image updated successfully.');
    }

    /**
     * Update the user's profile information.
     */
    public function updateAdmin(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('barangay.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroyAdmin(Request $request): RedirectResponse
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

//Super admin Profile ni dere

public function editSuperAdmin(Request $request): View
    {
        return view('lgu.profile.edit', [
            'user' => $request->user(),
        ]);
    }

//Sa image rani na part atong profile

public function updateSuperAdminImage(Request $request, $userId): RedirectResponse
{
    $request->validate([
        'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = Auth::user();

    //E check una ang user
    if ($user->id != $userId) {
        return Redirect::route('lgu.profile.edit')->withErrors(['user' => 'Unauthorized action.']);
    }

    //Usa mo kuha sa image nya e delete ang current picture usa e add ang bag o sa public 
    if ($request->hasFile('user_image')) {
        if ($user->user_image) {
            Storage::delete($user->user_image);
        }
        $user->user_image = $request->file('user_image')->store('user_images', 'public');
    }

    $user->save(); 

    return Redirect::route('lgu.profile.edit')->with('status', 'Profile image updated successfully.');
}

    /**
     * Update the user's profile information.
     */
    public function updateSuperAdmin(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('lgu.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroySuperAdmin(Request $request): RedirectResponse
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
}
