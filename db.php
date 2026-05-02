<?php
$servername = "localhost";
$username = "root"; // Usually 'root' for local XAMPP installations
$password = "";     // Usually empty for local XAMPP installations
$dbname = "myshop"; // <-- Make sure this is correct!

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>