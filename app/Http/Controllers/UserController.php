<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Purok;
use App\Models\BarangayOfficial;
use Illuminate\Http\Request;
use App\Events\Userlog;
use App\Models\Budget;
use App\Models\Resident;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();
        
        // Assuming the user model has a `barangay_id` property
        $barangayId = $user->barangay_id;
        
        // Fetch data for the user's barangay
        $totalResidents = Resident::where('barangay_id', $barangayId)->count();
        $marriedCount = Resident::where('barangay_id', $barangayId)
                                ->where('civil_status', 'Married')
                                ->count();
        $seniorCitizensCount = Resident::where('barangay_id', $barangayId)
                                        ->whereDate('birth_date', '<=', now()->subYears(60))
                                        ->count();
        $youthCount = Resident::where('barangay_id', $barangayId)
                               ->whereDate('birth_date', '>', now()->subYears(18))
                               ->count();

        $barangayOfficials = BarangayOfficial::where('barangay_id', $barangayId)->get();

        $puroks = Purok::where('barangay_id', $barangayId)->get();

        return view('user.dashboard', compact('totalResidents', 'marriedCount', 'seniorCitizensCount', 'youthCount', 'barangayOfficials', 'puroks'));
    }

    public function showBudgetReports()
    {
        // Get the currently logged-in user's barangay
        $userBarangayId = Auth::user()->barangay_id;

        // Fetch budget reports belonging to the user's barangay
        $budgetReports = Budget::where('barangay_id', $userBarangayId)->get();

        // Return the view with the budget reports for the user
        return view('user.index', ['budgetReports' => $budgetReports]);
    }

    public function deleteUser(Request $request, $user_id)
    {

            $user = User::where('id', $user_id)
                ->where('barangay_id', Auth::user()->barangay_id) 
                ->firstOrFail();
            $user->delete();

            $log_entry = 'Admin Deleted ' . $user->name . ' a user with an ID of ' . $user->id;
        event(new UserLog($log_entry));

            return redirect()->route('barangay.user.index')->with('success', 'User deleted successfully.');
    }
}

