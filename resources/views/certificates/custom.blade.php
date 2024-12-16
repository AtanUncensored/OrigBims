@extends('barangay.templates.navigation-bar')

@section('title', 'Request Certificate')

@section('content')

<div class="container px-4 py-8">
    <!-- Latest Requests Section -->
    <div class="bg-white shadow-lg rounded-lg py-4 px-6 mb-6">
        <h2 class="text-xl font-bold text-blue-500 mb-3 uppercase">Latest Custom Certificate Requests</h2>

        @if ($latestRequests->isNotEmpty())
            <div class="max-h-[70vh] overflow-y-auto">
                <table class="w-full table-auto border border-gray-200 rounded-md">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Certificate Name</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Full Name</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Gender</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Purpose</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Date Needed</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">OR number</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($latestRequests as $cusCert)
                            <tr class="border-b hover:bg-gray-50 transition duration-200">
                                <td class="px-4 py-2">{{ $cusCert->certificate_name }}</td>
                                <td class="px-4 py-2">{{ $cusCert->resident->first_name }}</td>
                                <td class="px-4 py-2">{{ $cusCert->resident->gender }}</td>
                                <td class="px-4 py-2">{{ Str::limit($cusCert->purpose, 10, '....') }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($cusCert->date_needed)->format('F j, Y') }}</td>
                                <td class="px-4 py-2 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Edit Button -->
                                        <button onclick="toggleEditModal('{{ $cusCert->id }}')" class="text-blue-600 py-1 px-2 sm:px-3 rounded hover:text-blue-800 text-sm sm:text-base">
                                            Add OR Number
                                        </button>

                                        <div id="edit-modal-{{ $cusCert->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
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
                                        
                                                <form action="{{ route('custom_certificate.update', $cusCert->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                        
                                                    <!-- OR Number Field -->
                                                        <div class="mb-4">
                                                            <label for="or_number" class="block text-sm text-left font-medium text-gray-700">OR Number</label>
                                                            <input type="number" id="or_number" name="or_number" value="{{ old('or_number', $request->or_number ?? '') }}
                                                            " class="w-full border border-gray-300 rounded-lg px-4 py-2" required />
                                                        </div>
                                            
                                                    <!-- Buttons -->
                                                    <div class="flex justify-end mt-6">
                                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mr-3">Save Changes</button>
                                                        <button type="button" onclick="toggleEditModal('{{ $cusCert->id }}')" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-2">
                                    <button 
                                        onclick="printCertificate('{{ route('custom-certificate.download', [
                                            'certificateId' => $cusCert->id,
                                            'requesterName' => str_replace(' ', '_', $cusCert->resident->first_name),
                                            'certificateType' => str_replace(' ', '_', $cusCert->certificate_name),
                                            'date' => \Carbon\Carbon::parse($cusCert->created_at)->format('Y-m-d'),
                                        ]) }}')"
                                        class="btn-print bg-green-500 text-white hover:bg-green-700 px-6 py-2 rounded-full text-sm">
                                        Download
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-gray-500 mt-4">No new custom certificate requests found.</p>
        @endif
    </div>

    <!-- Downloaded Requests Section -->
    <div class="bg-white shadow-lg rounded-lg py-4 px-6">
        <h2 class="text-xl font-bold text-gray-600 mb-3 uppercase">Downloaded Custom Certificate Requests</h2>

        @if ($downloadedRequests->isNotEmpty())
            <div class="max-h-[70vh] overflow-y-auto">
                <table class="w-full table-auto border border-gray-200 rounded-md">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Certificate Name</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Full Name</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Gender</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Purpose</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Date Needed</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Downloaded At</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">OR number</th>
                            <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-left text-xs">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($downloadedRequests as $cusCert)
                            <tr class="border-b hover:bg-gray-50 transition duration-200">
                                <td class="px-4 py-2">{{ $cusCert->certificate_name }}</td>
                                <td class="px-4 py-2">{{ $cusCert->resident->first_name }}</td>
                                <td class="px-4 py-2">{{ $cusCert->resident->gender }}</td>
                                <td class="px-4 py-2">{{ Str::limit($cusCert->purpose, 10, '....') }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($cusCert->date_needed)->format('F j, Y') }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($cusCert->downloaded_at)->format('F j, Y') }}</td>
                                <td class="px-4 py-2 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Edit Button -->
                                        <button onclick="toggleEditModal('{{ $cusCert->id }}')" class="text-blue-600 py-1 px-2 sm:px-3 rounded hover:text-blue-800 text-sm sm:text-base">
                                            Add OR Number
                                        </button>

                                        <div id="edit-modal-{{ $cusCert->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
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
                                        
                                                <form action="{{ route('custom_certificate.update', $cusCert->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                        
                                                    <!-- OR Number Field -->
                                                        <div class="mb-4">
                                                            <label for="or_number" class="block text-sm text-left font-medium text-gray-700">OR Number</label>
                                                            <input type="number" id="or_number" name="or_number" value="{{ old('or_number', $request->or_number ?? '') }}
                                                            " class="w-full border border-gray-300 rounded-lg px-4 py-2" required />
                                                        </div>
                                            
                                                    <!-- Buttons -->
                                                    <div class="flex justify-end mt-6">
                                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mr-3">Save Changes</button>
                                                        <button type="button" onclick="toggleEditModal('{{ $cusCert->id }}')" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-2">
                                    <button 
                                        onclick="printCertificate('{{ route('custom-certificate.download', [
                                            'certificateId' => $cusCert->id,
                                            'requesterName' => str_replace(' ', '_', $cusCert->resident->first_name),
                                            'certificateType' => str_replace(' ', '_', $cusCert->certificate_name),
                                            'date' => \Carbon\Carbon::parse($cusCert->downloaded_at)->format('Y-m-d'),
                                        ]) }}')"
                                        class="bg-blue-500 text-white hover:bg-blue-700 px-6 py-2 rounded-full text-sm">
                                        Redownload
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-gray-500 mt-4">No downloaded custom certificate requests found.</p>
        @endif
    </div>
</div>

<script>
    function printCertificate(url) {
        window.open(url, '_blank');
    }
    function toggleEditModal(requestId) {
        const modal = document.getElementById(`edit-modal-${requestId}`);
        modal.classList.toggle('hidden');
    }
</script>

@endsection
