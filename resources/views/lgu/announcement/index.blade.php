@extends('lgu.lgu-template.navigation-bar')

@section('title', 'Announcements')

@section('content')
<div class="px-4">
    <div class="bg-white py-2 px-4 rounded-lg shadow-lg mb-1">
        <h2 class="text-xl font-bold text-blue-500 mb-3">IMPORTANT ANNOUNCEMENTS:</h2>

        <hr class="border-t-2 mb-4 border-gray-300">

        <div class="flex justify-start items-center">
            <button onclick="toggleAddModal()" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500 mr-[200px]">
                <i class="fa-solid fa-plus"></i> Announcement</a>
            </button>
    
            @if(session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-2 px-4 rounded mb-2">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div id="add-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                            
            <!-- Add Form -->
            <div class="mt-[20px] mb-6 w-[700px] rounded">
                <div class="container mx-auto max-w-3xl px-4 py-6 bg-white shadow-lg rounded-lg">
                    <h2 class="text-xl font-bold text-blue-500 mb-3 text-center uppercase">Add New Announcement</h2>
                    
                    <form action="{{ route('superadmin.announcements.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div class="max-h-[52vh] overflow-y-auto space-y-4">
                            <!-- Title Input -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                                <input 
                                    type="text" 
                                    name="title" 
                                    id="title" 
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                    value="{{ old('title') }}"
                                    placeholder="Enter announcement title"
                                >
                                @error('title')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                
                            <!-- Announcement Date Input -->
                            <div>
                                <label for="announcement_date" class="block text-sm font-medium text-gray-700">Announcement Date:</label>
                                <input 
                                    type="datetime-local" 
                                    name="announcement_date" 
                                    id="announcement_date" 
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                    value="{{ old('announcement_date') }}"
                                >
                                @error('announcement_date')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                
                            <!-- Expiration Date Input -->
                            <div>
                                <label for="expiration_date" class="block text-sm font-medium text-gray-700">Expiration Date and Time:</label>
                                <input 
                                    type="datetime-local" 
                                    name="expiration_date" 
                                    id="expiration_date" 
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                    value="{{ old('expiration_date') }}"
                                >
                                @error('expiration_date')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                
                            <!-- Content Textarea -->
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700">Content:</label>
                                <textarea 
                                    name="content" 
                                    id="content" 
                                    rows="4" 
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                    placeholder="Write your announcement here..."
                                >{{ old('content') }}</textarea>
                                @error('content')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                
                            <!-- Image Upload -->
                            <div>
                                <label for="imgUrl" class="block text-sm font-medium text-gray-700">Upload Image:</label>
                                <input 
                                    type="file" 
                                    name="imgUrl" 
                                    id="imgUrl" 
                                    class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded file:border file:border-gray-300 file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"
                                >
                                @error('imgUrl')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                
                        <!-- Action Buttons -->
                        <div class="flex justify-end items-center mt-6">
                            <button type="submit" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500 mr-3">
                                Create Announcement
                            </button>
                            <button type="button" onclick="toggleAddModal()" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="max-h-[61vh] overflow-y-auto">
        @if($announcements->count())
        <div class="space-y-6"> 
            @foreach($announcements as $announcement)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden w-full mt-4 w-full">
                        <div class="image-area relative shadow-xl">
                            @if($announcement->expiration_date && $announcement->expiration_date < now())
                                <div class="absolute top-2 left-2 bg-red-600 text-white text-xs font-bold py-2 px-4 rounded shadow-md">
                                    This announcement is expired and will disappear after 3 months
                                </div>
                            @endif
                            @if($announcement->imgUrl)
                            <img src="{{ asset('storage/' . $announcement->imgUrl) }}" alt="Announcement Image" class="w-full h-48 object-cover">
                            <div class="absolute inset-0 bg-black opacity-25 rounded-lg"></div>
                            <div class="absolute inset-0 flex items-start justify-end py-2 px-4">
                                <p class="italic"><span class="text-white text-[20px] font-semibold">{{ $announcement->announcement_date }}</span></p>
                            </div>
                            @endif
                        </div>

                        <div class="p-4 flex">
                            <div>
                                <h3 class="lg:text-2xl text-[15px] font-semibold mb-2 text-blue-600">{{ $announcement->title }}</h3>
                            </div>
                            <a href="{{ route('superadmin.announcement.show', $announcement->id) }}" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500 ml-auto">View details</a>
                        </div>
                    </div>
            @endforeach        
        </div>

        <div class="pagination mt-6">
            {{ $announcements->links() }}
        </div>
        @else
            <p class="text-center text-gray-500 mt-10">No announcements found.</p>
        @endif
    </div>
</div>

<script>
    function toggleAddModal() {
        const modal = document.getElementById(`add-modal`);
        modal.classList.toggle('hidden');
    }
</script>
@endsection