@extends('barangay.templates.navigation-bar')

@section('title', 'Certificates')

@section('content')
<div class="container px-4">

    <div class="grid grid-rows-1 md:grid-rows-2 gap-4 max-h-[79vh] overflow-y-auto">
        
        <!-- Latest Requests Section -->
        <div class="bg-white shadow-lg rounded-lg py-2 px-4">
            <div class="flex justify-start items-center">
                <h2 class="text-xl font-bold text-blue-500 mb-3 uppercase mr-[125px]">Latest Certificate Requests:</h2>
            <form action="{{ route('certificates.index') }}" method="GET" class="mb-4 flex items-center">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    class="border rounded-l-lg px-4 py-2 w-1/5.5"
                    placeholder="Search certificates......" 
                    id="search-input"
                />
                <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-r-lg">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
            </div>
            @if($latestRequests->isEmpty())
                <div class="text-center py-16">
                    <i class="fa-solid fa-folder-open fa-3x text-muted"></i>
                    <p class="mt-3 text-muted text-gray-500">No recent certificate requests found.</p>
                </div>
            @else
                <div class="max-h-[30vh] overflow-y-auto">
                    <table class="w-full table-auto border border-[2px] border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Reference Number</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Full Name</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Certificate Type</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Purpose</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Date Needed</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">OR number</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Print</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestRequests as $request)
                                <tr class="border-b hover:bg-gray-50 transition duration-200">
                                    <td class="px-4 py-2 text-center">
                                        @if($request->reference_number)
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 font-semibold rounded-md text-sm tracking-wide">
                                                {{ $request->reference_number }}
                                            </span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-800 font-semibold rounded-md text-sm tracking-wide">
                                                No Reference Number
                                            </span>
                                        @endif
                                    </td>
                                                                        <td class="px-4 py-2">{{ $request->full_name }}</td>
                                    <td class="px-4 py-2">{{ $request->certificate_type }}</td>
                                    <td class="px-4 py-2">{{ $request->purpose }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($request->date_needed)->format('F j, Y') }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button onclick="toggleEditModal('{{ $request->id }}')" class="text-blue-600 py-1 px-2 sm:px-3 rounded hover:text-blue-800 text-sm sm:text-base">
                                                Add OR Number
                                            </button>

                                            <div id="edit-modal-{{ $request->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                                                <!-- Edit Form -->
                                                <div class="mt-[20px] mb-6 w-[400px] mx-auto bg-white p-6 rounded shadow">
                                            
                                                    <div class="flex justify-center items-center mb-4">
                                                        <div class="flex justify-start items-center">
                                                            <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 mr-5"></i>
                                                        </div>
                                                        <div class="flex justify-center items-center">
                                                            <h1 class="text-xl font-bold text-blue-600 text-center mb-2">Edit Certificate Request</h1>
                                                        </div>
                                                        <div class="flex justify-start items-center">
                                                            <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 ml-5"></i>
                                                        </div>
                                                    </div>
                                            
                                                    <hr class="border-t-2 border-blue-300 mb-4">
                                            
                                                    <form action="{{ route('certificate_requests.update', $request->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                            
                                                        <!-- Purpose Field -->
                                                        <div class="mb-4">
                                                            <label for="purpose" class="block text-sm text-left font-medium text-gray-700">Purpose</label>
                                                            <input type="text" id="purpose" name="purpose" value="{{ old('purpose', $request->purpose) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1" required>
                                                        </div>
                                            
                                                        <!-- OR Number Field -->
                                                            <div class="mb-4">
                                                                <label for="or_number" class="block text-sm text-left font-medium text-gray-700">OR Number</label>
                                                                <input type="number" id="or_number" name="or_number" value="{{ old('or_number', $request->or_number ?? '') }}
                                                                " class="w-full border border-gray-300 rounded-lg px-4 py-2" required />
                                                            </div>
                                                
                                                        <!-- Buttons -->
                                                        <div class="flex justify-end mt-6">
                                                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mr-3">Save Changes</button>
                                                            <button type="button" onclick="toggleEditModal('{{ $request->id }}')" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                                                Cancel
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2">
                                         <!-- Print Button -->
                                         <button 
                                         onclick="printCertificate('{{ route('certificate.download', [
                                             'certificateId' => $request->id,
                                             'requesterName' => str_replace(' ', '_', $request->requester_name),
                                             'certificateType' => str_replace(' ', '_', $request->certificate_type),
                                             'date' => \Carbon\Carbon::parse($request->created_at)->format('Y-m-d'),
                                         ]) }}')"
                                         class="btn-print text-white hover:bg-green-200 px-6 py-2 rounded-full text-sm ml-2">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="black" class="bi bi-printer" viewBox="0 0 18 18">
                                             <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                             <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                                         </svg>
                                     </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Downloaded Requests Section -->
        <div class="bg-white shadow-lg rounded-lg py-2 px-4">
            <h2 class="text-xl font-bold text-blue-500 mb-3 uppercase">Downloaded Certificate Requests:</h2>
            @if($downloadedRequests->isEmpty())
                <div class="text-center py-16">
                    <i class="fa-solid fa-folder-open fa-3x text-muted"></i>
                    <p class="mt-3 text-muted text-gray-500">No downloaded certificate requests found.</p>
                </div>
            @else
                <div class="max-h-[30vh] overflow-y-auto">
                    <table class="w-full table-auto border border-[2px] border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Reference Number</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Full Name</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Certificate Type</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Purpose</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Date Needed</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">OR number</th>
                                <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Print</th>                            </tr>
                        </thead>
                        <tbody>
                            @foreach($downloadedRequests as $request)
                                <tr class="border-b hover:bg-gray-50 transition duration-200">
                                    <td class="px-4 py-2 text-center">
                                        @if($request->reference_number)
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 font-semibold rounded-md text-sm tracking-wide">
                                                {{ $request->reference_number }}
                                            </span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-800 font-semibold rounded-md text-sm tracking-wide">
                                                No Reference Number
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <td class="px-4 py-2">{{ $request->full_name }}</td>
                                    <td class="px-4 py-2">{{ $request->certificate_type }}</td>
                                    <td class="px-4 py-2">{{ $request->purpose }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($request->date_needed)->format('F j, Y') }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Edit Button -->
                                            <button onclick="toggleEditModal('{{ $request->id }}')" class="text-blue-600 py-1 px-2 sm:px-3 rounded hover:text-blue-800 text-sm sm:text-base">
                                                Add OR Number
                                            </button>

                                            <div id="edit-modal-{{ $request->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                                                <!-- Edit Form -->
                                                <div class="mt-[20px] mb-6 w-[400px] mx-auto bg-white p-6 rounded shadow">
                                            
                                                    <div class="flex justify-center items-center mb-4">
                                                        <div class="flex justify-start items-center">
                                                            <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 mr-5"></i>
                                                        </div>
                                                        <div class="flex justify-center items-center">
                                                            <h1 class="text-xl font-bold text-blue-600 text-center mb-2">Edit Certificate Request</h1>
                                                        </div>
                                                        <div class="flex justify-start items-center">
                                                            <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 ml-5"></i>
                                                        </div>
                                                    </div>
                                            
                                                    <hr class="border-t-2 border-blue-300 mb-4">
                                            
                                                    <form action="{{ route('certificate_requests.update', $request->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                            
                                                        <!-- Purpose Field -->
                                                        <div class="mb-4">
                                                            <label for="purpose" class="block text-sm text-left font-medium text-gray-700">Purpose</label>
                                                            <input type="text" id="purpose" name="purpose" value="{{ old('purpose', $request->purpose) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1" required>
                                                        </div>
                                            
                                                        <!-- OR Number Field -->
                                                            <div class="mb-4">
                                                                <label for="or_number" class="block text-sm text-left font-medium text-gray-700">OR Number</label>
                                                                <input type="number" id="or_number" name="or_number" value="{{ old('or_number', $request->or_number ?? '') }}
                                                                " class="w-full border border-gray-300 rounded-lg px-4 py-2" required />
                                                            </div>
                                                
                                                        <!-- Buttons -->
                                                        <div class="flex justify-end mt-6">
                                                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mr-3">Save Changes</button>
                                                            <button type="button" onclick="toggleEditModal('{{ $request->id }}')" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                                                Cancel
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2">
                                        <!-- Print Button -->
                                        <button 
                                        onclick="printCertificate('{{ route('certificate.download', [
                                            'certificateId' => $request->id,
                                            'requesterName' => str_replace(' ', '_', $request->requester_name),
                                            'certificateType' => str_replace(' ', '_', $request->certificate_type),
                                            'date' => \Carbon\Carbon::parse($request->created_at)->format('Y-m-d'),
                                        ]) }}')"
                                        class="btn-print text-white hover:bg-green-200 px-6 py-2 rounded-full text-sm ml-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="black" class="bi bi-printer" viewBox="0 0 18 18">
                                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                                        </svg>
                                    </button>
                                   </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</div>

<script>
    // Function to print certificates
    function printCertificate(url) {
        window.open(url, '_blank');
    }

    window.onload = function() {
        document.getElementById('search-input').value = ''; // Clear the input field
    };

    
    function toggleEditModal(requestId) {
        const modal = document.getElementById(`edit-modal-${requestId}`);
        modal.classList.toggle('hidden');
    }
</script>

@endsection
