<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Purok;
use App\Events\Userlog;
use Illuminate\Http\Request;
use App\Models\BarangayOfficial;
use Illuminate\Support\Facades\Auth;

class BarangayOfficialController extends Controller
{

    public function createOfficial()
    {
        // Get the residents specific to the barangay of the authenticated user
        $barangayId = Auth::user()->barangay_id;
        $residents = Resident::where('barangay_id', $barangayId)->select('id', 'first_name', 'last_name')->get();

        return view('barangay.officials.create', compact('residents'));
    }

    // Store new barangay official
    public function storeOfficial(Request $request)
    {
        $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'position' => 'required|string|max:255',
            'purok' => 'required|string|max:255',
            'committee' => 'required|string|max:255',
            'start_of_service' => 'required|date',
            'end_of_service' => 'required|date|after:start_of_service',
        ]);

        $barangayId = Auth::user()->barangay_id;

        // Create a new barangay official for the authenticated user's barangay
        BarangayOfficial::create([
            'resident_id' => $request->resident_id,
            'barangay_id' => $barangayId,
            'position' => $request->position,
            'purok' => $request->purok,
            'committee' => $request->committee,
            'start_of_service' => $request->start_of_service,
            'end_of_service' => $request->end_of_service,
        ]);

        $log_entry = 'Admin Added a new Official with an ID  ' . $request->resident_id . ' in the position of ' . $request->position;
        event(new UserLog($log_entry));

        return redirect()->route('barangay.dashboard')->with('success', 'Official added successfully.');
    }


    public function editOfficial(BarangayOfficial $official)
    {
        // Ensure the authenticated user's barangay matches the official's barangay
        $barangayId = Auth::user()->barangay_id;
        if ($official->barangay_id !== $barangayId) {
            return redirect()->route('barangay.dashboard')->with('error', 'Unauthorized access.');
        }

        // Get the residents specific to the barangay of the authenticated user
        $residents = Resident::where('barangay_id', $barangayId)->select('id', 'first_name', 'last_name')->get();

        // Return the edit view with official and residents data
        return view('barangay.officials.edit', compact('official', 'residents'));
    }

    // Update function to process the form submission
    public function updateOfficial(Request $request, BarangayOfficial $official)
    {
        $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'position' => 'required|string|max:255',
            'purok' => 'required|string|max:255',
            'committee' => 'required|string|max:255',
            'start_of_service' => 'required|date',
            'end_of_service' => 'required|date|after:start_of_service',
        ]);

        // Ensure the authenticated user's barangay matches the official's barangay
        $barangayId = Auth::user()->barangay_id;
        if ($official->barangay_id !== $barangayId) {
            return redirect()->route('barangay.dashboard')->with('error', 'Unauthorized access.');
        }

        // Update the barangay official's data
        $official->update([
            'resident_id' => $request->resident_id,
            'position' => $request->position,
            'purok' => $request->purok,
            'committee' => $request->committee,
            'start_of_service' => $request->start_of_service,
            'end_of_service' => $request->end_of_service,
        ]);

        
        $log_entry = 'Admin Updated an Official with an ID of  ' . $request->resident_id . ' in the position ' . $request->position;
        event(new UserLog($log_entry));

        return redirect()->route('barangay.dashboard')->with('success', 'Official updated successfully.');
    }

    // public function destroyOfficial(BarangayOfficial $official) {
        
    //     $officialDetails = [
    //         'id' => $official->id,
    //         'position' => $official->position, 
    //     ];
    
    //     $log_entry = sprintf(
    //         'Admin Deleted an Official win an ID of: %s, in the Position of: %s',
    //         $officialDetails['id'],
    //         $officialDetails['position']
    //     );
    
    //     $official->delete();
    
    //     event(new UserLog($log_entry));
    
    //     return redirect()->route('barangay.dashboard')->with('success', 'Official deleted successfully');
    // }
    

}
