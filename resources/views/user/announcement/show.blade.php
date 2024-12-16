@extends('user.templates.navigation-bar')

@section('title', 'Announcements Details')

@section('content')

<div class="flex justify-end mr-3">
    <a href="{{ url('/announcements') }}" class="inline-block font-semibold text-blue-600 hover:text-blue-800 transition-all duration-300 text-lg">
        <i class="fa-solid fa-arrow-left"></i> Return to Announcements
    </a>
</div>

<div class="py-6 px-4 max-h-[70vh] overflow-y-auto mx-auto">
    <div class="image-area relative shadow-xl">
        @if($announcement->expiration_date && $announcement->expiration_date < now())
                                <div class="absolute top-2 left-2 bg-red-600 text-white text-xs font-bold py-2 px-4 rounded shadow-md">
                                    This announcement is expired and will be moved to the archive after 3 months
                                </div>
                            @endif
        @if($announcement->imgUrl)
        <img src="{{ asset('storage/' . $announcement->imgUrl) }}" alt="Announcement Image" class="w-full h-[350px] object-cover rounded-lg shadow-lg">
        <div class="absolute inset-0 bg-black opacity-25 rounded-lg"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <h1 class="text-white lg:text-4xl text-[20px] font-extrabold text-center drop-shadow-lg">{{ $announcement->title }}</h1>
        </div>
        @endif
    </div>

    <div class="content-area mt-8 bg-white rounded-lg py-6 px-8 shadow-xl leading-relaxed">
        <p class="uppercase font-bold tracking-wide text-gray-600 mb-3">Announcement Details</p>
        <div class="flex justify-between items-center text-sm text-gray-500 border-b border-gray-300 pb-4">
            <p class="italic">Date Scheduled: <span class="text-green-500 font-semibold">{{ $announcement->announcement_date }}</span></p>
            <p class="italic">Expiration Time: <span class="text-red-500 font-semibold">{{ $announcement->expiration_date }}</span></p>
        </div>

        <article class="mt-6 space-y-6 text-lg text-gray-800">
            {!! nl2br(e($announcement->content)) !!}
        </article>
    </div>
</div>

@if (\Carbon\Carbon::now()->greaterThanOrEqualTo($announcement->expiration_date))
    <div class="flex justify-end mr-4">
        <a href="{{ url('/announcementView/previous') }}" class="inline-block font-semibold text-red-600 hover:text-red-800 transition-all duration-300 text-lg">
            Back to Previous <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
@endif


@endsection