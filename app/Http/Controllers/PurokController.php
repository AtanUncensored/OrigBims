<?php

namespace App\Http\Controllers;

use App\Models\Purok;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurokController extends Controller
{
    public function index() {

        $userBarangayId = Auth::user()->barangay_id;

        $puroks = Purok::where('barangay_id', $userBarangayId)->get();

        return view('barangay.puroks.index', compact('puroks'));
    }

    public function createPurok() {
        return view('barangay.puroks.create');
    }

    public function storePurok(Request $request)
{
    $barangayId = Auth::user()->barangay_id;

    // Validate the request
    $request->validate([
        'purok_name'  => 'required|string|max:255',
        'purok_number' => 'required|integer|in:1,2,3,4,5,6,7',
    ]);

    // Check if the maximum limit of 7 Puroks is reached for the barangay
    $purokCount = Purok::where('barangay_id', $barangayId)->count();
    if ($purokCount >= 7) {
        return back()->withErrors(['error' => 'The maximum of 7 Puroks has already been reached for this barangay.']);
    }

    // Check if the purok_number is already taken within the same barangay
    $existingPurok = Purok::where('barangay_id', $barangayId)
        ->where('purok_number', $request->purok_number)
        ->first();
    if ($existingPurok) {
        return back()->withErrors(['error' => 'The Purok number is already taken for this barangay.']);
    }

    // Store the new Purok
    Purok::create([
        'barangay_id' => $barangayId,
        'purok_name'  => $request->purok_name,
        'purok_number'=> $request->purok_number,
    ]);

    return back()->with('success', 'Purok created successfully!');
}

    public function viewPurok(Purok $purok)
    {
        // Fetch residents belonging to the specific Purok
        $residents = Resident::where('purok_id', $purok->id)->get();

        // Count total residents in that Purok
        $totalResidents = $residents->count();

        // Count male residents
        $totalMales = $residents->where('gender', 'male')->count();

        // Count female residents
        $totalFemales = $residents->where('gender', 'female')->count();

        // $totalHouseholds = $residents->pluck('household_id')->unique()->count();


        // Return the view with the data
        return view('barangay.puroks.viewPurok', compact('purok', 'totalResidents', 'totalMales', 'totalFemales', 'residents',));
    }


    

}
