<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        <strong>Welcome!</strong> You have successfully logged in as a regular user.
                    </div>
                    
                    <h3 class="text-lg font-semibold mb-4">Welcome, {{ auth()->user()->name }}!</h3>
                    
                    <div class="bg-blue-50 dark:bg-blue-900 p-4 rounded-lg mb-4">
                        <p class="text-blue-800 dark:text-blue-200">
                            👋 Welcome to your user dashboard! 
                        </p>
                        <div class="mt-3">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <strong>Your role:</strong> 
                                <span class="font-semibold text-blue-600 dark:text-blue-300">
                                    {{ ucfirst(auth()->user()->user_type) }}
                                </span>
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                <strong>Account created:</strong> {{ auth()->user()->created_at->format('F d, Y') }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                <strong>Email:</strong> {{ auth()->user()->email }}
                            </p>
                            <p class="text-sm text-blue-600 dark:text-blue-300 mt-2 font-semibold">
                                ℹ️ You have access to basic user features.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>