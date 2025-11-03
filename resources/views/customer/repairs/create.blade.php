<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Repair - PropertyManager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <x-layouts.customer-nav />

    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Request Maintenance</h1>
                <p class="text-blue-100 text-lg">Report any issues or maintenance needs for your property</p>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-8">
        @if($tenants->count() > 0)
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2 flex items-center">
                    <i class="fas fa-tools text-blue-600 mr-3"></i>
                    Maintenance Request Form
                </h2>
                <p class="text-gray-600 mb-6">Fill out the form below to report any maintenance issues</p>
                
                <form action="{{ route('customer.repairs.store') }}" method="POST">
                    @csrf

                    <!-- Tenant/Property Selection -->
                    <div class="mb-6">
                        <label for="tenant_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Select Property <span class="text-red-500">*</span>
                        </label>
                        <select class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tenant_id') border-red-500 @enderror" 
                                id="tenant_id" name="tenant_id" required>
                            <option value="">Choose your property...</option>
                            @foreach($tenants as $tenant)
                            <option value="{{ $tenant->id }}" {{ old('tenant_id') == $tenant->id ? 'selected' : '' }}>
                                {{ $tenant->property_unit }} - {{ $tenant->property->location ?? 'N/A' }}
                            </option>
                            @endforeach
                        </select>
                        @error('tenant_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Issue Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Issue Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               class="w-full px-4 py-3 border  rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}" 
                               placeholder="e.g., Leaking faucet in kitchen, Broken AC unit, etc." 
                               required>
                        @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Priority Level -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Priority Level <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-green-500 transition-colors">
                                <input type="radio" name="priority" value="low" class="text-green-500 focus:ring-green-500" {{ old('priority') == 'low' ? 'checked' : '' }}>
                                <div class="ml-3">
                                    <span class="font-medium text-gray-900">Low Priority</span>
                                    <p class="text-sm text-gray-500">Minor issues that don't affect daily use</p>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-yellow-500 transition-colors">
                                <input type="radio" name="priority" value="medium" class="text-yellow-500 focus:ring-yellow-500" {{ old('priority') == 'medium' ? 'checked' : '' }}>
                                <div class="ml-3">
                                    <span class="font-medium text-gray-900">Medium Priority</span>
                                    <p class="text-sm text-gray-500">Issues that need attention soon</p>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-orange-500 transition-colors">
                                <input type="radio" name="priority" value="high" class="text-orange-500 focus:ring-orange-500" {{ old('priority') == 'high' ? 'checked' : '' }}>
                                <div class="ml-3">
                                    <span class="font-medium text-gray-900">High Priority</span>
                                    <p class="text-sm text-gray-500">Issues affecting daily activities</p>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-red-500 transition-colors">
                                <input type="radio" name="priority" value="urgent" class="text-red-500 focus:ring-red-500" {{ old('priority') == 'urgent' ? 'checked' : '' }}>
                                <div class="ml-3">
                                    <span class="font-medium text-gray-900">Urgent</span>
                                    <p class="text-sm text-gray-500">Emergency situations requiring immediate attention</p>
                                </div>
                            </label>
                        </div>
                        @error('priority')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Detailed Description <span class="text-red-500">*</span>
                        </label>
                        <textarea class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="6" 
                                  placeholder="Please describe the issue in detail. Include when it started, specific locations, and any other relevant information..." 
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-between items-center pt-6 border-t border-gray-200">
                        <a href="{{ route('customer.dashboard') }}" 
                           class="w-full sm:w-auto px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Dashboard
                        </a>
                        <button type="submit" 
                                class="w-full sm:w-auto px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition-colors transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>

            <!-- Emergency Notice -->
            <div class="bg-red-50 border border-red-200 rounded-2xl p-6 mt-6">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-red-500 text-xl mt-1 mr-3"></i>
                    <div>
                        <h3 class="text-lg font-semibold text-red-800 mb-2">Emergency Situations</h3>
                        <p class="text-red-700 mb-3">For emergency situations that require immediate attention, please call:</p>
                        <div class="text-center bg-white rounded-lg p-4 border border-red-300">
                            <h4 class="text-2xl font-bold text-red-600 mb-1">(02) 1234-5678</h4>
                            <p class="text-red-500 text-sm">Available 24/7 for emergencies only</p>
                        </div>
                        <div class="mt-4">
                            <strong class="text-red-800">Examples of emergencies:</strong>
                            <ul class="text-red-700 text-sm list-disc list-inside mt-2 space-y-1">
                                <li>Gas leaks or smell of gas</li>
                                <li>Major water leaks or flooding</li>
                                <li>No electricity in entire unit</li>
                                <li>Broken locks or security issues</li>
                                <li>Fire or smoke damage</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- No Active Leases State -->
            <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
                <div class="max-w-md mx-auto">
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <i class="fas fa-home text-white text-4xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">No Active Leases</h3>
                    <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                        You need an active lease agreement to submit maintenance requests. 
                        Please check your lease status or contact property management.
                    </p>
                    <div class="space-y-4">
                        <a href="{{ route('customer.leases.index') }}" 
                           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-file-contract mr-3"></i>
                            Check My Leases
                        </a>
                        <div class="pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-500">
                                Need immediate assistance? 
                                <a href="tel:+639123456789" class="text-blue-600 hover:text-blue-700 font-semibold">Call our emergency line</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex justify-center space-x-6 mb-6">
                <a href="#" class="text-gray-400 hover:text-white transition-colors">
                    <i class="fab fa-facebook text-xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition-colors">
                    <i class="fab fa-twitter text-xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition-colors">
                    <i class="fab fa-instagram text-xl"></i>
                </a>
            </div>
            <p class="text-gray-400">&copy; 2024 PropertyManager. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Priority level visual feedback
            const priorityRadios = document.querySelectorAll('input[name="priority"]');
            priorityRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    // Remove all previous styling
                    document.querySelectorAll('label').forEach(label => {
                        label.classList.remove('border-green-500', 'border-yellow-500', 'border-orange-500', 'border-red-500');
                    });
                    
                    // Add styling to selected priority
                    if (this.checked) {
                        const label = this.closest('label');
                        const priority = this.value;
                        
                        switch(priority) {
                            case 'low':
                                label.classList.add('border-green-500');
                                break;
                            case 'medium':
                                label.classList.add('border-yellow-500');
                                break;
                            case 'high':
                                label.classList.add('border-orange-500');
                                break;
                            case 'urgent':
                                label.classList.add('border-red-500');
                                break;
                        }
                    }
                });
            });

            // Trigger change event on page load for any pre-selected priority
            const selectedPriority = document.querySelector('input[name="priority"]:checked');
            if (selectedPriority) {
                selectedPriority.dispatchEvent(new Event('change'));
            }
        });
    </script>
</body>
</html>