@extends('barangay.templates.navigation-bar')

@section('title', 'Residents Account')

@section('content')

<div class="record px-4">

    <div class="bg-white py-2 px-4 rounded-lg shadow-lg mb-4 max-h-[15vh] overflow-y-auto">
        <h1 class="text-xl font-bold text-blue-500 mb-3 uppercase">look for a user account:</h1>

        @if(session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-2 px-4 rounded mb-2 mt-2">
                    {{ session('success') }}
                </div>
            @endif

        <div class="flex justify-center items-center">
            <form class="inline-flex items-center justify-center" method="GET" action="{{ route('barangay.user.index') }}">
                <input type="text" name="search" placeholder="Search a user..." class="py-2 px-4 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-gray-500">
                <button type="submit" class="py-2 px-4 bg-gray-600 text-white rounded-r-md hover:bg-gray-600 transition"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>

    <div class="bg-white py-2 px-4 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-4">

            <div class="flex justify-start items-center">
                <h1 class="text-xl font-bold text-blue-500 mb-3 uppercase">residents account:</h1>
            </div>

            @if(session('status'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="bg-green-500 text-white text-center py-2 px-4 rounded">
                    {{ session('status') }}
                </div>
            @endif

                <div class="flex justify-end items-center">
                    <button class="relative text-red-600 hover:text-red-800 rounded-lg group mr-3">
                        <span class="font-bold">Reminder <i class="fa-solid fa-triangle-exclamation"></i></span>
                        <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 hidden group-hover:block bg-white text-red-600 text-sm py-2 px-4 rounded shadow-lg w-64">
                            <strong>Note:</strong> You can only disable a user account if internal issues has been found. Please ensure that you have verified the problem before proceeding to disable the account.
                        </div>
                    </button> 

                    <button onclick="toggleAddModal()" class="py-2 px-4 text-[10px] lg:text-[15px] bg-blue-600 text-white font-bold rounded hover:bg-blue-500">
                        <i class="fa-solid fa-plus"></i> Add User Account</a>
                    </button>
                    
                    <div id="add-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-start z-20">
                            
                        <!-- Add Form -->
                        <div class="mt-[20px] mb-6 w-[400px] mx-auto bg-white p-6 rounded shadow">
        
                            <div class="flex justify-center items-center mb-4">
                                <div class="flex justify-start items-center">
                                    <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 mr-5"></i>
                                </div>
                                <div class="flex justify-center items-center">
                                    <h1 class="text-xl font-bold text-blue-600 text-center mb-2">Create Resident Account</h1>
                                </div>
                                <div class="flex justify-start items-center">
                                    <i class="fa-solid fa-diamond text-blue-600 text-[8px] mb-1 ml-5"></i>
                                </div>
                            </div>
        
                            <hr class="border-t-2 border-blue-300 mb-4">
        
                            <form action="{{ route('barangay.storeResidentUser') }}" method="POST">
                                @csrf
                                  <!-- Resident Dropdown with Search -->
                                  <div class="mb-4">
                                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                                    <input type="text" id="name" name="name" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                <div class="mb-4">
                                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                                    <input type="email" id="email" name="email" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                <div class="mb-4">
                                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                                    <input type="password" id="password" name="password" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ old('password') }}">
                                    @error('password')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                <div class="mb-4">
                                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                    @error('password_confirmation')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="flex justify-end items-center">
                                    <div class="mb-4">
                                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mr-3">Add User</button>
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
                </div>
        </div>
        <div class="overflow-x-auto">
            <div class="max-h-[40vh] overflow-y-auto">
                <table class="min-w-full border border-[2px] border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-center">Active Status</th>
                            <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Name</th>
                            <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Email</th>
                            <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-left">Household</th>
                            <th class="lg:py-3 lg:px-6 py-1 px-1 bg-gray-600 text-white font-bold uppercase text-[7px] lg:text-[12px] text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($users->count() > 0)
                            @foreach($users as $user)
                                <tr class="border-b border-gray-200">
                                    <td class="lg:px-6 text-[10px] lg:text-[15px] text-center"><span class="inline-block w-3 h-3 rounded-full {{ $user->is_active ? 'bg-green-500' : 'bg-gray-500' }}"></span></td>
                                    <td class="lg:px-6 text-[10px] lg:text-[15px] font-semibold">{{ $user->name }}</td>
                                    <td class="lg:px-6 text-[10px] lg:text-[15px] text-blue-500 font-semibold">{{ $user->email }}</td>
                                    <td class="lg:px-6 text-[10px] lg:text-[15px]">
                                        @if($user->households)
                                            {{ $user->households->household_name }}
                                        @else
                                            No household assigned
                                        @endif
                                    </td>                                
                                    <td class="text-center">
                                        <div class="flex justify-center items-center py-2">
                                            <button onclick="toggleDisableModal('{{ $user->id }}')" class="text-blue-700 py-1 px-2 md:px-3 rounded hover:text-blue-900">
                                                <i class="fa-solid fa-user-gear fa-lg"></i>
                                            </button>
                                            
                                             <!-- Delete Modal ni dere same sa log out nga layout -->
                                             <div id="disable-modal-{{ $user->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-20">
                                                <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-4 sm:p-6 md:w-1/2 lg:w-1/3">
                                                    <p class="text-left text-lg font-bold text-gray-600 uppercase mb-3">User: <span class="text-blue-600">{{ $user->name }}</span></p>
                                                    <p class="text-left text-lg font-bold text-gray-600 uppercase mb-3">Household: <span class="text-blue-600"> 
                                                        @if($user->households)
                                                        {{ $user->households->household_name }}
                                                        @else
                                                            No household assigned
                                                        @endif</span>
                                                    </p>

                                                    <hr class="border-t-2 mt-3 mb-4 border-gray-300">
                                                
                                                    <p class="mb-5 mt-3 text-gray-600 text-left text-[17px]">User Account Options</p>
                                                
                                                    <form method="POST" action="{{ route('barangay.user.toggleStatus', $user->id) }}">
                                                        @csrf
                                                        <div class="flex justify-start items-center mb-5">
                                                            <label class="mr-3 font-semibold">Disable / Enable:</label>
                                                            <input type="checkbox" name="is_active" id="toggle-switch-{{ $user->id }}" class="toggle-switch" {{ $user->is_active ? 'checked' : '' }}>
                                                        </div>
                                                
                                                        <div class="flex justify-end items-center">
                                                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mr-3">Save changes</button>
                                                            <button type="button" onclick="toggleDisableModal('{{ $user->id }}')" class="inline-block align-baseline font-bold text-[10px] lg:text-[15px] text-gray-600 hover:text-blue-800">
                                                                Cancel
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>                                                                                       
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <div class="w-full text-center text-gray-500">
                                <p>No users found for this barangay.</p>
                            </div>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

        function toggleAddModal() {
            const modal = document.getElementById(`add-modal`);
            modal.classList.toggle('hidden');
        }
        function toggleDisableModal(userId) {
            const modal = document.getElementById(`disable-modal-${userId}`);
            modal.classList.toggle('hidden');
        }

        function saveUserStatus(userId) {
    const checkbox = document.querySelector(`#toggle-switch-${userId}`);
    const isChecked = checkbox.checked;

    fetch(`/user/${userId}/toggle-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Ensure CSRF token is included for security
        },
        body: JSON.stringify({ is_active: isChecked })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            toggleDisableModal(userId); // Close modal after saving
        } else {
            alert('An error occurred while updating user status.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong while saving.');
    });
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
