@extends('templates.top-nav')

@section('content')
<style>
    body {
        background-image: url('{{ asset('storage/' . (strpos($barangay->background_image, 'images/') === false ? 'images/' . $barangay->background_image : $barangay->background_image)) }}');
        background-size: cover;
        background-position: center;
    }
    .error-alert {
        background-color: #f8d7da; 
        color: #721c24; 
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #f5c6cb; 
    }
    .password-container {
        position: relative;
        width: 100%;
    }
    .password-toggle {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
    }
    .password-toggle svg {
        width: 24px;
        height: 24px;
        color: #555;
    }
</style>

<div class="flex items-center justify-center mt-[100px]">
    <div class="bg-gray-300 p-4 rounded-lg shadow-lg bg-opacity-60 w-full max-w-md">

        <!-- Error message ni dere -->
        @if ($errors->any())
            <div class="error-alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        
        <div class="flex items-center justify-center mb-6">
            <div class="logo mr-4">
                <img src="{{ asset('storage/' . (strpos($barangay->logo, 'images/') === false ? 'images/' . $barangay->logo : $barangay->logo)) }}" alt="Barangay Logo" class="w-[40px] h-[40px] sm:w-[50px] sm:h-[50px] object-cover rounded-full">
            </div>
            <h2 class="text-xl font-bold text-blue-600">
                Brgy. {{ $barangay->barangay_name}}, Tubigon, Bohol
            </h2>
        </div>
        <form method="POST" action="{{ route('login', ['barangay_id' => $barangay->id]) }}">
            @csrf
            <div class="mt-4 flex items-center">
                <label for="email" class="text-sm font-bold text-start text-gray-700 mb-1 w-1/3 rounded">Email: </label>
                <input id="email" class="block w-full border-gray-300 dark:border-gray-700 text-black py-1 px-2 shadow-sm" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4 flex items-center">
                <label for="password" class="text-sm font-bold text-start text-gray-700 mb-1 w-1/3 rounded">Password: </label>
                <div class="password-container">
                    <input id="password" class="block w-full border-gray-300 dark:border-gray-700 text-black py-1 px-2 shadow-sm" type="password" name="password" required autocomplete="current-password" />
                    <span class="password-toggle" onclick="togglePasswordVisibility()">
                        <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg id="eye-slash-icon" class="hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </span>
                </div>
        
            </div>

            <!-- Login sud sa tagsa tagsang barangay -->
            <input type="hidden" name="barangay_id" value="{{ $barangay->id }}">
            <div class="flex items-center justify-center mt-6">
                <button type="submit" class="inline-flex items-center font-bold px-4 py-2 bg-blue-600 rounded">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        const eyeSlashIcon = document.getElementById('eye-slash-icon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.add('hidden');
            eyeSlashIcon.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('hidden');
            eyeSlashIcon.classList.add('hidden');
        }
    }
</script>
@endsection
