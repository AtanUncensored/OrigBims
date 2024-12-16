<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barangay Information Management System</title>
    <script src="{{ asset('/js/tailwind.min.js') }}"></script>
    <script src="{{ asset('/js/alpine.min.js') }}"></script>
    <link rel="icon" href="{{ asset('images/bims-logo.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=New+Amsterdam&display=swap" rel="stylesheet">

    <style>
        .new-amsterdam-regular {
            font-family: "New Amsterdam", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('translate-x-0');
            sidebar.classList.toggle('-translate-x-full');
        }

        function toggleDropdown() {
            var dropdownContent = document.getElementById('dropdown-content');
            dropdownContent.classList.toggle('hidden');
        }

        //Log out modal ni
        function toggleModal() {
        const modal = document.getElementById('logout-modal');
        modal.classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-100">
    <div id="main" class="flex h-screen">

    <!-- Sidebar -->
    <div id="sidebar" class="bg-blue-500 w-[190px] flex justify-center transition-transform transform md:translate-x-0 -translate-x-full hidden md:block h-auto md:h-screen">
        <div class="flex-grow">
        <div id="branding" class="flex flex-col py-1 px-2 items-center space-y-2 ml-3 md:flex-row md:space-y-0 md:space-x-4">
            <img src="{{ asset('storage/' . (strpos($barangay->logo, 'images/') === false ? 'images/' . $barangay->logo : $barangay->logo)) }}" alt="Barangay Logo" class="w-[40px] h-[40px] sm:w-[50px] sm:h-[50px] object-cover rounded-full">            <h1 class="text-xl lg:text-[25px]" style="font-family: 'Roboto', sans-serif; font-weight: 900; color: white;">
                BIMS
            </h1>
        </div>

            <nav id="main-nav">  
                <div class="mt-[15px]">
                    <a href="{{ url('/barangay-dashboard') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('barangay-dashboard*') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fas fa-house fa-lg text-blue-800"></i>
                        <span class="text-[13px] lg:text-[15px]">Dashboard</span>
                    </a>
                    <a href="{{ url('/announcements/show') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('announcements/show', 'announcements/previous', 'barangay/announcement/archived') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fa-solid fa-bullhorn text-blue-800"></i>
                        <span class="text-[13px] lg:text-[15px]">Announcements</span>
                    </a>
                    <a href="{{ url('/residents') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('residents', 'barangay/create-user') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fas fa-users fa-lg text-blue-800"></i>
                        <span class="text-[13px] lg:text-[15px]">Residents</span>
                    </a>
                    <a href="{{ url('/residentUser') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('residentUser') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fas fa-user fa-lg text-blue-800"></i>
                        <span class="text-[13px] lg:text-[15px]">Users</span>
                    </a>
                    <a href="{{ url('/complaints') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('complaints') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fa-regular fa-newspaper text-blue-800 font-bold"></i>
                        <span class="text-[13px] lg:text-[15px]">Complaints</span>
                    </a>
                    <a href="{{ url('/logs') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('logs') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fa-solid fa-list text-blue-800 font-bold"></i>
                        <span class="text-[13px] lg:text-[15px]">Logs</span>
                    </a>
                    <a href="{{ url('/reports') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('reports') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fa-solid fa-file-lines text-blue-800"></i>
                        <span class="text-[13px] lg:text-[15px]">Budget Reports</span>
                    </a>
                    <a href="{{ url('/certificates') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('certificates') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fa-solid fa-certificate text-blue-800"></i>
                        <span class="text-[13px] lg:text-[15px]">Certificates</span>
                    </a>
                    <a href="{{ url('/certificates/custom/template') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('certificates/custom/template') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fa-solid fa-certificate text-blue-800"></i>
                        <span class="text-[13px] lg:text-[15px]">Custom Certificates</span>
                    </a>
                    <a href="{{ url('/puroks') }}" class="flex items-center space-x-2 px-4 py-3 {{ Request::is('puroks') ? 'bg-blue-300 text-blue-900' : 'text-white' }} hover:bg-blue-300 hover:text-blue-900">
                        <i class="fas fa-house fa-lg text-blue-800"></i>
                        <span class="text-[13px] lg:text-[15px]">Puroks</span>
                    </a>
                </div>
            </nav>
        </div>
    </div>

        <div class="flex-1 flex flex-col">
            <!-- Top Navigation Bar -->
            <nav id="top-nav" class="flex justify-between items-center h-[60px] px-4">
                
                <button onclick="toggleSidebar()" class="md:hidden flex items-center text-blue-500">
                    <i class="fas fa-bars fa-lg mr-3"></i>
                </button>
                @yield('icon')
                <h1 class="text-[15px] lg:text-xl font-semibold text-blue-500">@yield('title', 'Dashboard')</h1>
                
                <div class="flex items-center ml-auto">
                    <div id="user-dropdown" class="relative px-4 py-2 rounded-lg flex items-center">
                        <button onclick="toggleDropdown()" class="flex items-center focus:outline-none">
                            <div class="border border-gray-300 border-t-2 rounded-full w-full flex justify-between items-center py-1 px-3">
                                <span class="text-gray-600 text-[13px] font-bold mr-2">{{ Auth::user()->name }}</span>
                            <div>
                                @if(Auth::user()->user_image)
                                    <img src="{{ Storage::url(Auth::user()->user_image) }}" alt="Profile Image" class="w-[28px] h-[28px] rounded-full object-cover">
                                @else
                                    <img src="{{asset('images/profile.jpg')}}" alt="Default Profile Image" class="w-[28px] h-[28px] rounded-full object-cover">
                                @endif
                            </div>
                            </div>
                        </button>
                
                        <div id="dropdown-content" class="hidden absolute right-0 mt-[115px] w-[100%] bg-white rounded-lg shadow-lg z-10">
                            <button onclick="window.location.href='/admin-profile'" class="w-full text-left px-4 py-2 text-green-700 hover:bg-gray-100 rounded-lg">
                                Profile
                             </button>
                            <button onclick="toggleModal()" class="w-full text-left px-4 py-2 text-red-700 hover:bg-gray-100 rounded-lg">
                                Log Out
                            </button>

                            <div id="logout-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                                <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-4 sm:p-6 md:w-1/2 lg:w-1/3 mt-16">
                                    <div class="flex justify-start items-center">
                                        <img class="w-[50px] h-[50px] rounded-full" src="{{ asset('images/bims-logo.png') }}" alt="barangay/lgu logo">
                                        <h3 class="text-lg font-bold text-center ml-3 text-red-500">Confirm Log Out</h3>
                                    </div>
                                    <p class="mb-6 mt-3 ml-4 text-gray-600">Are you sure you want to log out?</p>
                                    <div class="flex justify-end space-x-4">
                                        <button onclick="toggleModal()" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                                            Cancel
                                        </button>
                            
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700">
                                                <i class="fa-solid fa-right-from-bracket"></i>
                                                Log Out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </nav>

            <hr class="border-t-2 mt-1 border-gray-300 ml-4 mr-4">

            <!-- Main Content -->
            <div id="content" class="flex-1 p-4">
                @yield('content')
            </div>

            <footer>
                @include('templates.footer')
            </footer>
        </div>
    </div>
</body>
</html>