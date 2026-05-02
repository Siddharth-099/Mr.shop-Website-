<?php
include 'db.php'; // Database connection

// Handle form submission and product addition
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ⚠️ Note: For a real application, use prepared statements for security!
    $name = $_POST["name"];
    $price = $_POST["price"];
    $category = $_POST["category"];
    $discount_percentage = $_POST["discount_percentage"];

    // Image upload handling
    $imageName = $_FILES["image"]["name"];
    $imageTmp = $_FILES["image"]["tmp_name"];
    
    // Define the path where the image will be stored (e.g., "uploads/product_name.jpg")
    $imagePath = "uploads/" . basename($imageName);

    // Create 'uploads' directory if it doesn't exist
    if (!is_dir("uploads")) {
        // Permissions: 0777 allows full access (be cautious with this on production servers)
        mkdir("uploads", 0777, true); 
    }

    // Try to move the uploaded file
    if (move_uploaded_file($imageTmp, $imagePath)) {
        
        // This is the path used to display the image on the website (e.g., 'uploads/example.jpg')
        $image_web_path = $imagePath; 
        
        // SQL query to insert product data along with the web path
        $sql = "INSERT INTO products (name, category, price, discount_percentage, image) 
                VALUES ('$name', '$category', '$price', '$discount_percentage', '$image_web_path')";
        
        if ($conn->query($sql) === TRUE) {
            $status_message = "<p style='color:green;'>Product added successfully! Image Path: $image_web_path</p>";
        } else {
            $status_message = "<p style='color:red;'>Error adding product: " . $conn->error . "</p>";
        }
    } else {
        $status_message = "<p style='color:red;'>Image upload failed! Check permissions for 'uploads' folder.</p>";
    }
} else {
    $status_message = ''; // Clear message on first load
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* (તમારો CSS કોડ અહીં હતો, મેં તેને નીચે ફરીથી મૂક્યો છે) */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0f4f8, #c1d2e1);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            /* Added flex-direction to stack message and container */
            flex-direction: column; 
        }

        .container {
            background: linear-gradient(135deg, #e0eaf1, #f9fbfd);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        
        h2 {
            font-size: 28px;
            font-weight: 700;
            color: #4b0082;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            text-align: left;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            outline: none;
            border-color: #8a2be2;
        }
        
        input[type="file"] {
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background: linear-gradient(45deg, #28a745, #218838);
            color: white;
            padding: 15px 25px;
            border: none;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        input[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            background: linear-gradient(45deg, #218838, #1e7e34);
        }

        label {
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
        }
        
        p {
            margin-top: 20px;
            font-weight: 600;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<?= $status_message; ?> <div class="container">
    <h2>Add New Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="">--Select--</option>
                <option value="Cap">Cap</option>
                <option value="Shoes">Shoes</option>
                <option value="Shirt">Shirt</option>
                <option value="Perfume">Perfume</option>
                <option value="Watches">Watches</option>
                <option value="Wallets">Wallets</option>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" min="0" required>
        </div>

        <div class="form-group">
            <label for="discount_percentage">Discount (%):</label>
            <input type="number" id="discount_percentage" name="discount_percentage" value="0" min="0" max="100" required>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>

        <input type="submit" value="Add Product">
    </form>
</div>

</body>
</html>