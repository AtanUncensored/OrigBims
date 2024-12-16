@extends('lgu.lgu-template.navigation-bar')

@section('title', 'Announcements Details')

@section('content')

<div class="flex justify-end mr-3">
    <a href="{{ url('/lgu-announcement') }}" class="inline-block font-semibold text-blue-600 hover:text-blue-800 transition-all duration-300 text-lg">
        <i class="fa-solid fa-arrow-left"></i> Return to Announcements
    </a>
</div>

<div class="py-6 px-4 max-h-[72vh] overflow-y-auto mx-auto">
    <div class="image-area relative shadow-xl">
        @if($announcement->imgUrl)
        <img src="{{ asset('storage/' . $announcement->imgUrl) }}" alt="Announcement Image" class="w-full h-[350px] object-cover rounded-lg shadow-lg">
        <div class="absolute inset-0 bg-black opacity-25 rounded-lg"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <h1 class="text-white lg:text-4xl text-[20px] font-extrabold text-center drop-shadow-lg">{{ $announcement->title }}</h1>
        </div>
        @endif
    </div>

    <div class="content-area mt-8 bg-white rounded-lg py-6 px-8 shadow-xl leading-relaxed">
        <div class="flex justify-between items-center mb-3">
            <p class="uppercase font-bold tracking-wide text-gray-600">Announcement Details</p>

            <button onclick="toggleEditModal('{{ $announcement->id }}')" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500">
                <i class="fa-solid fa-pen"></i> Make changes
            </button>

            <div id="edit-modal-{{ $announcement->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                <!-- Edit Form -->
                <div class="mt-[20px] mb-6 w-[700px] rounded mx-auto bg-white p-6 shadow">
            
                    <div class="flex justify-center items-center mb-4">
                        <div class="flex justify-start items-center">
                            <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 mr-5"></i>
                        </div>
                        <div class="flex justify-center items-center">
                            <h1 class="text-xl font-bold text-blue-600 text-center mb-2">Edit Announcement</h1>
                        </div>
                        <div class="flex justify-start items-center">
                            <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 ml-5"></i>
                        </div>
                    </div>
            
                    <hr class="border-t-2 border-blue-300 mb-4">
            
                    <form action="{{ route('superadmin.announcement.update', $announcement->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="max-h-[52vh] overflow-y-auto space-y-4">
                            <!-- Title Input -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                                <input 
                                    type="text" 
                                    name="title" 
                                    id="title" 
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                    value="{{ old('title', $announcement->title) }}"
                                    placeholder="Enter announcement title"
                                >
                                @error('title')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                
                            <!-- Announcement Date Input -->
                            <div>
                                <label for="announcement_date" class="block text-sm font-medium text-gray-700">Announced Date and Time:</label>
                                <input 
                                    type="datetime-local" 
                                    name="announcement_date" 
                                    id="announcement_date" 
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                    value="{{ old('announcement_date', $announcement->announcement_date) }}"
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
                                    value="{{ old('expiration_date', $announcement->expiration_date) }}"
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
                                    class="mt-1 block w-full h-[250px] px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                    placeholder="Write your announcement here..."
                                >{{ old('content', $announcement->content) }}</textarea>
                                @error('content')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                
                            <!-- Image Upload -->

                            <div class="mb-4">
                                <label for="imgUrl" class="block text-sm font-medium text-gray-700">Upload Image:</label>
                                <input 
                                    type="file" 
                                    id="imgUrl" 
                                    name="imgUrl" 
                                    class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded file:border file:border-gray-300 file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100" accept="image/*">
                                @error('imgUrl')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                
                        <!-- Action Buttons -->
                        <div class="flex justify-end items-center mt-6">
                            <button type="submit" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500 mr-3">
                                Update Announcement
                            </button>
                            <button type="button" onclick="toggleEditModal('{{ $announcement->id }}')" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="flex justify-between items-center text-sm text-gray-500 border-b border-gray-300 pb-4">
            <p class="italic">Date Scheduled: <span class="text-green-500 font-semibold">{{ $announcement->announcement_date }}</span></p>
            <p class="italic">Expiration Time: <span class="text-red-500 font-semibold">{{ $announcement->expiration_date }}</span></p>
        </div>

        <article class="mt-6 space-y-6 text-lg text-gray-800">
            {!! nl2br(e($announcement->content)) !!}
        </article>
        
    </div>
</div>

<script>
     function toggleEditModal(announcementId) {
        const modal = document.getElementById(`edit-modal-${announcementId}`);
        modal.classList.toggle('hidden');
    }
</script>

@endsection