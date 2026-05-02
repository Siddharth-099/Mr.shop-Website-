                                                    --    database 12-19-2025


CREATE TABLE products (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(200),
    price DECIMAL(10,2),
    discount_percentage INT(11),
    image VARCHAR(255),
    category VARCHAR(100),
    max_quantity INT(11)
);

CREATE TABLE users (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    username VARCHAR(100),
    email VARCHAR(150),
    password VARCHAR(255),
    role ENUM('admin', 'user'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    user_id INT(11),
    product_name VARCHAR(150),
    quantity INT(11),
    price DECIMAL(10,2),
    address VARCHAR(255),
    contact_number VARCHAR(20),
    order_date DATETIME
);

CREATE TABLE payment (
    payment_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    payment_method VARCHAR(50),
    amount DECIMAL(10,2),
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);