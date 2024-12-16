<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Resident;
use App\Models\Household;
use Illuminate\Http\Request;
use App\Models\BarangayOfficial;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CertificateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request as HttpRequest;


class CustomCertificateController extends Controller
{

    public function create() {

        $barangayId = auth()->user()->barangay_id;

         // Retrieve user households
        $userHouseholds = Household::where('user_id', auth()->id())->pluck('id');
    
        // Retrieve residents belonging to these households
        $residents = Resident::whereHas('householdMembers', function ($query) use ($userHouseholds) {
            $query->whereIn('household_id', $userHouseholds);
        })->get();

        return view('certificates.indexTemplate', compact('residents'));
    }

    public function createTemplate(Request $request)
    {
        $resident = Resident::findOrFail($request->resident_id);
        return view('certificates.createTemplate', compact('resident'));
    }

    public function submit(Request $request)
    {
        $barangayId = Auth::user()->barangay_id;
    
        $validated = $request->validate([
            'certificate_name' => 'required|string|max:255',
            'purpose' => 'required|string',
            'secondpurpose' => 'nullable|string',
            'date_needed' => 'required|date',
            'resident_id' => 'required|exists:residents,id',
        ]);
    
        $certificateRequest = CertificateRequest::create([
            'user_id' => auth()->id(),
            'resident_id' => $validated['resident_id'],
            'certificate_name' => $validated['certificate_name'],
            'purpose' => $validated['purpose'],
            'secondpurpose' => $validated['secondpurpose'], // Corrected to use secondpurpose
            'date_needed' => $validated['date_needed'],
        ]);
    
        // Passing the data to the session for confirmation
        return redirect()->back()->with('success', 'Certificate request submitted successfully.')
                                 ->with('certificate', [
                                     'certificate_name' => $validated['certificate_name'],
                                     'date_needed' => $validated['date_needed'],
                                 ]);
    }
    
    
    public function indexCustom()
    {
        $barangayId = auth()->user()->barangay_id;

        $customCert = CertificateRequest::whereHas('resident', function ($query) use ($barangayId) {
            $query->where('barangay_id', $barangayId);
        })->get();

        $latestRequests = $customCert->whereNull('downloaded_at')->sortByDesc('created_at')->take(5);

        $downloadedRequests = $customCert->filter(function ($request) {
            return !is_null($request->downloaded_at);
        })->sortByDesc('downloaded_at');

        return view('certificates.custom', compact('latestRequests', 'downloadedRequests'));
    }

    
    

    

    public function downloadCustomCertificatePDF(Request $request, $certificateId)
    {
        // Retrieve the custom certificate with resident relationship
        $customCert = CertificateRequest::with('resident')->findOrFail($certificateId);
    
        // Retrieve Barangay details and officials
        $barangay = Barangay::findOrFail($customCert->resident->barangay_id);
        $barangayOfficials = BarangayOfficial::where('barangay_id', $barangay->id)->get();
    
        // Ensure the certificate has the required details
        $certificateName = $customCert->certificate_name ?? 'Custom Certificate';
        $purpose = $customCert->purpose ?? null;
        $secondpurpose = $customCert->secondpurpose ?? null; // Default to null if not set
        $or_number = $customCert->or_number ?? 'None';
    
        // Data to pass to the view
        $pdfData = [
            'certificateName' => $certificateName,
            'purpose' => $purpose,
            'secondpurpose' => $secondpurpose,
            'or_number' => $or_number,
            'resident' => $customCert->resident, // Resident data
            'barangay' => $barangay, // Barangay details
            'barangayOfficials' => $barangayOfficials, // Barangay officials list
            'barangayLogo' => public_path('storage/images/' . $barangay->logo), // Barangay logo path
        ];
    
        // Define the single Blade template for custom certificates
        $view = 'barangay.certificates.custom-cert-pdf';
    
        // Check if the view exists
        if (!view()->exists($view)) {
            abort(404, "The view for custom certificates does not exist.");
        }
    
        // Generate the PDF
        $pdf = Pdf::loadView($view, $pdfData);

        // Mark as downloaded (if it hasn't been marked already)
        if (!$customCert->downloaded_at) {
            $customCert->downloaded_at = now();
            $customCert->save();
        }
        
        // Stream the PDF to the browser for printing
        return $pdf->stream('custom_certificate.pdf');
    }

    // public function edit($id)
    // {
    //     $certificateRequest = CertificateRequest::findOrFail($id);
    //     return view('barangay.certificates.edit', compact('certificateRequest'));
    // }
        // Update the certificate request
    
        public function update(HttpRequest $request, $id)
    {
        // Validate the data
        $validated = $request->validate([
            'or_number' => 'required|string|max:50',
        ]);
    
        // Find the certificate request by ID and update it
        $certificateRequest = CertificateRequest::findOrFail($id);
        $certificateRequest->or_number = $request->input('or_number');
        $certificateRequest->save();
    
        return redirect()->route('certificates.indexCustom')->with('success', 'Certificate request updated successfully!');
    }
    


}
