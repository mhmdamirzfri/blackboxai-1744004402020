<?php
require_once 'db_connect.php';

try {
    // Create database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS rental_app");
    $pdo->exec("USE rental_app");

    // Create tables
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            role ENUM('tenant', 'landlord') NOT NULL,
            property_id INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS payments (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT NOT NULL,
            amount DECIMAL(10,2) NOT NULL,
            due_date DATE NOT NULL,
            status ENUM('paid', 'overdue', 'pending') DEFAULT 'pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id)
        )
    ");

    // Similar CREATE TABLE statements for chores, maintenance_requests, 
    // messages, and lease_agreements would go here...

    echo "Database and tables created successfully!";
} catch(PDOException $e) {
    die("Error setting up database: " . $e->getMessage());
}
?>