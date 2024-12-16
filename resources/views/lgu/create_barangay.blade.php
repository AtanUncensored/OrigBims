@extends('lgu.lgu-template.navigation-bar')

@section('title', 'Assign Barangay Admin')

@section('content')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="py-2 px-4 max-h-[80vh] overflow-y-auto">
    <h1 class="text-2xl font-bold text-blue-600 text-center">Create Barangay Admin</h1>

    <!-- Success message ni dere nya naka set pud na timer nya is 2 sec para ma wala
    gamit ang alpine extension naa sa js folder-->
    @if(session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-1 px-2 rounded mb-2 mt-2">
        {{ session('success') }}
    </div>
    @endif

    <!-- Create Form para sa admin sa kada barangay -->
    <div class="mt-[20px] mb-4 max-w-lg mx-auto bg-white p-8 rounded shadow">
        <form method="POST" action="{{ route('lgu.store-barangay-admin') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="barangay_id" class="block text-gray-700 text-sm font-bold mb-2">Select Barangay</label>
                <select name="barangay_id" id="barangay_id"  class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    @foreach($barangays as $barangay)
                        <option value="{{ $barangay->id }}">{{ $barangay->barangay_name }}</option>
                    @endforeach
                </select>
                @error('barangay_id')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                @error('name')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                @error('email')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                @error('password')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
            </div>
            <div class="flex justify-end items-center">
                <div class="mb-4">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mr-3">Create</button>
                </div>
                <div class="mb-4">
                    <a href="{{ route('lgu.admins') }}" class="inline-block align-baseline font-bold text-lg text-blue-600 hover:text-blue-800">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('.barangay-select').select2();
        });
    </script>
</div>
@endsection
