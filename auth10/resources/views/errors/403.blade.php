<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    <div class="text-6xl mb-4">🚫</div>
                    <h1 class="text-2xl font-bold mb-2">Access Denied</h1>
                    <p class="mb-4">You don't have permission to access this page.</p>

                    <a href="{{ route('user.dashboard') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded ml-2">
                        User Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>