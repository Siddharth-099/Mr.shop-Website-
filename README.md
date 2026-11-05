# 🛍️ PHP E-Commerce Website

A dynamic and user-friendly E-Commerce Website developed using HTML, CSS, JavaScript, PHP, and MySQL. This project provides an online shopping experience with user authentication, product management, shopping cart, order processing, and an Admin Panel.

The application includes both frontend and backend functionality, allowing users to browse products, place orders, and manage their accounts, while administrators can manage products and monitor customer orders.

## 🚀 Technologies Used

### Frontend

* HTML5
* CSS3
* JavaScript
* Bootstrap (if used)

### Backend

* PHP

### Database

* MySQL

### Tools

* Visual Studio Code
* XAMPP
* Git & GitHub

### AI Tools

* AI-Assisted Development
* AI-Based Coding Assistance
* AI-Assisted Debugging

## ✨ Features

### 👤 User Features

* User Registration and Login.
* Browse available products.
* View product details.
* Add products to shopping cart.
* Update and remove cart items.
* Checkout functionality.
* Place orders.
* View order confirmation.
* Contact and About pages.

### 🔐 Admin Panel

* Admin Login.
* Add new products.
* Manage existing products.
* Delete products.
* View customer orders.
* Manage product information.
* Monitor order details.

### 🗄️ Database Features

* MySQL database integration.
* Store user registration details.
* Store product information.
* Manage shopping cart data.
* Store customer orders.
* Backend data management using PHP.

## 📂 Project Structure

```text
Mr.shop-Website/
│
├── about.php
├── add_product.php
├── add_product.css
├── add_to_cart.php
├── checkout.php
├── contact.php
├── db.php
├── login.php
├── logout.php
├── order_confirmed.php
├── privacy.php
├── products.php
├── register.php
├── send_order_confirmation.php
├── service.php
├── sql.sql
│
└── README.md
```

## ⚙️ Installation and Setup

### 1. Clone the Repository

```bash
git clone https://github.com/Siddharth-099/Mr.shop-Website-.git
```

### 2. Move Project to Local Server

If you are using XAMPP, copy the project folder into:

```text
C:/xampp/htdocs/
```

### 3. Start XAMPP Services

Start the following services:

* Apache
* MySQL

### 4. Create MySQL Database

Create a new database in your local MySQL server.

Import the provided `sql.sql` file into your database.

You can use a MySQL command-line client or a database management tool to import the SQL file.

### 5. Configure Database Connection

Open the `db.php` file and configure your local MySQL credentials.

```php
<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "your_database_name";

$conn = mysqli_connect(
    $host,
    $username,
    $password,
    $database
);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>
```

Replace the database name and credentials with your actual local MySQL configuration.

### 6. Run the Project

Open your browser and visit:

```text
http://localhost/Mr.shop-Website-/
```

The website will run on your local development server.

## 🗄️ Database Management

The application uses a local MySQL database to store and manage application data.

PHP handles database operations such as:

* User registration and authentication.
* Product management.
* Shopping cart operations.
* Order processing.
* Admin operations.

## 🤖 Development Approach

AI-powered tools were used during development to assist with:

* Understanding and writing PHP code.
* Debugging and resolving errors.
* Improving application functionality.
* Assisting with frontend and backend development.

The application logic and implementation were developed and reviewed as part of the project work.

## 📌 Project Status

**Completed**

The core e-commerce functionalities have been developed, including user authentication, product management, shopping cart, checkout, order processing, and admin operations.

## 👨‍💻 Developer

**Siddharth Patel**

* GitHub: [Siddharth-099](https://github.com/Siddharth-099)

---

⭐ If you find this project interesting, feel free to explore the repository!
