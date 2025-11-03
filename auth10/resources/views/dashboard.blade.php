<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Success/Error Messages -->
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ session('error') }}
            </div>
            @endif

            <!-- Admin Statistics Section - Only for Admin -->
            @if(auth()->check() && auth()->user()->user_type === 'admin')
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Admin Statistics</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="bg-blue-100 dark:bg-blue-900 p-4 rounded-lg">
                            <h5 class="font-semibold">Total Users</h5>
                            <p class="text-2xl">{{ $totalUsers ?? 0 }}</p>
                        </div>
                        <div class="bg-green-100 dark:bg-green-900 p-4 rounded-lg">
                            <h5 class="font-semibold">Admin Users</h5>
                            <p class="text-2xl">{{ $adminCount ?? 0 }}</p>
                        </div>
                        <div class="bg-purple-100 dark:bg-purple-900 p-4 rounded-lg">
                            <h5 class="font-semibold">Regular Users</h5>
                            <p class="text-2xl">{{ $userCount ?? 0 }}</p>
                        </div>
                        <div class="bg-yellow-100 dark:bg-yellow-900 p-4 rounded-lg">
                            <h5 class="font-semibold">New This Month</h5>
                            <p class="text-2xl">{{ $newThisMonth ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- User Dashboard Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    
                    <!-- User-specific content -->
                    @auth
                    <div class="mt-4 p-4 {{ auth()->user()->user_type === 'admin' ? 'bg-green-50 dark:bg-green-900' : 'bg-blue-50 dark:bg-blue-900' }} rounded-lg">
                        <p class="{{ auth()->user()->user_type === 'admin' ? 'text-green-800 dark:text-green-200' : 'text-blue-800 dark:text-blue-200' }}">
                            @if(auth()->user()->user_type === 'admin')
                            🎉 Welcome Administrator! You have full access to manage users and system settings.
                            @else
                            👋 Welcome to your dashboard! As a regular user, you can view content but cannot edit or delete.
                            @endif
                        </p>
                        <div class="mt-3">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Your role: <span class="font-semibold {{ auth()->user()->user_type === 'admin' ? 'text-green-600 dark:text-green-300' : 'text-blue-600 dark:text-blue-300' }}">
                                    {{ ucfirst(auth()->user()->user_type) }}
                                </span>
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                Account created: {{ auth()->user()->created_at->format('F d, Y') }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                Email: {{ auth()->user()->email }}
                            </p>
                            @if(auth()->user()->user_type === 'admin')
                            <p class="text-sm text-green-600 dark:text-green-300 mt-1 font-semibold">
                                ✅ You have administrator privileges
                            </p>
                            @else
                            <p class="text-sm text-blue-600 dark:text-blue-300 mt-1">
                                ℹ️ You can view all content but editing is restricted to administrators.
                            </p>
                            @endif
                        </div>
                    </div>
                    @endauth

                    <!-- Quick Actions - Role-based -->

                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal - Only for Admin -->
    @if(auth()->check() && auth()->user()->user_type === 'admin')
   
    @endif


</x-app-layout>