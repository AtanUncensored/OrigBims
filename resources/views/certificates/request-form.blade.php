@extends('user.templates.navigation-bar')

@section('title', 'Request Certificate')

@section('content')

<div class="flex justify-center items-center">
    <div class="py-2 px-4 bg-white rounded-lg shadow-lg mr-4 w-[500px] ml-4 max-h-[530px] overflow-y-auto">
        <h2 class="text-xl font-bold text-blue-500 mb-4 text-center uppercase">Request Certificate</h2>
        <hr class="border-t-2 mt-3 mb-6 border-gray-300">

        <form id="requestForm" action="{{ route('certificates.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="certificate_type_id" class="block text-gray-700">Certificate Type</label>
                <select name="certificate_type_id" id="certificate_type_id" class="w-full border py-1 px-2 border-gray-400 rounded-lg" required>
                    @foreach ($certificateTypes as $certificateType)
                        <option value="{{ $certificateType->id }}" data-price="{{ $certificateType->price }}">
                            {{ $certificateType->certificate_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="resident_id" class="block text-gray-700">Select Resident</label>
                <select id="resident_id" name="resident_id" class="w-full border py-1 px-2 border-gray-400 rounded-lg" required>
                    @foreach($residents as $resident)
                        <option value="{{ $resident->id }}">{{ $resident->first_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="requester_name" class="block text-gray-700">Requester Name</label>
                <input type="text" id="requester_name" name="requester_name" class="w-full border py-1 px-2 border-gray-400 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="purpose" class="block text-gray-700">Purpose</label>
                <input type="text" id="purpose" name="purpose" class="w-full border py-1 px-2 border-gray-400 rounded-lg">
            </div>

            <!-- Mga hidden textfield -->
            <div class="mb-4 hidden" id="businessNameField">
                <label for="business_name" class="block text-gray-700">Business Name</label>
                <input type="text" id="business_name" name="business_name" class="w-full border py-1 px-2 border-gray-400 rounded-lg">
            </div>

            <div class="mb-4 hidden" id="lowIncomeField">
                <label for="monthly_ave_income" class="block text-gray-700">Monthly Average Income</label>
                <input type="text" id="monthly_ave_income" name="monthly_ave_income" class="w-full border py-1 px-2 border-gray-400 rounded-lg">
            </div>

            <div class="mb-4 hidden" id="witness_by">
                <label for="witness_by" class="block text-gray-700">Witness By:</label>
                <input type="text" id="witness_by" name="witness_by" class="w-full border py-1 px-2 border-gray-400 rounded-lg">
            </div>

            <!-- Mga hidden textfield -->

            <div class="mb-6">
                <label for="date_needed" class="block text-gray-700">Date Needed</label>
                <input type="datetime-local" id="date_needed" name="date_needed" class="w-full border py-1 px-2 border-gray-400 rounded-lg">
            </div>

            <div class="mb-4 flex justify-center items-center">
                <button type="button" id="submitRequest" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Submit Request</button>
            </div>
        </form>
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
            <button id="cancelRequest" 
                class="bg-gray-500 hover:bg-gray-600 text-white text-sm sm:text-base px-4 py-2 rounded-lg mr-2 transition duration-300">
                Cancel
            </button>
            <button id="confirmRequest" 
                class="bg-blue-500 hover:bg-blue-600 text-white text-sm sm:text-base px-4 py-2 rounded-lg transition duration-300">
                Confirm
            </button>
        </div>
    </div>
</div>

<!-- Success Modal -->
@if(session('success'))
    @php
        $successData = session('success');
        $adjustedDate = \Carbon\Carbon::parse($successData['adjusted_date'])->format('M d, Y h:i A');
    @endphp
    <div id="successModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white w-[90%] sm:w-[400px] p-6 rounded-lg shadow-lg relative">
            <div class="text-center mb-4">
                <i class="fa-solid fa-circle-check text-green-500 text-[100px]"></i>
                <h3 class="text-xl font-semibold text-green-600 mt-2">Success!</h3>
            </div>
            <p class="text-sm sm:text-base text-gray-700 text-center leading-relaxed">
                {{ $successData['message'] }}<br>
                <span class="block mt-4 text-red-600 font-bold text-lg">
                    Reference Number:
                </span>
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-lg p-2 mt-2 text-center text-lg">
                    {{ $successData['reference_number'] }}
                </div>
                <small class="block text-gray-500 mt-2">
                    Please take a screenshot of this number to present when you get the certificate in the barangay hall.
                </small>
                <br>
                You can get it on: <strong>{{ $adjustedDate }}</strong><br>
            </p>
            <div class="flex justify-center mt-6">
                <button id="closeSuccessModal" 
                    class="bg-blue-500 hover:bg-blue-600 text-white text-sm sm:text-base px-4 py-2 rounded-lg transition duration-300">
                    OK
                </button>
            </div>
        </div>
    </div>
@endif




<script>

document.addEventListener('DOMContentLoaded', function () {
    const confirmationModal = document.getElementById('confirmationModal');
    const successModal = document.getElementById('successModal');
    const certificateSelect = document.getElementById('certificate_type_id');
    const businessNameField = document.querySelector('.mb-4.hidden');
    const lowIncomeField = document.getElementById('lowIncomeField');
    const witness_by = document.getElementById('witness_by');



    // Helper: Show Modal
    const showModal = (modal) => modal.classList.remove('hidden');
    // Helper: Hide Modal
    const hideModal = (modal) => modal.classList.add('hidden');

    // Format time to 12-hour format
    const formatTo12Hour = (time) => {
        const [hour, minute] = time.split(':');
        const hours = (hour % 12) || 12;
        const ampm = hour >= 12 ? 'PM' : 'AM';
        return `${hours}:${minute} ${ampm}`;
    };

    // Toggle Business Name Field
    certificateSelect.addEventListener('change', function () {
        const selectedOption = certificateSelect.options[certificateSelect.selectedIndex].text.toLowerCase();
        if (selectedOption.includes('business')) {
            businessNameField.classList.remove('hidden');
        } else {
            businessNameField.classList.add('hidden');
        }
    });

    certificateSelect.addEventListener('change', function () {
        const selectedOption = certificateSelect.options[certificateSelect.selectedIndex].text.toLowerCase();
        if (selectedOption.includes('low income')) {
            lowIncomeField.classList.remove('hidden');
        } else {
            lowIncomeField.classList.add('hidden');
        }
    });

    certificateSelect.addEventListener('change', function () {
        const selectedOption = certificateSelect.options[certificateSelect.selectedIndex].text.toLowerCase();
        if (selectedOption.includes('job seeker')) {
            witness_by.classList.remove('hidden');
        } else {
            witness_by.classList.add('hidden');
        }
    });

    // Handle Submit Button Click
    document.getElementById('submitRequest').addEventListener('click', function () {
        const dateNeeded = document.getElementById('date_needed').value;
        const [datePart, timePart] = dateNeeded ? dateNeeded.split('T') : ['Not Specified', ''];

        if (!certificateSelect.value || !dateNeeded) {
            alert('Please fill in all required fields.');
            return;
        }

        // Update modal details
        const selected = certificateSelect.options[certificateSelect.selectedIndex];
        document.getElementById('modalDetails').innerHTML = `
            You are about to request <strong>${selected.text}</strong>.<br>
            Price: <strong>${selected.dataset.price ? '₱' + selected.dataset.price : 'Free'}</strong><br>
            Date Needed: <strong>${datePart}</strong><br>
            Time: <strong>${timePart ? formatTo12Hour(timePart) : 'Not Specified'}</strong>
        `;
        showModal(confirmationModal);
    });

    // Cancel Request
    document.getElementById('cancelRequest').addEventListener('click', () => hideModal(confirmationModal));

    // Confirm Request
    document.getElementById('confirmRequest').addEventListener('click', () => {
        hideModal(confirmationModal);
        document.getElementById('requestForm').submit();
    });

    // Close Success Modal
    if (successModal) {
        document.getElementById('closeSuccessModal').addEventListener('click', () => hideModal(successModal));
    }
});

</script>


@endsection
