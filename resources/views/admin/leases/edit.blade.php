<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Edit Lease Agreement</h1>
                
                <form action="{{ route('admin.leases.update', $lease->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Tenant Name -->
                        <div class="md:col-span-2">
                            <label for="tenant_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Tenant Name *
                            </label>
                            <input type="text" name="tenant_name" id="tenant_name" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                value="{{ old('tenant_name', $lease->tenant_name) }}"
                                placeholder="Enter tenant full name">
                            @error('tenant_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Property Unit -->
                        <div class="md:col-span-2">
                            <label for="property_unit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Property Unit *
                            </label>
                            <input type="text" name="property_unit" id="property_unit" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                value="{{ old('property_unit', $lease->property_unit) }}"
                                placeholder="e.g., Unit 101, Building A">
                            @error('property_unit')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lease Start -->
                        <div>
                            <label for="lease_start" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Lease Start Date *
                            </label>
                            <input type="date" name="lease_start" id="lease_start" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                value="{{ old('lease_start', $lease->lease_start->format('Y-m-d')) }}">
                            @error('lease_start')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lease End -->
                        <div>
                            <label for="lease_end" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Lease End Date *
                            </label>
                            <input type="date" name="lease_end" id="lease_end" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                value="{{ old('lease_end', $lease->lease_end->format('Y-m-d')) }}">
                            @error('lease_end')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Monthly Rent -->
                        <div>
                            <label for="monthly_rent" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Monthly Rent *
                            </label>
                            <input type="number" name="monthly_rent" id="monthly_rent" step="0.01" min="0" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                value="{{ old('monthly_rent', $lease->monthly_rent) }}"
                                placeholder="0.00">
                            @error('monthly_rent')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Security Deposit -->
                        <div>
                            <label for="security_deposit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Security Deposit
                            </label>
                            <input type="number" name="security_deposit" id="security_deposit" step="0.01" min="0"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                value="{{ old('security_deposit', $lease->security_deposit) }}"
                                placeholder="0.00">
                            @error('security_deposit')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Payment Frequency -->
                        <div>
                            <label for="payment_frequency" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Payment Frequency *
                            </label>
                            <select name="payment_frequency" id="payment_frequency" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="">Select Frequency</option>
                                <option value="monthly" {{ old('payment_frequency', $lease->payment_frequency) == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="quarterly" {{ old('payment_frequency', $lease->payment_frequency) == 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                                <option value="yearly" {{ old('payment_frequency', $lease->payment_frequency) == 'yearly' ? 'selected' : '' }}>Yearly</option>
                            </select>
                            @error('payment_frequency')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Status *
                            </label>
                            <select name="status" id="status" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="">Select Status</option>
                                <option value="active" {{ old('status', $lease->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="pending" {{ old('status', $lease->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="expired" {{ old('status', $lease->status) == 'expired' ? 'selected' : '' }}>Expired</option>
                                <option value="terminated" {{ old('status', $lease->status) == 'terminated' ? 'selected' : '' }}>Terminated</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="md:col-span-2">
                            <label for="terms" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Terms & Conditions
                            </label>
                            <textarea name="terms" id="terms" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                placeholder="Enter any special terms or conditions for this lease...">{{ old('terms', $lease->terms) }}</textarea>
                            @error('terms')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-600">
                        <a href="{{ route('admin.leases.index') }}" 
                           class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition duration-200 ease-in-out transform hover:scale-105">
                            Update Lease
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>