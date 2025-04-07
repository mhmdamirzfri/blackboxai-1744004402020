<?php
require_once 'functions.php';
startSession();

if (isLoggedIn()) {
    header("Location: " . (isLandlord() ? "dashboard_landlord.php" : "dashboard_tenant.php"));
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (login($email, $password)) {
        header("Location: " . (isLandlord() ? "dashboard_landlord.php" : "dashboard_tenant.php"));
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Management - Login</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <style>
        body {
            background-image: url('https://images.pexels.com/photos/3495058/pexels-photo-3495058.jpeg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .login-container {
            backdrop-filter: blur(5px);
            background-color: rgba(255, 255, 255, 0.85);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="login-container p-8 rounded-lg shadow-xl w-full max-w-md">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-blue-600">RentalSync</h1>
            <p class="text-gray-600 mt-2">Manage your shared living space</p>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
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
            <button type="submit" 
                    class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200 font-medium shadow-md">
                Sign In
            </button>
        </form>
        <div class="mt-6 text-center">
            <p class="text-gray-600">
                New to RentalSync? 
                <a href="register.php" class="text-blue-600 hover:text-blue-800 font-medium transition">Create account</a>
            </p>
        </div>
    </div>
</body>
</html>