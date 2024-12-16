@extends('lgu.lgu-template.navigation-bar')

@section('title', 'Barangays')

@section('content')
<div class="px-6 md:px-4">
    <!-- Search and Create Barangay -->
    <div class="bg-white rounded-lg max-h-[15vh] overflow-y-auto shadow-lg items-center px-4 mb-6">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold py-2 text-blue-500">LOOK FOR A BARANGAY:</h1>
        </div>

        @if(session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-2 px-4 rounded mb-2">
            {{ session('success') }}
        </div>
        @endif

        <div class="py-2 px-4 flex justify-center items-center">
            <form class="inline-flex w-full sm:w-auto" method="GET" action="{{ route('lgu.barangays-list') }}">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search..." 
                    class="px-3 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-gray-500 w-full sm:w-80 lg:py-2 lg:px-4 text-[7px] sm:text-base">
                <button 
                    type="submit" 
                    class="px-3 bg-gray-600 text-white rounded-r-md hover:bg-gray-600 transition lg:py-2 lg:px-4">
                    <i class="fa-solid fa-magnifying-glass fa-sm lg:fa-lg"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Table ni record sa available barangay -->
    <div class="max-h-[60vh] overflow-y-auto bg-white py-2 px-4 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-3">
            <h1 class="text-xl font-bold text-blue-500">BARANGAY RECORDS:</h1>

            <button onclick="toggleAddModal()" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500">
                <i class="fa-solid fa-plus"></i> Add Barangay Admin</a>
            </button>

            <div id="add-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                            
                <!-- Add Form -->
                <div class="mt-[20px] mb-6 w-[400px] mx-auto bg-white p-6 rounded shadow">

                    <div class="flex justify-center items-center mb-4">
                        <div class="flex justify-start items-center">
                            <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 mr-5"></i>
                        </div>
                        <div class="flex justify-center items-center">
                            <h1 class="text-xl font-bold text-blue-600 text-center mb-2">Create New Barangay</h1>
                        </div>
                        <div class="flex justify-start items-center">
                            <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 ml-5"></i>
                        </div>
                    </div>

                    <hr class="border-t-2 border-blue-300 mb-4">

                    <form action="{{ route('lgu.store-barangay') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Barangay Name -->
                        <div class="mb-4">
                            <label for="barangay_name" class="block text-gray-700 text-sm font-bold mb-2">Barangay Name</label>
                            <input type="text" id="barangay_name" name="barangay_name" 
                                   class="mt-1 py-1 px-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" 
                                   value="{{ old('barangay_name') }}" required>
                            @error('barangay_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                
                        <!-- Logo -->
                        <div class="mb-4">
                            <label for="logo" class="block text-gray-700 text-sm font-bold mb-2">Barangay Logo</label>
                            <input type="file" id="logo" name="logo" 
                                   class="mt-1 py-1 px-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            @error('logo')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                
                        <!-- Background Image -->
                        <div class="mb-4">
                            <label for="background_image" class="block text-gray-700 text-sm font-bold mb-2">Background Image</label>
                            <input type="file" id="background_image" name="background_image" 
                                   class="mt-1 py-1 px-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            @error('background_image')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                
                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500 mr-3">
                                Create
                            </button>

                            <button onclick="toggleAddModal()" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <table class="min-w-full table-auto bg-white border border-gray-300">
            <thead class="bg-gray-600 text-white">
                <tr>
                    <th class="py-3 px-4 lg:px-6 bg-gray-600 text-white font-bold uppercase text-[10px] lg:text-[13px] text-center">Logo</th>
                    <th class="py-3 px-4 lg:px-6 bg-gray-600 text-white font-bold uppercase text-[10px] lg:text-[13px] text-center">Name</th>
                    <th class="py-3 px-4 lg:px-6 bg-gray-600 text-white font-bold uppercase text-[10px] lg:text-[13px] text-center">Update</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangays as $barangay)
                <tr class="hover:bg-gray-300 transition duration-300 ease-in-out">
                    <td class="lg:py-2 py-3 lg:px-4 font-semibold">
                        @if ($barangay->logo)
                        <img src="{{ asset('storage/' . (strpos($barangay->logo, 'images/') === false ? 'images/' . $barangay->logo : $barangay->logo)) }}" alt="Barangay Logo" class="w-[40px] h-[40px] sm:w-[50px] sm:h-[50px] object-cover rounded-full">
                        @else
                            <span class="text-sm text-gray-500">No Logo</span>
                        @endif
                    </td>

                    <td class="py-2 px-4 lg:py-2 lg:px-4 text-[10px] lg:text-[15px] font-semibold text-center">{{ $barangay->barangay_name }}</td>
                    <td class="py-2 px-4 sm:px-6 font-semibold flex justify-center items-center">
                        <a href="{{ route('lgu.barangays-show', $barangay->id) }}" class="text-gray-700 py-1 px-2 sm:px-3 rounded hover:text-gray-900 text-sm sm:text-base">
                            <i class="fa-solid fa-window-maximize"></i>
                        </a>
                        <button onclick="toggleEditModal('{{ $barangay->id }}')" class="text-blue-600 py-1 px-2 sm:px-3 rounded hover:text-blue-800 text-sm sm:text-base">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </td>
                </tr>
                <!-- Edit Modal -->
                <div id="edit-modal-{{ $barangay->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                    <div class="mt-[20px] mb-6 w-[400px] mx-auto bg-white p-6 rounded shadow">
                        <div class="flex justify-center items-center mb-4">
                            <div class="flex justify-start items-center">
                                <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 mr-5"></i>
                            </div>
                            <div class="flex justify-center items-center">
                                <h1 class="text-xl font-bold text-blue-600 text-center mb-2">Edit Barangay Details</h1>
                            </div>
                            <div class="flex justify-start items-center">
                                <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 ml-5"></i>
                            </div>
                        </div>

                        <hr class="border-t-2 border-blue-300 mb-4">

                        <form action="{{ route('lgu.barangays-update', $barangay->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="flex items-center justify-center mb-4">
                                <img src="{{ asset('storage/' . (strpos($barangay->logo, 'images/') === false ? 'images/' . $barangay->logo : $barangay->logo)) }}" alt="Barangay Logo" class="w-[40px] h-[40px] sm:w-[50px] sm:h-[50px] object-cover rounded-full mr-3">
                                <h3 class="text-sm lg:text-lg font-bold text-green-600 uppercase">Brgy. {{ $barangay->barangay_name }}</h3>
                            </div>

                            <div class="mb-4">
                                <label for="logo" class="block text-gray-700 text-sm font-bold mb-2">Logo:</label>
                                <input type="file" id="logo" name="logo" class="mt-1 py-1 px-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" accept="image/*">
                                @error('logo')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="barangay_name" class="block text-gray-700 text-sm font-bold mb-2">Barangay Name:</label>
                                <input type="text" id="barangay_name" name="barangay_name" value="{{ old('barangay_name', $barangay->barangay_name) }}" class="mt-1 py-1 px-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                @error('barangay_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="background_image" class="block text-gray-700 text-sm font-bold mb-2">Background Image:</label>
                                <input type="file" id="background_image" name="background_image" class="mt-1 py-1 px-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" accept="image/*">
                                @error('background_image')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex justify-end items-center">
                                <button type="submit" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500 mr-3">Update</button>
                                <button onclick="toggleEditModal('{{ $barangay->id }}')" type="button" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // Pangpagawas sa modal

    function toggleAddModal() {
        const modal = document.getElementById(`add-modal`);
        modal.classList.toggle('hidden');
    }

    function toggleEditModal(barangayId) {
        const modal = document.getElementById(`edit-modal-${barangayId}`);
        modal.classList.toggle('hidden');
    }
</script>
@endsection
