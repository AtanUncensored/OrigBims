@extends('barangay.templates.navigation-bar')

@section('title', 'Purok Statistics')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded p-6 flex gap-20">

        <div class="mb-4">

            <h1 class="text-xl font-bold text-blue-500 mb-2">
                Statistics in Purok {{ $purok->purok_name }}
            </h1>

            <p class="text-lg"><strong>Total Residents:</strong> <span class="text-green-800 font-semibold">{{ $totalResidents }}</span></p>
            <p class="text-lg"><strong>Total Males:</strong> <span class="text-blue-800 font-semibold">{{ $totalMales }}</span></p>
            <p class="text-lg"><strong>Total Females:</strong> <span class="text-pink-800 font-semibold">{{ $totalFemales }}</span></p>
            {{-- <p class="text-lg"><strong>Total Households:</strong> {{ $totalHouseholds }}</p> --}}

        </div>

        <div>
            <h3 class="text-xl font-bold mb-4">Resident List</h3>
            <ul class="list-disc ml-6">
                @forelse ($residents as $resident)
                    <li class="mb-2">
                        <span class="font-semibold">{{ $resident->first_name }} {{ $resident->last_name }}</span> - 
                        <span>{{ $resident->gender }}</span>
                    </li>
                @empty
                    <li>No residents found in this Purok.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <a href="/puroks" class="inline-block mt-6 text-blue-500 hover:underline">Back to Purok List</a>

</div>  
@endsection
