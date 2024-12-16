@extends('lgu.lgu-template.navigation-bar')

@section('title', 'Barangay Admins')

@section('content')
<div class="px-6 md:px-4">
    <div class="bg-white rounded-lg max-h-[20vh] overflow-y-auto shadow-lg py-2 px-4 mb-5">
        <div id="title">
            <h1 class="text-xl font-bold text-blue-500 mb-3">FILTER BARANGAYS:</h1>
        </div>
    
        @if(session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-2 px-4 rounded mb-2">
            {{ session('success') }}
        </div>
        @endif
    
        <!-- Filter Form using Select2 -->
        <div class="mb-4"> 
          <form action="{{ route('lgu.admins') }}" method="GET" id="filterForm">
            <p class="mb-2 text-gray-600 text-[13px] lg:text-[15px] font-semibold">Filter here:</p>
                <select name="barangay_ids[]" id="barangay_id" class="barangay-select w-full p-2 border rounded-md" multiple>
                    @foreach($barangays as $barangay)
                        <option value="{{ $barangay->id }}" {{ in_array($barangay->id, (array) request('barangay_ids', [])) ? 'selected' : '' }}>
                            {{ $barangay->barangay_name }}
                        </option>
                    @endforeach
                </select>
          </form>
        </div>
    </div>


    <!-- Table for displaying Barangay Admins -->
    <div class="bg-white rounded-lg shadow-lg py-2 px-4">

        <h1 class="text-xl font-bold text-blue-500 mb-3">ADMINISTRATORS LIST:</h1>

        <div class="mb-2 flex justify-end ">

            <!-- Caution before proceding to delete an admin -->
            <button class="relative text-left px-4 py-2 text-red-600 text-[10px] lg:text-[15px] hover:text-red-800 rounded-lg group">
                <span class="font-bold">Caution <i class="fa-solid fa-triangle-exclamation"></i></span>
                <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 hidden group-hover:block bg-white text-red-600 text-[10px] lg:text-[15px] p-4 rounded shadow-lg w-64">
                    <strong>Warning!</strong> Beware when deleting a single admin from a specific barangay. Please Proceed with caution and read the confirmation before continuing.
                </div>
            </button>        
    
             <!-- Create -->
            {{-- <a href="{{ route('lgu.create-barangay') }}" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500"><i class="fa-solid fa-plus"></i> Add Barangay Admin</a> --}}

            <button onclick="toggleAddModal()" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500">
                <i class="fa-solid fa-plus"></i> Add New Barangay </a>
            </button>

            <!-- Add Modal ni dere same sa log out nga layout -->
            <div id="add-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                            
                <!-- Add Form -->
                <div class="mt-[20px] mb-6 w-[400px] mx-auto bg-white p-6 rounded shadow">

                    <div class="flex justify-center items-center mb-4">
                        <div class="flex justify-start items-center">
                            <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 mr-5"></i>
                        </div>
                        <div class="flex justify-center items-center">
                            <h1 class="text-xl font-bold text-blue-600 text-center mb-2">Create Barangay Admin</h1>
                        </div>
                        <div class="flex justify-start items-center">
                            <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 ml-5"></i>
                        </div>
                    </div>

                    <hr class="border-t-2 border-blue-300 mb-4">

                    <form method="POST" action="{{ route('lgu.store-barangay-admin') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="barangay_id" class="block text-gray-700 text-sm font-bold mb-2">Select Barangay</label>
                            <select name="barangay_id" id="barangay_id" class="mt-1 py-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                @foreach($barangays as $barangay)
                                    <option value="{{ $barangay->id }}">{{ $barangay->barangay_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                            <input type="text" id="name" name="name" class="mt-1 px-2 py-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" id="email" name="email" class="mt-1 px-2 py-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                            <input type="password" id="password" name="password" class="mt-1 px-2 py-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 px-2 py-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                            @error('password_confirmation')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex justify-end items-center">
                            <div class="mb-4">
                                <button type="submit" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500 mr-3">Create</button>
                            </div>
                            <div class="mb-4">
                                <button onclick="toggleAddModal()" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="max-h-[40vh] overflow-y-auto">
            <table class="min-w-full table-auto bg-white border border-gray-300 rounded-lg shadow-md">
                <thead class="bg-gray-600 text-white">
                    <tr>
                        <th class="py-3 px-4 lg:px-6 bg-gray-600 text-white font-bold uppercase text-[10px] lg:text-[13px] text-left">Name</th>
                        <th class="py-3 px-4 lg:px-6 bg-gray-600 text-white font-bold uppercase text-[10px] lg:text-[13px] text-left">Email</th>
                        <th class="py-3 px-4 lg:px-6 bg-gray-600 text-white font-bold uppercase text-[10px] lg:text-[13px] text-left">Barangay</th>
                        <th class="py-3 px-4 lg:px-6 bg-gray-600 text-white font-bold uppercase text-[10px] lg:text-[13px] text-left">Update</th>
                    </tr>
                </thead>
                <tbody>
                    @if($adminUsers->isEmpty())
                    <tr class="hover:bg-gray-300 transition duration-300 ease-in-out">
                        <td colspan="4" class="py-4 px-6 text-center text-gray-500">
                            No barangay administrators found.
                        </td>
                    </tr>
                    @else
                    @foreach ($adminUsers as $admin)
                    <tr class="hover:bg-gray-300 transition duration-300 ease-in-out">
                        <td class="py-2 px-4 font-semibold border-b text-[10px] lg:text-[15px] border-gray-200">{{ $admin->name }}</td>
                        <td class="py-2 px-4 font-semibold border-b text-[8px] lg:text-[15px] text-blue-600 border-gray-200">{{ $admin->email }}</td>
                        <td class="py-2 px-4 font-semibold border-b text-[10px] lg:text-[15px] border-gray-200">{{ $admin->barangay ? $admin->barangay->barangay_name : 'N/A' }}</td>
                        <td class="py-2 px-4 font-semibold border-b border-gray-200">
                            {{-- <a href="{{ route('lgu.admins-crud.edit-barangay-admin', $admin->id) }}" class="text-blue-600 py-1 px-2 sm:px-3 rounded hover:text-blue-800 text-sm sm:text-base"><i class="fa-solid fa-pen"></i></a> --}}

                            <button onclick="toggleEditModal('{{ $admin->id }}')" class="text-blue-600 py-1 px-2 sm:px-3 rounded hover:text-blue-800 text-sm sm:text-base">
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <button onclick="toggleDeleteModal('{{ $admin->id }}')" class="text-red-600 py-1 px-2 sm:px-3 rounded hover:text-red-800 text-sm sm:text-base">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                            <!-- Edit Modal ni dere same sa log out nga layout -->
                            <div id="edit-modal-{{ $admin->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                                <!-- Edit Form -->
                                <div class="mt-[20px] mb-6 w-[400px] mx-auto bg-white p-6 rounded shadow">
                            
                                    <div class="flex justify-center items-center mb-4">
                                        <div class="flex justify-start items-center">
                                            <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 mr-5"></i>
                                        </div>
                                        <div class="flex justify-center items-center">
                                            <h1 class="text-xl font-bold text-blue-600 text-center mb-2">Edit Barangay Admin</h1>
                                        </div>
                                        <div class="flex justify-start items-center">
                                            <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 ml-5"></i>
                                        </div>
                                    </div>
                            
                                    <hr class="border-t-2 border-blue-300 mb-4">
                            
                                    <form action="{{ route('lgu.admins-crud.update-barangay-admin', $admin->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                            
                                        <div class="mb-4">
                                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                                            <input type="text" name="name" id="name" value="{{ old('name', $admin->name) }}" class="mt-1 px-2 py-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('name') border-red-500 @enderror" required>
                                            @error('name')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                            
                                        <div class="mb-4">
                                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                                            <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" class="mt-1 px-2 py-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('email') border-red-500 @enderror" required>
                                            @error('email')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                            
                                        <div class="mb-4">
                                            <label for="barangay_id" class="block text-gray-700 text-sm font-bold mb-2">Assigned Barangay</label>
                                            <select name="barangay_id" id="barangay_id" class="mt-1 py-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('barangay_id') border-red-500 @enderror">
                                                <option value="">Select a Barangay</option>
                                                @foreach ($barangays as $barangay)
                                                    <option value="{{ $barangay->id }}" {{ old('barangay_id', $admin->barangay_id) == $barangay->id ? 'selected' : '' }}>
                                                        {{ $barangay->barangay_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('barangay_id')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                            
                                        <div class="flex justify-end items-center">
                                            <div class="mb-4">
                                                <button type="submit" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500 mr-3">Update</button>
                                            </div>
                                            <div class="mb-4">
                                                <button onclick="toggleEditModal('{{ $admin->id }}')" type="button" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            

                            <!-- Delete Modal ni dere same sa log out nga layout -->
                            <div id="delete-modal-{{ $admin->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                                <div class="bg-white rounded-lg shadow-lg w-[400px] max-w-lg p-4 sm:p-6 md:w-1/2 lg:w-1/3 mt-[16px]">
                                    <div class="flex justify-start items-center mb-3">
                                        <img src="{{ asset('storage/' . (strpos($admin->barangay->logo, 'images/') === false ? 'images/' . $admin->barangay->logo : $admin->barangay->logo)) }}" alt="barangay/lgu logo" class="w-[25px] h-[25px] lg:w-[50px] lg:h-[50px] sm:w-[50px] sm:h-[50px] object-cover rounded-full">
                                        <h3 class="text-sm lg:text-lg font-bold text-green-600 ml-3 uppercase"> Brgy. {{ $admin->barangay ? $admin->barangay->barangay_name : 'N/A' }}</h3>
                                    </div>
                                    <h3 class="block text-gray-700 text-[18px] font-bold mb-2">Admin user: <span class="text-blue-600">{{ $admin->name }}</span></h3>
                                    <hr class="border-t-2 border-gray-300">
                                    <p class="mb-3 mt-3 text-sm lg:text-[15px] text-red-500">Records added by this admin will also be deleted.</p>

                                    <p class="block text-gray-700 text-[15px] font-bold mb-2">Continue to delete admin?</p>
                                    
                                    <div class="flex justify-end space-x-4">
                                        <form action="{{ route('lgu.admins-crud.delete-barangay-admin', $admin->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="py-2 px-4 text-[10px] lg:text-[15px] bg-red-600 text-white font-bold rounded hover:bg-red-500">
                                                Delete
                                            </button>
                                        </form>

                                        <button onclick="toggleDeleteModal('{{ $admin->id }}')" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>                            
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Search para sa barangay nga filter
        $('.barangay-select').select2({
            placeholder: 'Select Barangay',
            allowClear: true
        });

        // Submit form kung maka select na ug barangay
        $('#barangay_id').on('change', function() {
            $('#filterForm').submit();
        });
    });

        //Show ni sa add modal
        function toggleAddModal() {
            const modal = document.getElementById(`add-modal`);
            modal.classList.toggle('hidden');
        }
    
        //Show ni sa edit modal
        function toggleEditModal(adminId) {
            const modal = document.getElementById(`edit-modal-${adminId}`);
            modal.classList.toggle('hidden');
        }
        //Show ni sa delete modal
        function toggleDeleteModal(adminId) {
            const modal = document.getElementById(`delete-modal-${adminId}`);
            modal.classList.toggle('hidden');
        }
</script>

@endsection