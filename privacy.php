<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Man Store</title>
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

        /* Privacy Policy container styling */
        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
            text-align: left;
            animation: slideInUp 0.8s ease-out forwards;
        }

        h1 {
            text-align: center;
            color: #4527a0;
            margin-bottom: 30px;
            font-weight: 700;
        }

        h2 {
            color: #c2185b;
            margin-top: 30px;
            font-weight: 600;
            border-bottom: 2px solid #f8bbd0;
            padding-bottom: 5px;
        }

        p {
            line-height: 1.8;
            font-size: 16px;
            color: #555;
        }

        strong {
            color: #4527a0;
        }

        ul {
            padding-left: 20px;
            color: #555;
        }

        ul li {
            margin-bottom: 8px;
            line-height: 1.6;
        }

        /* Back button styling */
        .back-link {
            display: inline-block;
            background: linear-gradient(90deg, #2196f3, #1976d2);
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            margin-top: 30px;
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
            <h1>Privacy Policy</h1>
            <p><strong>Last Updated: September 16, 2025</strong></p>

            <h2>1. Introduction</h2>
            <p>Our website, Man Store, is committed to protecting your privacy. This Privacy Policy explains how we collect, use, and protect your information when you visit our website. By using this website, you agree to the collection and use of data described in this policy.</p>

            <h2>2. Information We Collect</h2>
            <p>We collect various types of information to provide you with the best services:</p>
            <ul>
                <li><strong>Personal Information:</strong> When you make a purchase or register, we collect information such as your name, email address, shipping address, and telephone number.</li>
                <li><strong>Payment Data:</strong> Payment details (such as credit card number) required to complete a purchase are processed securely through payment gateways. We do not directly store your payment data.</li>
                <li><strong>Usage Data:</strong> We may collect information about your browser, device, and the pages you have visited on the website.</li>
            </ul>

            <h2>3. How We Use Your Information</h2>
            <p>We use your information for the following purposes:</p>
            <ul>
                <li>To process orders and deliver products.</li>
                <li>To personalize your experience.</li>
                <li>To ensure secure transactions.</li>
                <li>To send you updates about our products, promotions, and news (if you have consented to this).</li>
                <li>To improve our website and services.</li>
            </ul>

            <h2>4. Sharing of Information</h2>
            <p>We do not sell or rent your personal information. However, we may share your data with trusted service providers who help us provide services such as payment processing and delivery. These service providers use your information solely to provide those services.</p>

            <h2>5. Your Rights</h2>
            <p>You have the right to access, update, or delete your personal information. For this, you can contact us.</p>

            <h2>6. Security</h2>
            <p>We implement appropriate technical and organizational security measures to protect your data from unauthorized access or disclosure.</p>

            <h2>7. Contact</h2>
            <p>If you have any questions about this privacy policy, please contact us at: <strong>Mr.store@gmail.com</strong>.</p>
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