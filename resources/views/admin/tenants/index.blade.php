<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tenants Management') }}
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">All Tenants</h3>
                            <p class="text-gray-600">Manage your tenant listings here.</p>
                        </div>
                        <div class="flex space-x-2">
                            <!-- Print Button -->
                            <button onclick="printTenantsTable()" 
                                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                </svg>
                                <span>Print</span>
                            </button>
                            
                            <!-- Download Button -->
                            <button onclick="downloadTenantsCSV()" 
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span>Download CSV</span>
                            </button>
                            
                            <a href="{{ route('admin.tenants.create') }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                <span>Add Tenant</span>
                            </a>
                        </div>
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
                                       placeholder="Search by name, email, phone..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Status Filter -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" 
                                        id="status" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All Status</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>

                            <!-- Property Filter -->
                            <div>
                                <label for="property_id" class="block text-sm font-medium text-gray-700 mb-1">Property</label>
                                <select name="property_id" 
                                        id="property_id" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All Properties</option>
                                    @foreach($properties as $property)
                                        <option value="{{ $property->id }}" {{ request('property_id') == $property->id ? 'selected' : '' }}>
                                            {{ $property->code }} - {{ $property->name }}
                                        </option>
                                    @endforeach
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

                    <!-- Tenants Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white" id="tenantsTable">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tenant
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Contact Info
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Property Unit
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Lease Period
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Rent Amount
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider print:hidden">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            @include('admin.tenants.partials.tenants_table')
                        </table>
                    </div>

                    <!-- Pagination -->
                    @include('admin.tenants.partials.pagination')
                </div>
            </div>
        </div>
    </div>

    <!-- Print Styles -->
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #tenantsTable, #tenantsTable * {
                visibility: visible;
            }
            #tenantsTable {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .print-hidden, .pagination, .bg-gray-50, [class*="shadow"], button, a {
                display: none !important;
            }
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f8f9fa;
                font-weight: bold;
            }
        }

        @page {
            size: landscape;
            margin: 0.5cm;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('searchForm');
            const resetFilters = document.getElementById('resetFilters');
            const searchInput = document.getElementById('search');
            const statusFilter = document.getElementById('status');
            const propertyFilter = document.getElementById('property_id');
            let searchTimeout;

            // Debounced search function
            function performSearch() {
                const formData = new FormData(searchForm);
                const params = new URLSearchParams(formData);

                fetch(`{{ route('admin.tenants.search') }}?${params}`, {
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

            // Print function
            window.printTenantsTable = function() {
                // Create a print-friendly version
                const printWindow = window.open('', '_blank');
                const table = document.getElementById('tenantsTable').cloneNode(true);
                
                // Remove action buttons from print version
                const actionCells = table.querySelectorAll('td:last-child, th:last-child');
                actionCells.forEach(cell => cell.remove());

                // Create print content
                const printContent = `
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <title>Tenants Report - {{ now()->format('Y-m-d') }}</title>
                        <style>
                            body { font-family: Arial, sans-serif; margin: 20px; }
                            .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
                            .header h1 { margin: 0; color: #333; }
                            .header .subtitle { color: #666; margin-top: 5px; }
                            .print-date { text-align: right; margin-bottom: 20px; color: #666; }
                            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                            th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
                            th { background-color: #f8f9fa; font-weight: bold; }
                            .status-active { color: #10b981; font-weight: bold; }
                            .status-inactive { color: #ef4444; font-weight: bold; }
                            .status-pending { color: #f59e0b; font-weight: bold; }
                            @page { size: landscape; margin: 1cm; }
                            @media print {
                                .no-print { display: none; }
                                body { margin: 0; }
                            }
                        </style>
                    </head>
                    <body>
                        <div class="header">
                            <h1>Tenants Management Report</h1>
                            <div class="subtitle">Property Management System</div>
                        </div>
                        <div class="print-date">
                            Generated on: {{ now()->format('F d, Y h:i A') }}
                        </div>
                        ${table.outerHTML}
                        <div class="no-print" style="margin-top: 20px; text-align: center;">
                            <button onclick="window.print()" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Print Report</button>
                            <button onclick="window.close()" style="padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">Close</button>
                        </div>
                    </body>
                    </html>
                `;

                printWindow.document.write(printContent);
                printWindow.document.close();
                
                // Auto-print after a short delay
                setTimeout(() => {
                    printWindow.print();
                }, 500);
            }

            // Download CSV function
            window.downloadTenantsCSV = function() {
                const table = document.getElementById('tenantsTable');
                const rows = table.querySelectorAll('tr');
                let csvContent = "data:text/csv;charset=utf-8,";
                
                // Add headers
                const headers = [];
                table.querySelectorAll('thead th').forEach(header => {
                    if (!header.classList.contains('print-hidden')) {
                        headers.push(`"${header.textContent.trim()}"`);
                    }
                });
                csvContent += headers.join(',') + '\n';
                
                // Add data rows
                rows.forEach((row, index) => {
                    if (index === 0) return; // Skip header row
                    
                    const rowData = [];
                    row.querySelectorAll('td').forEach((cell, cellIndex) => {
                        // Skip action column
                        if (cellIndex < row.cells.length - 1) {
                            let cellText = cell.textContent.trim();
                            
                            // Remove status badges and keep only text
                            const statusBadge = cell.querySelector('.px-2, .inline-flex');
                            if (statusBadge) {
                                cellText = statusBadge.textContent.trim();
                            }
                            
                            // Escape quotes and wrap in quotes
                            cellText = cellText.replace(/"/g, '""');
                            rowData.push(`"${cellText}"`);
                        }
                    });
                    csvContent += rowData.join(',') + '\n';
                });
                
                // Create download link
                const encodedUri = encodeURI(csvContent);
                const link = document.createElement("a");
                link.setAttribute("href", encodedUri);
                link.setAttribute("download", `tenants_report_{{ now()->format('Y_m_d') }}.csv`);
                document.body.appendChild(link);
                
                // Trigger download
                link.click();
                document.body.removeChild(link);
            }

            // Real-time search with debounce
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(performSearch, 500);
            });

            // Filter changes
            statusFilter.addEventListener('change', performSearch);
            propertyFilter.addEventListener('change', performSearch);

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