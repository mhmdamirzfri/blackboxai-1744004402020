<?php
require_once 'functions.php';
redirectIfNotLoggedIn();
$user = getCurrentUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Dashboard | RentalSync</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .dashboard-card {
            transition: transform 0.2s ease-in-out;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-xl font-semibold text-blue-600">RentalSync</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Hi, <?php echo htmlspecialchars($user['name']); ?></span>
                    <a href="logout.php" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Payment Card -->
            <div class="dashboard-card bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-money-bill-wave text-blue-500 mr-2"></i>
                        Rent & Payments
                    </h2>
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded">Due Soon</span>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">October Rent</span>
                        <span class="font-medium">$800.00</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Utilities</span>
                        <span class="font-medium">$120.50</span>
                    </div>
                    <div class="pt-3 border-t border-gray-200">
                        <button class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                            Make Payment
                        </button>
                    </div>
                </div>
            </div>

            <!-- Chores Card -->
            <div class="dashboard-card bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-broom text-green-500 mr-2"></i>
                    Your Chores
                </h2>
                <ul class="space-y-3">
                    <li class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" class="rounded text-green-500 mr-2">
                            <span>Take out trash</span>
                        </div>
                        <span class="text-xs text-gray-500">Due tomorrow</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" class="rounded text-green-500 mr-2">
                            <span>Clean kitchen</span>
                        </div>
                        <span class="text-xs text-gray-500">Due Friday</span>
                    </li>
                </ul>
                <div class="pt-3 mt-4 border-t border-gray-200">
                    <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        View All Chores
                    </button>
                </div>
            </div>

            <!-- Maintenance Card -->
            <div class="dashboard-card bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-tools text-orange-500 mr-2"></i>
                    Maintenance
                </h2>
                <form class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Report an Issue</label>
                        <select class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option>Select issue type</option>
                            <option>Plumbing</option>
                            <option>Electrical</option>
                            <option>Appliance</option>
                        </select>
                    </div>
                    <div>
                        <textarea class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                  rows="3" placeholder="Describe the issue..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-orange-500 text-white py-2 px-4 rounded hover:bg-orange-600 transition">
                        Submit Request
                    </button>
                </form>
            </div>

            <!-- Messages Card -->
            <div class="dashboard-card bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-envelope text-purple-500 mr-2"></i>
                    Messages
                </h2>
                <div class="space-y-3">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-user text-purple-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Landlord</p>
                            <p class="text-sm text-gray-500">Just wanted to remind you about...</p>
                        </div>
                    </div>
                </div>
                <div class="pt-3 mt-4 border-t border-gray-200">
                    <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        View All Messages
                    </button>
                </div>
            </div>

            <!-- Lease Card -->
            <div class="dashboard-card bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-file-contract text-yellow-500 mr-2"></i>
                    Lease Agreement
                </h2>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Current Lease</span>
                    <span class="text-sm text-gray-500">Expires 05/31/2024</span>
                </div>
                <div class="pt-3 mt-4 border-t border-gray-200">
                    <button class="w-full bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600 transition">
                        View Lease
                    </button>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="dashboard-card bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-bolt text-red-500 mr-2"></i>
                    Quick Actions
                </h2>
                <div class="grid grid-cols-2 gap-3">
                    <button class="flex flex-col items-center justify-center p-3 bg-gray-100 rounded hover:bg-gray-200 transition">
                        <i class="fas fa-calendar-alt text-blue-500 mb-1"></i>
                        <span class="text-xs">Events</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-3 bg-gray-100 rounded hover:bg-gray-200 transition">
                        <i class="fas fa-users text-green-500 mb-1"></i>
                        <span class="text-xs">Housemates</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-3 bg-gray-100 rounded hover:bg-gray-200 transition">
                        <i class="fas fa-cog text-gray-500 mb-1"></i>
                        <span class="text-xs">Settings</span>
                    </button>
                    <button class="flex flex-col items-center justify-center p-3 bg-gray-100 rounded hover:bg-gray-200 transition">
                        <i class="fas fa-question-circle text-purple-500 mb-1"></i>
                        <span class="text-xs">Help</span>
                    </button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>