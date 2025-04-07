<?php
require_once 'functions.php';
startSession();

if (isLoggedIn()) {
    header("Location: " . (isLandlord() ? "dashboard_landlord.php" : "dashboard_tenant.php"));
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'tenant';
    $property_id = $_POST['property_id'] ?? null;

    try {
        global $pdo;
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role, property_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $hashed_password, $role, $property_id]);
        
        $_SESSION['success'] = "Registration successful! Please login.";
        header("Location: index.php");
        exit();
    } catch(PDOException $e) {
        $error = "Registration failed: " . (strpos($e->getMessage(), 'Duplicate entry') ? "Email already exists" : "Please try again");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Management - Register</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <style>
        body {
            background-image: url('https://images.pexels.com/photos/209296/pexels-photo-209296.jpeg');
            background-size: cover;
            background-position: center;
        }
        .register-container {
            backdrop-filter: blur(5px);
            background-color: rgba(255, 255, 255, 0.9);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="register-container p-8 rounded-lg shadow-xl w-full max-w-md">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-blue-600">Join RentalSync</h1>
            <p class="text-gray-600 mt-2">Create your account</p>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-gray-700 mb-1 font-medium">Full Name</label>
                <input type="text" name="name" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                       placeholder="John Doe">
            </div>
            <div>
                <label class="block text-gray-700 mb-1 font-medium">Email</label>
                <input type="email" name="email" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                       placeholder="your@email.com">
            </div>
            <div>
                <label class="block text-gray-700 mb-1 font-medium">Password</label>
                <input type="password" name="password" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                       placeholder="••••••••">
            </div>
            <div>
                <label class="block text-gray-700 mb-1 font-medium">I am a</label>
                <select name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="tenant">Tenant</option>
                    <option value="landlord">Landlord</option>
                </select>
            </div>
            <div id="propertyIdField" class="hidden">
                <label class="block text-gray-700 mb-1 font-medium">Property ID</label>
                <input type="text" name="property_id" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                       placeholder="Property ID (if applicable)">
            </div>
            <button type="submit" 
                    class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200 font-medium shadow-md">
                Create Account
            </button>
        </form>
        <div class="mt-6 text-center">
            <p class="text-gray-600">
                Already have an account? 
                <a href="index.php" class="text-blue-600 hover:text-blue-800 font-medium transition">Sign in</a>
            </p>
        </div>
    </div>

    <script>
        document.querySelector('select[name="role"]').addEventListener('change', function() {
            const propertyIdField = document.getElementById('propertyIdField');
            if (this.value === 'landlord') {
                propertyIdField.classList.remove('hidden');
            } else {
                propertyIdField.classList.add('hidden');
            }
        });
    </script>
</body>
</html>