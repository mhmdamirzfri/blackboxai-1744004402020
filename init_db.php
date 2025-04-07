<?php
require_once 'db_connect.php';
require_once 'functions.php';

try {
    // Run the database setup
    require_once 'db_setup.php';

    // Add test users
    $pdo->exec("
        INSERT INTO users (name, email, password, role, property_id) VALUES
        ('John Tenant', 'tenant@example.com', '" . password_hash('tenant123', PASSWORD_DEFAULT) . "', 'tenant', 1),
        ('Jane Landlord', 'landlord@example.com', '" . password_hash('landlord123', PASSWORD_DEFAULT) . "', 'landlord', 1)
    ");

    // Add test payments
    $pdo->exec("
        INSERT INTO payments (user_id, amount, due_date, status) VALUES
        (1, 800.00, DATE_ADD(CURDATE(), INTERVAL 5 DAY), 'pending'),
        (1, 120.50, DATE_ADD(CURDATE(), INTERVAL 2 DAY), 'pending')
    ");

    // Add test chores
    $pdo->exec("
        INSERT INTO chores (task, assigned_to, due_date, status) VALUES
        ('Take out trash', 1, DATE_ADD(CURDATE(), INTERVAL 1 DAY), 'pending'),
        ('Clean kitchen', 1, DATE_ADD(CURDATE(), INTERVAL 3 DAY), 'pending')
    ");

    // Add test maintenance requests
    $pdo->exec("
        INSERT INTO maintenance_requests (user_id, issue, priority, status) VALUES
        (1, 'Leaky faucet in kitchen', 'medium', 'pending'),
        (1, 'Heating not working', 'high', 'pending')
    ");

    echo "<div class='max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-md'>";
    echo "<h1 class='text-2xl font-bold text-green-600 mb-4'>Database Initialized Successfully!</h1>";
    echo "<p class='mb-4'>Test accounts created:</p>";
    echo "<ul class='mb-6 space-y-2'>";
    echo "<li><strong>Tenant:</strong> email: tenant@example.com, password: tenant123</li>";
    echo "<li><strong>Landlord:</strong> email: landlord@example.com, password: landlord123</li>";
    echo "</ul>";
    echo "<a href='index.php' class='inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition'>Go to Login Page</a>";
    echo "</div>";

} catch(PDOException $e) {
    echo "<div class='max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-md'>";
    echo "<h1 class='text-2xl font-bold text-red-600 mb-4'>Error Initializing Database</h1>";
    echo "<p class='text-gray-700'>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Initialize Database</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body class="bg-gray-100">
</body>
</html>