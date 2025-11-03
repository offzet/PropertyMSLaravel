<!-- resources/views/admin/repairs/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Repairs Management') }}
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
                            <h3 class="text-lg font-medium text-gray-900">All Repair Requests</h3>
                            <p class="text-gray-600">Manage repair requests and maintenance issues.</p>
                        </div>
                        <a href="{{ route('admin.repairs.create') }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span>Add Repair Request</span>
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
                                       placeholder="Search by title, description, property..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Status Filter -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" 
                                        id="status" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>

                            <!-- Priority Filter -->
                            <div>
                                <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                                <select name="priority" 
                                        id="priority" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All Priority</option>
                                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                                    <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
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

                    <!-- Repairs Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Repair Details
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Property & Tenant
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Priority
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date Reported
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            @include('admin.repairs.partials.repairs_table')
                        </table>
                    </div>

                    <!-- Pagination -->
                    @include('admin.repairs.partials.pagination')
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('searchForm');
            const resetFilters = document.getElementById('resetFilters');
            const searchInput = document.getElementById('search');
            const statusFilter = document.getElementById('status');
            const priorityFilter = document.getElementById('priority');
            let searchTimeout;

            // Debounced search function
            function performSearch() {
                const formData = new FormData(searchForm);
                const params = new URLSearchParams(formData);

                fetch(`{{ route('admin.repairs.search') }}?${params}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.querySelector('tbody').innerHTML = data.html;
                    document.querySelector('.bg-white.px-4.py-3.border-t')?.remove();
                    const table = document.querySelector('table');
                    table.insertAdjacentHTML('afterend', data.pagination);
                })
                .catch(error => console.error('Error:', error));
            }

            // Real-time search with debounce
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(performSearch, 500);
            });

            // Filter changes
            statusFilter.addEventListener('change', performSearch);
            priorityFilter.addEventListener('change', performSearch);

            // Form submission
            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                performSearch();
            });

            // Reset filters
            resetFilters.addEventListener('click', function() {
                searchForm.reset();
                performSearch();
            });

            // Handle pagination clicks (event delegation)
            document.addEventListener('click', function(e) {
                if (e.target.closest('.pagination a')) {
                    e.preventDefault();
                    const url = e.target.closest('a').href;
                    
                    fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.querySelector('tbody').innerHTML = data.html;
                        document.querySelector('.bg-white.px-4.py-3.border-t')?.remove();
                        const table = document.querySelector('table');
                        table.insertAdjacentHTML('afterend', data.pagination);
                        
                        // Update URL without page reload
                        window.history.pushState({}, '', url);
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>
</x-app-layout>