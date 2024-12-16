@extends('user.templates.navigation-bar')

@section('title', 'Announcements')

@section('content')
<div class="px-4">
    <div class="bg-white flex justify-between items-center py-2 px-4 rounded-lg shadow-lg mb-1">
        <h2 class="text-xl font-bold text-blue-500 mb-3 text-start">IMPORTANT ANNOUNCEMENTS:</h2>
        <a href="{{ route('user.announcement.previous') }}" class="py-2 px-4 text-[10px] lg:text-[15px] bg-red-600 text-white font-bold rounded hover:bg-red-500">Previous Announcements</a>
    </div>
    

    <div class="max-h-[70vh] overflow-y-auto">
        @if($announcements->count())
        <div class="space-y-6">
            @foreach($announcements as $announcement)
                <div class="bg-white shadow-md rounded-lg overflow-hidden w-full mt-4 w-full">
                    
                    
                    @if($announcement->is_global)
                    <div class="flex items-center space-x-2 ml-auto justify-end mr-2"> 
                        <span class="text-yellow-500 text-3xl">&#x1F4CC;</span> 
                        <span class="text-yellow-500 text-sm font-semibold">LGU Announcement</span> 
                    </div>
                    @endif

                    <div class="image-area relative shadow-xl">
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
                        <a href="{{ route('user.announcement.show', $announcement->id) }}" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500 ml-auto">View details</a>
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
@endsection
