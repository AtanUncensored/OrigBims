<?php

namespace App\Http\Controllers;


use App\Models\Resident;
use App\Models\User;
use App\Models\Purok;
use App\Models\Household;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Export\ResidentDataExport;
use Carbon\Carbon;

class ResidentController extends Controller
{

    public function index(Request $request)
    {
        // Get the currently logged-in user's barangay_id
        $userBarangayId = Auth::user()->barangay_id;
    
        // Get the search query from the request
        $search = $request->input('search');
    
        // Get the selected filter values (Purok, Gender, Age, and Is Alive)
        $purokFilter = $request->input('purok_filter');
        $genderFilter = $request->input('gender_filter');
        $ageFilter = $request->input('age_filter'); // Get the selected age filter
        $isAliveFilter = $request->input('is_alive_filter'); // Get the selected "Is Alive" filter
    
        // Get the available households and users based on the logged-in user's barangay
        $households = Household::whereHas('user', function ($query) use ($userBarangayId) {
            $query->where('barangay_id', $userBarangayId);
        })->get();
    
        $puroks = Purok::where('barangay_id', $userBarangayId)->get();
    
        $users = User::where('barangay_id', $userBarangayId)->get();
    
        // Build the query for residents
        $residentsQuery = Resident::where('barangay_id', $userBarangayId);
    
        // Apply search filtering if a search term is provided
        if ($search) {
            $residentsQuery->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%");
            });
        }
    
        // Apply Purok filter if selected
        if ($purokFilter) {
            $residentsQuery->where('purok_id', $purokFilter);
        }
    
        // Apply Gender filter if selected
        if ($genderFilter) {
            $residentsQuery->where('gender', $genderFilter);
        }
    
        // Apply Age filter if selected
        if ($ageFilter) {
            switch ($ageFilter) {
                case 'children':
                    $residentsQuery->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 0 AND 12');
                    break;
                case 'teens':
                    $residentsQuery->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 13 AND 19');
                    break;
                case 'adults':
                    $residentsQuery->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 20 AND 39');
                    break;
                case 'middle_aged':
                    $residentsQuery->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 40 AND 59');
                    break;
                case 'senior':
                    $residentsQuery->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 60');
                    break;
            }
        }
    
        // Apply "Is Alive" filter if selected
        if ($isAliveFilter !== null) {
            $residentsQuery->where('is_alive', $isAliveFilter);
        }
    
        // Order residents by is_alive (alive first) and then by last name
        $residents = $residentsQuery->orderByRaw('is_alive DESC')  // Order by is_alive (1 first, 0 later)
                                   ->orderBy('last_name')       // Then order by last_name alphabetically
                                   ->get()
                                   ->map(function ($resident) {
                                       // Calculate the age based on birth_date
                                       $resident->age = Carbon::parse($resident->birth_date)->age;
                                       return $resident;
                                   });
    
        // Return the view with the residents and filter data
        return view('barangay.residents.index', compact('residents', 'search', 'puroks', 'households', 'users', 'purokFilter', 'genderFilter', 'ageFilter', 'isAliveFilter'));
    }
    


    public function exportExcel(Request $request)
    {
        $barangayId = auth()->user()->barangay_id;
    
        // Get the filter values from the request
        $search = $request->input('search');
        $purokFilter = $request->input('purok_filter');
        $genderFilter = $request->input('gender_filter');
        $ageFilter = $request->input('age_filter');
        $isAliveFilter = $request->input('is_alive_filter');
    
        // Pass the filtered values to the export class
        return Excel::download(new ResidentDataExport(
            $barangayId, $search, $purokFilter, $genderFilter, $ageFilter, $isAliveFilter
        ), 'residents.xlsx');
    }
    


    
}
