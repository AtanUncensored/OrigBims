@extends('user.templates.navigation-bar')

@section('title', 'Complaints')

@section('content')

  <div class="px-4">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-xl font-bold text-blue-500 mb-3">How can we help?</h1>
        
        <hr class="border-t-2 my-4 border-gray-700">

        <form action="{{ route('user.complaint.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="complain_type" class="block text-md font-semibold text-gray-700">Type of Concern</label>
                <input type="text" name="complain_type" id="complain_type" class="py-2 px-4 w-full border border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="date_of_incident" class="block text-md font-semibold text-gray-700">Date of Incident</label>
                <input type="date" name="date_of_incident" id="date_of_incident" class="py-2 px-4 w-full border border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="details" class="block text-md font-medium text-gray-700">Details</label>
                <textarea name="details" id="details" cols="10" rows="4" placeholder="Details here..." class="py-2 px-4 w-full border border-gray-300 rounded-md shadow-sm" required></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700">
                    Submit
                </button>
                <a href="/user-complaints" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800 mt-2 ml-3">
                    Cancel
                </a>
            </div>
        </form>
    </div>
  </div>

@endsection
