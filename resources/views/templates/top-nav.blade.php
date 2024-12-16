<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ asset('/js/tailwind.min.js') }}"></script>
    <title>@yield('title', 'Barangay Information Management System')</title>
    <link rel="icon" href="{{ asset('images/bims-logo.png') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        body {
            background-attachment: fixed;
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .top-nav {
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .content {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .title {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        .img-logo img {
            max-width: 300px;
            max-height: 300px;
        }
        .bims {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
        }
        .bims header {
            font-size: 2.5rem;
            font-weight: bold;
            font-family:'Times New Roman', Times, serif;
            margin: 0;
            line-height: 1.2; 
        }
        .login-form {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            margin: 20px auto;
        }
        .login-form label {
            display: block;
            font-size: 1.5rem;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
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
        .selection {
            cursor: pointer;
        
        }
        .select2-dropdown {
            border: none;
            text-align: center;
            border-radius: 0.375rem; 
            color:rgb(69, 69, 77) ; 
        }

        .select2-container--default .select2-selection--single {
            background-color: white; 
            border: none; 
            border-radius: 0.375rem; 
        }
 
    </style>
</head>
<body>
    <div class="top-nav bg-blue-500 text-white py-2 px-4 text-xl flex items-center justify-between">
        <div class="flex items-center">
            <div class="img-logo">
                <img class="w-[60px] h-[60px] rounded-full" src="{{ asset('images/bims-logo.png') }}" alt="LGU logo">
            </div>
            <a href="/" class="ml-4 font-bold gap-2 text-3xl">BIMS</a>
        </div>
        <div class="relative">
            <button class="py-2 px-4 rounded inline-flex items-center">
                <select name="barangay_id" class="barangay-select selection rounded w-[150px] h-[70px]" onchange="redirectToLogin(this)">
                    <option value="Barangays">Barangays</option>
                    @foreach($barangays as $barangay)
                        <option value="{{ url('/login/'.$barangay->barangay_name) }}">{{ $barangay->barangay_name }}</option>
                    @endforeach
                </select>
            </button>
        </div>
    </div>
    <div class="content">
        @yield('content')
    </div>
    
    @include('templates.footer')

    <script>
        $(document).ready(function() {
            $('.barangay-select').select2({
                width: 'resolve',
            });
        });

        function redirectToLogin(select) {
        var url = select.value;
        if (url) {
            window.location.href = url;
        }
     }
    </script>
</body>
</html>
