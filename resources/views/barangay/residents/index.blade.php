@extends('barangay.templates.navigation-bar')

@section('title', 'Residents')

@section('content')
<div class="px-4">
    <div class="flex justify-end items-center mb-4">
        <form action="{{ route('residents.download-excel') }}" method="POST" target="__blank">
            @csrf
            <input type="hidden" name="search" value="{{ $search }}">
            <input type="hidden" name="purok_filter" value="{{ $purokFilter }}">
            <input type="hidden" name="gender_filter" value="{{ $genderFilter }}">
            <input type="hidden" name="age_filter" value="{{ $ageFilter }}">
            <input type="hidden" name="is_alive_filter" value="{{ $isAliveFilter }}">
            <div>
                <button class="py-2 px-3 text-white bg-green-500 rounded-lg  hover:bg-green-600 shadow-lg transition">
                    <i class="fa-solid fa-file-export"></i> Export
                </button>
            </div>
        </form>
    </div>

     <!-- Search bar -->
     <div class="bg-white py-2 px-4 rounded-lg shadow-lg mb-4 max-h-[15vh] overflow-y-auto">
        <h1 class="text-xl font-bold text-blue-500 mb-3">LOOK FOR A RESIDENT:</h1>

        <form method="GET" action="{{ route('barangay.residents.index') }}">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <!-- Search Bar -->
                    <input type="text" name="search" value="{{ old('search', $search) }}" placeholder="Search a resident..." class="py-2 px-4 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-gray-500">
                    <button type="submit" class="py-2 px-4 bg-gray-600 text-white rounded-r-md hover:bg-gray-600 transition"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            
                <div class="flex">
                    <label class="mt-2 mr-3 text-gray-600 text-[13px] lg:text-[15px] font-semibold">Filter Resident By:</label>
                    <!-- Purok Filter -->
                    <select name="purok_filter" class="py-2 px-4 bg-gray-600 text-white text-md font-semibold rounded focus:outline-none mr-2" onchange="this.form.submit()">
                        <option value="">All Purok</option>
                        @foreach($puroks as $purok)
                            <option class="capitalize" value="{{ $purok->id }}" {{ $purok->id == old('purok_filter', $purokFilter) ? 'selected' : '' }}>{{ $purok->purok_name }} ({{ $purok->purok_number }})</option>
                        @endforeach
                    </select>
            
                    <!-- Gender Filter -->
                    <select name="gender_filter" class="py-1 px-2 bg-gray-600 text-white text-md font-semibold rounded focus:outline-none mr-2" onchange="this.form.submit()">
                        <option value="">All Gender</option>
                        <option value="male" {{ old('gender_filter', $genderFilter) == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender_filter', $genderFilter) == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
            
                    <!-- Age Filter -->
                    <select name="age_filter" class="py-1 px-2 bg-gray-600 text-white text-md font-semibold rounded focus:outline-none mr-2" onchange="this.form.submit()">
                        <option value="">All Age Group</option>
                        <option value="children" {{ old('age_filter', $ageFilter) == 'children' ? 'selected' : '' }}>Children (0-12)</option>
                        <option value="teens" {{ old('age_filter', $ageFilter) == 'teens' ? 'selected' : '' }}>Teens (13-19)</option>
                        <option value="adults" {{ old('age_filter', $ageFilter) == 'adults' ? 'selected' : '' }}>Adults (20-39)</option>
                        <option value="middle_aged" {{ old('age_filter', $ageFilter) == 'middle_aged' ? 'selected' : '' }}>Middle-aged (40-59)</option>
                        <option value="senior" {{ old('age_filter', $ageFilter) == 'senior' ? 'selected' : '' }}>Senior Citizens (60+)</option>
                    </select>

                    <select name="is_alive_filter" class="py-1 px-2 bg-gray-600 text-white text-md font-semibold rounded focus:outline-none" onchange="this.form.submit() " >
                        <option value="">Status</option>
                        <option value="1" {{ $isAliveFilter == '1' ? 'selected' : '' }}>Living</option>
                        <option value="0" {{ $isAliveFilter == '0' ? 'selected' : '' }}>Deceased</option>
                    </select>
                    
                </div>
            </div>
        </form>
     </div>
    
    <div class="bg-white py-2 px-4 rounded-lg shadow-lg">
        <div class="flex justify-between mb-4">
            <h1 class="text-xl font-bold text-blue-500 mb-3">LIST OF RESIDENTS:</h1>

            @if(session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-2 px-4 rounded mb-2">
                    {{ session('success') }}
                </div>
            @endif
    
            <a href="{{ route('barangay.create-user') }}" class="py-2 px-2 font-semibold bg-blue-600 text-white rounded flex items-center space-x-2 hover:bg-blue-500 transition">
                <i class="fa-solid fa-plus"></i>
                <span>Add Resident</span>
            </a>
        </div>
        <div class="max-h-[43vh] overflow-y-auto">
            <table class="min-w-full bg-white border border-[2px] border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">Living / Deceased</th>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">Last Name</th>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">First Name</th>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">Middle Name</th>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">Suffix</th>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">Purok</th>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">Gender</th>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-left">Age</th>
                        <th class="py-3 px-6 bg-gray-600 text-white font-bold uppercase text-[12px] text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($residents as $resident)
                        <tr class="hover:bg-gray-200 transition">
                            <td class="py-2 px-4 text-sm text-gray-500 text-center">
                                <!-- Displaying the "Is Alive" status as a colored dot -->
                                <span class="inline-block w-3 h-3 rounded-full {{ $resident->is_alive ? 'bg-green-500' : 'bg-red-500' }}"></span>
                            </td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $resident->last_name }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $resident->first_name }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $resident->middle_name }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $resident->suffix }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $resident->purok->purok_name }} ({{ $resident->purok->purok_number }})</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $resident->gender }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $resident->age }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm font-medium space-x-2 text-center">
                                <a href="{{ route('barangay.residents.view', ['resident_id' => $resident->id]) }}" class="text-gray-700 py-1 px-2 md:px-3 rounded hover:text-gray-900"><i class="fa-solid fa-window-maximize"></i></a>

                                <button onclick="toggleEditModal('{{ $resident->id }}')" class="text-blue-600 py-1 px-2 sm:px-3 rounded hover:text-blue-800 text-sm sm:text-base">
                                    <i class="fa-solid fa-pen"></i>
                                </button>

                                <div id="edit-modal-{{ $resident->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                                    <!-- Edit Form -->
                                    <div class="mt-[20px] mb-6 w-[750px] mx-auto bg-white p-6 rounded shadow">
                                
                                        <p class="font-bold text-xl text-center">Edit Personal Information</p>
                                        <hr class="border-t-2 border-gray-300 mb-4 mt-4">
                    
                                
                                        <form action="{{ route('barangay.residents.update', $resident->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="max-h-[70vh] overflow-y-auto grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div class="container">
                                                    <div class="form-group">
                                                        <label for="is_alive" class="block text-sm font-medium text-gray-700 text-left">Status ( Living/Deceased ):</label>
                                                        <div class="flex items-center">
                                                            <!-- Switch toggle for Is Alive -->
                                                            <input type="checkbox" name="is_alive" id="is_alive" value="1" {{ old('is_alive', $resident->is_alive) ? 'checked' : '' }} class="toggle-switch">
                                                            @error('is_alive')
                                                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="first_name" class="block text-sm font-medium text-gray-700 text-left">First Name:</label>
                                                        <input type="text" name="first_name" id="first_name" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('first_name', $resident->first_name) }}">
                                                        @error('first_name')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="last_name" class="block text-sm font-medium text-gray-700 text-left">Last Name:</label>
                                                        <input type="text" name="last_name" id="last_name" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('last_name', $resident->last_name) }}">
                                                        @error('last_name')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="middle_name" class="block text-sm font-medium text-gray-700 text-left">Middle Name:</label>
                                                        <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $resident->middle_name) }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('middle_name')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="suffix" class="block text-sm font-medium text-gray-700 text-left">Suffix:</label>
                                                        <select name="suffix" id="suffix" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                            <option value="">Select suffix</option>
                                                            <option value="Sr." {{ old('suffix', $resident->suffix) === 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                                            <option value="Jr." {{ old('suffix', $resident->suffix) === 'Jr.' ? 'selected' : '' }}>Jr.</option>
                                                            <option value="1st" {{ old('suffix', $resident->suffix) === '1st' ? 'selected' : '' }}>1st</option>
                                                            <option value="2nd" {{ old('suffix', $resident->suffix) === '2nd' ? 'selected' : '' }}>2nd</option>
                                                            <option value="3rd" {{ old('suffix', $resident->suffix) === '3rd' ? 'selected' : '' }}>3rd</option>
                                                            <option value="None" {{ old('suffix', $resident->suffix) === 'None' ? 'selected' : '' }}>None</option>
                                                        </select>
                                                        @error('suffix')
                                                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>   

                                                    <div class="form-group">
                                                        <label for="purok" class="block text-sm font-medium text-gray-700 text-left">Purok:</label>
                                                        <select name="purok" id="purok" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                            <option value="">Select Purok</option>
                                                            @foreach ($puroks as $purok)
                                                                <option value="{{ $purok->id }}" {{ old('purok', $resident->purok_id) == $purok->id ? 'selected' : '' }}>
                                                                    Purok {{ $purok->purok_number }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('purok')
                                                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>   
                                                    
                                    
                                                    <div class="form-group">
                                                        <label for="birth_date" class="block text-sm font-medium text-gray-700 text-left">Birth Date:</label>
                                                        <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', $resident->birth_date) }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('birth_date')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="place_of_birth" class="block text-sm font-medium text-gray-700 text-left">Place of Birth:</label>
                                                        <input type="text" name="place_of_birth" id="place_of_birth" value="{{ old('place_of_birth', $resident->place_of_birth) }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('place_of_birth')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="gender" class="block text-sm font-medium text-gray-700 text-left">Gender:</label>
                                                        <select name="gender" id="gender" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                            <option value="">Select Gender</option>
                                                            <option value="male" {{ old('gender', $resident->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                                            <option value="female" {{ old('gender', $resident->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                                            <option value="other" {{ old('gender', $resident->gender) === 'other' ? 'selected' : '' }}>Other</option>
                                                        </select>
                                                        @error('gender')
                                                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>                                                    
                                                    
                                                </div>
                                                <div class="container2">
                                
                                                    <div class="form-group">
                                                        <label for="civil_status" class="block text-sm font-medium text-gray-700 text-left">Civil Status:</label>
                                                        <select name="civil_status" id="civil_status" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                            <option value="Single" {{ old('civil_status', $resident->civil_status) === 'Single' ? 'selected' : '' }}>Single</option>
                                                            <option value="Married" {{ old('civil_status', $resident->civil_status) === 'Married' ? 'selected' : '' }}>Married</option>
                                                            <option value="Widowed" {{ old('civil_status', $resident->civil_status) === 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                                            <option value="Separated" {{ old('civil_status', $resident->civil_status) === 'Separated' ? 'selected' : '' }}>Separated</option>
                                                            <option value="Divorced" {{ old('civil_status', $resident->civil_status) === 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                                        </select>
                                                        @error('civil_status')
                                                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>   
                                    
                                                    <div class="form-group">
                                                        <label for="phone_number" class="block text-sm font-medium text-gray-700 text-left">Phone Number:</label>
                                                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $resident->phone_number) }}"class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('phone_number')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="citizenship" class="block text-sm font-medium text-gray-700 text-left">Citizenship:</label>
                                                        <input type="text" name="citizenship" id="citizenship" value="{{ old('citizenship', $resident->citizenship) }}"class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('citizenship')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="nickname" class="block text-sm font-medium text-gray-700 text-left">Nickname:</label>
                                                        <input name="nickname" id="nickname" value="{{ old('nickname', $resident->nickname) }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('nickname')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="email" class="block text-sm font-medium text-gray-700 text-left">Email:</label>
                                                        <input type="email" name="email" id="email" value="{{ old('email', $resident->email) }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('email')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="current_address" class="block text-sm font-medium text-gray-700 text-left">Current Address:</label>
                                                        <input type="text" name="current_address" id="current_address" value="{{ old('current_address', $resident->current_address) }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('current_address')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                    
                                                    <div class="form-group">
                                                        <label for="permanent_address" class="block text-sm font-medium text-gray-700 text-left">Permanent Address:</label>
                                                        <input type="text" name="permanent_address" id="permanent_address" value="{{ old('permanent_address', $resident->permanent_address) }}" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                        @error('permanent_address')
                                                         <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                         @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="father_id" class="block text-sm font-medium text-gray-700 text-left">Father:</label>
                                                        <select name="father_id" id="father_id" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                            <option value="">Select Father</option>
                                                            @foreach ($residents->where('gender', 'male') as $residentOption)  <!-- Filter for males -->
                                                                <option value="{{ $residentOption->id }}" {{ old('father_id', $resident->father_id) == $residentOption->id ? 'selected' : '' }}>
                                                                    {{ $residentOption->first_name }} {{ $residentOption->last_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('father_id')
                                                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    
                                                    <!-- Mother Field -->
                                                    <div class="form-group">
                                                        <label for="mother_id" class="block text-sm font-medium text-gray-700 text-left">Mother:</label>
                                                        <select name="mother_id" id="mother_id" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                                            <option value="">Select Mother</option>
                                                            @foreach ($residents->where('gender', 'female') as $residentOption)  <!-- Filter for females -->
                                                                <option value="{{ $residentOption->id }}" {{ old('mother_id', $resident->mother_id) == $residentOption->id ? 'selected' : '' }}>
                                                                    {{ $residentOption->first_name }} {{ $residentOption->last_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('mother_id')
                                                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    
                                                </div>   
                                            </div>      
                                            <div class="button-group flex justify-end mt-3">
                                                <button type="submit" class="btn btn-primary bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 mr-3">Update Resident</button>
                                
                                                <button type="button" onclick="toggleEditModal('{{ $resident->id }}')" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                                    Cancel
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <button onclick="toggleDeleteModal('{{ $resident->id }}')" class="text-red-700 py-1 px-2 md:px-3 rounded hover:text-red-900">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                    
                                <!-- Delete Modal ni dere same sa log out nga layout -->
                                <div id="delete-modal-{{ $resident->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-20">
                                    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-4 sm:p-6 md:w-1/2 lg:w-1/3">
                                        <p class="text-left text-lg font-bold text-gray-600 uppercase mb-3">Name: <span class="text-blue-600">{{ $resident->last_name}}, {{ $resident->first_name}}</span></p>
                                        <p class="text-left text-lg font-bold text-gray-600 uppercase mb-3">From: <span class="text-blue-600">Purok - {{ $resident->purok->purok_number}} ({{ $resident->purok->purok_name}})</span></p>
                                        <hr class="border-t-2 border-gray-300">
            
                                        <p class="mb-5 mt-3 text-gray-600 text-left text-[17px]">Continue to delete this Resident?</p>
                                            
                                        <div class="flex justify-end space-x-4">
                                    
                                            <form action="{{ route('barangay.residents.delete', ['resident_id' => $resident->id]) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                                    Delete
                                                </button>
                                            </form>

                                            <button onclick="toggleDeleteModal('{{ $resident->id }}')" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div> 
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No residents record found for this barangay.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
       //Show ni sa delete modal
       function toggleDeleteModal(residentId) {
            const modal = document.getElementById(`delete-modal-${residentId}`);
            modal.classList.toggle('hidden');
        }

        function toggleEditModal(residentId) {
        const modal = document.getElementById(`edit-modal-${residentId}`);
        modal.classList.toggle('hidden');
    }
</script>

<style>
    /* Switch styling */
.toggle-switch {
    position: relative;
    width: 50px;
    height: 24px;
    -webkit-appearance: none;
    background-color: #ccc;
    border-radius: 50px;
    outline: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

.toggle-switch:checked {
    background-color: #4CAF50; /* Green when checked */
}

.toggle-switch:before {
    content: '';
    position: absolute;
    top: 2px;
    left: 2px;
    width: 20px;
    height: 20px;
    background-color: white;
    border-radius: 50%;
    transition: transform 0.3s;
}

.toggle-switch:checked:before {
    transform: translateX(26px); /* Move the circle to the right when checked */
}

    .toggle-checkbox:checked {
        right: 0;
        border-color: #4CAF50; 
    }
    .toggle-checkbox:checked + .toggle-label {
        background-color: #4CAF50; 
    }
    .toggle-checkbox {
        transition: all 0.3s ease;
    }
    .toggle-label {
        transition: all 0.3s ease;
    }
</style>


@endsection
