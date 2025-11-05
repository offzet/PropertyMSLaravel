<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->name }} - PropertyManager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <x-layouts.customer-nav />

    <!-- Property Header -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-4">
                <a href="{{ route('customer.properties.index') }}" class="hover:text-blue-600">Properties</a>
                <i class="fas fa-chevron-right text-gray-400"></i>
                <span class="text-gray-900">{{ $property->name }}</span>
            </nav>

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $property->name }}</h1>
                    <div class="flex items-center space-x-4">
                        <span
                            class="px-3 py-1 rounded-full text-sm font-semibold
                            {{ $property->status == 'available' ? 'bg-green-500 text-white' : 'bg-orange-500 text-white' }}">
                            {{ ucfirst($property->status) }}
                        </span>
                        <span class="px-3 py-1 rounded-full bg-blue-600 text-white text-sm font-semibold">
                            {{ ucfirst($property->type) }}
                        </span>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-map-marker-alt text-red-500 mr-1"></i>
                            <span>{{ $property->location }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 lg:mt-0">
                    <div class="text-3xl font-bold text-blue-600">₱{{ number_format($property->price) }}/month</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Property Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Error Messages -->
        @if (session('error'))
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-500 text-xl mr-2"></i>
                    <div>
                        <span class="text-red-800 font-semibold">{{ session('error') }}</span>
                        <p class="text-red-600 text-sm mt-1">Please try another property or check back later.</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Property Images Gallery -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Property Images</h2>

                    @if ($property->image)
                        <!-- Main Large Image -->
                        <div class="mb-4">
                            <img id="mainImage" src="{{ Storage::url($property->image) }}" alt="{{ $property->name }}"
                                class="w-full h-80 object-cover rounded-lg">
                        </div>

                        <!-- Thumbnail Gallery -->
                        <div class="flex justify-center">
                            <div class="cursor-pointer">
                                <img src="{{ Storage::url($property->image) }}" alt="{{ $property->name }}"
                                    class="w-24 h-24 object-cover rounded-lg border-2 border-blue-500"
                                    onclick="changeMainImage('{{ Storage::url($property->image) }}')">
                            </div>
                        </div>
                    @else
                        <!-- Default image if no images uploaded -->
                        <div
                            class="bg-gradient-to-br from-blue-400 to-purple-500 rounded-2xl h-80 flex items-center justify-center text-white">
                            <div class="text-center">
                                <i class="fas fa-home text-6xl mb-4"></i>
                                <p class="text-xl">No Images Available</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Property Details -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Property Details</h2>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-6">
                        @if ($property->bedrooms)
                            <div class="text-center">
                                <i class="fas fa-bed text-blue-500 text-2xl mb-2"></i>
                                <div class="font-semibold text-gray-900">{{ $property->bedrooms }}</div>
                                <div class="text-sm text-gray-600">Bedrooms</div>
                            </div>
                        @endif

                        @if ($property->bathrooms)
                            <div class="text-center">
                                <i class="fas fa-bath text-blue-500 text-2xl mb-2"></i>
                                <div class="font-semibold text-gray-900">{{ $property->bathrooms }}</div>
                                <div class="text-sm text-gray-600">Bathrooms</div>
                            </div>
                        @endif

                        @if ($property->area_sqm)
                            <div class="text-center">
                                <i class="fas fa-vector-square text-blue-500 text-2xl mb-2"></i>
                                <div class="font-semibold text-gray-900">{{ $property->area_sqm }} m²</div>
                                <div class="text-sm text-gray-600">Area</div>
                            </div>
                        @endif

                        <div class="text-center">
                            <i class="fas fa-building text-blue-500 text-2xl mb-2"></i>
                            <div class="font-semibold text-gray-900">{{ ucfirst($property->type) }}</div>
                            <div class="text-sm text-gray-600">Type</div>
                        </div>
                    </div>

                    @if ($property->description)
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Description</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $property->description }}</p>
                        </div>
                    @endif
                </div>

                <!-- Location -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Location</h2>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-map-marker-alt text-red-500 mt-1"></i>
                        <div>
                            <p class="text-gray-900 font-semibold">{{ $property->location }}</p>
                            <p class="text-gray-600 text-sm mt-1">Conveniently located with easy access to amenities and
                                transportation.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Contact Information (Static) -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-blue-200">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Contact Information</h3>

                    <div class="space-y-4">
                        <!-- Property Manager -->
                        <div class="flex items-start space-x-3">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
                                JS
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">Basty Mirafelix</h4>
                                <p class="text-sm text-gray-600">Property Manager</p>
                                <div class="flex items-center mt-1 text-sm text-gray-500">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span>4.8 • 120 Reviews</span>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Details -->
                        <div class="space-y-2">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-phone-alt w-5 text-blue-500"></i>
                                <span class="ml-3">+63 912 345 6789</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-envelope w-5 text-blue-500"></i>
                                <span class="ml-3">john@propertymanager.com</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-clock w-5 text-blue-500"></i>
                                <span class="ml-3">Available 8AM - 8PM</span>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Rent This Property -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-green-200">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Rent This Property</h3>

                    @php
                        // Check if property has pending or approved applications
                        $hasPendingApplications = \App\Models\Tenant::where('property_id', $property->id)
                            ->whereIn('status', ['pending', 'approved'])
                            ->exists();
                    @endphp

                    @if ($property->status == 'available' && !$hasPendingApplications)
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 text-xl mr-2"></i>
                                <span class="text-green-800 font-semibold">Available for Rent</span>
                            </div>
                            <p class="text-green-600 text-sm mt-1">Ready for immediate move-in</p>
                        </div>

                        <!-- Rental Application Form -->
                        <form action="{{ route('customer.applications.store', $property->id) }}" method="POST"
                            class="space-y-4" id="rentalForm">
                            @csrf

                            <!-- Personal Information (Auto-filled) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                                <input type="text" name="name" required value="{{ Auth::user()->name }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50">
                                <p class="text-xs text-gray-500 mt-1">Auto-filled from your profile</p>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                    <input type="email" name="email" required value="{{ Auth::user()->email }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50">
                                    <p class="text-xs text-gray-500 mt-1">Auto-filled</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                                    <input type="tel" name="phone" id="phone" required
                                        value="{{ Auth::user()->phone ?? '' }}" placeholder="09XX XXX XXXX"
                                        maxlength="13"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 {{ Auth::user()->phone ? 'bg-gray-50' : '' }}"
                                        @if (Auth::user()->phone) data-auto-filled="true" @endif>
                                    <p class="text-xs text-gray-500 mt-1" id="phoneHelp">
                                        @if (Auth::user()->phone)
                                            Auto-filled from your profile
                                        @else
                                            Enter your 11-digit Philippine mobile number (e.g., 0912 345 6789)
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Rental Period -->
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Lease Start Date
                                        *</label>
                                    <input type="date" name="lease_start" id="lease_start" required
                                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Lease End Date
                                        *</label>
                                    <input type="date" name="lease_end" id="lease_end" required
                                        min="{{ date('Y-m-d', strtotime('+2 days')) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <!-- Proposed Rent - Auto-retrieved from property price -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Monthly Rent (₱) *
                                </label>
                                <div class="relative">
                                    <input type="number" name="rent_amount" required value="{{ $property->price }}"
                                        readonly
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 font-semibold">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">
                                    Fixed monthly rent: ₱{{ number_format($property->price) }}
                                </p>
                            </div>

                            <!-- Additional Information -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Additional Message
                                    (Optional)</label>
                                <textarea name="message" rows="3"
                                    placeholder="Tell us about yourself, your rental history, or any special requirements..."
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="flex items-start space-x-2">
                                <input type="checkbox" name="terms" id="terms" required
                                    class="mt-1 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <label for="terms" class="text-sm text-gray-600">
                                    I agree to the <strong>terms and conditions</strong>
                                    and understand that this application is subject to approval.
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg font-semibold text-center transition duration-300 transform hover:scale-105 flex items-center justify-center">
                                <i class="fas fa-file-contract mr-2"></i>
                                Submit Rental Application
                            </button>
                        </form>
                    @else
                        <!-- Property Not Available -->
                        <div class="bg-orange-50 border border-orange-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle text-orange-500 text-xl mr-2"></i>
                                <div>
                                    <span class="text-orange-800 font-semibold">
                                        @if ($property->status != 'available')
                                            Property {{ ucfirst($property->status) }}
                                        @elseif($hasPendingApplications)
                                            Application in Progress
                                        @endif
                                    </span>
                                    <p class="text-orange-600 text-sm mt-1">
                                        @if ($property->status != 'available')
                                            Sorry, this property has already been rented or sold by another customer and
                                            is waiting for admin confirmation.
                                        @elseif($hasPendingApplications)
                                            Sorry, this property already has a pending or approved application from
                                            another customer and is waiting for admin confirmation.
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Notify When Available -->
                        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-semibold text-gray-900 mb-2">Find Similar Properties</h4>
                            <p class="text-gray-600 text-sm mb-3">Browse other available properties in our collection.
                            </p>
                            <a href="{{ route('customer.properties.index') }}"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg text-sm font-semibold transition duration-300 inline-flex items-center justify-center">
                                <i class="fas fa-search mr-2"></i>
                                Browse Available Properties
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Property Info -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Property Information</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Property Code:</span>
                            <span class="font-semibold">{{ $property->code }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span
                                class="font-semibold {{ $property->status == 'available' ? 'text-green-600' : 'text-orange-600' }}">
                                {{ ucfirst($property->status) }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Type:</span>
                            <span class="font-semibold">{{ ucfirst($property->type) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Monthly Rent:</span>
                            <span class="font-semibold text-blue-600">₱{{ number_format($property->price) }}</span>
                        </div>
                        @if ($property->bedrooms)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Bedrooms:</span>
                                <span class="font-semibold">{{ $property->bedrooms }}</span>
                            </div>
                        @endif
                        @if ($property->bathrooms)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Bathrooms:</span>
                                <span class="font-semibold">{{ $property->bathrooms }}</span>
                            </div>
                        @endif
                        @if ($property->area_sqm)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Area:</span>
                                <span class="font-semibold">{{ $property->area_sqm }} m²</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2024 PropertyManager. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Image gallery functionality
        function changeMainImage(imageUrl) {
            document.getElementById('mainImage').src = imageUrl;
        }

        // Improved Phone number formatting function for Philippine numbers
        function formatPhoneNumber(input) {
            // Remove all non-digit characters
            let value = input.value.replace(/\D/g, '');

            // If empty, return empty
            if (!value) return '';

            // Ensure it starts with 0 or 63
            if (value.startsWith('0')) {
                // Keep as is - starts with 0
            } else if (value.startsWith('63')) {
                // Convert 63 to 0
                value = '0' + value.substring(2);
            } else if (value.startsWith('9') && value.length === 10) {
                // If starts with 9 and has 10 digits, prepend 0
                value = '0' + value;
            }

            // Limit to 11 digits total (0 + 10 digits)
            if (value.length > 11) {
                value = value.substring(0, 11);
            }

            // Format: 09XX XXX XXXX
            let formatted = '';
            if (value.length > 0) {
                formatted = value.substring(0, 4); // 09XX
            }
            if (value.length > 4) {
                formatted += ' ' + value.substring(4, 7); // XXX
            }
            if (value.length > 7) {
                formatted += ' ' + value.substring(7, 11); // XXXX
            }

            input.value = formatted;
        }

        // Convert to +63 format for submission
        function convertToInternationalFormat(phone) {
            // Remove all non-digit characters and spaces
            let value = phone.replace(/\D/g, '');

            if (value.startsWith('0')) {
                return '+63' + value.substring(1);
            } else if (value.startsWith('63')) {
                return '+' + value;
            } else if (value.startsWith('9') && value.length === 10) {
                return '+63' + value;
            }
            return phone;
        }

        // Validate phone number format - dapat exactly 11 digits
        function validatePhoneNumber(phone) {
            // Remove spaces and check format
            const cleanPhone = phone.replace(/\s/g, '');
            // Dapat: 0 + 10 digits = 11 characters total
            const phoneRegex = /^0[9]\d{9}$/; // 0 followed by 9 and 9 more digits
            return phoneRegex.test(cleanPhone) && cleanPhone.length === 11;
        }

        // Auto-calculate lease end date when start date changes
        document.getElementById('lease_start')?.addEventListener('change', function() {
            const startDate = new Date(this.value);
            const endDate = new Date(startDate);
            endDate.setFullYear(endDate.getFullYear() + 1); // Default 1 year lease

            const endDateInput = document.getElementById('lease_end');
            if (endDateInput) {
                endDateInput.min = this.value; // Ensure end date is after start date
                // Only set default if end date is not already set
                if (!endDateInput.value) {
                    endDateInput.value = endDate.toISOString().split('T')[0];
                }
            }
        });

        // Form validation
        document.getElementById('rentalForm')?.addEventListener('submit', function(e) {
            let isValid = true;
            const errorMessages = [];

            // Validate lease dates
            const startDate = new Date(document.getElementById('lease_start').value);
            const endDate = new Date(document.getElementById('lease_end').value);
            const today = new Date();
            today.setHours(0, 0, 0, 0); // Reset time part for accurate comparison

            if (startDate <= today) {
                isValid = false;
                errorMessages.push('Lease start date must be in the future.');
            }

            if (endDate <= startDate) {
                isValid = false;
                errorMessages.push('Lease end date must be after the start date.');
            }

            // Validate phone number
            const phoneInput = document.getElementById('phone');
            const phone = phoneInput.value;

            if (!phone) {
                isValid = false;
                errorMessages.push('Please enter your phone number.');
            } else if (!validatePhoneNumber(phone)) {
                isValid = false;
                errorMessages.push(
                    'Please enter a valid 11-digit Philippine mobile number.\n\nFormat: 0912 345 6789\n\nCurrent input: ' +
                    phone);
            }

            // Validate terms and conditions
            const terms = document.getElementById('terms');
            if (!terms.checked) {
                isValid = false;
                errorMessages.push('You must agree to the terms and conditions.');
            }

            if (!isValid) {
                e.preventDefault();
                alert('Please fix the following errors:\n\n' + errorMessages.join('\n'));
            } else {
                // Convert phone number to +63 format before submission
                const internationalFormat = convertToInternationalFormat(phone);
                phoneInput.value = internationalFormat;
            }
        });

        // Initialize date validation on page load
        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.getElementById('lease_start');
            const endDateInput = document.getElementById('lease_end');

            if (startDateInput && !startDateInput.value) {
                // Set minimum start date to tomorrow
                const tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                startDateInput.min = tomorrow.toISOString().split('T')[0];
            }

            if (endDateInput && !endDateInput.value) {
                // Set minimum end date to day after tomorrow
                const dayAfterTomorrow = new Date();
                dayAfterTomorrow.setDate(dayAfterTomorrow.getDate() + 2);
                endDateInput.min = dayAfterTomorrow.toISOString().split('T')[0];
            }

            // Format existing phone number if any
            const phoneInput = document.getElementById('phone');
            if (phoneInput && phoneInput.value) {
                setTimeout(() => {
                    formatPhoneNumber(phoneInput);
                    // Validate existing number
                    const phone = phoneInput.value;
                    if (phone && !validatePhoneNumber(phone)) {
                        phoneInput.classList.add('border-red-500');
                        const phoneHelp = document.getElementById('phoneHelp');
                        if (phoneHelp) {
                            phoneHelp.textContent = 'Invalid phone number format. Please use 09XX XXX XXXX';
                            phoneHelp.classList.add('text-red-500');
                        }
                    }
                }, 100);
            }

            // Add input event listener for real-time formatting
            phoneInput?.addEventListener('input', function() {
                formatPhoneNumber(this);

                // Real-time validation
                const phone = this.value;
                const phoneHelp = document.getElementById('phoneHelp');

                if (phone && validatePhoneNumber(phone)) {
                    this.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                    this.classList.add('border-green-500', 'focus:border-green-500',
                        'focus:ring-green-500');
                    if (phoneHelp) {
                        phoneHelp.textContent = 'Valid Philippine mobile number';
                        phoneHelp.classList.remove('text-red-500');
                        phoneHelp.classList.add('text-green-500');
                    }
                } else if (phone) {
                    this.classList.remove('border-green-500', 'focus:border-green-500',
                        'focus:ring-green-500');
                    this.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                    if (phoneHelp) {
                        phoneHelp.textContent = 'Please enter 11 digits (09XX XXX XXXX)';
                        phoneHelp.classList.remove('text-green-500');
                        phoneHelp.classList.add('text-red-500');
                    }
                } else {
                    this.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500',
                        'border-green-500', 'focus:border-green-500', 'focus:ring-green-500');
                    this.classList.add('border-gray-300', 'focus:border-blue-500', 'focus:ring-blue-500');
                    if (phoneHelp) {
                        phoneHelp.textContent =
                            'Enter your 11-digit Philippine mobile number (e.g., 0912 345 6789)';
                        phoneHelp.classList.remove('text-red-500', 'text-green-500');
                        phoneHelp.classList.add('text-gray-500');
                    }
                }
            });

            // Format on blur as well
            phoneInput?.addEventListener('blur', function() {
                formatPhoneNumber(this);
            });
        });

        // Allow user to paste phone numbers and auto-format them
        document.getElementById('phone')?.addEventListener('paste', function(e) {
            // Let the paste happen first, then format
            setTimeout(() => {
                formatPhoneNumber(this);
            }, 0);
        });

        // Enhanced input handling for better UX
        document.getElementById('phone')?.addEventListener('keydown', function(e) {
            // Allow: backspace, delete, tab, escape, enter, and numbers
            if ([46, 8, 9, 27, 13].includes(e.keyCode) ||
                // Allow: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode == 67 && e.ctrlKey === true) ||
                (e.keyCode == 86 && e.ctrlKey === true) ||
                (e.keyCode == 88 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39) ||
                // Allow: numbers and numpad numbers
                ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105))) {
                return;
            }
            // Prevent if not a number or allowed key
            e.preventDefault();
        });
    </script>
</body>

</html>
