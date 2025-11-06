<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to PropertyManager - Customer Portal</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <!-- Navigation -->
    <x-layouts.customer-nav />

    <!-- Hero Section -->
    <section class="relative py-20 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <!-- Floating Circles -->
            <div
                class="absolute top-10 left-10 w-72 h-72 bg-gradient-to-r from-blue-200 to-purple-200 rounded-full opacity-20 blur-3xl animate-pulse">
            </div>
            <div
                class="absolute bottom-20 right-20 w-96 h-96 bg-gradient-to-r from-purple-200 to-pink-200 rounded-full opacity-15 blur-3xl animate-pulse delay-1000">
            </div>
            <div
                class="absolute top-1/2 left-1/3 w-64 h-64 bg-gradient-to-r from-cyan-200 to-blue-200 rounded-full opacity-25 blur-3xl animate-pulse delay-500">
            </div>

            <!-- Grid Pattern -->
            <div
                class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.1)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.1)_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_80%_50%_at_50%_50%,black,transparent)]">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Hero Content -->
                <div class="text-center lg:text-left">
                    <div
                        class="inline-flex items-center bg-white/80 backdrop-blur-sm rounded-full px-4 py-2 mb-6 border border-blue-200 shadow-sm">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                        <span class="text-sm font-medium text-gray-700">Your Property Journey Starts Here</span>
                    </div>

                    <h1 class="text-4xl md:text-6xl font-bold text-gray-900 leading-tight mb-6">
                        Find Your
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 block">
                            Dream Space
                        </span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 max-w-2xl">
                        Discover perfectly curated properties that match your lifestyle.
                        From cozy apartments to luxury homes, your ideal rental is just a click away.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('customer.properties.index') }}"
                            class="group bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-2xl flex items-center justify-center">
                            <i class="fas fa-search mr-3 group-hover:scale-110 transition-transform"></i>
                            Explore Properties
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="flex flex-wrap gap-6 mt-12 justify-center lg:justify-start">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">500+</div>
                            <div class="text-gray-600 text-sm">Properties</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">98%</div>
                            <div class="text-gray-600 text-sm">Satisfaction</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">24/7</div>
                            <div class="text-gray-600 text-sm">Support</div>
                        </div>
                    </div>
                </div>

                <!-- Hero Visual -->
                <div class="relative">
                    <!-- Main Card -->
                    <div
                        class="relative bg-white/80 backdrop-blur-sm rounded-3xl p-8 shadow-2xl border border-white/20 transform rotate-2 hover:rotate-0 transition-transform duration-500">
                        <!-- Property Card -->
                        <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6 border border-blue-200">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center">
                                        <i class="fas fa-home text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900">Luxury Apartment</h3>
                                        <p class="text-sm text-gray-600">Makati City</p>
                                    </div>
                                </div>
                                <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    Available
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-4 mb-4">
                                <div class="text-center">
                                    <i class="fas fa-bed text-blue-500 mb-1"></i>
                                    <div class="text-sm font-semibold">2 Bed</div>
                                </div>
                                <div class="text-center">
                                    <i class="fas fa-bath text-blue-500 mb-1"></i>
                                    <div class="text-sm font-semibold">2 Bath</div>
                                </div>
                                <div class="text-center">
                                    <i class="fas fa-vector-square text-blue-500 mb-1"></i>
                                    <div class="text-sm font-semibold">85m²</div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="text-2xl font-bold text-blue-600">₱25,000<span
                                        class="text-sm text-gray-600">/month</span></div>
                                <button
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Elements -->
                    <div
                        class="absolute -top-4 -right-4 w-24 h-24 bg-gradient-to-r from-green-400 to-cyan-400 rounded-2xl rotate-12 shadow-lg animate-float">
                        <div class="w-full h-full flex items-center justify-center text-white">
                            <i class="fas fa-star text-xl"></i>
                        </div>
                    </div>

                    <div
                        class="absolute -bottom-6 -left-6 w-20 h-20 bg-gradient-to-r from-orange-400 to-pink-400 rounded-2xl -rotate-12 shadow-lg animate-float-delayed">
                        <div class="w-full h-full flex items-center justify-center text-white">
                            <i class="fas fa-heart text-lg"></i>
                        </div>
                    </div>

                    <!-- Floating Badges -->
                    <div
                        class="absolute top-1/4 -left-8 bg-white/90 backdrop-blur-sm rounded-2xl p-4 shadow-lg border border-gray-200 transform -rotate-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-shield-alt text-blue-600"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">Secure</div>
                                <div class="text-xs text-gray-600">Booking</div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="absolute bottom-1/4 -right-8 bg-white/90 backdrop-blur-sm rounded-2xl p-4 shadow-lg border border-gray-200 transform rotate-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-bolt text-green-600"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">Fast</div>
                                <div class="text-xs text-gray-600">Process</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    Everything You Need in
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                        One Place
                    </span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Streamline your property management experience with our comprehensive suite of features
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Feature 1 -->
                <div
                    class="group bg-gradient-to-br from-white to-blue-50 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-blue-100">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-file-contract text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Lease Management</h3>
                    <p class="text-gray-600 mb-6">
                        Access your lease agreements, track important dates, and manage renewals with ease.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            Digital lease signing
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            Automatic reminders
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            Document storage
                        </li>
                    </ul>
                </div>

                <!-- Feature 2 (Maintenance) -->
                <div
                    class="group bg-gradient-to-br from-white to-orange-50 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-orange-100">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-tools text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Maintenance</h3>
                    <p class="text-gray-600 mb-6">
                        Submit maintenance requests and track their progress in real-time.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            24/7 request submission
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            Photo attachments
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            Real-time updates
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl md:text-5xl font-bold mb-2">500+</div>
                    <div class="text-blue-100">Happy Customers</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-bold mb-2">1,200+</div>
                    <div class="text-blue-100">Properties Managed</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-bold mb-2">99%</div>
                    <div class="text-blue-100">Satisfaction Rate</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-bold mb-2">24/7</div>
                    <div class="text-blue-100">Customer Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Actions -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Quick Actions</h2>
                <p class="text-xl text-gray-600">Get things done quickly with these shortcuts</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                <a href="{{ route('customer.properties.index') }}"
                    class="group bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border border-gray-100">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-home text-white text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">View Properties</h3>
                    <p class="text-sm text-gray-600">See all your properties</p>
                </a>

                <a href="{{ route('customer.repairs.index') }}"
                    class="group bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border border-gray-100">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-tools text-white text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Report Issue</h3>
                    <p class="text-sm text-gray-600">Submit maintenance</p>
                </a>

                <a href="#"
                    class="group bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border border-gray-100">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-question-circle text-white text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Get Help</h3>
                    <p class="text-sm text-gray-600">Contact support</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">What Our Customers Say</h2>
                <p class="text-xl text-gray-600">Join thousands of satisfied property owners and tenants</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-2xl p-8">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                            MJ
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Maria Johnson</h4>
                            <p class="text-blue-600">Property Owner</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">
                        "This platform made managing my rental properties so much easier. Maintenance requests get
                        handled quickly!"
                    </p>
                </div>

                <div class="bg-gray-50 rounded-2xl p-8">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                            RS
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Robert Smith</h4>
                            <p class="text-green-600">Tenant</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">
                        "As a tenant, I love how easy it is to track maintenance requests. The mobile app is fantastic!"
                    </p>
                </div>

                <div class="bg-gray-50 rounded-2xl p-8">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                            AL
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Amanda Lee</h4>
                            <p class="text-orange-600">Property Manager</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">
                        "This system has streamlined our operations significantly. Our tenants are happier and our team
                        is more efficient."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-700 text-white">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold mb-6">Ready to Rent a Property?</h2>
            <p class="text-xl text-blue-100 mb-8">
                Join thousands of satisfied customers and experience the difference today.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('customer.properties.index') }}"
                    class="bg-white text-blue-600 hover:bg-gray-100 font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-rocket mr-2"></i>
                    Rent Now!
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-home text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">PropertyManager</h3>
                            <p class="text-gray-400 text-sm">Customer Portal</p>
                        </div>
                    </div>
                    <p class="text-gray-400">
                        Simplifying property management for owners and tenants alike.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">My Properties</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Maintenance</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Documents</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Support</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Contact Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">FAQs</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Tutorials</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Contact Info</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3"></i>
                            support@propertymanager.com
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-3"></i>
                            +1 (555) 123-4567
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-clock mr-3"></i>
                            24/7 Support Available
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 PropertyManager. All rights reserved. Making property management simple and efficient.
                </p>
            </div>
        </div>
    </footer>

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(12deg);
            }

            50% {
                transform: translateY(-20px) rotate(12deg);
            }
        }

        @keyframes float-delayed {

            0%,
            100% {
                transform: translateY(0) rotate(-12deg);
            }

            50% {
                transform: translateY(-15px) rotate(-12deg);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float-delayed 4s ease-in-out infinite;
        }
    </style>
</body>

</html>
