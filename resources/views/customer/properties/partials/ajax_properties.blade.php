@forelse($properties as $property)
<div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
    <!-- Property Image -->
    <div class="h-48 relative overflow-hidden">
        @if($property->image)
            <img src="{{ Storage::url($property->image) }}" 
                 alt="{{ $property->name }}" 
                 class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                <i class="fas fa-home text-white text-4xl"></i>
            </div>
        @endif
        <div class="absolute top-4 left-4">
            <span class="px-3 py-1 rounded-full text-xs font-semibold 
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
            <div class="text-2xl font-bold text-blue-600">₱{{ number_format($property->price) }}</div>
        </div>
        
        <div class="flex items-center text-gray-600 mb-3">
            <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
            <span class="text-sm">{{ $property->location }}</span>
        </div>

        <!-- Property Features -->
        <div class="grid grid-cols-3 gap-4 mb-4 text-center">
            @if($property->bedrooms)
            <div class="text-sm text-gray-600">
                <i class="fas fa-bed text-blue-500 block mb-1"></i>
                {{ $property->bedrooms }} Bed
            </div>
            @endif
            @if($property->bathrooms)
            <div class="text-sm text-gray-600">
                <i class="fas fa-bath text-blue-500 block mb-1"></i>
                {{ $property->bathrooms }} Bath
            </div>
            @endif
            @if($property->area_sqm)
            <div class="text-sm text-gray-600">
                <i class="fas fa-vector-square text-blue-500 block mb-1"></i>
                {{ $property->area_sqm }} m²
            </div>
            @endif
        </div>

        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
            {{ $property->description ?: 'Modern property with excellent amenities and convenient location.' }}
        </p>

        <div class="flex justify-between items-center">
            <div class="text-sm text-gray-500">
                <i class="fas fa-code mr-1"></i>
                {{ $property->code }}
            </div>
            <a href="{{ route('customer.properties.show', $property->id) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition duration-300">
                View Details
            </a>
        </div>
    </div>
</div>
@empty
<div class="col-span-full text-center py-12">
    <i class="fas fa-home text-gray-400 text-6xl mb-4"></i>
    <h3 class="text-2xl font-bold text-gray-600 mb-2">No Properties Found</h3>
    <p class="text-gray-500">Try adjusting your search term.</p>
</div>
@endforelse