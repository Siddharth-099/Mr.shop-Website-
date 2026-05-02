<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services - Man Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* General Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e8eaf6, #c5cae9);
            color: #333;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(90deg, #4527a0, #b71c1c);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar .logo .logo-img {
            height: 40px;
            width: auto;
            transition: transform 0.3s ease;
        }

        .navbar .logo .logo-img:hover {
            transform: scale(1.1) rotate(-5deg);
        }

        .navbar .nav-links {
            display: flex;
            align-items: center;
        }

        .navbar .nav-links a {
            color: #fff;
            text-decoration: none;
            margin-left: 25px;
            font-size: 16px;
            font-weight: 500;
            transition: color 0.3s ease, transform 0.3s ease;
            position: relative;
            padding: 5px 0;
        }

        .navbar .nav-links a:hover {
            color: #f44336;
            transform: translateY(-2px);
        }

        .navbar .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #f44336;
            transition: width 0.3s ease;
        }

        .navbar .nav-links a:hover::after {
            width: 100%;
        }

        /* Main Content */
        .content-container {
            flex: 1;
            display: flex;
            justify-content: center;
            padding: 40px 20px;
        }

        .container {
            max-width: 1100px;
            width: 100%;
            padding: 40px;
            background-color: #ffffff;
            border: 2px solid #ddd;
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
            animation: slideInUp 0.8s ease-out forwards;
        }

        h1 {
            color: #4527a0;
            text-align: center;
            font-weight: 700;
            margin-bottom: 30px;
            font-size: 48px;
        }
        
        .subheading {
            text-align: center;
            color: #555;
            font-size: 16px;
            margin-top: -20px;
            margin-bottom: 40px;
        }

        h2 {
            color: #c2185b;
            margin-top: 30px;
            font-weight: 600;
            border-bottom: 2px solid #f8bbd0;
            padding-bottom: 5px;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .service-card {
            background-color: #fce4ec;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #f8bbd0;
            animation: fadeIn 1s ease-out;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .service-card i {
            font-size: 40px;
            margin-bottom: 15px;
            color: #f44336;
        }
        
        .service-card h2 {
            color: #c2185b;
            border: none;
            text-shadow: none;
        }
        
        .service-card p {
            color: #555;
        }

        /* Footer */
        .footer {
            background: linear-gradient(90deg, #4527a0, #b71c1c);
            color: white;
            text-align: center;
            padding: 20px;
            font-family: 'Poppins', sans-serif;
            margin-top: auto;
        }

        .footer p {
            margin: 0;
            font-size: 14px;
            color: white;
        }

        .footer-links {
            margin-top: 10px;
        }

        .footer-links a {
            color: #fff;
            margin: 0 15px;
            text-decoration: none;
            transition: color 0.3s ease, transform 0.3s ease;
            font-weight: 500;
        }

        .footer-links a:hover {
            color: #f44336;
            text-decoration: underline;
            transform: translateY(-2px);
        }

        /* CSS Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
            }
            .navbar .nav-links {
                margin-top: 10px;
                flex-wrap: wrap;
                justify-content: center;
            }
            .navbar .nav-links a {
                margin: 5px 10px;
            }
            .container {
                width: 95%;
                padding: 25px;
            }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="products.php" class="logo">
            <img src="l1.jpg" alt="Man Store Logo" class="logo-img">
        </a>
        <div class="nav-links">
            <a href="products.php">🛍️ Products</a>
            <a href="about.php">👥 About Us</a>
            <a href="contact.php">📞 Contact</a>
        </div>
    </div>

    <div class="content-container">
        <div class="container">
            <h1>Our Services</h1>
            <p class="subheading">Everything you need to make shopping easier at Man Store</p>

            <section class="services-grid">
                <div class="service-card">
                    <i class="fas fa-truck"></i>
                    <h2>Fast Delivery</h2>
                    <p>Quick and reliable shipping to your doorstep, anywhere in the country.</p>
                </div>

                <div class="service-card">
                    <i class="fas fa-headset"></i>
                    <h2>24/7 Support</h2>
                    <p>Our support team is here to help you anytime, day or night.</p>
                </div>

                <div class="service-card">
                    <i class="fas fa-undo"></i>
                    <h2>Easy Returns</h2>
                    <p>Not happy with your purchase? Enjoy hassle-free returns and exchanges.</p>
                </div>

                <div class="service-card">
                    <i class="fas fa-lock"></i>
                    <h2>Secure Payments</h2>
                    <p>Your payment information is protected with top-level encryption.</p>
                </div>

                <div class="service-card">
                    <i class="fas fa-tags"></i>
                    <h2>Best Deals</h2>
                    <p>Regular offers, flash sales, and seasonal discounts just for you.</p>
                </div>

                <div class="service-card">
                    <i class="fas fa-box-open"></i>
                    <h2>Wide Product Range</h2>
                    <p>From electronics to fashion, shop across all categories in one place.</p>
                </div>
            </section>
        </div>
    </div>

    <footer class="footer">
        <p>© 2025 Man Store. All rights reserved.</p>
        <div class="footer-links">
            <a href="privacy.php">Privacy Policy</a>
            <a href="service.php">Terms of Service</a>
            <a href="contact.php">Contact Us</a>
        </div>
    </footer>

</body>
</html>