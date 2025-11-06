{{-- resources/views/admin/tenants/edit.blade.php --}}
<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Tenant</h1>
        </div>

        <!-- Form -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-200 dark:border-gray-700">
            <form action="{{ route('admin.tenants.update', $tenant->id) }}" method="POST" id="tenantForm">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $tenant->name) }}"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
                            required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email', $tenant->email) }}"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
                            required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Phone
                        </label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $tenant->phone) }}"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Property Selection -->
                    <div>
                        <label for="property_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Property Unit <span class="text-red-500">*</span>
                        </label>
                        <select name="property_id" id="property_id"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
                            required>
                            <option value="">Select Property Unit</option>
                            @foreach ($properties as $property)
                                <option value="{{ $property->id }}" data-price="{{ $property->price }}"
                                    {{ old('property_id', $tenant->property_id) == $property->id ? 'selected' : '' }}>
                                    {{ $property->code }} - {{ $property->name }} ({{ $property->type }}) -
                                    ₱{{ number_format($property->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                        @error('property_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lease Start -->
                    <div>
                        <label for="lease_start"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Lease Start Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="lease_start" id="lease_start"
                            value="{{ old('lease_start', $tenant->lease_start ? $tenant->lease_start->format('Y-m-d') : '') }}"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
                            required>
                        @error('lease_start')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lease End -->
                    <div>
                        <label for="lease_end" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Lease End Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="lease_end" id="lease_end"
                            value="{{ old('lease_end', $tenant->lease_end ? $tenant->lease_end->format('Y-m-d') : '') }}"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
                            required>
                        @error('lease_end')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rent Amount (Auto-filled from property price) -->
                    <div>
                        <label for="rent_amount"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Rent Amount <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="rent_amount" id="rent_amount" step="0.01" min="0"
                            value="{{ old('rent_amount', $tenant->rent_amount) }}"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
                            required readonly>
                        <p class="text-sm text-gray-500 mt-1">Auto-filled from selected property</p>
                        @error('rent_amount')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
                            required>
                            <option value="">Select Status</option>
                            <option value="active" {{ old('status', $tenant->status) == 'active' ? 'selected' : '' }}>
                                Active</option>
                            <option value="inactive"
                                {{ old('status', $tenant->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="pending"
                                {{ old('status', $tenant->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6 flex justify-end space-x-4">
                    <a href="{{ route('admin.tenants.index') }}"
                        class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                        Update Tenant
                    </button>
                </div>
            </form>

            <!-- Delete Button Section -->
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-600">
                <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-md">
                    <h3 class="text-lg font-medium text-red-800 dark:text-red-400 mb-2">Delete Tenant</h3>
                    <p class="text-red-600 dark:text-red-300 mb-4">Once you delete a tenant, there is no going back.
                        Please be certain.</p>
                    <form action="{{ route('admin.tenants.destroy', $tenant->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Are you sure you want to delete this tenant? This action cannot be undone.')"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md transition duration-200">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const propertySelect = document.getElementById('property_id');
            const rentAmountInput = document.getElementById('rent_amount');

            propertySelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const price = selectedOption.getAttribute('data-price');

                if (price) {
                    rentAmountInput.value = price;
                } else {
                    rentAmountInput.value = '';
                }
            });

            // Trigger change on page load
            propertySelect.dispatchEvent(new Event('change'));
        });
    </script>
</x-app-layout>
