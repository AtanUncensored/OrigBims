@extends('user.templates.navigation-bar')

@section('title', 'Request Certificate')

@section('content')
<div class="flex justify-center items-center">
    <div class="px-4 bg-white overflow-y-auto max-h-[500px] w-[900px]">
        <div class="flex justify-center pt-[50px] items-center mb-[25px]">
            <div class="logo">
                <img style="width: 120px; height:auto"
                    src="{{ asset('storage/' . (strpos(Auth::user()->barangay->logo, 'images/') === false ? 'images/' . Auth::user()->barangay->logo : Auth::user()->barangay->logo)) }}" 
                    alt="barangay/lgu logo">
            </div>
        
            <!-- Certificate Header -->
            <div class="heading text-center mt-[50px]">
                <header>Republic of the Philippines</header>
                <header>Province of Bohol</header>
                <header>Municipality of Tubigon</header>
                <header class="barangay-name uppercase font-semibold">BARANGAY OF {{ $barangay->barangay_name }}</header>
                <br>
                <header class="font-semibold">OFFICE OF THE PUNONG BARANGAY</header>
            </div>
        </div>

        <!-- Success Message -->
      @if(session('success'))
    <div id="successModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg relative w-[90%] sm:w-[400px]">
            <div class="text-center text-green-500 font-semibold mb-4">
                {{ session('success') }}
            </div>
            <!-- Close Button -->
            <div class="flex justify-end">
                <button id="closeSuccessModal" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-lg mt-4">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        // Show the success modal
        document.getElementById('successModal').classList.remove('hidden');
        
        // Close the modal when the close button is clicked
        document.getElementById('closeSuccessModal').addEventListener('click', function() {
            document.getElementById('successModal').classList.add('hidden');
        });

        // Hide the modal after 10 seconds (10000ms)
        setTimeout(function() {
            const successModal = document.getElementById('successModal');
            if (successModal) {
                successModal.classList.add('hidden');
            }
        }, 10000); // Set this to 10000 for 10 seconds
    </script>
@endif

<!-- Confirmation Modal Section -->
@if(session('certificate'))
    <div id="confirmationModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg relative w-[90%] sm:w-[400px]">
            <h2 class="font-semibold text-lg text-blue-600">Certificate Request Submitted Successfully</h2>
            <h2 class="font-semibold text-lg">It is now being processed and checked</h2>
            <p><strong>Certificate Name:</strong> {{ session('certificate.certificate_name') }}</p>
            <p><strong>You can get it on:</strong>{{ session('certificate.date_needed') }} Working Hours</p>
            <!-- Close Button -->
            <div class="flex justify-end">
                <button id="closeConfirmationModal" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-lg mt-4">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        // Show the confirmation modal
        document.getElementById('confirmationModal').classList.remove('hidden');
        
        // Close the modal when the close button is clicked
        document.getElementById('closeConfirmationModal').addEventListener('click', function() {
            document.getElementById('confirmationModal').classList.add('hidden');
        });

        // Hide the modal after 10 seconds (10000ms)
        setTimeout(function() {
            const confirmationModal = document.getElementById('confirmationModal');
            if (confirmationModal) {
                confirmationModal.classList.add('hidden');
            }
        }, 10000); // Set this to 10000 for 10 seconds
    </script>
