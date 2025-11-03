<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    
                    <!-- Virtual Tour Button -->
                    <div class="mt-6">
                        <a href="{{ asset('virtual-tour/try.html') }}">Virtual Tour</a>
                           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            🏛️ Start Virtual Tour
                        </a>
                        
                        <!-- Optional: Description -->
                        <p class="mt-2 text-sm text-gray-600">
                            Explore our interactive virtual tour experience.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>