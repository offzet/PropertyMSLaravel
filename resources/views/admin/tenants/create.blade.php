<x-app-layout>
        <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Tenant') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto px-4 py-6">

        <!-- Form -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-200 dark:border-gray-700">
            <form action="{{ route('admin.tenants.store') }}" method="POST" id="tenantForm">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name') }}"
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
                        <input type="email" 
                               name="email" 
                               id="email" 
                               value="{{ old('email') }}"
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
                        <input type="text" 
                               name="phone" 
                               id="phone" 
                               value="{{ old('phone') }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Property Selection -->
                    <div>
                        <label for="property_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Property Unit <span class="text-red-500">*</span>
                        </label>
                        <select name="property_id" 
                                id="property_id" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
                                required>
                            <option value="">Select Property Unit</option>
                            @foreach($properties as $property)
                                <option value="{{ $property->id }}" 
                                        data-price="{{ $property->price }}"
                                        {{ old('property_id') == $property->id ? 'selected' : '' }}>
                                    {{ $property->code }} - {{ $property->name }} ({{ $property->type }}) - ₱{{ number_format($property->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                        @error('property_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lease Start -->
                    <div>
                        <label for="lease_start" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Lease Start Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               name="lease_start" 
                               id="lease_start" 
                               value="{{ old('lease_start') }}"
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
                        <input type="date" 
                               name="lease_end" 
                               id="lease_end" 
                               value="{{ old('lease_end') }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
                               required>
                        @error('lease_end')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rent Amount (Auto-filled from property price) -->
                    <div>
                        <label for="rent_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Rent Amount <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               name="rent_amount" 
                               id="rent_amount" 
                               step="0.01" 
                               min="0"
                               value="{{ old('rent_amount') }}"
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
                        <select name="status" 
                                id="status" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
                                required>
                            <option value="">Select Status</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
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
                        Create Tenant
                    </button>
                </div>
            </form>
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
            
            // Trigger change on page load if there's a selected value
            if (propertySelect.value) {
                propertySelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
</x-app-layout>