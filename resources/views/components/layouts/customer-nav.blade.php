<nav x-data="{ open: false, profileOpen: false }" class="bg-white shadow-lg border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('customer.dashboard') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <div class="hidden md:block">
                        <h1 class="text-lg font-bold text-gray-900">PropertyManager</h1>
                        <p class="text-xs text-gray-500">Customer Portal</p>
                    </div>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('customer.dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('customer.dashboard') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600 hover:bg-gray-50' }}">
                    Home
                </a>
                <a href="{{ route('customer.properties.index') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('customer.properties.index') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600 hover:bg-gray-50' }}">
                    Properties
                </a>
                <a href="{{ route('customer.leases.index') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('customer.leases.index') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600 hover:bg-gray-50' }}">
                    My Leases
                </a>
                <a href="{{ route('customer.repairs.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                    <i class="fas fa-tools mr-3"></i>
                    My Repairs
                </a>

                <!-- Profile Dropdown -->
                <div class="relative ml-3" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div x-show="open" class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
            <a href="{{ route('customer.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('customer.dashboard') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600 hover:bg-gray-50' }}">
                Home
            </a>
            <a href="{{ route('customer.properties.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('customer.properties.index') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600 hover:bg-gray-50' }}">
                Properties
            </a>
            <a href="{{ route('customer.leases.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('customer.leases.index') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600 hover:bg-gray-50' }}">
                My Leases
            </a>
            <a href="{{ route('customer.repairs.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors">
                <i class="fas fa-tools mr-3"></i>
                My Repairs
            </a>
            <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-200 pt-2">
                @csrf
                <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-red-600 hover:bg-red-50">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</nav>