@endif


        <!-- Certificate Information Section -->
        <div class="custom-form-container bg-white p-6 rounded-lg shadow-md mx-auto w-full max-w-3xl">
            <form id="certificateForm" action="{{ route('certificates.customized.submit') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="resident_id" value="{{ $resident->id }}">
        
                <!-- Certificate Name Input -->
                <div class="flex justify-center">
                    <input type="text" 
                           name="certificate_name" 
                           class="border border-gray-300 rounded-md py-2 px-4 font-bold uppercase text-xl w-full max-w-md" 
                           placeholder="Certificate Name" 
                           required>
                </div>
        
                <!-- TO WHOM IT MAY CONCERN -->
                <p class="font-semibold text-lg">TO WHOM IT MAY CONCERN:</p>
        
                <!-- Certification Details -->
                <div class="text-gray-800 leading-relaxed">
                    <p>
                        This is to certify that 
                        <span class="font-semibold uppercase">
                            {{ $resident->first_name }} {{ $resident->last_name }} {{ $resident->suffix }}
                        </span>, 
                        {{ \Carbon\Carbon::parse($resident->birth_date)->age }} years old,
                        {{ $resident->gender }}, {{ $resident->civil_status }}, is a bona fide 
                    </p>
                    <p>resident of Purok {{ $resident->purok->purok_number }}, Barangay {{ $barangay->barangay_name }}, Tubigon, Bohol.</p>
                </div>
        
                <!-- Purpose -->
                <div>
                    <textarea name="purpose" 
                    placeholder="Enter the purpose of the request here..." 
                    class="border border-gray-300 rounded-md py-2 px-4 w-full mt-2 h-48 resize-none" 
                    required></textarea>
      
                    <!-- Second input field for 2nd Purpose -->
                    <textarea name="secondpurpose" 
                    placeholder="Enter the purpose of the request here..." 
                    class="border border-gray-300 rounded-md py-2 px-4 w-full mt-4 h-48 resize-none" 
                    ></textarea>
            
                </div>
        
                <!-- Date -->
                <div class="text-gray-800">
                    <p>
                        Issued this day of 
                        <input type="date" 
                               name="date_needed" 
                               class="border border-gray-300 rounded-md py-1 px-2" 
                               value="{{ now()->format('Y-m-d') }}" 
                               required>
                        at Barangay {{ $barangay->barangay_name }}, Tubigon, Bohol, Philippines.
                    </p>
                </div>
        
                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="button" onclick="showConfirmationModal()" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg">
                        Submit
                    </button>
                </div>
            </form>
        </div>        
        
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmationModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white w-[90%] sm:w-[400px] p-6 rounded-lg shadow-lg relative">
        <div class="flex items-center mb-4">
            <img src="{{ asset('storage/' . (strpos($barangay->logo, 'images/') === false ? 'images/' . $barangay->logo : $barangay->logo)) }}" 
                alt="Barangay Logo" 
                class="w-12 h-12 sm:w-14 sm:h-14 object-cover rounded-full mr-3">
            <h3 class="text-lg sm:text-xl font-semibold text-blue-600">Confirm Your Request</h3>
        </div>
        <hr class="border-t-2 border-blue-200 mb-4">
        <p id="modalDetails" class="text-sm sm:text-base text-gray-700 leading-relaxed"></p>
        <div class="flex justify-end mt-6">
            <button id="cancelRequest" onclick="closeConfirmationModal()" 
                class="bg-gray-500 hover:bg-gray-600 text-white text-sm sm:text-base px-4 py-2 rounded-lg mr-2 transition duration-300">
                Cancel
            </button>
            <button id="confirmRequest" onclick="submitForm()" 
                class="bg-blue-500 hover:bg-blue-600 text-white text-sm sm:text-base px-4 py-2 rounded-lg transition duration-300">
                Confirm
            </button>
        </div>
    </div>
</div>

<script>
    // Show the modal with the certificate details
    function showConfirmationModal() {
        const residentName = "{{ $resident->first_name }} {{ $resident->last_name }} {{ $resident->suffix }}";
        const certificateName = document.querySelector('input[name="certificate_name"]').value;
        
        // Set the details to display in the modal
        document.getElementById('modalDetails').innerText = `
            Are you sure you want to request the certificate: "${certificateName}" for ${residentName}?
        `;

        // Show the modal
        document.getElementById('confirmationModal').classList.remove('hidden');
    }

    // Close the confirmation modal
    function closeConfirmationModal() {
        document.getElementById('confirmationModal').classList.add('hidden');
    }

    // Submit the form
    function submitForm() {
        document.getElementById('certificateForm').submit();
    }
</script>
@endsection
