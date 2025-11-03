<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Repair Request') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.repairs.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Property Selection -->
                            <div>
                                <label for="property_id" class="block text-sm font-medium text-gray-700">Property *</label>
                                <select name="property_id" id="property_id" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                    <option value="">Select Property</option>
                                    @foreach($properties as $property)
                                        <option value="{{ $property->id }}" {{ old('property_id') == $property->id ? 'selected' : '' }}>
                                            {{ $property->name }} - {{ $property->address }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('property_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tenant Selection -->
                            <div>
                                <label for="tenant_id" class="block text-sm font-medium text-gray-700">Tenant *</label>
                                <select name="tenant_id" id="tenant_id" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                    <option value="">Select Tenant</option>
                                    @foreach($tenants as $tenant)
                                        <option value="{{ $tenant->id }}" 
                                                data-property-id="{{ $tenant->property_id }}"
                                                {{ old('tenant_id') == $tenant->id ? 'selected' : '' }}>
                                            {{ $tenant->name }} - {{ $tenant->email }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tenant_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Repair Title -->
                            <div class="md:col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-700">Repair Title *</label>
                                <input type="text" name="title" id="title" required value="{{ old('title') }}"
                                       placeholder="e.g., Leaking Faucet, Broken Window, Electrical Issue"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description *</label>
                                <textarea name="description" id="description" rows="4" required
                                          placeholder="Please provide detailed description of the repair needed..."
                                          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Priority -->
                            <div>
                                <label for="priority" class="block text-sm font-medium text-gray-700">Priority *</label>
                                <select name="priority" id="priority" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                    <option value="">Select Priority</option>
                                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                                    <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                </select>
                                @error('priority')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                                <select name="status" id="status" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                    <option value="">Select Status</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('admin.repairs.index') }}"
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                                Save Repair Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const propertySelect = document.getElementById('property_id');
            const tenantSelect = document.getElementById('tenant_id');
            
            // Function to filter tenants based on selected property
            function filterTenantsByProperty(propertyId) {
                const tenantOptions = tenantSelect.querySelectorAll('option');
                
                tenantOptions.forEach(option => {
                    if (option.value === '') {
                        option.style.display = ''; // Always show the "Select Tenant" option
                    } else {
                        const tenantPropertyId = option.getAttribute('data-property-id');
                        if (!propertyId || tenantPropertyId === propertyId) {
                            option.style.display = '';
                        } else {
                            option.style.display = 'none';
                        }
                    }
                });
                
                // Reset tenant selection if the current selection doesn't match the property
                const selectedTenant = tenantSelect.value;
                if (selectedTenant) {
                    const selectedOption = tenantSelect.querySelector(`option[value="${selectedTenant}"]`);
                    if (selectedOption && selectedOption.style.display === 'none') {
                        tenantSelect.value = '';
                    }
                }
            }
            
            // Function to filter properties based on selected tenant
            function filterPropertiesByTenant(tenantId) {
                if (!tenantId) {
                    // Show all properties if no tenant is selected
                    const propertyOptions = propertySelect.querySelectorAll('option');
                    propertyOptions.forEach(option => {
                        option.style.display = '';
                    });
                    return;
                }
                
                const selectedTenantOption = tenantSelect.querySelector(`option[value="${tenantId}"]`);
                if (selectedTenantOption) {
                    const tenantPropertyId = selectedTenantOption.getAttribute('data-property-id');
                    
                    const propertyOptions = propertySelect.querySelectorAll('option');
                    propertyOptions.forEach(option => {
                        if (option.value === '') {
                            option.style.display = ''; // Always show the "Select Property" option
                        } else if (option.value === tenantPropertyId) {
                            option.style.display = '';
                        } else {
                            option.style.display = 'none';
                        }
                    });
                    
                    // Auto-select the property if it matches the tenant
                    if (tenantPropertyId && (!propertySelect.value || propertySelect.querySelector(`option[value="${propertySelect.value}"]`).style.display === 'none')) {
                        propertySelect.value = tenantPropertyId;
                    }
                }
            }
            
            // Event listeners
            propertySelect.addEventListener('change', function() {
                filterTenantsByProperty(this.value);
            });
            
            tenantSelect.addEventListener('change', function() {
                filterPropertiesByTenant(this.value);
            });
            
            // Initial filtering based on any pre-selected values
            if (propertySelect.value) {
                filterTenantsByProperty(propertySelect.value);
            }
            
            if (tenantSelect.value) {
                filterPropertiesByTenant(tenantSelect.value);
            }
        });
    </script>
</x-app-layout>