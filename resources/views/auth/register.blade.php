<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-50 dark:bg-gray-900">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-100 mb-6">
                {{ __('Create your account') }}
            </h2>

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Full Name -->
                <div>
                    <x-input-label for="name" :value="__('Full Name')" />
                    <x-text-input id="name" class="block mt-1 w-full"
                                  type="text" name="name" :value="old('name')"
                                  required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email Address')" />
                    <x-text-input id="email" class="block mt-1 w-full"
                                  type="email" name="email" :value="old('email')"
                                  required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                  type="password" name="password"
                                  required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                  type="password" name="password_confirmation"
                                  required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Register Button -->
                <div class="flex items-center justify-center mt-6">
                    <x-primary-button class="px-8 py-2">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Divider -->
            <div class="flex items-center my-6">
                <hr class="flex-grow border-gray-300 dark:border-gray-700">
                <span class="mx-2 text-gray-400 text-sm">or</span>
                <hr class="flex-grow border-gray-300 dark:border-gray-700">
            </div>

            <!-- Social Login Buttons -->
                         <div class="space-y-3 mt-4">
                <a class="bg-background text-foreground flex w-full items-center justify-center space-x-2 rounded-lg border px-4 py-2 text-sm font-medium transition-colors duration-200 hover:opacity-70"
                href="{{ route('auth.redirect', ['provider' => 'google']) }}">
                    <svg class="h-auto w-4" width="40" height="42" viewBox="0 0 46 47" fill="none">
                        <path d="M46 24.0287C46 22.09 45.8533 20.68 45.5013 19.2112H23.4694V27.9356H36.4069C36.1429 30.1094 34.7347 33.37 31.5957 35.5731L31.5663 35.8669L38.5191 41.2719L38.9885 41.3306C43.4477 37.2181 46 31.1669 46 24.0287Z" fill="#4285F4" />
                        <path d="M23.4694 47C29.8061 47 35.1161 44.9144 39.0179 41.3012L31.625 35.5437C29.6301 36.9244 26.9898 37.8937 23.4987 37.8937C17.2793 37.8937 12.0281 33.7812 10.1505 28.1412L9.88649 28.1706L2.61097 33.7812L2.52296 34.0456C6.36608 41.7125 14.287 47 23.4694 47Z" fill="#34A853" />
                        <path d="M10.1212 28.1413C9.62245 26.6725 9.32908 25.1156 9.32908 23.5C9.32908 21.8844 9.62245 20.3275 10.0918 18.8588V18.5356L2.75765 12.8369L2.52296 12.9544C0.909439 16.1269 0 19.7106 0 23.5C0 27.2894 0.909439 30.8731 2.49362 34.0456L10.1212 28.1413Z" fill="#FBBC05" />
                        <path d="M23.4694 9.07688C27.8699 9.07688 30.8622 10.9863 32.5344 12.5725L39.1645 6.11C35.0867 2.32063 29.8061 0 23.4694 0C14.287 0 6.36607 5.2875 2.49362 12.9544L10.0918 18.8588C11.9987 13.1894 17.25 9.07688 23.4694 9.07688Z" fill="#EB4335" />
                    </svg>
                    <span>Continue with Google</span>
                </a>

                <a class="bg-background text-foreground flex w-full items-center justify-center space-x-2 rounded-lg border px-4 py-2 text-sm font-medium transition-colors duration-200 hover:opacity-70"
                href="{{ route('auth.redirect', ['provider' => 'facebook']) }}">
                    <svg class="w-4 h-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#1877F2">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    <span>Continue with Facebook</span>
                </a>
            </div>

        <!-- Already have an account -->
        <p class="mt-6 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Already have an account?') }}
            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 font-medium">
                {{ __('Log in here') }}
            </a>
        </p>
    </div>
</x-guest-layout>
