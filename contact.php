<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Man Store</title>
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

        /* Contact Page Container */
        .contact-page {
            max-width: 800px;
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

        .subheading {
            text-align: center;
            color: #555;
            font-size: 16px;
            margin-top: -20px;
            margin-bottom: 40px;
        }
        
        p {
            line-height: 1.7;
            color: #555;
        }

        ul {
            list-style: none;
            padding: 0;
            margin-top: 30px;
        }

        ul li {
            margin-bottom: 20px;
            font-size: 16px;
            line-height: 1.6;
            display: flex;
            align-items: flex-start;
        }
        
        ul li i {
            margin-right: 15px;
            font-size: 24px;
            color: #f44336; /* Coral Red for icons */
        }

        .social-links {
            margin-top: 40px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
            text-align: center;
        }
        
        .social-links p {
            font-weight: 600;
            margin-bottom: 15px;
            color: #c2185b; /* Deep Pink */
        }

        .social-links a {
            text-decoration: none;
            font-size: 18px;
            margin: 0 15px;
            color: #fff;
            background: linear-gradient(90deg, #2196f3, #1976d2);
            padding: 10px 20px;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .social-links a:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            background: linear-gradient(90deg, #1e88e5, #1565c0);
        }
        
        .social-links a i {
            margin-right: 8px;
            font-size: 20px;
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
            .contact-page {
                width: 95%;
                padding: 25px;
            }
            .social-links a {
                padding: 10px 15px;
                font-size: 16px;
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
    <main class="contact-page">
        <h1>Contact Us</h1>
        <p class="subheading">Have questions or need support? We're here to help!</p>

        <section class="contact-info">
            <ul>
                <li><i class="fas fa-map-marker-alt"></i> <strong>Address:</strong> Man Store, Main Bazar, Gandhinagar-360 414</li>
                <li><i class="fas fa-phone-alt"></i> <strong>Phone:</strong> +91-9876543210</li>
                <li><i class="fas fa-envelope"></i> <strong>Email:</strong> Mr.shop@gmail.com</li>
            </ul>

            <div class="social-links">
                <p><strong>Follow Us:</strong></p>
                <a href="https://instagram.com/santosh_bengals_official" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="https://facebook.com/mrshopstore" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>
            </div>
        </section>
    </main>
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