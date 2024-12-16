{{-- resources/views/barangay/complaints/show.blade.php --}}
@extends('barangay.templates.navigation-bar')

@section('title', 'Reply to Complaint')

@section('content')
<div class="py-2 px-4">    
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Complaint Details:</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <p class="text-gray-600"><strong>Name:</strong> {{ $complaint->user->name }}</p>
            <p class="text-gray-600"><strong>Email:</strong> {{ $complaint->user->email }}</p>
        </div>
        <div>
            <p class="text-gray-600"><strong>Type:</strong> {{ $complaint->complain_type }}</p>
            <p class="text-gray-600"><strong>Date of Incident:</strong> {{ $complaint->date_of_incident }}</p>
        </div>
    </div>
    <div class="mt-4">
        <p class="text-gray-600"><strong>Details:</strong> {{ $complaint->details }}</p>
    </div>

        <hr class="my-4 border border-gray-300">

        @if($complaint->reply)
        <div class="text-blue-600 font-semibold text-[15px] mb-3">
            <a href="/complaints">Return</a>
        </div>
            <div class="p-4 bg-gray-100 rounded-md">
                    <h3 class="text-lg font-semibold">Barangay Reply:</h3>
                <p>{{ $complaint->reply }}</p>
                <button onclick="toggleEditForm()" class="text-blue-500 hover:underline mr-3">Edit Reply</button>

                <form id="edit-reply-form" style="display:none;" action="{{ route('barangay.complaints.update-reply', $complaint->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <textarea name="reply" rows="4" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">{{ $complaint->reply }}</textarea>
                        @error('reply')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition focus:outline-none">
                            Update Reply
                        </button>
                        <button type="button" onclick="toggleEditForm()" class="ml-2 px-4 py-2 bg-gray-300 text-black rounded-md">Cancel</button>
                    </div>
                </form>
            </div>
        @else
            <!-- Reply form -->
            <form action="{{ route('barangay.complaints.reply', $complaint->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="reply" class="block text-lg font-medium text-gray-700">Reply to the complaint</label>
                    <textarea name="reply" id="reply" rows="6" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Enter your reply here...">{{ old('reply') }}</textarea>
                    
                    @error('reply')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition focus:outline-none mr-3">
                        Submit Reply
                    </button>
                    <a href="/complaints" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800 mt-2">
                        Cancel
                    </a>
                </div>
            </form>
        @endif
    </div>
</div>

<script>
    function toggleEditForm() {
        const form = document.getElementById('edit-reply-form');
        form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    }
</script>

@endsection
