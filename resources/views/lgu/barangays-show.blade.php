@extends('lgu.lgu-template.navigation-bar')

@section('title', 'Barangay Details')

@section('content')
<div class="px-4">

    <div class="flex justify-between items-center mb-3 mt-5">
        <h2 class="font-semibold mb-2 text-sm sm:text-base">Current record of this barangay:</h2>
        <a href="{{ route('lgu.barangays-list') }}" class="inline-block align-baseline font-bold text-sm sm:text-lg text-blue-600 hover:text-blue-800">
            Back to List
        </a>
    </div>
    <div class="max-h-[62vh] lg:max-h-[65vh] overflow-y-auto">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            
            <div class="bg-white shadow rounded-lg p-4 sm:p-6">
                <div class="flex items-center">
                    <i class="fa-solid fa-user fa-lg text-blue-500"></i>
                    <h3 class="text-sm sm:text-lg font-semibold ml-2">Residents</h3>
                </div>
                <p class="text-lg sm:text-2xl font-semibold text-right text-green-600 mt-2"><span class="text-gray-500 text-xs sm:text-[15px]">Total:</span> {{ $totalUsers }}</p>
            </div>

            <!-- Males Card -->
            <div class="bg-white shadow rounded-lg p-4 sm:p-6">
                <div class="flex items-center">
                    <i class="fa-solid fa-male fa-2xl text-blue-500"></i>
                    <h3 class="text-sm sm:text-lg font-semibold ml-2">Males</h3>
                </div>
                <p class="text-lg sm:text-2xl font-semibold text-right text-green-600 mt-2"><span class="text-gray-500 text-xs sm:text-[15px]">Total:</span> {{ $totalMales }}</p>
            </div>

            <!-- Females Card -->
            <div class="bg-white shadow rounded-lg p-4 sm:p-6">
                <div class="flex items-center">
                    <i class="fa-solid fa-person-dress fa-2xl text-blue-500"></i>
                    <h3 class="text-sm sm:text-lg font-semibold ml-2">Females</h3>
                </div>
                <p class="text-lg sm:text-2xl font-semibold text-right text-green-600 mt-2"><span class="text-gray-500 text-xs sm:text-[15px]">Total:</span> {{ $totalFemales }}</p>
            </div>

            <!-- Adults Card -->
            <div class="bg-white shadow rounded-lg p-4 sm:p-6">
                <div class="flex items-center">
                    <i class="fa-solid fa-user-tie fa-xl text-blue-500"></i>
                    <h3 class="text-sm sm:text-lg font-semibold ml-2">Adults</h3>
                </div>
                <p class="text-lg sm:text-2xl font-semibold text-right text-green-600 mt-2"><span class="text-gray-500 text-xs sm:text-[15px]">Total:</span> {{ $totalAdults }}</p>
            </div>

            <!-- Seniors Card -->
            <div class="bg-white shadow rounded-lg p-4 sm:p-6">
                <div class="flex items-center">
                    <i class="fa-solid fa-user-tie fa-xl text-blue-500"></i>
                    <h3 class="text-sm sm:text-lg font-semibold ml-2">Seniors</h3>
                </div>
                <p class="text-lg sm:text-2xl font-semibold text-right text-green-600 mt-2"><span class="text-gray-500 text-xs sm:text-[15px]">Total:</span> {{ $totalSeniors }}</p>
            </div>

            <!-- Youth Card -->
            <div class="bg-white shadow rounded-lg p-4 sm:p-6">
                <div class="flex items-center">
                    <i class="fa-solid fa-user-graduate fa-xl text-blue-500"></i>
                    <h3 class="text-sm sm:text-lg font-semibold ml-2">Youth</h3>
                </div>
                <p class="text-lg sm:text-2xl font-semibold text-right text-green-600 mt-2"><span class="text-gray-500 text-xs sm:text-[15px]">Total:</span> {{ $totalYouth }}</p>
            </div>

            <!-- Children Card -->
            <div class="bg-white shadow rounded-lg p-4 sm:p-6">
                <div class="flex items-center">
                    <i class="fa-solid fa-child fa-xl text-blue-500"></i>
                    <h3 class="text-sm sm:text-lg font-semibold ml-2">Children</h3>
                </div>
                <p class="text-lg sm:text-2xl font-semibold text-right text-green-600 mt-2"><span class="text-gray-500 text-xs sm:text-[15px]">Total:</span> {{ $totalChildren }}</p>
            </div>

            <!-- Households Card -->
            <div class="bg-white shadow rounded-lg p-4 sm:p-6">
                <div class="flex items-center">
                    <i class="fa-solid fa-home fa-xl text-blue-500"></i>
                    <h3 class="text-sm sm:text-lg font-semibold ml-2">Households</h3>
                </div>
                <p class="text-lg sm:text-2xl font-semibold text-right text-green-600 mt-2"><span class="text-gray-500 text-xs sm:text-[15px]">Total:</span> {{ $household }}</p>
            </div>

            <!-- Married Card -->
            <div class="bg-white shadow rounded-lg p-4 sm:p-6">
                <div class="flex items-center">
                    <i class="fa-solid fa-ring fa-xl text-blue-500"></i>
                    <h3 class="text-sm sm:text-lg font-semibold ml-2">Married</h3>
                </div>
                <p class="text-lg sm:text-2xl font-semibold text-right text-green-600 mt-2"><span class="text-gray-500 text-xs sm:text-[15px]">Total:</span> {{ $marriedCount }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
