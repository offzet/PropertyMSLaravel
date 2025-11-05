<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Requests - PropertyManager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <x-layouts.customer-nav />

    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Maintenance and Repairs</h1>
                <p class="text-blue-100 text-lg">Track the status of your maintenance requests</p>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">All Requests</h2>
            <a href="{{ route('customer.repairs.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition-colors flex items-center">
                <i class="fas fa-plus mr-2"></i>
                New Request
            </a>
        </div>

        @if ($repairs->count() > 0)
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Request Details</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Property</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Priority</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date Submitted</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($repairs as $repair)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-tools text-blue-600"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $repair->title }}
                                                </div>
                                                <div class="text-sm text-gray-500 truncate max-w-xs">
                                                    {{ Str::limit($repair->description, 50) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $repair->tenant->property_unit }}</div>
                                        <div class="text-sm text-gray-500">{{ $repair->property->location ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $priorityColors = [
                                                'low' => 'bg-green-100 text-green-800',
                                                'medium' => 'bg-yellow-100 text-yellow-800',
                                                'high' => 'bg-orange-100 text-orange-800',
                                                'urgent' => 'bg-red-100 text-red-800',
                                            ];
                                        @endphp
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $priorityColors[$repair->priority] }}">
                                            {{ ucfirst($repair->priority) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'in_progress' => 'bg-blue-100 text-blue-800',
                                                'completed' => 'bg-green-100 text-green-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                            ];

                                            $statusIcons = [
                                                'pending' => 'fa-clock',
                                                'in_progress' => 'fa-spinner',
                                                'completed' => 'fa-check-circle',
                                                'cancelled' => 'fa-times-circle',
                                            ];
                                        @endphp
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$repair->status] }}">
                                            <i class="fas {{ $statusIcons[$repair->status] }} mr-1"></i>
                                            {{ ucfirst(str_replace('_', ' ', $repair->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $repair->created_at->format('M d, Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Status Legend -->
            <div class="mt-6 bg-white rounded-2xl shadow-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Legend</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
                        <span class="text-sm text-gray-600">Pending - Waiting for review</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
                        <span class="text-sm text-gray-600">In Progress - Being worked on</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                        <span class="text-sm text-gray-600">Completed - Request resolved</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                        <span class="text-sm text-gray-600">Cancelled - Request cancelled</span>
                    </div>
                </div>
            </div>
        @else
            <!-- No Repair Requests -->
            <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
                <div class="max-w-md mx-auto">
                    <div
                        class="w-32 h-32 bg-gradient-to-br from-gray-400 to-gray-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <i class="fas fa-tools text-white text-4xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">No Repair Requests</h3>
                    <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                        You haven't submitted any maintenance requests yet.
                        When you do, you'll be able to track their status here.
                    </p>
                    <a href="{{ route('customer.repairs.create') }}"
                        class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-plus mr-3"></i>
                        Submit Your First Request
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-10 mt-16 fixed bottom-0 left-0 w-full">
        <div class="max-w-7xl mx-auto px-6 text-center">

            <p class="text-gray-400 text-sm">&copy; 2025 PropertyManager. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
