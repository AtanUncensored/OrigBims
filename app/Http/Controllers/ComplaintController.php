<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function userIndex() {
        $userId = Auth::user()->id;
        $complaints = Complaint::where('user_id', $userId)->get();

        return view('user.complaint.index', compact('complaints'));
    }

    public function create()
    {
        return view('user.complaint.create-complaint');
    }


     // Store complaint for a user
     public function storeComplaint(Request $request)
     {
         // Validate the request data
         $validatedData = $request->validate([
             'complain_type' => 'required|string|max:255',
             'date_of_incident' => 'required|date',
             'details' => 'required|string|max:1000',
         ]);
 
         // Get the currently logged-in user's barangay and ID
         $userBarangayId = Auth::user()->barangay_id;
         $userId = Auth::user()->id;
 
         // Create a new complaint
         $complaint = new Complaint($validatedData);
         $complaint->user_id = $userId;  // Associate complaint with user
         $complaint->barangay_id = $userBarangayId;  // Associate complaint with barangay
         $complaint->save();
 
         // Redirect to the user's complaint index page
         return redirect()->route('user.complaint.index')->with('success', 'Complaint filed successfully.');
     }

     public function barangayComplaints(Request $request)
     {
         $barangayId = Auth::user()->barangay_id;
     
         // Get the search query from the request
         $search = $request->input('search');
     
         // Retrieve complaints that belong to the user's barangay
         // Apply search filtering if a search term is provided
         $complaints = Complaint::where('barangay_id', $barangayId)
             ->when($search, function ($query) use ($search) {
                 return $query->where('complain_type', 'like', "%{$search}%")
                              ->orWhere('details', 'like', "%{$search}%"); // You can add more fields to search as needed
             })
             ->get();
     
         // Return the view with the complaints and the search term
         return view('barangay.complaints.index', compact('complaints', 'search'));
     }
     
    // View a specific complaint
    public function viewComplaint(Complaint $complaint)
    {
        $complaint->load('user');
        
        return view('barangay.complaints.view', compact('complaint',));
    }

    // Reply to a specific complaint
    public function replyComplaint(Request $request, Complaint $complaint)
    {
        $validatedData = $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        // Update the complaint with the reply
        $complaint->reply = $validatedData['reply'];
        $complaint->save();

        return redirect()->route('barangay.complaints.index')->with('success', 'Reply submitted successfully.');
    }

    public function updateReply(Request $request, Complaint $complaint)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'reply' => 'required|string|max:1000',
        ]);
    
        // Update the reply
        $complaint->reply = $validatedData['reply'];
        $complaint->save();
    
        // Redirect back to the complaint view with a success message
        return redirect()->route('barangay.complaints.view', $complaint->id)->with('success', 'Reply updated successfully.');
    }
    

    
}
