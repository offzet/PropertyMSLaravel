<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Animation Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />


    <style>
        /* Custom CSS for enhanced design */
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translate(0, 0px);
            }

            50% {
                transform: translate(0, 15px);
            }

            100% {
                transform: translate(0, -0px);
            }
        }

        .gradient-text {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .property-card {
            transition: all 0.3s ease;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .property-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .testimonial-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .testimonial-card::before {
            content: "";
            position: absolute;
            top: -10px;
            left: 20px;
            font-size: 80px;
            color: #667eea;
            opacity: 0.1;
            font-family: Georgia, serif;
        }

        .nav-link {
            position: relative;
            padding-bottom: 5px;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-gradient);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
        }

        .btn-outline {
            border: 2px solid #667eea;
            border-radius: 10px;
            padding: 10px 28px;
            color: #667eea;
            font-weight: 600;
            transition: all 0.3s ease;
            background: transparent;
        }

        .btn-outline:hover {
            background: #667eea;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        /* Dark mode adjustments */
        @media (prefers-color-scheme: dark) {

            .stat-card,
            .testimonial-card {
                background: #1f2937;
            }
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 font-sans overflow-x-hidden">

    <!-- Header -->
    <header class="sticky top-0 left-0 right-0 z-50 bg-gray-50 dark:bg-gray-900 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <nav class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-12 h-12 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center shadow-md">
                        <i class="fas fa-home text-white text-lg"></i>
                    </div>
                    <span class="text-2xl font-bold gradient-text">PropertyPro</span>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="nav-link text-gray-700 dark:text-gray-300 font-medium">Features</a>
                    <a href="#testimonials"
                        class="nav-link text-gray-700 dark:text-gray-300 font-medium">Testimonials</a>

                </div>

                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary">
                            Dashboard <i class="ml-2 fas fa-arrow-right"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition nav-link">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-primary">
                                Get Started
                            </a>
                        @endif
                    @endauth

                    <!-- Mobile menu button -->
                    <button id="mobile-menu-button" class="md:hidden text-gray-700 dark:text-gray-300">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </nav>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden mt-4 py-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex flex-col space-y-4">
                    <a href="#features" class="text-gray-700 dark:text-gray-300 font-medium">Features</a>
                    <a href="#testimonials" class="text-gray-700 dark:text-gray-300 font-medium">Testimonials</a>

                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 flex flex-col lg:flex-row items-center justify-between gap-12">

            <!-- Text -->
            <div class="lg:w-1/2" data-aos="fade-right">
                <h1 class="text-4xl lg:text-6xl font-bold mb-6 leading-tight">
                    Simplify Your <span class="gradient-text">Property Management</span>
                </h1>
                <p class="text-lg lg:text-xl text-gray-600 dark:text-gray-400 mb-8 max-w-lg">
                    Streamline your property operations with our comprehensive platform. Track maintenance, manage
                    tenants,
                    and optimize your investments all in one place.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 mb-12">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary text-center">
                            Go to Dashboard <i class="ml-2 fas fa-arrow-right"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary text-center">
                            Get Started Free
                        </a>
                        <a href="#features" class="btn-outline text-center">
                            Learn More
                        </a>
                    @endauth
                </div>

                <div class="flex items-center gap-8">
                    <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">500+</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Properties Managed</div>
                    </div>
                    <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">98%</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Client Satisfaction</div>
                    </div>
                    <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">24/7</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Support</div>
                    </div>
                </div>
            </div>

            <!-- Card -->
            <div class="lg:w-1/2 relative" data-aos="fade-left" data-aos-delay="300">
                <div class="property-card bg-white dark:bg-gray-800 rounded-2xl p-6 max-w-md mx-auto floating">
                    <div class="mb-4">
                        <div class="relative rounded-xl overflow-hidden mb-4">
                            <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                                alt="Luxury Apartment Complex" class="w-full h-48 object-cover">
                            <div
                                class="absolute top-4 right-4 bg-white dark:bg-gray-800 px-3 py-1 rounded-full shadow-md">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">95% Occupied</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-bold text-xl">Luxury Apartment Complex</h3>
                                <p class="text-gray-600 dark:text-gray-400 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2 text-indigo-500"></i>
                                    Downtown District
                                </p>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                <span class="font-medium">4.8</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="font-bold text-lg">24</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Units</div>
                        </div>
                        <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="font-bold text-lg">22</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Occupied</div>
                        </div>
                        <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="font-bold text-lg">2</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Vacant</div>
                        </div>
                        <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="font-bold text-lg">3</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Maintenance</div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Monthly Revenue</div>
                            <div class="font-bold text-lg">$42,500</div>
                        </div>
                        <button class="btn-primary">
                            View Details
                        </button>
                    </div>
                </div>

                <!-- Floating elements for visual interest -->
                <div
                    class="absolute -top-4 -left-4 w-20 h-20 bg-indigo-100 dark:bg-indigo-900 rounded-full opacity-50 z-0">
                </div>
                <div
                    class="absolute -bottom-6 -right-6 w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-full opacity-50 z-0">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-gray-100 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl lg:text-4xl font-bold mb-4" data-aos="fade-up">Everything You Need to Manage
                Properties</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 mb-12 max-w-2xl mx-auto" data-aos="fade-up"
                data-aos-delay="100">
                Our platform provides all the tools you need to efficiently manage your property.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow hover:shadow-lg transition"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon bg-gradient-to-r from-indigo-500 to-purple-500 mx-auto">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Tenant Management</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Manage tenant information, lease agreements, and communication in one place.
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow hover:shadow-lg transition"
                    data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon bg-gradient-to-r from-green-400 to-blue-500 mx-auto">
                        <i class="fas fa-tools text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Maintenance Tracking</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Streamline maintenance requests and track repair status easily.
                    </p>
                </div>
                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow hover:shadow-lg transition"
                    data-aos="fade-up" data-aos-delay="700">
                    <div class="feature-icon bg-gradient-to-r from-teal-400 to-cyan-500 mx-auto">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Secure Data</h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Your data is protected with enterprise-grade security and regular backups.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl lg:text-4xl font-bold mb-4 text-center" data-aos="fade-up">What Our Clients Say</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 mb-12 max-w-2xl mx-auto text-center" data-aos="fade-up"
                data-aos-delay="100">
                Hear from property managers who have transformed their business with our platform.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold mr-4">
                            SJ
                        </div>
                        <div>
                            <h4 class="font-bold">Sarah Johnson</h4>
                            <p class="text-sm text-gray-500">Property Manager, Urban Living</p>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">
                        "This platform has cut our administrative work by 60%. The maintenance tracking feature alone
                        has saved us countless hours each week."
                    </p>
                    <div class="flex mt-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                </div>

                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 rounded-full bg-gradient-to-r from-green-400 to-blue-500 flex items-center justify-center text-white font-bold mr-4">
                            MR
                        </div>
                        <div>
                            <h4 class="font-bold">Michael Roberts</h4>
                            <p class="text-sm text-gray-500">Real Estate Investor</p>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">
                        "As someone with multiple properties across the city, having a centralized dashboard has been a
                        game-changer for tracking performance."
                    </p>
                    <div class="flex mt-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                </div>

                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 rounded-full bg-gradient-to-r from-pink-500 to-rose-500 flex items-center justify-center text-white font-bold mr-4">
                            ED
                        </div>
                        <div>
                            <h4 class="font-bold">Emily Davis</h4>
                            <p class="text-sm text-gray-500">Property Owner</p>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">
                        "The financial reporting features have given me insights I never had before. I can now make
                        data-driven decisions about my properties."
                    </p>
                    <div class="flex mt-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="py-12 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div
                            class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center">
                            <i class="fas fa-home text-white"></i>
                        </div>
                        <span class="text-xl font-bold">PropertyPro</span>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Simplifying property management for landlords and property managers worldwide.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-500 hover:text-indigo-600 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600 transition">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-lg mb-4">Product</h3>
                    <ul class="space-y-2">
                        <li><a href="#"
                                class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 transition">Features</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 transition">Pricing</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 transition">Integrations</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 transition">Updates</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-lg mb-4">Resources</h3>
                    <ul class="space-y-2">
                        <li><a href="#"
                                class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 transition">Blog</a></li>
                        <li><a href="#"
                                class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 transition">Documentation</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 transition">Community</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 transition">Support</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-lg mb-4">Company</h3>
                    <ul class="space-y-2">
                        <li><a href="#"
                                class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 transition">About</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 transition">Careers</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 transition">Contact</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 transition">Partners</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div
                class="pt-8 border-t border-gray-200 dark:border-gray-700 flex flex-col md:flex-row justify-between items-center">
                <div class="text-sm text-gray-500 dark:text-gray-400 mb-4 md:mb-0">
                    © 2025 PropertyPro. All rights reserved.
                </div>
                <div class="flex space-x-6 text-sm text-gray-500 dark:text-gray-400">
                    <a href="#" class="hover:text-indigo-600 transition">Privacy Policy</a>
                    <a href="#" class="hover:text-indigo-600 transition">Terms of Service</a>
                    <a href="#" class="hover:text-indigo-600 transition">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // Initialize AOS (Animate On Scroll)
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 100
            });

            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });

                        // Close mobile menu if open
                        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                            mobileMenu.classList.add('hidden');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
