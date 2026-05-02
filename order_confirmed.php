<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmed!</title>
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
        /* CSS Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Body and background styling */
        body {
            font-family: 'Poppins', sans-serif;
            background: url('lo2.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center; /* This centers the flex item horizontally */
            align-items: center;
            height: 100vh;
            color: #333;
            
            /* The key change to shift the box right */
            transform: translateX(15%); /* Adjusted from 10% to 15% */
        }

        /* Confirmation box styling */
        .confirmation-box {
            /* 🔴 ઓરિજિનલ ટ્રાન્સપરન્ટ સફેદ બેકગ્રાઉન્ડ */
            background-color: rgba(255, 255, 255, 0.95); 
            padding: 50px; /* ઓરિજિનલ પેડિંગ */
            border-radius: 20px;
            box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.15); /* ઓરિજિનલ પડછાયો */
            max-width: 400px; /* ઓરિજિનલ વિડ્થ */
            width: 90%; 
            text-align: center;
            animation: slideInUp 1s ease-out forwards;
            position: relative;
            
            /* ✅ ફેરફાર: બોક્સને 350px જમણી બાજુ ખસેડો */
            transform: translateX(350px); 
            transition: transform 0.3s ease-out; 
            position: relative; /* ensure transform works correctly */
        }

        /* Text styling */
        h1 {
            color: #1a237e;
            font-size: 32px;
            margin-top: 0;
            font-weight: 700;
        }

        p {
            font-size: 16px;
            color: #555;
            line-height: 1.5;
            margin-bottom: 25px; /* ઓરિજિનલ માર્જિન */
            animation: fadeIn 1s ease-in;
            animation-delay: 0.5s;
        }

        /* Button styling */
        a {
            display: inline-block;
            background: linear-gradient(90deg, #1a237e, #004d40); 
            color: white;
            padding: 15px 30px; /* ઓરિજિનલ પેડિંગ */
            border-radius: 50px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            margin-top: 10px; /* ઓરિજિનલ માર્જિન */
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(26, 35, 126, 0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
            /* width: 100%; <- ઓરિજિનલ કોડમાં આ નહોતું, મેં હટાવી દીધું છે */
        }

        a:hover {
            transform: translateY(-5px); 
            box-shadow: 0 8px 25px rgba(26, 35, 126, 0.6);
            background: linear-gradient(90deg, #0d1252, #003a31); 
        }

        /* Checkmark styling */
        .checkmark {
            color: #4CAF50;
            font-size: 60px;
            margin-bottom: 15px;
            animation: fadeIn 0.8s ease-in;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .confirmation-box {
                padding: 30px 20px; /* ઓરિજિનલ પેડિંગ */
                /* મોબાઇલ પર પાછું સેન્ટર */
                transform: translateX(0); 
            }
            h1 {
                font-size: 28px;
            }
            a {
                padding: 12px 25px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

<div class="confirmation-box">
    <div class="checkmark">✅</div>
    <h1>Thank You!</h1>
    <p>Your order has been placed successfully. We've received your request and will process it shortly. You'll receive a confirmation email with more details.</p>
    <a href="products.php">Continue Shopping</a>
</div>

</body>
</html>