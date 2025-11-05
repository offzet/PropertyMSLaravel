<nav x-data="{ open: false }" class="w-64 bg-white border-r border-gray-200 flex flex-col shadow-lg">
    <!-- Logo Section -->
    <div
        class="flex items-center justify-between h-20 px-6 border-b border-gray-100 bg-gradient-to-r from-blue-600 to-purple-700">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <div>
                <h1 class="text-lg font-bold text-white">PropertyManager</h1>
                <p class="text-xs text-blue-100">Admin Panel</p>
            </div>
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="flex-1 overflow-y-auto py-6">
        <div class="px-4 space-y-1">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 mb-4">MAIN MENU</p>

            <ul class="space-y-1">
                <!-- Dashboard -->
                <li>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 hover:shadow-sm group">
                        <div class="w-6 h-6 flex items-center justify-center text-gray-400 group-hover:text-blue-600">
                            <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-white' : '' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <span
                            class="font-medium {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-700 group-hover:text-blue-700' }}">{{ __('Dashboard') }}</span>
                    </x-nav-link>
                </li>

                <!-- Properties -->
                <li>
                    <x-nav-link :href="route('admin.properties.index')" :active="request()->routeIs('admin.properties.index')"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg transition-all duration-200 hover:bg-blue-50 hover:text-blue-700 hover:shadow-sm group">
                        <div class="w-6 h-6 flex items-center justify-center text-gray-400 group-hover:text-blue-600">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.properties.index') ? 'text-white' : '' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <span
                            class="font-medium {{ request()->routeIs('admin.properties.index') ? 'text-white' : 'text-gray-700 group-hover:text-blue-700' }}">{{ __('Properties') }}</span>
                    </x-nav-link>
                </li>

                <!-- Tenants -->
                <li>
                    <x-nav-link :href="route('admin.tenants.index')" :active="request()->routeIs('admin.tenants.index')"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg transition-all duration-200 hover:bg-green-50 hover:text-green-700 hover:shadow-sm group">
                        <div class="w-6 h-6 flex items-center justify-center text-gray-400 group-hover:text-green-600">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.tenants.index') ? 'text-white' : '' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <span
                            class="font-medium {{ request()->routeIs('admin.tenants.index') ? 'text-white' : 'text-gray-700 group-hover:text-green-700' }}">{{ __('Tenants') }}</span>
                    </x-nav-link>
                </li>

                <!-- Repairs -->
                <li>
                    <x-nav-link :href="route('admin.repairs.index')" :active="request()->routeIs('admin.repairs.index')"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg transition-all duration-200 hover:bg-red-50 hover:text-red-700 hover:shadow-sm group">
                        <div class="w-6 h-6 flex items-center justify-center text-gray-400 group-hover:text-red-600">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.repairs.index') ? 'text-white' : '' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <span
                            class="font-medium {{ request()->routeIs('admin.repairs.index') ? 'text-white' : 'text-gray-700 group-hover:text-red-700' }}">{{ __('Repairs') }}</span>
                    </x-nav-link>
                </li>
            </ul>

            <!-- Additional Section -->

        </div>
    </div>
</nav>
