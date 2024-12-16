@extends('barangay.templates.navigation-bar')

@section('title', 'Resident Details')

@section('content')
<div class="py-1 px-4 bg-white rounded-lg shadow-lg">

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded-lg border border-green-300 text-center mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded-lg border border-red-300 mb-4">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="flex justify-between items-center mt-6">
        <p class="text-blue-500 font-semibold text-2xl">Resident: {{ $resident->last_name}}, {{ $resident->first_name}}</p>

        <a href="{{ route('barangay.residents.index') }}" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
            Back to List
        </a>
    </div>

    <hr class="border-t-2 mt-3 mb-4 border-gray-300">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-3 max-h-[430px] overflow-y-auto">
        <div class="info1 space-y-4">
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">First Name:</span>
                <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">{{ $resident->first_name }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Last Name:</span>
                <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">{{ $resident->last_name }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Middle Name:</span>
                <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">{{ $resident->middle_name }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Suffix:</span>
                <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">{{ $resident->suffix }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Purok:</span>
                <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">{{ $resident->purok->purok_number }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Birth Date:</span>
                <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">{{ $resident->birth_date }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Place of Birth:</span>
                <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">{{ $resident->place_of_birth }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Gender:</span>
                <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">{{ $resident->gender }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Age:</span>
                <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">{{ $resident->age }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Civil Status:</span>
                <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">{{ $resident->civil_status }}</span>
            </div>
        </div>

        <div class="info2 space-y-4">
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Phone Number:</span>
                <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">{{ $resident->phone_number }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Citizenship:</span>
                <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">{{ $resident->citizenship }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Nickname:</span>
                <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">{{ $resident->nickname }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Email:</span>
                <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">{{ $resident->email }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Current Address:</span>
                <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">{{ $resident->current_address }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Permanent Address:</span>
                <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">{{ $resident->permanent_address }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-600 w-40">Household:</span>
                <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">
                    @foreach($householdNames as $householdName)
                    {{ $householdName }}@if(!$loop->last), @endif
                    @endforeach
            </div>
            <div class="info2 space-y-4">
                <!-- Mother -->
                <div class="flex items-center">
                    <span class="font-semibold text-gray-600 w-40">Mother:</span>
                    <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">
                        @if ($mother)
                            {{ $mother->first_name }} {{ $mother->last_name }}
                        @else
                            Not Specified
                        @endif
                    </span>
                </div>
            
                <!-- Father -->
                <div class="flex items-center">
                    <span class="font-semibold text-gray-600 w-40">Father:</span>
                    <span class="text-gray-800 border border-gray-300 py-1 w-full px-3">
                        @if ($father)
                            {{ $father->first_name }} {{ $father->last_name }}
                        @else
                            Not Specified
                        @endif
                    </span>
                </div>
            
                <!-- Children -->
                <div class="flex items-start">
                    <span class="font-semibold text-gray-600 w-40">Children:</span>
                    <div class="text-gray-800 border border-gray-300 py-1 w-full px-3">
                        @if ($children->isNotEmpty())
                            @foreach ($children as $child)
                                <div>{{ $child->first_name }} {{ $child->last_name }}</div>
                            @endforeach
                        @else
                            <div>None</div>
                        @endif
                    </div>
                </div>
                
            </div>
                        
        </div>
    </div>
</div>
@endsection
