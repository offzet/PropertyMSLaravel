<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Properties - PropertyManager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <x-layouts.customer-nav />

    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Available Properties</h1>
                <p class="text-xl text-blue-100">Find your perfect home from our curated selection</p>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <form method="GET" action="{{ route('customer.properties.index') }}" class="space-y-4">
                <!-- Search and Sort Row -->
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Search -->
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                                placeholder="Search for available properties..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Sort -->
                    <div class="w-full md:w-48">
                        <select name="sort" onchange="this.form.submit()"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First
                            </option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low
                                to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price:
                                High to Low</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name: A to Z
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Filter Row -->
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <!-- Property Type -->
                    <div>
                        <select name="type" onchange="this.form.submit()"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>All Types</option>
                            @foreach ($propertyTypes as $type)
                                <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                    {{ ucfirst($type) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Bedrooms -->
                    <div>
                        <select name="bedrooms" onchange="this.form.submit()"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="any" {{ request('bedrooms') == 'any' ? 'selected' : '' }}>Any Bedrooms
                            </option>
                            <option value="1" {{ request('bedrooms') == '1' ? 'selected' : '' }}>1 Bedroom
                            </option>
                            <option value="2" {{ request('bedrooms') == '2' ? 'selected' : '' }}>2 Bedrooms
                            </option>
                            <option value="3" {{ request('bedrooms') == '3' ? 'selected' : '' }}>3 Bedrooms
                            </option>
                            <option value="4" {{ request('bedrooms') == '4' ? 'selected' : '' }}>4+ Bedrooms
                            </option>
                        </select>
                    </div>

                    <!-- Bathrooms -->
                    <div>
                        <select name="bathrooms" onchange="this.form.submit()"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="any" {{ request('bathrooms') == 'any' ? 'selected' : '' }}>Any Bathrooms
                            </option>
                            <option value="1" {{ request('bathrooms') == '1' ? 'selected' : '' }}>1 Bathroom
                            </option>
                            <option value="2" {{ request('bathrooms') == '2' ? 'selected' : '' }}>2 Bathrooms
                            </option>
                            <option value="3" {{ request('bathrooms') == '3' ? 'selected' : '' }}>3+ Bathrooms
                            </option>
                        </select>
                    </div>

                    <!-- Price Range -->
                    <div class="flex gap-2">
                        <input type="number" name="min_price" value="{{ request('min_price') }}"
                            placeholder="Min Price"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <input type="number" name="max_price" value="{{ request('max_price') }}"
                            placeholder="Max Price"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Filter Buttons -->
                    <div class="flex gap-2">
                        <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition duration-300">
                            <i class="fas fa-filter mr-2"></i>Apply
                        </button>
                        <a href="{{ route('customer.properties.index') }}"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Properties Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                    <div class="text-2xl font-bold text-blue-600 mb-2">{{ $properties->total() }}</div>
                    <div class="text-gray-600 font-medium">Total Properties</div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                    <div class="text-2xl font-bold text-green-600 mb-2">{{ $properties->count() }}</div>
                    <div class="text-gray-600 font-medium">Showing</div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                    <div class="text-2xl font-bold text-orange-600 mb-2">{{ $propertyTypes->count() }}</div>
                    <div class="text-gray-600 font-medium">Property Types</div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                    <div class="text-2xl font-bold text-purple-600 mb-2">
                        ₱{{ number_format($properties->min('price') ?? 0) }} -
                        ₱{{ number_format($properties->max('price') ?? 0) }}</div>
                    <div class="text-gray-600 font-medium">Price Range</div>
                </div>
            </div>

            <!-- Property Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="propertiesGrid">
                @forelse($properties as $property)
                    <div
                        class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <!-- Property Image -->
                        <div class="h-48 relative overflow-hidden">
                            @if ($property->image)
                                <img src="{{ Storage::url($property->image) }}" alt="{{ $property->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                    <i class="fas fa-home text-white text-4xl"></i>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $property->status == 'available' ? 'bg-green-500 text-white' : 'bg-orange-500 text-white' }}">
                                    {{ ucfirst($property->status) }}
                                </span>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 rounded-full bg-blue-600 text-white text-xs font-semibold">
                                    {{ ucfirst($property->type) }}
                                </span>
                            </div>
                        </div>

                        <!-- Property Details -->
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-bold text-gray-900">{{ $property->name }}</h3>
                                <div class="text-2xl font-bold text-blue-600">₱{{ number_format($property->price) }}
                                </div>
                            </div>

                            <div class="flex items-center text-gray-600 mb-3">
                                <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                <span class="text-sm">{{ $property->location }}</span>
                            </div>

                            <!-- Property Features -->
                            <div class="grid grid-cols-3 gap-4 mb-4 text-center">
                                @if ($property->bedrooms)
                                    <div class="text-sm text-gray-600">
                                        <i class="fas fa-bed text-blue-500 block mb-1"></i>
                                        {{ $property->bedrooms }} Bed
                                    </div>
                                @endif
                                @if ($property->bathrooms)
                                    <div class="text-sm text-gray-600">
                                        <i class="fas fa-bath text-blue-500 block mb-1"></i>
                                        {{ $property->bathrooms }} Bath
                                    </div>
                                @endif
                                @if ($property->area_sqm)
                                    <div class="text-sm text-gray-600">
                                        <i class="fas fa-vector-square text-blue-500 block mb-1"></i>
                                        {{ $property->area_sqm }} m²
                                    </div>
                                @endif
                            </div>

                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $property->description ?: 'Modern property with excellent amenities and convenient location.' }}
                            </p>

                            <div class="flex justify-center items-center">
                                <a href="{{ route('customer.properties.show', $property->id) }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white text-center  px-4 py-2 rounded-lg text-sm font-semibold transition duration-300 w-full">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <i class="fas fa-home text-gray-400 text-6xl mb-4"></i>
                        <h3 class="text-2xl font-bold text-gray-600 mb-2">No Properties Found</h3>
                        <p class="text-gray-500">Try adjusting your search filters.</p>
                        <a href="{{ route('customer.properties.index') }}"
                            class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-300">
                            Clear Filters
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($properties->hasPages())
                <div class="mt-12">
                    {{ $properties->links() }}
                </div>
            @endif

            <!-- Call to Action -->
            <div class="text-center mt-12">
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Can't Find What You're Looking For?</h3>
                    <p class="text-gray-600 mb-6">Contact us for personalized property recommendations.</p>
                    <a href="#"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition duration-300">
                        <i class="fas fa-phone-alt mr-2"></i>
                        Contact Agent
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2024 PropertyManager. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let delayTimer;

            $('#searchInput').on('keyup', function() {
                clearTimeout(delayTimer);
                let query = $(this).val();

                delayTimer = setTimeout(() => {
                    if (query.length >= 2 || query.length === 0) {
                        $.ajax({
                            url: "{{ route('customer.properties.ajax-search') }}", // FIXED ROUTE NAME
                            type: "GET",
                            data: {
                                search: query
                            },
                            beforeSend: function() {
                                $('#propertiesGrid').html(
                                    '<div class="col-span-full text-center py-12 text-gray-500">Searching...</div>'
                                );
                            },
                            success: function(response) {
                                $('#propertiesGrid').html(response.html);
                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX Error:', error);
                                $('#propertiesGrid').html(
                                    '<div class="col-span-full text-center py-12 text-red-500">Error occurred while searching. Please try again.</div>'
                                );
                            }
                        });
                    }
                }, 400);
            });
        });
    </script>
</body>

</html>
