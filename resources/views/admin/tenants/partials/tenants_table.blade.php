<tbody class="divide-y divide-gray-200">
    @forelse($tenants as $tenant)
    <tr class="hover:bg-gray-50">
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10 bg-purple-100 rounded-full flex items-center justify-center">
                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">{{ $tenant->name }}</div>
                    <div class="text-sm text-gray-500">ID: {{ $tenant->id }}</div>
                </div>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ $tenant->email }}</div>
            <div class="text-sm text-gray-500">{{ $tenant->phone ?? 'N/A' }}</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ $tenant->property_unit }}</div>
            @if($tenant->property)
                <div class="text-sm text-gray-500">{{ $tenant->property->type }}</div>
            @endif
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">
                @if($tenant->lease_start && $tenant->lease_end)
                    {{ $tenant->lease_start->format('M d, Y') }} - {{ $tenant->lease_end->format('M d, Y') }}
                @else
                    N/A
                @endif
            </div>

        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">₱{{ number_format($tenant->rent_amount, 2) }}/month</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            @php
                $statusColors = [
                    'active' => 'bg-green-100 text-green-800',
                    'inactive' => 'bg-red-100 text-red-800',
                    'pending' => 'bg-yellow-100 text-yellow-800'
                ];
            @endphp
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$tenant->status] ?? 'bg-gray-100 text-gray-800' }} capitalize">
                {{ $tenant->status }}
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <a href="{{ route('admin.tenants.edit', $tenant->id) }}" 
               class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
            <form action="{{ route('admin.tenants.destroy', $tenant->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        onclick="return confirm('Are you sure you want to delete this tenant?')"
                        class="text-red-600 hover:text-red-900">
                    Delete
                </button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
            <div class="flex flex-col items-center justify-center py-8">
                <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <p class="text-lg font-medium text-gray-500 mb-2">No tenants found</p>
                <p class="text-sm text-gray-400">Get started by adding your first tenant.</p>
            </div>
        </td>
    </tr>
    @endforelse
</tbody>