<?php

namespace App\Http\Controllers;

use App\Models\Household;
use App\Models\HouseholdMember;
use App\Models\Barangay;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LguController extends Controller
{
    public function index()
    {
        // Get all barangays with the count of users in each
        $barangays = Barangay::withCount('users')->orderBy('barangay_name', 'asc')->get();

        // Initialize counters
        $totalUsers = $totalAdults = $totalSeniors = $totalYouth = $totalChildren = 0;
        $totalMales = $totalFemales = $marriedCount = 0;
        $householdCount = 0;

        // Loop through each barangay
        foreach ($barangays as $barangay) {
            // Retrieve residents based on the current barangay
            $residents = Resident::where('barangay_id', $barangay->id)->get();

            // Count total users
            $totalUsers += $residents->count();

            // Count males and females
            $totalMales += $residents->where('gender', 'male')->count();
            $totalFemales += $residents->where('gender', 'female')->count();

            // Count married residents
            $marriedCount += $residents->where('civil_status', 'Married')->count();

            // Count households
            $householdCount = Household::get()->count();
            

            // Loop through residents and calculate age-based statistics
            $residents->each(function ($resident) use (&$totalAdults, &$totalSeniors, &$totalYouth, &$totalChildren) {
                // Calculate age once
                $age = \Carbon\Carbon::parse($resident->birth_date)->age;

                // Age group calculations
                if ($age >= 18 && $age < 60) {
                    $totalAdults++;
                }
                if ($age >= 60) {
                    $totalSeniors++;
                }
                if ($age >= 15 && $age < 30) {
                    $totalYouth++;
                }
                if ($age < 15) {
                    $totalChildren++;
                }
            });
        }

        // Return the view with the calculated data
        return view('lgu.dashboard', compact('barangays', 'totalUsers', 'totalMales', 'totalFemales', 'totalAdults', 'totalSeniors', 'totalYouth', 'totalChildren', 'marriedCount', 'householdCount', 'totalUsers'));
    }
        public function createBarangay()
    {
        return view('lgu.create-barangay');
    }
    public function storeBarangay(Request $request)
{
    $request->validate([
        'barangay_name' => 'required|string|max:255|unique:barangays,barangay_name',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $barangay = new Barangay();
    $barangay->barangay_name = $request->barangay_name;

    // Sanitize the barangay name for file naming (slugify)
    $barangayNameSlug = strtolower(str_replace(' ', '-', $request->barangay_name));

    // Handle the logo upload
    if ($request->has('logo')) {
        $logoFile = $request->file('logo');
        $extension = $logoFile->getClientOriginalExtension(); // Get the original extension
        $logoFileName = $barangayNameSlug . '-logo.' . $extension; // Keep original extension

        // Store the file in the 'public/images' directory
        $logoFile->move(public_path('storage/images'), $logoFileName);
        $barangay->logo = 'images/' . $logoFileName; // Save relative path
    }

    // Handle the background image upload
    if ($request->has('background_image')) {
        $backgroundFile = $request->file('background_image');
        $extension = $backgroundFile->getClientOriginalExtension(); // Get the original extension
        $backgroundFileName = $barangayNameSlug . '.' . $extension; // Keep original extension

        // Store the file in the 'public/images' directory
        $backgroundFile->move(public_path('storage/images'), $backgroundFileName);
        $barangay->background_image = 'images/' . $backgroundFileName; // Save relative path
    }

    // Save the Barangay record
    $barangay->save();

    return redirect()->route('lgu.barangays-list')->with('success', 'Barangay successfully created.');
}

    




    public function barangaysList(Request $request)
    {
        // Retrieve the search query from the request
        $search = $request->input('search');    
        
        // If a search query is provided, filter the barangays based on the name
        $barangays = Barangay::when($search, function ($query, $search) {
            return $query->where('barangay_name', 'like', '%' . $search . '%');
        })->orderBy('barangay_name', 'asc')->get();
        return view('lgu.barangays-list', compact('barangays', 'search'))->with('success', 'Barangay updated successfully!');
    }

    public function show($barangayId)
    {
        // Retrieve barangay
        $barangay = Barangay::findOrFail($barangayId);
    
        // Retrieve residents based on the barangay_id
        $residents = Resident::where('barangay_id', $barangayId)->get();
    
        // Initialize counters
        $totalUsers = $residents->count();
        $totalAdults = $totalSeniors = $totalYouth = $totalChildren = 0;

        $totalMales = Resident::where('barangay_id', $barangayId)
        ->where('gender', 'Male')
        ->count();

        $totalFemales = Resident::where('barangay_id', $barangayId)
        ->where('gender', 'Female')
        ->count();

        $marriedCount = Resident::where('barangay_id', $barangayId)
        ->where('civil_status', 'Married')
        ->count();

        $household = Household::join('household_members', 'households.id', '=', 'household_members.household_id')
        ->join('residents', 'household_members.resident_id', '=', 'residents.id')
        ->where('residents.barangay_id', $barangayId)
        ->distinct('households.id') 
        ->count('households.id'); 
        
    
        // Loop through residents and calculate the statistics
        $residents->each(function($resident) use (&$totalAdults, &$totalSeniors, &$totalYouth, &$totalChildren) {

            // Calculate age once
            $age = \Carbon\Carbon::parse($resident->birth_date)->age;
    
            // Age group calculations
            if ($age >= 18 && $age < 60) {
                $totalAdults++;
            }
            if ($age >= 60) {
                $totalSeniors++;
            }
            if ($age >= 15 && $age < 30) {
                $totalYouth++;
            }
            if ($age < 15) {
                $totalChildren++;
            }
        });
    
        // Pass data to the view
        return view('lgu.barangays-show', compact('barangay', 'totalUsers', 'totalMales', 'totalFemales', 'totalAdults', 'totalSeniors', 'totalYouth', 'totalChildren', 'marriedCount', 'household'));
    }
    

    public function edit(Barangay $barangay) {
        return view('lgu.barangay-edit', compact('barangay'));
    }

    public function update(Barangay $barangay, Request $request)
{
    $request->validate([
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'barangay_name' => 'required|string|max:255',
        'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle logo update
    $logoFilename = $barangay->logo; // Preserve logo kung wala gi update
    if ($request->hasFile('logo')) {
        // Delete old logo if it exists
        $oldLogoPath = public_path('storage/images/' . $barangay->logo);
        if (file_exists($oldLogoPath)) {
            unlink($oldLogoPath);
        }


        $logoFile = $request->file('logo');
        $logoExtension = $logoFile->getClientOriginalExtension();
        $logoFilename = $barangay->logo; // Use the original filename for the new logo
        $logoFile->move(public_path('storage/images'), $logoFilename); // Overwrite file with same name
    }

    // Handle background image update
    $backgroundImageFilename = $barangay->background_image; // Preserve background kung wala gi update
    if ($request->hasFile('background_image')) {
        
        $oldBackgroundImagePath = public_path('storage/images/' . $barangay->background_image);
        if (file_exists($oldBackgroundImagePath)) {
            unlink($oldBackgroundImagePath);
        }

        // Get the original file name without time() modification
        $backgroundImageFile = $request->file('background_image');
        $backgroundImageExtension = $backgroundImageFile->getClientOriginalExtension();
        $backgroundImageFilename = $barangay->background_image; // Use the original filename for the new background image
        $backgroundImageFile->move(public_path('storage/images'), $backgroundImageFilename); // Overwrite the existing file with the same name
    }

    // Update the database
    $barangay->update([
        'barangay_name' => $request->barangay_name,
        'logo' => $logoFilename,
        'background_image' => $backgroundImageFilename,
    ]);

    return redirect()->route('lgu.barangays-list')->with('success', 'Barangay updated successfully!');
}

    
    // public function destroy(Barangay $barangay)
    // {
    //     $barangay->delete();

    //     return redirect()->route('lgu.barangays-list')->with('success', 'Barangay deleted successfully.');
    // }
    
    
    
    public function admins(Request $request)
    {
        $barangays = Barangay::orderBy('barangay_name', 'asc')->get();
    
        $adminUsersQuery = User::role('admin')
                               ->join('barangays', 'users.barangay_id', '=', 'barangays.id')
                               ->select('users.*', 'barangays.barangay_name')
                               ->orderBy('barangays.barangay_name', 'asc');
    
        if ($request->has('barangay_ids')) {
            $adminUsersQuery->whereIn('barangay_id', $request->barangay_ids);
        }
    
        $adminUsers = $adminUsersQuery->get();
    
        return view('lgu.admins', compact('adminUsers', 'barangays'));
    }    
    

    public function editAdmin(User $adminUser)
    {
        return view('lgu.admins-crud.edit-barangay-admin', compact('adminUser'));
    }

    public function updateAdmin(Request $request, User $adminUser)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $adminUser->id,
            'barangay_id' => 'nullable|exists:barangays,id',
        ]);

        $adminUser->update($request->all());

        return redirect()->route('lgu.admins')->with('success', 'Barangay Admin updated successfully.');
    }

    public function destroyAdmin(User $admin)
    {
        // Delete the admin user
        $admin->delete();

        return redirect()->route('lgu.admins')->with('success', 'Barangay Admin deleted successfully.');
    }

    public function createBarangayForm()
    {   
        $barangays = Barangay::orderBy('barangay_name','asc')->get();
        return view('lgu.create_barangay', compact('barangays'));
    }


    public function storeBarangayAdmin(Request $request)
    {
            // Validate the input fields
            $request->validate([
                'name' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'barangay_id' => $request->barangay_id,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('admin'); // Assigning the 'admin' role to the created Barangay user

        return redirect()->route('lgu.admins')->with('success', 'Barangay created successfully.');
    }

    
}

