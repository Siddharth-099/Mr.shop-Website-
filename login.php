<?php
// Include database connection file
require 'db.php';

// Start session
session_start();

// Initialize error message
$error = '';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch user by email AND username
    // The change is here: added 'username' to the SELECT statement
    $stmt = $conn->prepare("SELECT id, email, password, username FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user with the provided email exists
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row["password"])) {
            // Set session variables for logged-in user
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['loggedin'] = true;
            
            // Store the username in the session after successful login
            $_SESSION['username'] = $row['username'];

            // Determine the redirection URL
            // Default to 'products.php' if no specific URL is stored.
            $redirect_url = 'products.php';
            if (isset($_SESSION['redirect_url'])) {
                $redirect_url = $_SESSION['redirect_url'];
                // Unset the session variable to prevent an infinite loop.
                unset($_SESSION['redirect_url']);
            }

            // Redirect to the determined URL.
            header("Location: " . $redirect_url);
            exit();
        } else {
            // Incorrect password
            $error = "❌ Incorrect password. Please try again.";
        }
    } else {
        // Email not found
        $error = "❌ Email not found. Please Create Account.";
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="gu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr. Shop - Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: url('lb2.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center; /* This centers the flex item horizontally */
            align-items: center;
            height: 100vh;
            color: #333;
            
            /* The key change to shift the box right */
            transform: translateX(15%); /* Adjusted from 10% to 15% */
        }
        
        /* Container for the login form */
        .login-container {
            background: #ffffff; 
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            width: 90%;
            max-width: 450px;
            text-align: center;
            animation: slideInUp 1s ease-out forwards;
            position: relative;
        }
        
        @keyframes slideInUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        h2 {
            margin-bottom: 25px;
            font-size: 32px;
            font-weight: 700;
            color: #1a237e;
        }

        .logo {
            width: 150px;
            height: auto;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        
        .logo:hover {
            transform: scale(1.05);
        }

        /* Input fields styling */
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 15px 20px;
            margin: 12px 0;
            border: 2px solid #ddd;
            border-radius: 12px;
            font-size: 16px;
            color: #333;
            background: #f7f9fc;
            transition: all 0.3s ease-in-out;
            outline: none;
            font-family: 'Poppins', sans-serif;
        }
        
        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: #999;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #00bcd4;
            box-shadow: 0 0 15px rgba(0, 188, 212, 0.25);
            background: #fff;
        }

        /* Submit button styling */
        input[type="submit"] {
            background: linear-gradient(90deg, #1a237e, #004d40);
            color: white;
            border: none;
            padding: 16px 35px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            margin-top: 25px;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 4px 15px rgba(26, 35, 126, 0.4);
            width: 100%;
            display: block;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        input[type="submit"]:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(26, 35, 126, 0.6);
            background: linear-gradient(90deg, #0d1252, #003a31);
        }

        /* Error message styling */
        .error-message {
            background-color: #ffebee;
            color: #c62828;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 12px;
            font-weight: 500;
            border: 1px solid #ef9a9a;
            animation: fadeIn 0.6s ease-in-out;
            font-size: 15px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Custom button (for Register link) styling */
        .custom-button {
            display: inline-block;
            background-color: transparent;
            color: #1a237e;
            padding: 16px 35px;
            border: 2px solid #1a237e;
            border-radius: 50px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            margin-top: 20px;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            text-decoration: none;
            width: 100%;
            box-sizing: border-box;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .custom-button:hover {
            transform: translateY(-5px);
            background-color: #1a237e;
            color: white;
            box-shadow: 0 8px 25px rgba(26, 35, 126, 0.6);
        }
        
        /* Mobile responsive adjustments */
        @media (max-width: 768px) {
            .login-container {
                width: 95%;
                padding: 35px 25px;
            }
            .logo {
                width: 120px;
            }
            input[type="email"],
            input[type="password"],
            input[type="submit"],
            .custom-button {
                font-size: 16px;
                padding: 15px 25px;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                width: 98%;
                padding: 25px 15px;
            }
            .logo {
                width: 100px;
            }
            input[type="email"],
            input[type="password"],
            input[type="submit"],
            .custom-button {
                font-size: 15px;
                padding: 13px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="l1.jpg" alt="Mr. Shop Logo" class="logo">
        <h2>Welcome Back</h2>

        <?php if ($error): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <input type="submit" value="Login">
        </form>

        <a href="register.php" class="custom-button">Create an Account</a>
    </div>
</body>
</html>
