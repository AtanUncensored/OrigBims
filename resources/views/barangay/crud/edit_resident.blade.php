@extends('barangay.templates.navigation-bar')

@section('title', 'Resident Details Update')

@section('content')
<div class="py-6 px-8 bg-white rounded-lg shadow-lg">
    <h1 class="text-center font-bold text-3xl text-blue-600 mb-6">Edit Resident</h1>

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

    <form action="{{ route('barangay.residents.update', $resident->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-h-[55vh] overflow-y-auto">
            <div class="info1 space-y-4">
                <div class="form-group">
                    <label for="first_name" class="font-semibold">First Name:</label>
                    <input type="text" class="form-control w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300" id="first_name" name="first_name" value="{{ old('first_name', $resident->first_name) }}" required>
                </div>
    
                <div class="form-group">
                    <label for="last_name" class="font-semibold">Last Name:</label>
                    <input type="text" class="form-control w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300" id="last_name" name="last_name" value="{{ old('last_name', $resident->last_name) }}" required>
                </div>
    
                <div class="form-group">
                    <label for="middle_name" class="font-semibold">Middle Name:</label>
                    <input type="text" class="form-control w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300" id="middle_name" name="middle_name" value="{{ old('middle_name', $resident->middle_name) }}">
                </div>

                <div class="form-group">
                    <label for="suffix" class="font-semibold">Suffix:</label>
                    <input type="text" class="form-control w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300" id="suffix" name="suffix" value="{{ old('suffix', $resident->suffix) }}">
                </div>
                
                <div class="form-group">
                    <label for="purok" class="font-semibold">Purok:</label>
                    <select name="purok" id="purok" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:outline-none focus:ring focus:ring-blue-400">
                        <option value="">Select Purok</option>
                        @foreach ($puroks as $purok)
                            <option value="{{ $purok->id }}" {{ old('purok', $resident->purok_id) == $purok->id ? 'selected' : '' }}>
                                Purok {{ $purok->purok_number }}
                            </option>
                        @endforeach
                    </select>
                </div>                
    
                <div class="form-group">
                    <label for="birth_date" class="font-semibold">Birth Date:</label>
                    <input type="date" class="form-control w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300" id="birth_date" name="birth_date" value="{{ old('birth_date', $resident->birth_date) }}">
                </div>
    
                <div class="form-group">
                    <label for="place_of_birth" class="font-semibold">Place of Birth:</label>
                    <input type="text" class="form-control w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300" id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth', $resident->place_of_birth) }}">
                </div>
    
                <div class="form-group">
                    <label for="gender" class="font-semibold">Gender:</label>
                    <input type="text" class="form-control w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300" id="gender" name="gender" value="{{ old('gender', $resident->gender) }}">
                </div>
            </div>

            <div class="info2 space-y-4">
                <div class="form-group">
                    <label for="civil_status" class="font-semibold">Civil Status:</label>
                    <input type="text" class="form-control w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300" id="civil_status" name="civil_status" value="{{ old('civil_status', $resident->civil_status) }}">
                </div>

                <div class="form-group">
                    <label for="phone_number" class="font-semibold">Phone Number:</label>
                    <input type="text" class="form-control w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300" id="phone_number" name="phone_number" value="{{ old('phone_number', $resident->phone_number) }}">
                </div>

                <div class="form-group">
                    <label for="citizenship" class="font-semibold">Citizenship:</label>
                    <input type="text" class="form-control w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300" id="citizenship" name="citizenship" value="{{ old('citizenship', $resident->citizenship) }}">
                </div>

                <div class="form-group">
                    <label for="nickname" class="font-semibold">Nickname:</label>
                    <input type="text" class="form-control w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300" id="nickname" name="nickname" value="{{ old('nickname', $resident->nickname) }}">
                </div>

                <div class="form-group">
                    <label for="email" class="font-semibold">Email:</label>
                    <input type="email" class="form-control w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300" id="email" name="email" value="{{ old('email', $resident->email) }}">
                </div>

                <div class="form-group">
                    <label for="current_address" class="font-semibold">Current Address:</label>
                    <input type="text" class="form-control w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300" id="current_address" name="current_address" value="{{ old('current_address', $resident->current_address) }}">
                </div>

                <div class="form-group">
                    <label for="permanent_address" class="font-semibold">Permanent Address:</label>
                    <input type="text" class="form-control w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300" id="permanent_address" name="permanent_address" value="{{ old('permanent_address', $resident->permanent_address) }}">
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="py-2 px-6 bg-blue-600 text-white mr-3 font-semibold rounded-lg shadow hover:bg-blue-700 transition ease-in-out duration-150">
                Update
            </button>
            <a href="{{ route('barangay.residents.index') }}" class="py-2 px-6 text-blue-600 font-semibold hover:text-blue-700 transition ease-in-out duration-150">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
