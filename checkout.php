<?php
session_start();
include 'db.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// $error ને શરૂઆતમાં ખાલી સ્ટ્રિંગ તરીકે સેટ કરવામાં આવે છે.
$success = false;
$error = '';
$totalAmount = 0;

// Calculate total from cart
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
foreach ($cart as $item) {
    // ખાતરી કરો કે price અને quantity સેટ છે અને ન્યૂમેરિક છે
    $price = isset($item['price']) ? (float)$item['price'] : 0;
    $quantity = isset($item['quantity']) ? (int)$item['quantity'] : 0;
    $totalAmount += $price * $quantity;
}

// Handle form submit (આ બ્લોક માત્ર ત્યારે જ એક્ઝિક્યુટ થશે જ્યારે ફોર્મ સબમિટ થશે)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_method = isset($_POST['payment_method']) ? trim($_POST['payment_method']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $contact_number = isset($_POST['contact_number']) ? trim($_POST['contact_number']) : '';

    if (!empty($payment_method) && !empty($address) && !empty($contact_number)) {
        
        // Use a transaction here for safer database operations (best practice)
        // mysqli_begin_transaction($conn); 

        $stmt = $conn->prepare("INSERT INTO payment (payment_method, amount) VALUES (?, ?)");
        $stmt->bind_param("sd", $payment_method, $totalAmount);

        if ($stmt->execute()) {
            $payment_id = $conn->insert_id;
            $order_date = date('Y-m-d H:i:s');
            $all_orders_successful = true;
            
            foreach ($cart as $item) {
                $product_name = isset($item['name']) ? $item['name'] : 'Unknown Product';
                $quantity = isset($item['quantity']) ? (int)$item['quantity'] : 0;
                $price = isset($item['price']) ? (float)$item['price'] : 0;

                $order_stmt = $conn->prepare("INSERT INTO orders (product_name, quantity, price, order_date, address, contact_number) VALUES (?, ?, ?, ?, ?, ?)");
                $order_stmt->bind_param("sidsss", $product_name, $quantity, $price, $order_date, $address, $contact_number);
                
                if (!$order_stmt->execute()) {
                    $all_orders_successful = false;
                    // Log error or break, but for simplicity, we continue
                }
            }

            if ($all_orders_successful) {
                // mysqli_commit($conn); 
                $_SESSION['cart'] = []; // Clear cart
                
                // ✅ સફળતા મળતા યુઝરને નવા પેજ પર રીડાયરેક્ટ કરો
                header("location: order_confirmed.php");
                exit;
            } else {
                // mysqli_rollback($conn); 
                $error = "Order items could not be saved to the database. Please try again.";
            }

        } else {
            $error = "Payment record error: " . $stmt->error;
        }
    } else {
        // અહીં $error સેટ થાય છે, જે માત્ર સબમિટ પછીની નિષ્ફળતા દર્શાવે છે
        $error = "Please fill in all required fields: payment method, address, and contact number.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Payment</title>
    <!-- Note: checkout.css is not provided, so I'm using inline <style> -->
    <link rel="stylesheet" href="checkout.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Global Reset */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body { 
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e3f2fd, #b3e5fc); /* Matches the cart page background */
            padding: 30px; 
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center; /* Center the container vertically and horizontally */
            min-height: 100vh;
            flex-direction: column; 
            padding-top: 0; /* Centering is handled by align-items */
        }
        
        /* ✅ લોગો સ્ટાઇલ (નાનો, કન્ટેનરની અંદર) */
        .checkout-logo {
            width: 65px; /* Nano size */
            height: auto;
            display: block;
            margin: 0 auto 10px auto; /* Center it above the h2, with some space below */
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15); 
            transition: transform 0.3s ease-in-out;
            background-color: white; /* Ensure background is clean */
            padding: 5px;
        }
        
        .checkout-logo:hover {
            transform: scale(1.05);
        }
        /* END LOGO STYLE */

        .container {
            max-width: 500px;
            /* margin: auto; <- Removed, as body flex centers it */
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        h2 {
            text-align: center;
            color: #1a237e; 
            margin-bottom: 20px;
            margin-top: 0; /* Ensure no extra space above h2 */
            font-weight: 600;
        }
        label {
            display: block;
            margin-top: 20px;
            font-weight: 600;
            color: #555;
        }
        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ccc;
            border-radius: 10px;
            margin-top: 8px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #004d40; 
            box-shadow: 0 0 8px rgba(0, 77, 64, 0.4);
            outline: none;
        }
        button {
            width: 100%;
            padding: 15px;
            margin-top: 30px;
            background: linear-gradient(90deg, #1a237e, #004d40); 
            color: white;
            font-size: 18px;
            font-weight: 600;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(26, 35, 126, 0.4); 
        }
        button:hover { 
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(26, 35, 126, 0.6);
            background: linear-gradient(90deg, #0d1252, #003a31); 
        }
        .error { 
            text-align: center; 
            font-size: 16px; 
            color: red; 
            background: #ffebeb;
            border: 1px solid #ff0000;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .total-amount {
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            color: #1a237e; 
            margin: 20px 0;
            padding: 15px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            border: 1px solid #ccc;
        }
        
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #1a237e; 
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.2s ease;
        }
        
        .back-link:hover {
            transform: scale(1.05); 
        }
        /* Responsive adjustments */
        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

<!-- Note: The large external logo tag was removed. -->

<div class="container">
    <!-- ✅ નાનો લોગો કન્ટેનરની અંદર મૂકવામાં આવ્યો છે -->
    <img src="l1.jpg" alt="Mr. Shop Logo" class="checkout-logo">
    
    <h2>Make Payment</h2>
    <p class="total-amount">Total Amount: ₹<?= number_format($totalAmount, 2) ?></p>

    <?php if ($error): // આ બ્લોક માત્ર ત્યારે જ એક્ઝિક્યુટ થશે જ્યારે $error માં કોઈ વેલ્યુ હશે ?>
        <p class="error">❌ **Error:** <?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="address">Delivery Address:</label>
        <textarea id="address" name="address" required></textarea>

        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" required>

        <label>Select Payment Method:</label>
        <select name="payment_method" required>
            <option value="">-- Select --</option>
            <option value="GPay">GPay (UPI)</option>
            <option value="cash on delivery">Cash on Delivery (COD)</option>
            <option value="Credit Card/Debit Card">Credit Card/Debit Card</option>
        </select>

        <button type="submit">Confirm Payment</button>
    </form>
    <a href="products.php" class="back-link">← Continue Shopping</a>
</div>

</body>
</html>
