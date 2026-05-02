<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* Keyframe animations for a smooth visual experience */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes bg-animation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Body and background styling */
        body {
            font-family: 'Poppins', sans-serif;
            /* Using the same gradient colors from the registration page */
            background: linear-gradient(135deg, #e3f2fd, #b3e5fc);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: #333; /* Darker text for better readability on a light background */
            overflow: hidden;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        /* Container for the logout message */
        .logout-container {
            background-color: #ffffff; /* White background to match the login/register box */
            padding: 50px 60px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15); /* Soft shadow from register page */
            max-width: 450px;
            width: 90%;
            animation: slideInUp 0.8s ease-out forwards;
        }

        /* Heading for the logout message */
        h2 {
            font-size: 32px; /* Consistent with the h2 from the register page */
            font-weight: 700;
            margin-bottom: 25px;
            color: #1a237e; /* Main brand color */
            text-shadow: none; /* Removing text-shadow for a cleaner look on a light background */
        }

        /* Text for redirection info */
        .redirect-info {
            font-size: 16px; /* Slightly larger for better readability */
            color: #666; /* A softer dark color */
            margin-top: 15px;
            font-weight: 400;
        }

        /* Styling for the login button */
        a.btn-login {
            display: inline-block;
            /* Using the same gradient as the registration button for consistency */
            background: linear-gradient(90deg, #1a237e, #004d40);
            color: white;
            padding: 16px 35px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            margin-top: 25px;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(26, 35, 126, 0.4);
        }

        a.btn-login:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(26, 35, 126, 0.6);
            background: linear-gradient(90deg, #0d1252, #003a31);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .logout-container {
                width: 95%;
                padding: 30px;
            }
            h2 {
                font-size: 28px;
            }
            a.btn-login {
                font-size: 16px;
                padding: 14px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <h2>You have successfully logged out 👋</h2>
        <p class="redirect-info">Redirecting to login page in 5 seconds...</p>
        <a href="login.php" class="btn-login">Login Again</a>
    </div>
</body>
</html>