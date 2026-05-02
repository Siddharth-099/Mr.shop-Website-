<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Man Store</title>
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
            align-items: center;
            padding: 40px 20px;
        }

        .container {
            max-width: 900px;
            width: 100%;
            background-color: #ffffff;
            border: 2px solid #ddd;
            padding: 40px;
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

        h2 {
            color: #c2185b;
            font-weight: 600;
            margin-top: 30px;
            border-bottom: 2px solid #f8bbd0;
            padding-bottom: 5px;
        }

        p {
            line-height: 1.7;
            color: #555;
        }

        ul {
            padding-left: 20px;
            color: #555;
        }

        ul li {
            margin-bottom: 8px;
            line-height: 1.6;
        }
        
        .highlight {
            font-weight: bold;
            background: linear-gradient(45deg, #2ecc71, #2980b9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: none;
        }

        /* Back link button styling */
        .back-link {
            display: inline-block;
            background: linear-gradient(90deg, #2196f3, #1976d2);
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            margin-top: 40px;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .back-link:hover {
            background: linear-gradient(90deg, #1e88e5, #1565c0);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        /* Footer */
        .footer {
            background: linear-gradient(90deg, #4527a0, #b71c1c);
            color: white;
            text-align: center;
            padding: 20px;
            font-family: 'Poppins', sans-serif;
            margin-top: auto; /* Push footer to the bottom */
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
            <h1>About Us - Man Store</h1>

            <h2>1. Who We Are</h2>
            <p>Man Store is your go-to destination for trendy fashion, electronics, and lifestyle products. Established in 2025, we strive to provide a seamless shopping experience for every customer.</p>

            <h2>2. Our Vision</h2>
            <p>To become India's most trusted and customer-centric online shopping platform. 🌟</p>

            <h2>3. Our Mission</h2>
            <p>We aim to deliver top-quality products at affordable prices with fast delivery and exceptional customer service. 🚀</p>

            <h2>4. What We Offer</h2>
            <p>From <span class="highlight">clothing, cosmetics, accessories</span> to <span class="highlight">electronics, home essentials</span> – we have it all under one roof. 📦</p>

            <h2>5. Why Choose Us?</h2>
            <ul>
                <li>✔️ Secure payment methods 🔒</li>
                <li>✔️ Easy returns ↩️</li>
                <li>✔️ 24/7 customer support 📞</li>
                <li>✔️ Exclusive discounts 💰</li>
            </ul>

            <h2>6. Our Values</h2>
            <p>We believe in **transparency**, **innovation**, and putting our customers first. Your satisfaction is our top priority. ❤️</p>

            <h2>7. Customer Testimonials</h2>
            <p><em>"Fast delivery and great product quality. I highly recommend Man Store!"</em> – Priya R.</p>
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