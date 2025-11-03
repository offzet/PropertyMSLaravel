<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <!-- AlpineJS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        /* Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            padding: 80px 0;
            text-align: center;
        }
        
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 30px;
        }
        
        .btn-primary {
            display: inline-block;
            background-color: #e74c3c;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary:hover {
            background-color: #c0392b;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        /* Features Section */
        .features {
            padding: 80px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 15px;
        }
        
        .section-title p {
            color: #7f8c8d;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .feature-card {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: #3498db;
            margin-bottom: 20px;
        }
        
        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #2c3e50;
        }
        
        /* Testimonials */
        .testimonials {
            background-color: #ecf0f1;
            padding: 80px 0;
        }
        
        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .testimonial-card {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .testimonial-text {
            font-style: italic;
            margin-bottom: 20px;
            color: #555;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
        }
        
        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #3498db;
            margin-right: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .author-info h4 {
            margin-bottom: 5px;
            color: #2c3e50;
        }
        
        .author-info p {
            color: #7f8c8d;
            font-size: 0.9rem;
        }
        
        /* Footer */
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 50px 0 20px;
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .footer-column h3 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: #3498db;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: #3498db;
        }
        
        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #34495e;
            color: #bdc3c7;
            font-size: 0.9rem;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <x-layouts.customer />

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Welcome to Your Customer Dashboard</h1>
            <p>Manage your account, browse products, and access exclusive customer services all in one place.</p>
            <a href="#" class="btn-primary">Explore Features</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="section-title">
                <h2>What You Can Do</h2>
                <p>Explore all the features available to you as a valued customer</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🛒</div>
                    <h3>Browse Products</h3>
                    <p>Explore our extensive catalog of products with detailed descriptions and customer reviews.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📦</div>
                    <h3>Track Orders</h3>
                    <p>Monitor your orders in real-time with our advanced tracking system.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💳</div>
                    <h3>Manage Payments</h3>
                    <p>Securely manage your payment methods and view transaction history.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">👤</div>
                    <h3>Profile Management</h3>
                    <p>Update your personal information, preferences, and communication settings.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📞</div>
                    <h3>24/7 Support</h3>
                    <p>Get help anytime with our round-the-clock customer support service.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎁</div>
                    <h3>Exclusive Offers</h3>
                    <p>Access special discounts and promotions available only to registered customers.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <div class="section-title">
                <h2>What Our Customers Say</h2>
                <p>Hear from customers who have enjoyed our services</p>
            </div>
            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <p class="testimonial-text">"The customer portal has made managing my orders so much easier. I can track everything in real-time and the support team is always helpful!"</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">MJ</div>
                        <div class="author-info">
                            <h4>Maria Johnson</h4>
                            <p>Premium Member</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">"I love the exclusive offers available through the customer portal. It feels great to be rewarded for my loyalty to this brand."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">RS</div>
                        <div class="author-info">
                            <h4>Robert Smith</h4>
                            <p>Valued Customer</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">"The user interface is intuitive and the features are exactly what I need as a regular customer. Highly recommended!"</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">AL</div>
                        <div class="author-info">
                            <h4>Amanda Lee</h4>
                            <p>Business Client</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <h3>CustomerPortal</h3>
                    <p>Your one-stop destination for all customer needs and services.</p>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Products</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">About Us</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Support</h3>
                    <ul class="footer-links">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Shipping Info</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Contact Info</h3>
                    <ul class="footer-links">
                        <li>Email: support@customerportal.com</li>
                        <li>Phone: +1 (555) 123-4567</li>
                        <li>Address: 123 Business Ave, City, State 12345</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2023 CustomerPortal. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>