<?php

namespace App\Http\Controllers;

use App\Models\CertificateType;
use App\Models\Household;
use App\Models\HouseholdMember;
use App\Models\Request as CertificateRequest;
use App\Models\Resident;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;


class CertificateRequestController extends Controller
{
    public function create()
    {
        // get sa ang user 
        $userHouseholds = Household::where('user_id', Auth::id())->pluck('id');
    
        //sa mga resident nani sa household
        $residents = Resident::whereHas('householdMembers', function ($query) use ($userHouseholds) {
            $query->whereIn('household_id', $userHouseholds);
        })->get();
    
        $certificateTypes = CertificateType::all();
    
        return view('certificates.request-form', compact('residents', 'certificateTypes'));
    }

    public function store(HttpRequest $request)
{
    // Validate input
    $validated = $request->validate([
        'resident_id' => 'required|exists:residents,id',
        'certificate_type_id' => 'required|exists:certificate_types,id',
        'requester_name' => 'nullable|string|max:255',
        'purpose' => 'nullable|string|max:255',
        'date_needed' => 'nullable|date',
        'business_name' => 'nullable|required_if:certificate_type_id,6|string|max:255',
        'monthly_ave_income' => 'nullable|required_if:certificate_type_id,5|numeric',
        'witness_by' => 'nullable|required_if:certificate_type_id,2|string|max:255',


    ]);

    // Fetch resident details
    $resident = Resident::find($validated['resident_id']);
    $fullName = $resident->first_name . ' ' . $resident->last_name . ' ' . $resident->suffix;
    $birthDate = $resident->birth_date;
    $age = Carbon::parse($birthDate)->age;

    $barangayId = Auth::user()->barangay_id;

    // Generate a unique reference number
    $referenceNumber = 'BRGY-' . strtoupper(Str::random(6)) . '-' . now()->format('YmdHis');

    // Prepare data for the certificate request
    $certificateRequestData = [
        'user_id' => Auth::user()->id,
        'resident_id' => $validated['resident_id'],
        'certificate_type_id' => $validated['certificate_type_id'],
        'requester_name' => $validated['requester_name'] ?? Auth::user()->name,
        'purpose' => $validated['purpose'],
        'or_number' => null,
        'date_needed' => $validated['date_needed'],
        'barangay_id' => $barangayId,
        'reference_number' => $referenceNumber,
    ];

    // Include business name if required
    if ($validated['certificate_type_id'] == 6 && isset($validated['business_name'])) {
        $certificateRequestData['business_name'] = $validated['business_name'];
    }
    // Include monthly average low income if the certificate type is low income
    if ($validated['certificate_type_id'] ==  5 && isset($validated['monthly_ave_income'])) {
        $certificateRequestData['monthly_ave_income'] = $validated['monthly_ave_income'];
    }
    if ($validated['certificate_type_id'] ==  2 && isset($validated['witness_by'])) {
        $certificateRequestData['witness_by'] = $validated['witness_by'];
    }

    // Save Certificate Request
    $certificateRequest = CertificateRequest::create($certificateRequestData);
    $requestId = $certificateRequest->id; 

    // Determine the certificate type and associated table
    $certificateType = CertificateType::find($validated['certificate_type_id']);
    $tableName = $certificateType->table_name;

    // Prepare common data for specific certificate tables
    $commonData = [
        'user_id' => Auth::user()->id,
        'resident_id' => $validated['resident_id'],
        'name' => $fullName,
        'age' => $age,
        'civil_status' => $resident->civil_status,
        'gender' => $resident->gender,
        'created_at' => now(),
        'updated_at' => now(),
    ];

    // Insert into specific tables based on certificate type
    if (in_array($tableName, ['cert_indigencies', 'cert_job_seekers', 'cert_unifast', 'cert_low_income', 'cert_business'])) {
        $businessSpecificData = $tableName == 'cert_business'
            ? ['business_name' => $validated['business_name']]
            : [];
        $lowIncomeSpecificData = $tableName == 'cert_low_income'
        ? ['monthly_ave_income' => $validated['monthly_ave_income']]
        : [];
        $jobseekerSpecificData = $tableName == 'cert_job_seekers'
        ? ['witness_by' => $validated['witness_by']]
        : [];
        DB::table($tableName)->insert(array_merge($commonData, $businessSpecificData, $lowIncomeSpecificData, $jobseekerSpecificData));
    } elseif ($tableName == 'cert_residences') {
        DB::table($tableName)->insert(array_merge($commonData, [
            'date' => now(),
        ]));
    }

    // Adjust date_needed to be 3 minutes earlier
    $adjustedDate = $validated['date_needed']
        ? Carbon::parse($validated['date_needed'])->subMinutes(3)->toDateTimeString()
        : null;

    // Return with success data
    return redirect()->back()->with('success', [
        'message' => "You have successfully requested a {$certificateType->certificate_name} certificate.",
        'adjusted_date' => $adjustedDate,
        'reference_number' => $referenceNumber,
    ]);
}


    


//     public function edit($id)
// {
//     $certificateRequest = CertificateRequest::findOrFail($id);
//     return view('barangay.certificates.edit', compact('certificateRequest'));
// }
    // Update the certificate request

    public function update(HttpRequest $request, $id)
{
    // Validate the data
    $validated = $request->validate([
        'purpose' => 'required|string|max:255',
        'or_number' => 'required|string|max:50',
    ]);

    // Find the certificate request by ID and update it
    $certificateRequest = CertificateRequest::findOrFail($id);
    $certificateRequest->purpose = $request->input('purpose');
    $certificateRequest->or_number = $request->input('or_number');
    $certificateRequest->save();

    return redirect()->route('certificates.index')->with('success', 'Certificate request updated successfully!');
}

}