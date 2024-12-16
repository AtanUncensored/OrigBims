@extends('barangay.templates.navigation-bar')

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
        <div class="flex items-center justify-between">
            <div class="flex justify-start items-center">
                <h1 class="text-xl font-bold text-blue-500 mb-3">BARANGAY OFFICIALS:</h1>
            </div>
            <div class="flex justify-center items-center">
                @if(session('success'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-2 px-4 rounded mb-2">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="flex justify-end items-center mb-3">
                <button onclick="toggleAddModal()" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500">
                    <i class="fa-solid fa-plus"></i> Add Officials</a>
                </button>

                <div id="add-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                            
                    <!-- Add Form -->
                    <div class="mt-[20px] mb-6 w-[400px] mx-auto bg-white p-6 rounded shadow">
    
                        <div class="flex justify-center items-center mb-4">
                            <div class="flex justify-start items-center">
                                <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 mr-5"></i>
                            </div>
                            <div class="flex justify-center items-center">
                                <h1 class="text-xl font-bold text-blue-600 text-center mb-2">Add Barangay Official</h1>
                            </div>
                            <div class="flex justify-start items-center">
                                <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 ml-5"></i>
                            </div>
                        </div>
    
                        <hr class="border-t-2 border-blue-300 mb-4">
    
                        <form action="{{ route('barangay.officials.store') }}" method="POST">
                            @csrf
                              <!-- Resident Dropdown with Search -->
                            <div class="mb-4">
                                @if(session('success'))
                                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-1 px-2 rounded mt-2">
                                    {{ session('success') }}
                                </div>
                                @endif
                            </div>
                            <div class="mb-4">
                                <label for="resident_id" class="block text-gray-700 text-sm font-bold mb-2">Select Resident</label>
                                <select name="resident_id" id="resident_id" class="mt-1 block w-full text-sm text-gray-900 border py-1 px-2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                    <option value="">Select a resident</option>
                                    @foreach($residents as $resident)
                                        <option value="{{ $resident->id }}">{{ $resident->first_name }} {{ $resident->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('resident_id')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="position" class="block text-gray-700 text-sm font-bold mb-2">Position</label>
                                <select name="position" id="position" class="mt-1 block w-full text-sm text-gray-900 border py-1 px-2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                    <option value="">Select a Position</option>
                                    <option value="Barangay Captain">Barangay Captain</option>
                                    <option value="Barangay Kagawad">Barangay Kagawad</option>
                                    <option value="Secretary">Barangay Secretary</option>
                                    <option value="Treasurer">Barangay Treasurer</option>
                                    <option value="Barangay Tanod">Barangay Tanod</option>
                                    <option value="Sk Chairperson">SK Chairperson</option>
                                    <option value="Sk Kagawad">SK Kagawad</option>
                                </select>
                                @error('position')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="purok" class="block text-gray-700 text-sm font-bold mb-2">Assign Purok:</label>
                                <select name="purok" id="purok" value="{{ old('purok') }}" class="mt-1 block w-full text-sm text-gray-900 border py-1 px-2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                    <option value="">Select Purok</option>
                                    @foreach ($puroks as $purok)
                                        <option value="{{ $purok->id }}">Purok {{ $purok->purok_number }}</option>
                                    @endforeach
                                        <option value="All Purok">All Purok</option>
                                </select>
                                @error('purok')
                                 <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                 @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="committee" class="block text-gray-700 text-sm font-bold mb-2">Committee</label>
                                <select name="committee" id="committee" class="mt-1 block w-full text-sm text-gray-900 border py-1 px-2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                    <option value="">Select a Committee</option>
                                    <option value="Committee on Health">Committee on Health</option>
                                    <option value="Committee on Education">Committee on Education</option>
                                    <option value="Committee on Social Services">Committee on Social Services</option>
                                    <option value="Committee on Finance">Committee on Finance</option>
                                    <option value="Committee on Environment">Committee on Environment</option>
                                    <option value="Committee on Public Safety">Committee on Public Safety</option>
                                    <option value="None">None</option>
                                </select>
                                @error('committee')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="start_of_service" class="block text-gray-700 text-sm font-bold mb-2">Start of Service</label>
                                <input type="date" id="start_of_service" name="start_of_service" class="mt-1 block py-1 px-2 w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" >
                                @error('start_of_service')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="end_of_service" class="block text-gray-700 text-sm font-bold mb-2">End of Service</label>
                                <input type="date" id="end_of_service" name="end_of_service" class="mt-1 block py-1 px-2 w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" >
                                @error('end_of_service')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex justify-end items-center">
                                <div class="mb-4">
                                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 mr-3">Create Official</button>
                                </div>
                                <div class="mb-4">
                                    <button type="button" onclick="toggleAddModal()" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
                            <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangayOfficials as $official)
                            <tr class="border-b border-gray-200">
                                <td class="lg:px-6 text-[10px] lg:text-[15px]">{{ $official->resident->first_name }}, {{ $official->resident->last_name}}</td>
                                <td class="lg:px-6 text-[10px] lg:text-[15px]">{{ $official->position }}</td>
                                <td class="lg:px-6 text-[10px] lg:text-[15px]">
                                    @if ($official->purok !== 'All Purok')
                                        Purok {{ $official->purok }}
                                    @else
                                        {{ $official->purok }}
                                    @endif
                                </td>                                
                                <td class="lg:px-6 text-[10px] lg:text-[15px]">{{ $official->committee }}</td>
                                <td class="lg:px-6 text-[10px] lg:text-[15px]">{{ $official->start_of_service }}</td>
                                <td class="lg:px-6 text-[10px] lg:text-[15px]">{{ $official->end_of_service }}</td>
                                <td class="text-center">
                                    <div class="flex justify-center items-center py-2">
                                        <button onclick="toggleEditModal('{{ $official->id }}')" class="text-blue-600 py-1 px-2 sm:px-3 rounded hover:text-blue-800 text-sm sm:text-base">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
    
                                        {{-- <button onclick="toggleDeleteModal('{{ $official->id }}')" class="text-red-700 lg:text-[14px] text-[7px] py-1 px-2 md:px-3 rounded hover:text-red-900">
                                            <i class="fa-solid fa-trash"></i>
                                        </button> --}}

                                        <div id="edit-modal-{{ $official->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                                            <!-- Edit Form -->
                                            <div class="mt-[20px] mb-6 w-[400px] mx-auto bg-white p-6 rounded shadow">
                                        
                                                <div class="flex justify-center items-center mb-4">
                                                    <div class="flex justify-start items-center">
                                                        <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 mr-5"></i>
                                                    </div>
                                                    <div class="flex justify-center items-center">
                                                        <h1 class="text-xl font-bold text-blue-600 text-center mb-2">Edit Barangay Official</h1>
                                                    </div>
                                                    <div class="flex justify-start items-center">
                                                        <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 ml-5"></i>
                                                    </div>
                                                </div>
                                        
                                                <hr class="border-t-2 border-blue-300 mb-4">
                                        
                                                <form action="{{ route('barangay.officials.update', $official->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                            
                                                    <div class="max-h-[60vh] overflow-y-auto">
                                                    <!-- Resident Dropdown with Search -->
                                                        <div class="mb-4">
                                                            <label for="resident_id" class="block text-gray-700 text-sm font-bold mb-2 text-start">Select Resident</label>
                                                            <select name="resident_id" id="resident_id" class="mt-1 block w-full text-sm text-gray-900 border py-1 px-2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                                                <option value="">Select a resident</option>
                                                                @foreach($residents as $resident)
                                                                    <option value="{{ $resident->id }}" {{ $resident->id == $official->resident_id ? 'selected' : '' }}>
                                                                        {{ $resident->first_name }} {{ $resident->last_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('resident_id')
                                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                
                                                        <div class="mb-4">
                                                            <label for="position" class="block text-gray-700 text-sm font-bold mb-2 text-left">Position</label>
                                                            <select name="position" id="position" class="mt-1 block w-full text-sm text-gray-900 border py-1 px-2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                                                <option value="">Select a Position</option>
                                                                <option value="Barangay Captain" {{ $official->position === 'Barangay Captain' ? 'selected' : '' }}>Barangay Captain</option>
                                                                <option value="Barangay Kagawad" {{ $official->position === 'Barangay Kagawad' ? 'selected' : '' }}>Barangay Kagawad</option>
                                                                <option value="Secretary" {{ $official->position === 'Secretary' ? 'selected' : '' }}>Barangay Secretary</option>
                                                                <option value="Treasurer" {{ $official->position === 'Treasurer' ? 'selected' : '' }}>Barangay Treasurer</option>
                                                                <option value="Barangay Tanod" {{ $official->position === 'Barangay Tanod' ? 'selected' : '' }}>Barangay Tanod</option>
                                                                <option value="Sk Chairperson" {{ $official->position === 'Sk Chairperson' ? 'selected' : '' }}>SK Chairperson</option>
                                                                <option value="Sk Kagawad" {{ $official->position === 'Sk Kagawad' ? 'selected' : '' }}>SK Kagawad</option>
                                                            </select>
                                                            @error('position')
                                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                            
                                                        <div class="mb-4">
                                                            <label for="purok" class="block text-gray-700 text-sm font-bold mb-2 text-start">Select Purok</label>
                                                            <select name="purok" id="purok" class="mt-1 block w-full text-sm text-gray-900 border py-1 px-2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                                                <option value="">Select a Purok</option>
                                                                @foreach($puroks as $purok)
                                                                    <option value="{{ $purok->id }}" {{ $purok->id == $official->purok ? 'selected' : '' }}>
                                                                        Purok {{ $purok->purok_number }}
                                                                    </option>
                                                                @endforeach
                                                                <option value="All Purok" {{ $official->purok === 'All Purok' ? 'selected' : '' }}>All Purok</option>
                                                            </select>
                                                            @error('purok')<span>{{ $message }}</span>@enderror
                                                        </div>
                                                        
                                                        <div class="mb-4">
                                                            <label for="committee" class="block text-gray-700 text-sm font-bold mb-2 text-left">Committee</label>
                                                            <select name="committee" id="committee" class="mt-1 block w-full text-sm text-gray-900 border py-1 px-2 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                                                <option value="">Select a Committee</option>
                                                                <option value="Committee on Health" {{ $official->committee == 'Committee on Health' ? 'selected' : '' }}>Committee on Health</option>
                                                                <option value="Committee on Education" {{ $official->committee == 'Committee on Education' ? 'selected' : '' }}>Committee on Education</option>
                                                                <option value="Committee on Social Services" {{ $official->committee == 'Committee on Social Services' ? 'selected' : '' }}>Committee on Social Services</option>
                                                                <option value="Committee on Finance" {{ $official->committee == 'Committee on Finance' ? 'selected' : '' }}>Committee on Finance</option>
                                                                <option value="Committee on Environment" {{ $official->committee == 'Committee on Environment' ? 'selected' : '' }}>Committee on Environment</option>
                                                                <option value="Committee on Public Safety" {{ $official->committee == 'Committee on Public Safety' ? 'selected' : '' }}>Committee on Public Safety</option>
                                                                <option value="None" {{ $official->committee == 'None' ? 'selected' : '' }}>None</option>
                                                            </select>
                                                            @error('committee')
                                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        
                                            
                                                        <!-- Start of Service -->
                                                        <div class="mb-4">
                                                            <label for="start_of_service" class="block text-gray-700 text-sm font-bold mb-2 text-start">Start of Service</label>
                                                            <input type="date" name="start_of_service" id="start_of_service" class="mt-1 block py-1 px-2 w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ old('start_of_service', $official->start_of_service) }}">
                                                            @error('start_of_service')
                                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                            
                                                        <!-- End of Service -->
                                                        <div class="mb-4">
                                                            <label for="end_of_service" class="block text-gray-700 text-sm font-bold mb-2 text-start">End of Service</label>
                                                            <input type="date" name="end_of_service" id="end_of_service" class="mt-1 block py-1 px-2 w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ old('end_of_service', $official->end_of_service) }}">
                                                            @error('end_of_service')
                                                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="flex justify-end items-center mt-3">
                                                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 mr-3">
                                                            Update Official
                                                        </button>
                                                        <button type="button" onclick="toggleEditModal('{{ $official->id }}')" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        
                                        {{-- <div id="delete-modal-{{ $official->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-20">
                                            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-4 sm:p-6 md:w-1/2 lg:w-1/3">
                                                <p class="text-left text-lg font-bold text-gray-600 uppercase mb-3">Name: 
                                                    <span class="text-blue-600">{{ $official->resident->first_name }}, {{ $official->resident->last_name }}</span>
                                                </p>
                                                <p class="text-left text-lg font-bold text-gray-600 uppercase mb-3">Position: 
                                                    <span class="text-blue-600">{{ $official->position }}</span>
                                                </p>
                                                <hr class="border-t-2 border-gray-300">

                                                <p class="mt-3 text-gray-600 text-left text-[17px]">End of term / Some issue occured</p>
                                                <p class="mb-5 mt-2 text-gray-600 text-left text-[17px]">Continue to delete this Official?</p>
                                                <div class="flex justify-end space-x-4">
                                                    <form action="{{ route('barangay.officials.destroy', ['official' => $official->id]) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                            Delete
                                                        </button>
                                                    </form>
                                                    <button onclick="toggleDeleteModal('{{ $official->id }}')" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>                                         --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // function toggleDeleteModal(id) {
    //     const modal = document.getElementById(`delete-modal-${id}`);
    //     if (modal) {
    //         modal.classList.toggle('hidden');
    //     }
    // }
    function toggleAddModal() {
        const modal = document.getElementById(`add-modal`);
        modal.classList.toggle('hidden');
    }

    function toggleEditModal(officialId) {
        const modal = document.getElementById(`edit-modal-${officialId}`);
        modal.classList.toggle('hidden');
    }
</script>

@endsection