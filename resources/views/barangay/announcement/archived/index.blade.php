@extends('barangay.templates.navigation-bar')

@section('title', 'Archived Announcements')

@section('content')
<div class="px-4">
    <div class="bg-white flex justify-between items-center rounded-lg shadow-lg py-2 px-4">
        <h2 class="text-xl font-bold text-green-600 mb-3 uppercase text-start">Archived List:</h2>

        @if(session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-2 px-4 rounded mb-2">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-end">
            <a href="{{ url('/announcements/show') }}" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500">
                Return
            </a>
        </div>
    </div>

    <div class="max-h-[70vh] overflow-y-auto">
        @if($archivedAnnouncements->count())
            <div class="space-y-6"> 
                @foreach($archivedAnnouncements as $archive)
                    <div class="bg-white border border-[2px] border-gray-200 rounded-lg overflow-hidden w-full mt-4 w-full">
                        <div class="image-area relative shadow-xl">
                            @if($archive->imgUrl)
                            <img src="{{ asset('storage/' . $archive->imgUrl) }}" alt="Announcement Image" class="w-full h-48 object-cover">
                            <div class="absolute inset-0 bg-black opacity-25 rounded-lg"></div>
                            <div class="absolute inset-0 flex items-start justify-end py-2 px-4">
                                <p class="italic"><span class="text-white text-[20px] font-semibold">{{ $archive->announcement_date }}</span></p>
                            </div>
                            @endif
                        </div>
                        <div class="p-4 flex">
                            <div>
                                <h3 class="lg:text-2xl text-[15px] font-semibold mb-2 text-green-600">{{ $archive->title }}</h3>
                            </div>
                            <button onclick="toggleEditModal('{{ $archive->id }}')" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500 ml-auto">
                                Restore
                            </button>
                            
                            <div id="edit-modal-{{ $archive->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                                {{-- Edit modal content --}}
                                <div class="mt-[260px] mb-6 w-[400px] rounded mx-auto bg-white p-6 shadow">
                                    <form action="{{ route('barangay.announcement.restore', $archive->id) }}" method="POST" class="inline-block ml-auto">
                                        @csrf
                                        <div class="flex justify-between items-center mb-3">
                                            <label for="expiration_date" class="block text-sm font-medium text-gray-700">Expiration Date & Time:</label>
                                            <input 
                                                type="datetime-local" 
                                                name="expiration_date" 
                                                id="expiration_date" 
                                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm "
                                                value="{{ $archive->expiration_date }}"
                                            >
                                            @error('expiration_date')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                            </div>
                                            <div class="flex justify-end items-center">
                                                <button type="submit" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500 mr-3">Restore</button>
                                                <button type="button" onclick="toggleEditModal('{{ $archive->id }}')" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                                    Cancel
                                                </button>
                                            </div>
                                    </form>    
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach        
            </div>

            <div class="pagination mt-6">
                {{ $archivedAnnouncements->links() }}
            </div>
        @else
            <p class="text-center text-gray-500 mt-10">No archived announcements found.</p>
        @endif
    </div>
</div>

<script>
      function toggleEditModal(archiveId) {
        const modal = document.getElementById(`edit-modal-${archiveId}`);
        modal.classList.toggle('hidden');
    }
</script>
@endsection


