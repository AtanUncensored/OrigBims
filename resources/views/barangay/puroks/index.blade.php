@extends('barangay.templates.navigation-bar')

@section('title', 'Puroks')

@section('content')
    <div class="px-4">
        <div class="py-2 px-4 bg-white rounded-lg shadow-lg">

            <div class="flex justify-start items-center">
                <h1 class="text-xl font-bold text-blue-500 mb-3">PUROK LIST:</h1>
            </div>                    

            <hr class="border-t-2 mb-4 border-gray-300 mb-6">
    
            <div class="flex justify-start items-center">
                <button onclick="toggleAddModal()" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500">
                    <i class="fa-solid fa-plus"></i> Add Purok</a>
                </button>
    
                <div id="add-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                                
                    <!-- Add Form -->
                    <div class="mt-[20px] mb-6 w-[400px] mx-auto bg-white p-6 rounded shadow">
    
                        <div class="flex justify-center items-center mb-4">
                            <div class="flex justify-start items-center">
                                <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 mr-5"></i>
                            </div>
                            <div class="flex justify-center items-center">
                                <h1 class="text-xl font-bold text-blue-600 text-center mb-2">Add New Purok</h1>
                            </div>
                            <div class="flex justify-start items-center">
                                <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 ml-5"></i>
                            </div>
                        </div>
    
                        <hr class="border-t-2 border-blue-300 mb-4">
    
                        <form action="{{ route('barangay.purok.storePurok') }}" method="POST">
                            @csrf
                              <!-- Resident Dropdown with Search -->
                              <div class="mb-4">
                                <label for="purok_name" class="block text-gray-700 text-sm font-bold mb-2">Purok_Name:</label>
                                <input type="text" class="mt-1 block py-1 px-2 w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="purok_name" name="purok_name" value="{{ old('purok_name')}}">
                                @error('purok_name')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="purok_number" class="block text-gray-700 text-sm font-bold mb-2">Purok_Number:</label>
                                <input type="number" class="mt-1 block py-1 px-2 w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="purok_number" name="purok_number" value="{{ old('purok_number')}}">
                                @error('purok_number')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex justify-end items-center">
                                <div class="mb-4">
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mr-3">Add Purok</button>
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
    
                <div class="ml-[300px]">
                    @if(session('success'))
                        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-2 px-4 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
        
                    @if ($errors->has('error'))
                        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-red-500 text-white text-center py-2 px-4 rounded">
                            {{ $errors->first('error') }}
                        </div>
                    @endif
                </div>
            </div>
    
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-6">
                @foreach ($puroks as $purok)
                    <div class=" rounded-lg p-4 shadow-md border border-gray-300 hover:shadow-lg transition">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Purok: {{ $purok->purok_number }}</h3>

                        <hr class="border-t-2 mb-4 border-gray-300 mb-3">
    
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800">Name: {{ $purok->purok_name }}</h3>
                            <a href="{{ route('purok.residents', $purok->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                View
                            </a>
                        </div>
    
                    </div>
                    
                @endforeach
            </div>
    
        </div>
    </div>

<script>
      function toggleAddModal() {
        const modal = document.getElementById(`add-modal`);
        modal.classList.toggle('hidden');
    }
</script>
@endsection
