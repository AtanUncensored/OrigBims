@extends('user.templates.navigation-bar')

@section('title', 'Complaints')

@section('content')

  <div class="px-4 ">
    <div class="bg-white py-2 px-4 rounded-lg shadow-lg mb-4">
      <h2 class="text-xl font-bold text-blue-500 mb-3">COMPLAINTS:</h2>

      <hr class="border-t-2 mt-3 mb-6 border-gray-300">

    <!-- Add Complaint Button -->
      <div class="mb-4">
          <a href="{{ route('user.complaint.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700">
              Make a Complaint
          </a>
      </div>
    </div>

    <div class="flex justify-between space-x-8">
      <div class="w-full bg-white shadow-lg p-4 rounded-md max-h-[58vh] overflow-y-auto">
        <h3 class="text-xl font-semibold text-center text-blue-600 mb-4">-Pending Complaints-</h3>
        @forelse($complaints->whereNull('reply') as $complaint)
          <div class="bg-white p-4 mb-4 rounded-lg shadow-lg border border-gray-300 border-[2px]">
              <h3 class="text-lg font-semibold">{{ $complaint->complain_type }}</h3>
              <p class="text-gray-700 mb-2">{{ $complaint->details }}</p>
              <p class="text-gray-500 text-sm mb-4">Date: {{ $complaint->date_of_incident }}</p>
    
              <div class="border-t mt-2 pt-2">
                <span class="text-gray-500">No reply yet</span>
              </div>
          </div>
        @empty
          <p class="text-gray-600">No pending complaints.</p>
        @endforelse
      </div>
      
      <div class="w-full bg-white shadow-lg p-4 rounded-md max-h-[58vh] overflow-y-auto">
        <h3 class="text-xl font-semibold text-center text-green-600 mb-4">-Replied Complaints-</h3>
        @forelse($complaints->whereNotNull('reply') as $complaint)
          <div class="bg-white p-4 mb-4 rounded-lg shadow-lg border border-gray-300 border-[2px]">
              <h3 class="text-lg font-semibold">{{ $complaint->complain_type }}</h3>
              <p class="text-gray-700 mb-2">{{ $complaint->details }}</p>
              <p class="text-gray-500 text-sm mb-4">Date: {{ $complaint->date_of_incident }}</p>
    
              <div class="border-t mt-2 pt-2">
                <h5 class="text-blue-600 font-bold">Barangay Reply:</h5>
                <p class="px-4 py-2 text-gray-800">{{ $complaint->reply }}</p>
              </div>
          </div>
        @empty
          <p class="text-gray-600">No complaints have been replied to yet.</p>
        @endforelse
      </div>
    </div>
  </div>

@endsection
