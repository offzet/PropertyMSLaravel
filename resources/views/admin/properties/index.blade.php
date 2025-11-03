<!-- resources/views/admin/properties/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Properties Management') }}
            </h2>
            
            <!-- User Dropdown -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')" class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>{{ __('Profile') }}</span>
                    </x-dropdown-link>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="flex items-center space-x-2 text-red-600 hover:text-red-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>{{ __('Log Out') }}</span>
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">All Properties</h3>
                            <p class="text-gray-600">Manage your property listings here.</p>
                        </div>
                        <a href="{{ route('admin.properties.create') }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span>Add Property</span>
                        </a>
                    </div>

                    <!-- Search and Filters -->
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <form id="searchForm" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Search Input -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                                <input type="text" 
                                       name="search" 
                                       id="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Search by name, code, address..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Status Filter -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" 
                                        id="status" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All Status</option>
                                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="rented" {{ request('status') == 'rented' ? 'selected' : '' }}>Rented</option>
                                    <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                </select>
                            </div>

                            <!-- Type Filter -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                                <select name="type" 
                                        id="type" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All Types</option>
                                    <option value="apartment" {{ request('type') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                                    <option value="house" {{ request('type') == 'house' ? 'selected' : '' }}>House</option>
                                    <option value="condo" {{ request('type') == 'condo' ? 'selected' : '' }}>Condo</option>
                                    <option value="commercial" {{ request('type') == 'commercial' ? 'selected' : '' }}>Commercial</option>
                                </select>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-end space-x-2">
                                <button type="submit" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    <span>Search</span>
                                </button>
                                <button type="button" 
                                        id="resetFilters"
                                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                                    Reset
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Properties Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Property
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Type & Address
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Rent Amount
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200" id="propertiesTableBody">
                                @include('admin.properties.partials.properties_table')
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Container -->
                    <div class="pagination-container mt-4">
                        @include('admin.properties.partials.pagination')
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    let searchTimeout;

    // Real-time search with debounce
    $('#search').on('keyup', function () {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(performSearch, 500);
    });

    // Filter changes
    $('#status, #type').on('change', function () {
        performSearch();
    });

    // Form submission
    $('#searchForm').on('submit', function (e) {
        e.preventDefault();
        performSearch();
    });

    // Reset filters
    $('#resetFilters').on('click', function () {
        $('#searchForm')[0].reset();
        performSearch();
    });

    function performSearch() {
        const formData = $('#searchForm').serialize();
        
        // Show loading state
        $('#propertiesTableBody').html(`
            <tr>
                <td colspan="5" class="px-6 py-12 text-center">
                    <div class="flex justify-center items-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                        <span class="ml-3 text-gray-600">Searching properties...</span>
                    </div>
                </td>
            </tr>
        `);
        
        $.ajax({
            url: "{{ route('admin.properties.search') }}",
            type: "GET",
            data: formData,
            success: function (data) {
                $('#propertiesTableBody').html(data.html);
                $('.pagination-container').html(data.pagination);
            },
            error: function (xhr) {
                console.error('Search error:', xhr);
                $('#propertiesTableBody').html(`
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-red-600">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 mb-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                                <p class="text-lg font-medium">Error loading properties</p>
                                <p class="text-sm text-gray-600">Please try again later.</p>
                            </div>
                        </td>
                    </tr>
                `);
            }
        });
    }

    // Pagination with AJAX
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');
        
        // Show loading state
        $('#propertiesTableBody').html(`
            <tr>
                <td colspan="5" class="px-6 py-12 text-center">
                    <div class="flex justify-center items-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                        <span class="ml-3 text-gray-600">Loading properties...</span>
                    </div>
                </td>
            </tr>
        `);
        
        $.ajax({
            url: url,
            type: "GET",
            success: function (data) {
                $('#propertiesTableBody').html(data.html);
                $('.pagination-container').html(data.pagination);
                window.history.pushState({}, '', url);
            },
            error: function (xhr) {
                console.error('Pagination error:', xhr);
                $('#propertiesTableBody').html(`
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-red-600">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 mb-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                                <p class="text-lg font-medium">Error loading page</p>
                                <p class="text-sm text-gray-600">Please try again.</p>
                            </div>
                        </td>
                    </tr>
                `);
            }
        });
    });
});
</script>
</x-app-layout>