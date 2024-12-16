<?php

// app/Http/Controllers/Auth/AuthenticatedSessionController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $barangays = \App\Models\Barangay::all(); // Get all barangays for the dropdown
        return view('auth.login', compact('barangays'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();
        $selectedBarangayId = $request->input('barangay_id'); // Get selected barangay ID

        // Check if the user's barangay matches the selected barangay
        if ($user->barangay_id == $selectedBarangayId) {
            // Redirect based on role
            if ($user->hasRole('superAdmin')) {
                return redirect()->route('lgu.dashboard');
            } elseif ($user->hasRole('admin')) {
                return redirect()->route('barangay.dashboard');
            } elseif ($user->hasRole('user')) {
                return redirect()->route('user.dashboard');
            }

            return redirect()->intended('/');
        } else {
            // If the barangay doesn't match, logout and return with an error message
            Auth::guard('web')->logout();
            return redirect()->back()->withErrors(['barangay_id' => 'You are not authorized to access this barangay.']);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {

        $user = Auth::user();
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($user && $user->hasRole('superAdmin')) {
            return redirect('/lgu-login');  
        }

        return redirect('/');
    }
}
