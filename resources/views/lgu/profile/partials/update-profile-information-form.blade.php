<section>
    <div class="max-h-[80vh] overflow-y-auto">
        <div class="flex justify-center items-center"> 
            <div class="w-[340px] lg:w-[800px] bg-white shadow-lg rounded-lg py-4 px-7">
                <header>
                    <h1 class="text-2xl font-bold text-start uppercase text-blue-600">Account</h1>
    
                    <p class="mt-1 text-sm text-start text-gray-600">
                        {{ __("Keep track of your account and update your information if necessary") }}
                    </p>
                </header>

                <div class="mt-3 flex justify-center items-center">
                    <img src="{{asset('images/profile.jpg')}}" alt="Default Profile Image" class="w-[100px] h-[100px] rounded-full object-cover bg-blue-500 py-1 px-1">
                </div>
                <div>
                    <p class="text-center font-semibold text-gray-600">{{ $user->name }}</p>
                    <p class="text-center font-semibold text-blue-600">{{ $user->email }}</p>
                </div>

            {{-- <div class="flex items-center mb-[30px] mt-3">
                <div>
                    @if($user->user_image)
                    <img src="{{ Storage::url($user->user_image) }}" alt="Profile Image" class="w-32 h-32 rounded-full object-cover">
                    @else
                    <img src="{{asset('images/profile.jpg')}}" alt="Default Profile Image" class="w-32 h-32 rounded-full object-cover">
                    @endif
                </div>
                <div>
                    <form action="{{ route('lgu.lgus-update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-col">
                            <div class="ml-3">
                                <label for="user_image" class="block text-gray-700 text-sm font-bold mb-2">Profile Picture:</label>
                                <input type="file" id="user_image" name="user_image" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" accept="image/*">
                                @error('user_image')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="ml-3 mt-5">
                                <button type="submit" class='px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>Change Image</button>  
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}

            <hr class="border-t-2 mt-3 mb-4 border-gray-300">

            <div>
                <button id="toggleEmailForm" class='px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>
                    <i class="fa-solid fa-envelope"></i> Email
                </button>

                <p class="mt-3 text-sm text-start text-gray-600">
                    {{ __("Update your account's profile information and email address.") }}
                </p>

                <div id="emailForm" style="display: none;">

                    <h2 class="text-xl font-bold text-start text-blue-900 mt-3">
                        Username & Email
                     </h2>
    
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>
    
                    <form method="post" action="{{ route('lgu.profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
    
                        <div>
                            <x-input-label for="name" :value="__('Name:')" />
                            <x-text-input id="name" name="name" type="text" class="py-2 px-2 w-full border border-gray-200" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
    
                        <div>
                            <x-input-label for="email" :value="__('Email:')" />
                            <x-text-input id="email" name="email" type="email" class="py-2 px-2 w-full border border-gray-200" :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
    
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
    
                            @if (session('status') === 'profile-updated')
                                <p id="saveMessage" class="text-sm text-gray-600" style="display: none;">{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            
            <hr class="border-t-2 mt-3 mb-4 border-gray-300">
            
            <div>
                <button id="togglePasswordForm" class='px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>
                    <i class="fa-solid fa-key"></i> Password
                </button>

                <p class="mt-3 mb-3 text-start text-sm text-gray-600">
                    {{ __('Ensure your account is using a long, random password to stay secure.') }}
                </p>

                <div id="passwordForm" style="display: none;">
                    @include('lgu.profile.partials.update-password-form')  
                </div>
            </div>

            {{-- <hr class="border-t-2 mt-3 mb-4 border-gray-300">

            <div>
                <button id="toggleDeleteForm" class='px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>
                    <i class="fa-solid fa-gear"></i> Manage
                </button>
                <div id="deleteForm" style="display: none;">
                    @include('lgu.profile.partials.delete-user-form')
                </div>
            </div>  --}}
        </div>
    </div>
</section>

<script>

    document.getElementById('toggleEmailForm').onclick = function() {
        var emailForm = document.getElementById('emailForm');
        emailForm.style.display = (emailForm.style.display === 'none' || emailForm.style.display === '') ? 'block' : 'none';
    };

    document.getElementById('togglePasswordForm').onclick = function() {
        var passwordForm = document.getElementById('passwordForm');
        passwordForm.style.display = (passwordForm.style.display === 'none' || passwordForm.style.display === '') ? 'block' : 'none';
    };

    // document.getElementById('toggleDeleteForm').onclick = function() {
    //     var deleteForm = document.getElementById('deleteForm');
    //     deleteForm.style.display = (deleteForm.style.display === 'none' || deleteForm.style.display === '') ? 'block' : 'none';
    // };
</script>
