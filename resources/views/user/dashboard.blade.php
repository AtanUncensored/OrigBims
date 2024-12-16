@extends('user.templates.navigation-bar')

@section('content')

<div class="records px-4">
    <div class="bg-white py-2 px-4 rounded-lg shadow-lg">
        <h1 class="text-xl font-bold text-blue-500 mb-4">BARANGAY RECORDS:</h1>
        <div class="flex flex-wrap justify-between mb-4 max-h-[28vh] lg:gap-1 lg:max-h-[20vh] overflow-y-auto space-y-2 lg:space-y-0">
            <!-- Total Residents Card -->
            <div class="card border border-[2px] border-gray-200 rounded-[8px] py-1 px-3 w-full sm:w-1/2 lg:w-[23%]">
                <div class="card-body">
                    <div class="flex justify-between items-center">
                        <h5 class="card-title text-blue-900 font-bold">Residents</h5>
                        <p class="text-blue-900 font-bold py-1 mb-2 px-2 text-[9px] lg:text-sm rounded-full mt-2">  
                            <i class="fa-solid fa-users text-lg lg:text-lg"></i> 
                        </p>
                    </div>
                    <hr class="border-t-2 mb-2 border-gray-300">
                    <div class="flex justify-between items-center">
                        <div class="flex justify-start items-center">
                            <p class="cart-text font-semibold text-[13px] lg:text-sm mr-1 text-gray-500">Total:</p>
                            <p class="card-text font-semibold text-lg lg:text-lg text-green-700 mb-1"> {{ $totalResidents }}</p>
                        </div>
                        <div class="flex justify-end items-center">
                            <p class="text-green-700 font-bold py-1 px-2 text-[9px] rounded-full bg-green-200">
                                <i class="fa-solid fa-angles-up text-[13px]"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Married Card -->
            <div class="card border border-[2px] border-gray-200 rounded-[8px] py-1 px-3 w-full sm:w-1/2 lg:w-[23%]">
                <div class="card-body">
                    <div class="flex justify-between items-center">
                        <h5 class="card-title text-red-900 font-bold">Married</h5>
                        <p class="text-red-900 font-bold py-1 mb-2 px-2 text-[9px] lg:text-sm rounded-full mt-2"> 
                            <i class="fa-solid fa-ring text-lg lg:text-lg"></i> 
                        </p>
                    </div>
                    <hr class="border-t-2 mb-2 border-gray-300">
                    <div class="flex justify-between items-center">
                        <div class="flex justify-start items-center">
                            <p class="cart-text font-semibold text-[13px] lg:text-sm mr-1 text-gray-500">Total:</p>
                            <p class="card-text font-semibold text-lg lg:text-lg text-green-700 mb-1"> {{ $marriedCount }}</p>
                        </div>
                        <div class="flex justify-end items-center">
                            <p class="text-green-700 font-bold py-1 px-2 text-[9px] rounded-full bg-green-200">
                                <i class="fa-solid fa-angles-up text-[13px]"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Senior Citizen Card -->
            <div class="card border border-[2px] border-gray-200 rounded-[8px] py-1 px-3 w-full sm:w-1/2 lg:w-[23%]">
                <div class="card-body">
                    <div class="flex justify-between items-center">
                        <h5 class="card-title text-gray-700 font-bold">Senior Citizen</h5>
                        <p class="text-gray-700 font-bold py-1 mb-2 px-2 text-[9px] lg:text-sm rounded-full mt-2"> 
                            <i class="fa-solid fa-user-tie text-lg lg:text-lg"></i> 
                        </p>
                    </div>
                    <hr class="border-t-2 mb-2 border-gray-300">
                    <div class="flex justify-between items-center">
                        <div class="flex justify-start items-center">
                            <p class="cart-text font-semibold text-[13px] lg:text-sm mr-1 text-gray-500">Total:</p>
                            <p class="card-text font-semibold text-lg lg:text-lg text-green-700 mb-1"> {{ $seniorCitizensCount }}</p>
                        </div>
                        <div class="flex justify-end items-center">
                            <p class="text-green-700 font-bold py-1 px-2 text-[9px] rounded-full bg-green-200">
                                <i class="fa-solid fa-angles-up text-[13px]"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Youth Card -->
            <div class="card border border-[2px] border-gray-200 rounded-[8px] py-1 px-3 w-full sm:w-1/2 lg:w-[23%]">
                <div class="card-body">
                    <div class="flex justify-between items-center">
                        <h5 class="card-title text-purple-900 font-bold">Youth</h5>
                        <p class="text-purple-900 font-bold py-1 mb-2 px-2 text-[9px] lg:text-sm rounded-full mt-2"> 
                            <i class="fa-solid fa-user-graduate text-lg lg:text-lg"></i>
                        </p>
                    </div>
                    <hr class="border-t-2 mb-2 border-gray-300">
                    <div class="flex justify-between items-center">
                        <div class="flex justify-start items-center">
                            <p class="cart-text font-semibold text-[13px] lg:text-sm mr-1 text-gray-500">Total:</p>
                            <p class="card-text font-semibold text-lg lg:text-lg text-green-700 mb-1">{{ $youthCount }}</p>
                        </div>
                        <div class="flex justify-end items-center">
                            <p class="text-green-700 font-bold py-1 px-2 text-[9px] rounded-full bg-green-200">
                                <i class="fa-solid fa-angles-up text-[13px]"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barangay Officials Section -->
    <div class="bg-white py-2 px-4 rounded-lg shadow-lg mt-4">
        <div class="flex items-center justify-start">
            <h1 class="text-xl font-bold text-blue-500 mt-1 mb-4">BARANGAY OFFICIALS:</h1>
        </div>
    
        <div class="overflow-x-auto">
            <div class="max-h-[40vh] overflow-y-auto">
                <table class="min-w-full border border-[2px] border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Name</th>
                            <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Position</th>
                            <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Purok Assigned</th>
                            <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Committee</th>
                            <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Start of Service</th>
                            <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">End of Service</th>
                        </tr>
                    </thead>
                    <tbody class="text-[8px] lg:text-[12px]">
                        @foreach ($barangayOfficials as $official)
                            <tr class="border-b border-gray-200">
                                <td class="lg:px-6 py-3 text-[10px] lg:text-[15px]">{{ $official->resident->first_name }}, {{ $official->resident->last_name}}</td>
                                <td class="lg:px-6 py-3 text-[10px] lg:text-[15px]">{{ $official->position }}</td>
                                <td class="lg:px-6 py-3 text-[10px] lg:text-[15px]">
                                    @if ($official->purok !== 'All Purok')
                                        Purok {{ $official->purok }}
                                    @else
                                        {{ $official->purok }}
                                    @endif
                                </td>                                
                                <td class="lg:px-6 py-3 text-[10px] lg:text-[15px]">{{ $official->committee }}</td>
                                <td class="lg:px-6 py-3 text-[10px] lg:text-[15px]">{{ $official->start_of_service }}</td>
                                <td class="lg:px-6 py-3 text-[10px] lg:text-[15px]">{{ $official->end_of_service }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
