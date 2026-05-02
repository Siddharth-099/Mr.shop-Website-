<?php
include 'db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $checkSql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $message = "<div class='error-message'>❌ This email is already registered. <a href='login.php'>Login here</a></div>";
    } else {
        // Insert new user
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            $message = "<div class='success-message'>✅ Registered successfully. <a href='login.php'>Login here</a></div>";
        } else {
            $message = "<div class='error-message'>❌ Error: " . $stmt->error . "</div>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="gu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr. Shop - Register</title>
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
            background: url('w1.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center; /* This centers the flex item horizontally */
            align-items: center;
            height: 100vh;
            color: #333;
            
            /* The key change to shift the box right */
            transform: translateX(-15%); /* Adjusted from 10% to 15% */
        }

        @keyframes fadeInBackground {
            from {
                background-color: #f0f0f0;
            }
            to {
                background-color: #b3e5fc;
            }
        }
        
        /* Container for the registration form */
        .register-container {
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
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 15px 20px;
            margin: 12px 0;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 16px;
            color: #333;
            background: #f8f9fa;
            transition: all 0.3s ease-in-out;
            outline: none;
            font-family: 'Poppins', sans-serif;
        }
        
        input[type="text"]::placeholder,
        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: #999;
        }

        input[type="text"]:focus,
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

        /* Message styling (success and error) */
        .success-message,
        .error-message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 12px;
            font-weight: 500;
            color: white;
            animation: fadeIn 0.5s ease-in;
            text-align: center;
            font-size: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .success-message {
            background-color: #4caf50;
            border: 1px solid #388e3c;
        }

        .error-message {
            background-color: #e57373;
            border: 1px solid #d32f2f;
        }

        /* Styling for links within messages */
        .success-message a,
        .error-message a {
            color: white;
            text-decoration: underline;
            font-weight: 600;
        }
        
        .success-message a:hover,
        .error-message a:hover {
            color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <img src="l1.jpg" alt="Mr. Shop Logo" class="logo">
        <h2>Create an Account</h2>
        
        <?php echo $message; ?>

        <form method="post">
            <input type="text" name="name" id="name" placeholder="Enter your full name" required>
            <input type="email" name="email" id="email" placeholder="Enter your email address" required>
            <input type="password" name="password" id="password" placeholder="Create a strong password" required>
            <input type="submit" value="Sign Up">
        </form>
    </div>
</body>
</html>