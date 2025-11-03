<tbody class="divide-y divide-gray-200">
    @forelse($repairs as $repair)
    <tr class="hover:bg-gray-50">
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">{{ $repair->title }}</div>
                    <div class="text-sm text-gray-500 truncate max-w-xs">{{ Str::limit($repair->description, 50) }}</div>
                </div>
            </div>
        </td>
        <td class="px-6 py-4">
            <div class="text-sm font-medium text-gray-900">{{ $repair->property->name ?? 'N/A' }}</div>
            <div class="text-sm text-gray-500">{{ $repair->tenant->name ?? 'N/A' }}</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            @php
                $priorityColors = [
                    'low' => 'bg-green-100 text-green-800',
                    'medium' => 'bg-yellow-100 text-yellow-800',
                    'high' => 'bg-orange-100 text-orange-800',
                    'urgent' => 'bg-red-100 text-red-800'
                ];
            @endphp
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $priorityColors[$repair->priority] ?? 'bg-gray-100 text-gray-800' }} capitalize">
                {{ $repair->priority }}
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            @php
                $statusColors = [
                    'pending' => 'bg-yellow-100 text-yellow-800',
                    'in_progress' => 'bg-blue-100 text-blue-800',
                    'completed' => 'bg-green-100 text-green-800',
                    'cancelled' => 'bg-red-100 text-red-800'
                ];
            @endphp
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$repair->status] ?? 'bg-gray-100 text-gray-800' }} capitalize">
                {{ str_replace('_', ' ', $repair->status) }}
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            {{ $repair->created_at->format('M d, Y') }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <a href="{{ route('admin.repairs.edit', $repair->id) }}" 
               class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
            <form action="{{ route('admin.repairs.destroy', $repair->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        onclick="return confirm('Are you sure you want to delete this repair request?')"
                        class="text-red-600 hover:text-red-900">
                    Delete
                </button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
            <div class="flex flex-col items-center justify-center py-8">
                <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <p class="text-lg font-medium text-gray-500 mb-2">No repair requests found</p>
                <p class="text-sm text-gray-400">Get started by adding your first repair request.</p>
            </div>
        </td>
    </tr>
    @endforelse
</tbody>