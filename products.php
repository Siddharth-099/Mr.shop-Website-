<?php
// 🚨 START: Enable Error Reporting (For Debugging) 🚨
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// Include the database connection file
// NOTE: Make sure your db.php file successfully sets the $conn variable.
include 'db.php';

// 👇 DATABASE CONNECTION CHECK ADDED/IMPROVED
if (!isset($conn) || $conn === false || $conn->connect_error) {
    die("FATAL ERROR: Database connection failed. Please check db.php and credentials.");
}
// ----------------------------------------------

// --- Cart Item Count ---
// Count the total number of items in the cart for the notification badge
$cart_count = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['quantity'];
    }
}

// --- Category Data ---
// Manually map categories to emojis for visual appeal (can be extended)
$category_emojis = [
    'Watches' => '⌚',
    'Shoes' => '👟',
    'Wallets' => '👛',
    'Cap' => '🧢',
    'Perfume' => '🧴',
    'Shirt' => '👕',
];

// Dynamically fetch all unique categories from the products table for the category bar
$categories_from_db = [];
// Using prepared statement for robustness, although simple query
$sql_cats = "SELECT DISTINCT category FROM products ORDER BY category ASC";
$result_cats = $conn->query($sql_cats);

if ($result_cats && $result_cats->num_rows > 0) {
    while ($row = $result_cats->fetch_assoc()) {
        // Only include non-empty categories
        if (!empty(trim($row['category']))) {
            $categories_from_db[] = trim($row['category']);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Man Store - Products</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <style>
        /* General Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e8eaf6, #c5cae9); /* Light Indigo Background */
            color: #333;
            padding: 0;
            line-height: 1.6;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(90deg, #4527a0, #b71c1c); /* Deep Indigo to Bright Red */
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar .logo .logo-img {
            height: 40px;
            width: auto;
            transition: transform 0.3s ease;
        }

        .navbar .logo .logo-img:hover {
            transform: scale(1.1) rotate(-5deg);
        }

        .navbar .search-box {
            flex: 1;
            display: flex;
            margin: 0 20px;
            align-items: center;
        }

        .navbar .search-box input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #fff;
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            outline: none;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .navbar .search-box input[type="text"]::placeholder {
            color: rgba(255, 255, 255, 0.8);
        }

        .navbar .search-box input[type="text"]:focus {
            background-color: rgba(255, 255, 255, 0.4);
            border-color: #f44336; /* Coral */
        }

        .navbar .search-box button {
            padding: 12px 20px;
            background-color: #f44336; /* Coral */
            border: none;
            cursor: pointer;
            margin-left: 10px;
            color: #fff; /* White text for contrast */
            font-weight: 700;
            border-radius: 25px;
            transition: all 0.3s ease;
            box-shadow: 0 0 5px #f44336;
            font-size: 16px;
        }

        .navbar .search-box button:hover {
            background-color: #d32f2f; /* Darker Red */
            box-shadow: 0 0 15px #d32f2f;
            transform: scale(1.05);
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
            color: #f44336; /* Coral */
            transform: translateY(-2px);
        }

        .navbar .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #f44336; /* Coral */
            transition: width 0.3s ease;
        }

        .navbar .nav-links a:hover::after {
            width: 100%;
        }

        .cart-badge {
            background-color: #ff8f00; /* Amber */
            color: white;
            padding: 4px 8px;
            border-radius: 50%;
            font-size: 12px;
            vertical-align: super;
            margin-left: 4px;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        /* New: Welcome Message Styling */
        .navbar .welcome-message {
            color: #fff;
            font-weight: 600;
            font-size: 16px;
            padding: 0 20px;
            white-space: nowrap;
        }


        /* Category Icons Bar */
        .category-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            padding: 20px 10px;
            background-color: #fff; /* White background */
            border-bottom: 2px solid #e0e0e0; /* Light grey border */
            overflow-x: auto;
            white-space: nowrap;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .category-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 25px;
            background-color: #fce4ec; /* Light Pink */
            border: 1px solid #f8bbd0; /* Lighter Pink Border */
            border-radius: 50px;
            text-decoration: none;
            color: #c2185b; /* Deep Pink */
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .category-item:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            background-color: #f48fb1; /* Brighter Pink */
            color: #fff;
        }

        .category-item.active {
            background: linear-gradient(45deg, #4527a0, #f44336); /* Indigo to Coral */
            color: #fff;
            border-color: #4527a0;
            box-shadow: 0 4px 10px rgba(69, 39, 160, 0.4);
            animation: highlight 0.5s ease-out forwards;
        }

        .category-item.active:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 15px rgba(69, 39, 160, 0.6);
            background: linear-gradient(45deg, #301e62, #d32f2f); /* Darker Indigo to Darker Red */
        }

        @keyframes highlight {
            from {
                transform: scale(1);
            }
            to {
                transform: scale(1.02);
            }
        }

        /* Heading Animation */
        .wavy-heading {
            font-size: 38px;
            text-align: center;
            color: #4527a0; /* Deep Indigo */
            padding: 40px 0 20px;
            letter-spacing: 2px;
            font-weight: 700;
            animation: fadeIn 1.5s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Products Grid */
        .products-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: stretch;
            padding: 20px;
            gap: 30px;
        }

        /* Product Card */
        .product-card {
            background: #ffffff;
            border-radius: 15px;
            overflow: hidden;
            width: 300px;
            height: auto;
            min-height: 450px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            text-align: center;
            border: 1px solid #dcdcdc;
            padding: 20px;
            position: relative;
            animation: popIn 0.5s ease-out forwards;
            opacity: 0;
            transform: scale(0.9);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        @keyframes popIn {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .products-grid .product-card:nth-child(1) { animation-delay: 0.1s; }
        .products-grid .product-card:nth-child(2) { animation-delay: 0.2s; }
        .products-grid .product-card:nth-child(3) { animation-delay: 0.3s; }
        .products-grid .product-card:nth-child(4) { animation-delay: 0.4s; }
        .products-grid .product-card:nth-child(5) { animation-delay: 0.5s; }
        .products-grid .product-card:nth-child(6) { animation-delay: 0.6s; }
        .products-grid .product-card:nth-child(7) { animation-delay: 0.7s; }
        .products-grid .product-card:nth-child(8) { animation-delay: 0.8s; }

        .product-card:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3), 0 0 25px #f44336; /* Coral shadow */
        }

        .product-card img {
            max-width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .product-card img:hover {
            transform: scale(1.02);
        }

        .product-card h2 {
            font-size: 22px;
            font-weight: 600;
            padding: 5px 0;
            color: #333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 5px;
        }
        
        .product-card p {
            font-size: 16px;
            padding: 5px 0;
            color: #555;
            margin-bottom: 5px;
        }

        .product-card strong {
            color: #4527a0; /* Deep Indigo */
        }

        .price-container {
            display: flex;
            justify-content: center;
            align-items: baseline;
            gap: 10px;
            margin: 10px 0;
        }

        .original-price-label {
            color: #888;
            font-size: 14px;
        }

        .original-price-value {
            color: #888;
            text-decoration: line-through;
            font-size: 14px;
        }

        .discounted-price {
            color: #f44336; /* Coral */
            font-size: 18px;
            font-weight: 700;
        }

        .discount-badge {
            background-color: #f44336; /* Coral */
            color: #fff;
            padding: 5px 10px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            position: absolute;
            top: 15px;
            right: 15px;
            transform: rotate(-10deg);
        }

        .product-card form {
            margin-top: auto;
        }

        .product-card label {
            font-size: 14px;
            color: #555;
            display: block;
            margin-top: 10px;
        }

        .product-card input[type="number"] {
            width: 80px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 8px;
            font-family: 'Poppins', sans-serif;
            margin-top: 5px;
            font-size: 14px;
        }

        .product-card button[type="submit"] {
            background: linear-gradient(90deg, #2196f3, #1976d2); /* Blue gradient */
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            margin-top: 15px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            letter-spacing: 1px;
        }

        .product-card button[type="submit"]:hover {
            background: linear-gradient(90deg, #1e88e5, #1565c0); /* Darker Blue */
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 6px 15px rgba(0,0,0,0.3);
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(90deg, #4527a0, #b71c1c); /* Deep Indigo to Bright Red */
            color: white;
            text-align: center;
            padding: 20px;
            font-family: 'Poppins', sans-serif;
            margin-top: 40px;
        }

        .footer p {
            margin: 0;
            font-size: 14px;
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
            color: #f44336; /* Coral */
            text-decoration: underline;
            transform: translateY(-2px);
        }
        
        /* Responsive design for smaller screens */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 15px;
            }

            .navbar .search-box {
                margin: 10px 0;
            }

            .navbar .nav-links {
                margin-top: 10px;
                flex-wrap: wrap;
                justify-content: center;
            }

            .navbar .nav-links a {
                margin: 5px 10px;
            }

            .category-bar {
                justify-content: flex-start;
            }
            
            .wavy-heading {
                font-size: 28px;
            }

            .products-grid {
                gap: 20px;
            }

            .product-card {
                width: 100%;
                max-width: 350px;
            }
            .navbar .welcome-message {
                margin-top: 10px;
                padding: 0 10px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="products.php" class="logo">
        <img src="l1.jpg" alt="Your Shop Logo" class="logo-img">
    </a>
    <div class="search-box">
        <form method="GET" action="" style="display: flex; width: 100%;">
            <input type="text" name="search" placeholder="Search products..."
                value="<?php if (isset($_GET['search'])) echo htmlspecialchars($_GET['search']); ?>">
            <button type="submit">🔍</button>
        </form>
    </div>

    <?php if (isset($_SESSION['username'])): ?>
        <span class="welcome-message">Hii, Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></span>
    <?php endif; ?>

    <div class="nav-links">
        <a href="cart.php">🛒 Cart <span class="cart-badge"><?php echo $cart_count; ?></span></a>
        <a href="logout.php">🔓 Logout</a>
    </div>
</div>

<div class="category-bar">
    <a href="products.php" class="category-item <?php if (empty($_GET['category'])) echo 'active'; ?>">
        <span class="emoji">🛍️</span> All
    </a>
    <a href="?category=sale" class="category-item <?php if (isset($_GET['category']) && strtolower($_GET['category']) == 'sale') echo 'active'; ?>">
        <span class="emoji">🔥</span> Sale
    </a>
    <?php
    // Loop through categories from the database to create dynamic links
    foreach ($categories_from_db as $cat) {
        $selected = (isset($_GET['category']) && strtolower($_GET['category']) == strtolower($cat)) ? "active" : "";
        $emoji = isset($category_emojis[$cat]) ? $category_emojis[$cat] : '📦'; // Use default emoji if not found
        echo "<a href='?category=" . urlencode($cat) . "' class='category-item " . $selected . "'>";
        echo "<span class='emoji'>" . $emoji . "</span> " . htmlspecialchars($cat) . "</a>";
    }
    ?>
</div>

<h1 class="wavy-heading">Our Products</h1>

<div class="products-grid">
<?php
// --- Product Fetching Logic (UPDATED TO USE PREPARED STATEMENTS) ---
$products_to_display = [];
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';

$sql_base = "SELECT id, name, price, discount_percentage, image, category, max_quantity FROM products";
$where_clauses = [];
$param_types = '';
$param_values = [];
$order_limit = " ORDER BY id DESC LIMIT 8"; // Default to show latest 8, avoiding slow ORDER BY RAND()

// 1. Handle Search Input
if (!empty($search)) {
    // Add WHERE clause for searching by product name
    $where_clauses[] = "LOWER(TRIM(name)) LIKE ?";
    $param_types .= 's';
    // Must bind the variable with wildcards
    $param_values[] = '%' . strtolower($search) . '%';
    $order_limit = " ORDER BY id DESC"; // Remove limit for search results
}

// 2. Handle Category Filter
if (strtolower($category) === 'sale') {
    // Filter for products with a discount of 70% or more
    $where_clauses[] = "discount_percentage >= 70";
    $order_limit = " ORDER BY discount_percentage DESC";
} else if (!empty($category)) {
    // Filter by a specific category
    $where_clauses[] = "LOWER(TRIM(category)) = LOWER(TRIM(?))";
    $param_types .= 's';
    $param_values[] = $category;
    $order_limit = " ORDER BY id DESC";
}

// Construct the final SQL query
if (!empty($where_clauses)) {
    $sql_base .= " WHERE " . implode(" AND ", $where_clauses);
}
$sql = $sql_base . $order_limit;

// Prepare the statement
if ($stmt = $conn->prepare($sql)) {
    // Bind parameters if they exist
    if (!empty($param_values)) {
        // Use call_user_func_array to handle dynamic binding of parameters
        $stmt->bind_param($param_types, ...$param_values);
    }

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch and store results
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products_to_display[] = $row;
        }
    }
    // Close the statement
    $stmt->close();
} else {
    // Handle prepare error
    echo "<p style='text-align:center; color: red;'>Database query preparation failed: " . htmlspecialchars($conn->error) . "</p>";
}

// --- Product Display Loop ---
if (!empty($products_to_display)) {
    foreach ($products_to_display as $row) {
        // Set a default max_quantity if it's not set in the database
        $max_qty = isset($row['max_quantity']) ? $row['max_quantity'] : 10;
        $discount = isset($row['discount_percentage']) ? $row['discount_percentage'] : 0;
        $original_price = $row['price'];
        $discounted_price = $original_price;

        if ($discount > 0) {
            $discounted_price = $original_price - ($original_price * ($discount / 100));
        }

        echo "<div class='product-card'>";
        // Show discount badge if there's a discount
        if ($discount > 0) {
            echo "<span class='discount-badge'>-" . htmlspecialchars($discount) . "%</span>";
        }
        
        // ઈમેજ પાથ (સુરક્ષિત રીતે પ્રદર્શિત)
        echo "<img src='" . htmlspecialchars($row['image']) . "' alt='Product Image'>";
        
        echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
        
        echo "<div class='price-container'>";
        if ($discount > 0) {
            echo "<span class='original-price-label'>MRP: </span><span class='original-price-value'>₹" . number_format($original_price, 2) . "</span>";
            echo "<span class='discounted-price'>₹" . number_format($discounted_price, 2) . "</span>";
        } else {
            echo "<p><strong>MRP:</strong> ₹" . number_format($original_price, 2) . "</p>";
        }
        echo "</div>";

        // 2. ✨ UPDATED: Removed method/action and added class for AJAX targeting
        echo "<form class='add-to-cart-form'>"; 
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<input type='hidden' name='name' value='" . htmlspecialchars($row['name']) . "'>";
        echo "<input type='hidden' name='price' value='" . $discounted_price . "'>";
        
        // કાર્ટમાં પણ સાચો ઈમેજ પાથ મોકલો
        echo "<input type='hidden' name='image' value='" . htmlspecialchars($row['image']) . "'>";
        
        // Pass the current page URL with its query parameters as a hidden field
        echo "<input type='hidden' name='redirect_url' value='" . htmlspecialchars($_SERVER['REQUEST_URI']) . "'>";
        
        echo "<label for='qty_" . $row['id'] . "'>Quantity:</label>";
        // Add the max attribute based on the database value
        echo "<input type='number' id='qty_" . $row['id'] . "' name='quantity' value='1' min='1' max='" . htmlspecialchars($max_qty) . "' required><br>";
        echo "<button type='submit'>Add to Cart</button>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "<p style='text-align:center; padding: 20px; font-size: 18px;'>No products found matching your criteria. 😟</p>";
}
// Close the database connection
$conn->close();
?>
</div>

<footer class="footer">
    <p>© <?php echo date("Y"); ?> Man Store. All rights reserved.</p>
    <div class="footer-links">
        <a href="privacy.php">Privacy Policy</a>
        <a href="service.php">Terms of Service</a>
        <a href="contact.php">Contact Us</a> 
        <a href="about.php">👤About Us</a> </div>
</footer>

<script>
$(document).ready(function() {
    // 'add-to-cart-form' ક્લાસ ધરાવતા તમામ ફોર્મ માટે સબમિટ ઇવેન્ટ પકડો
    $(".add-to-cart-form").submit(function(e) {
        e.preventDefault(); // 🛑 ફોર્મ સબમિટ થતું અને પેજ રિફ્રેશ થતું અટકાવો

        const form = $(this);
        const submitButton = form.find('button[type="submit"]');

        // બટનને Disable કરો અને Loading મેસેજ આપો
        submitButton.prop('disabled', true).text('Adding... ⏳');

        // AJAX વિનંતી શરૂ કરો
        $.ajax({
            type: "POST", 
            url: "add_to_cart.php", // આ ફાઇલ પર વિનંતી મોકલો
            data: form.serialize(), // ફોર્મનો તમામ ડેટા (product_id, quantity, વગેરે) લો
            
            success: function(response) {
                // કાર્ટ કાઉન્ટ અપડેટ કરવા માટે વર્તમાન સંખ્યા અને ઉમેરેલી સંખ્યા લો
                let currentCount = parseInt($('.cart-badge').text());
                let quantityAdded = parseInt(form.find('input[name="quantity"]').val());
                
                // 🛒 કાર્ટ બેજ પર નવી સંખ્યા સેટ કરો
                $('.cart-badge').text(currentCount + quantityAdded); 

                // બટન પર સફળતાનો સંદેશ બતાવો
                submitButton.text('Added! ✔️');

                // 2 સેકન્ડ પછી બટનને મૂળ સ્થિતિમાં પાછું લાવો
                setTimeout(function() {
                    submitButton.prop('disabled', false).text('Add to Cart');
                }, 2000);
            },
            
            error: function(xhr, status, error) {
                // ભૂલ આવે તો યુઝરને જાણ કરો અને બટન ફરીથી સક્ષમ કરો
                alert("Error adding item to cart. Please check console for details.");
                console.error("AJAX Error:", status, error, xhr.responseText);
                submitButton.prop('disabled', false).text('Error! ❌ Try Again');
            }
        });
    });
});
</script>

</body>
</html>