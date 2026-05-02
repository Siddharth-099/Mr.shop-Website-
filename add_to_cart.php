<?php
session_start();

// --- Authentication Check ---
// If the user is NOT logged in, redirect them to the login page.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Store the current page URL to redirect back after login.
    $_SESSION['redirect_url'] = $_SERVER['HTTP_REFERER'] ?? 'products.php';
    header("Location: login.php");
    exit; // Stop script execution
}

// Check if the request method is POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve product details from the POST data.
    $product_id = $_POST['product_id'] ?? null;
    $name = $_POST['name'] ?? 'Unknown Product';
    $price = $_POST['price'] ?? 0.00;
    $quantity = $_POST['quantity'] ?? 1;
    
    // Get the image URL. Use a placeholder if it's missing.
    $image = $_POST['image'] ?? "https://placehold.co/100x100/A0E7E5/000000?text=Product";

    // Validate essential data
    if ($product_id === null) {
        header("Location: products.php?status=error&message=Product ID is missing.");
        exit;
    }
    
    // Convert price and quantity to correct types
    $price = (float)$price;
    $quantity = (int)$quantity;

    // Initialize cart session if it doesn't exist.
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // --- NEW LOGIC START ---
    // Check if the product is already in the cart using its ID as the key.
    if (isset($_SESSION['cart'][$product_id])) {
        // If product exists, just update its quantity.
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        // If the product is not in the cart, add it as a new item.
        $_SESSION['cart'][$product_id] = [
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'quantity' => $quantity
        ];
    }
    // --- NEW LOGIC END ---
}

// --- Redirect Back ---
$redirect_back_url = $_SERVER['HTTP_REFERER'] ?? 'products.php';
header("Location: " . $redirect_back_url);
exit;
?>