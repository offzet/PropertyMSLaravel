<!-- resources/views/admin/properties/partials/properties_table.blade.php -->
@forelse($properties as $property)
<tr class="hover:bg-gray-50">
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>
            <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">{{ $property->name }}</div>
                <div class="text-sm text-gray-500">Code: {{ $property->code }}</div>
            </div>
        </div>
    </td>
    <td class="px-6 py-4">
        <div class="text-sm text-gray-900 capitalize">{{ $property->type }}</div>
        <div class="text-sm text-gray-500 truncate max-w-xs">{{ $property->location }}</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-900">₱{{ number_format($property->price, 2) }}/month</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        @php
            $statusColors = [
                'available' => 'bg-green-100 text-green-800',
                'rented' => 'bg-blue-100 text-blue-800',
                'maintenance' => 'bg-yellow-100 text-yellow-800',
                'sold' => 'bg-gray-100 text-gray-800'
            ];
        @endphp
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$property->status] ?? 'bg-gray-100 text-gray-800' }} capitalize">
            {{ $property->status }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <a href="{{ route('admin.properties.edit', $property->id) }}" 
           class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
        <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    onclick="return confirm('Are you sure you want to delete this property?')"
                    class="text-red-600 hover:text-red-900">
                Delete
            </button>
        </form>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="px-6 py-16 text-center">
        <div class="flex flex-col items-center justify-center">
            <svg class="w-24 h-24 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <p class="text-xl font-medium text-gray-500 mb-2">No properties found</p>
            <p class="text-sm text-gray-400 mb-6">Get started by adding your first property.</p>

        </div>
    </td>
</tr>
@endforelse