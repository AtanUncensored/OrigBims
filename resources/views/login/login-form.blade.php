<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barangay Information Management System</title>
    <link rel="icon" href="{{ asset('images/bims-logo.png') }}">
    <script src="{{ asset('/js/tailwind.min.js') }}"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
            background-image: url('{{ asset('/images/lgu-building.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .content {
            display: flex;
            align-items: center;
            flex-grow: 1;
            padding: 60px 20px 20px;
            gap: 20px;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.5);
            flex-direction: row;
        }
        .logo {
            flex: 1;
            max-width: 350px;
        }
        .info-login {
            flex: 2;
            max-width: 500px;
        }
        .info-login .bims {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            margin-bottom: 20px;
        }
        .info-login .bims header {
            font-size: 3rem;
            font-family:'Times New Roman', Times, serif;
            font-weight: bold;
            margin: 0;
            line-height: 0;
            text-align: center;
        }
        .login-form {
            margin-top: 20px;
            padding: 25px;
            border-radius: 15px;
            background-color: rgba(255, 255, 255, 0.8);
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            position: relative;
        }
        .form-group label {
            font-size: 1rem;
            font-weight: bold;
            width: 100px;
            margin-right: 10px;
        }
        .form-group input {
            flex: 1;
            padding: 4px;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .password-toggle svg {
            width: 20px;
            height: 20px;
        }
        .login-form a {
            display: block;
            text-align: center;
            margin-top: 10px;
            padding: 10px;
            background-color: #1d4ed8;
            color: white;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .login-form a:hover {
            background-color: #2563eb;
        }
    
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }

        @media (max-width: 768px) { 
            .content {
                flex-direction: column; 
            }
            .logo {
                order: 1;
            }
            .info-login {
                order: 2;
            }
        }
    </style>
</head>
<body>
    <div class="top-nav bg-blue-500 flex justify-start py-2 px-4 items-center">
        <div class="w-[60px] h-[60px] lg:w-[60px] lg:h-[60px]">
            <img src="{{ asset('images/bims-logo.png') }}" alt="BIMS logo">
        </div>
        <div class="title">
            <p href="/" class="font-bold text-white text-[15px] lg:text-xl">
                <span class="block lg:hidden font-bold gap-2 text-3xl px-4">BIMS</span> 
                <span class="hidden lg:block gap-2 px-4">Barangay Information Management System</span>
            </p>
        </div>
    </div>     
    <div class="content">
        <div class="logo">
            <img class="rounded-full w-[200px] h-[200px] lg:w-[300px] lg:h-[300px]" src="{{ asset('images/tubigon-logo.png') }}" alt="LGU logo">
        </div>
        <div class="info-login">

            <!-- Admin Notice -->
            <div class="admin-notice bg-blue-500 text-white py-2 px-4 rounded-lg text-center">
                <strong>Local Government Unit (LGU) Tubigon </strong>
            </div>
            <div class="login-form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                        @error('email')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password" />
                        <span class="password-toggle" onclick="togglePasswordVisibility()">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>                    
                            <svg id="eye-slash-icon" class="hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>                          
                        </span>
                        @error('password')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex items-center justify-end mt-6">
                        <button type="submit" class="inline-flex items-center font-bold px-4 py-2 bg-blue-600 text-white rounded">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('templates.footer')
    
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
</body>
</html>
