@extends('barangay.templates.navigation-bar')

@section('title', 'Previous Announcements')

@section('content')
<div class="px-4">
    <div class="bg-white flex justify-between items-center rounded-lg shadow-lg py-2 px-4">
        <h2 class="text-xl font-bold text-red-500 mb-3 uppercase text-start">Previous Announcements:</h2>

        <div class="flex justify-end">
            <a href="{{ url('/announcements/show') }}" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500">
                Return
            </a>
        </div>
    </div>

    <div class="max-h-[70vh] overflow-y-auto">
        @if($announcements->count())
            <div class="space-y-6"> 
                @foreach($announcements as $announcement)
                    <div class="bg-white border border-[2px] border-gray-200 rounded-lg overflow-hidden w-full mt-4 w-full">
                        <div class="image-area relative shadow-xl">
                            @if($announcement->expiration_date && $announcement->expiration_date < now())
                            <div class="absolute top-2 left-2 bg-red-600 text-white text-xs font-bold py-2 px-4 rounded shadow-md">
                                This announcement is expired and will be moved to the archive after 3 months
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
                                <h3 class="lg:text-2xl text-[15px] font-semibold mb-2 text-red-600">{{ $announcement->title }}</h3>
                            </div>
                            <a href="{{ route('barangay.announcement.show', $announcement->id) }}" class="ml-auto py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500">View details</a>
                        </div>
                    </div>
                @endforeach        
            </div>

            <div class="pagination mt-6">
                {{ $announcements->links() }}
            </div>
        @else
            <p class="text-center text-gray-500 mt-10">No previous announcements found.</p>
        @endif
    </div>
</div>
@endsection