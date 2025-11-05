<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Leases - PropertyManager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    <!-- Navigation -->
    <x-layouts.customer-nav />

    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-tight">My Leases</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto leading-relaxed">
                Manage your rental applications and track your lease agreements — all in one place.
            </p>
        </div>
    </header>

    <!-- Content -->
    <main class="flex-grow -mt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            @if ($leases->count() > 0)
                <!-- Stats Overview -->
                <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <!-- Stat card -->
                    <div
                        class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-blue-500 hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-center space-x-4">
                            <div class="p-4 bg-blue-100 rounded-xl">
                                <i class="fas fa-file-contract text-blue-600 text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Leases</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $leases->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-center space-x-4">
                            <div class="p-4 bg-green-100 rounded-xl">
                                <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Active Leases</p>
                                <p class="text-3xl font-bold text-gray-900">
                                    {{ $leases->where('status', 'active')->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-yellow-500 hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-center space-x-4">
                            <div class="p-4 bg-yellow-100 rounded-xl">
                                <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Pending</p>
                                <p class="text-3xl font-bold text-gray-900">
                                    {{ $leases->where('status', 'pending')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Leases Table -->
                <section class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                    <header class="px-8 py-5 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-xl font-semibold text-gray-800">Your Lease Agreements</h2>
                    </header>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-100 uppercase text-gray-600 text-xs tracking-wider">
                                <tr>
                                    <th class="px-6 py-4">Property</th>
                                    <th class="px-6 py-4">Lease Period</th>
                                    <th class="px-6 py-4">Rent</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4">Remaining</th>
                                    <th class="px-6 py-4 text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @foreach ($leases as $lease)
                                    <tr class="hover:bg-blue-50 transition duration-150">
                                        <td class="px-6 py-5">
                                            <div class="flex items-center space-x-4">
                                                <div
                                                    class="h-12 w-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow">
                                                    <i class="fas fa-home text-white text-lg"></i>
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-900">{{ $lease->property_unit }}
                                                    </p>
                                                    <p class="text-gray-500 text-sm flex items-center">
                                                        <i class="fas fa-map-marker-alt text-red-400 mr-2 text-xs"></i>
                                                        {{ $lease->property->location ?? 'N/A' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-5 space-y-1">
                                            <div class="flex items-center text-gray-800">
                                                <i class="fas fa-play text-green-500 mr-2 text-xs"></i>
                                                {{ \Carbon\Carbon::parse($lease->lease_start)->format('M d, Y') }}
                                            </div>
                                            <div class="flex items-center text-gray-800">
                                                <i class="fas fa-flag-checkered text-red-500 mr-2 text-xs"></i>
                                                {{ \Carbon\Carbon::parse($lease->lease_end)->format('M d, Y') }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-5">
                                            <span
                                                class="text-lg font-bold text-blue-600">₱{{ number_format($lease->rent_amount, 2) }}</span>
                                            <p class="text-xs text-gray-500">per month</p>
                                        </td>

                                        <td class="px-6 py-5">
                                            @php
                                                $statusConfig = [
                                                    'pending' => [
                                                        'color' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                        'icon' => 'clock',
                                                    ],
                                                    'active' => [
                                                        'color' => 'bg-green-100 text-green-800 border-green-200',
                                                        'icon' => 'check-circle',
                                                    ],
                                                    'inactive' => [
                                                        'color' => 'bg-red-100 text-red-800 border-red-200',
                                                        'icon' => 'times-circle',
                                                    ],
                                                ];
                                                $config = $statusConfig[$lease->status] ?? [
                                                    'color' => 'bg-gray-100 text-gray-800 border-gray-200',
                                                    'icon' => 'question-circle',
                                                ];
                                            @endphp
                                            <span
                                                class="px-3 py-2 inline-flex items-center text-sm font-semibold rounded-full border {{ $config['color'] }}">
                                                <i class="fas fa-{{ $config['icon'] }} mr-2 text-xs"></i>
                                                {{ ucfirst($lease->status) }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-5">
                                            @php
                                                $endDate = \Carbon\Carbon::parse($lease->lease_end)->startOfDay();
                                                $today = \Carbon\Carbon::now()->startOfDay();
                                                $daysRemaining = $today->diffInDays($endDate);
                                                $isExpired = $today->gt($endDate);
                                            @endphp
                                            @if ($isExpired)
                                                <div class="flex items-center text-red-600 font-semibold">
                                                    <i class="fas fa-exclamation-triangle mr-2"></i> Expired
                                                </div>
                                            @else
                                                <div class="text-center">
                                                    <p class="text-2xl font-bold text-gray-900">{{ $daysRemaining }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">days left</p>
                                                </div>
                                            @endif
                                        </td>

                                        <td class="px-6 py-5 text-center">
                                            <a href="{{ route('customer.leases.show', $lease) }}"
                                                class="inline-flex items-center px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 shadow">
                                                <i class="fas fa-eye mr-2"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            @else
                <!-- Empty State -->
                <section class="bg-white rounded-2xl shadow-xl p-16 text-center border border-gray-100">
                    <div class="max-w-md mx-auto">
                        <div
                            class="w-28 h-28 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg">
                            <i class="fas fa-file-contract text-white text-4xl"></i>
                        </div>
                        <h3 class="text-3xl font-extrabold text-gray-900 mb-4">No Leases Found</h3>
                        <p class="text-gray-600 text-lg mb-10">
                            You haven’t applied for any properties yet. Discover our available listings today.
                        </p>
                        <a href="{{ route('customer.properties.index') }}"
                            class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-search mr-3"></i> Browse Properties
                        </a>
                    </div>
                </section>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-10 mt-16">
        <div class="max-w-7xl mx-auto px-6 text-center">

            <p class="text-gray-400 text-sm">&copy; 2025 PropertyManager. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
