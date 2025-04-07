<?php
require_once 'db_connect.php';

function startSession() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

function login($email, $password) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name'];
        return true;
    }
    return false;
}

function isLoggedIn() {
    startSession();
    return isset($_SESSION['user_id']);
}

function isLandlord() {
    return isLoggedIn() && $_SESSION['role'] === 'landlord';
}

function redirectIfNotLoggedIn() {
    if (!isLoggedIn()) {
        header("Location: index.php");
        exit();
    }
}

function redirectIfNotLandlord() {
    redirectIfNotLoggedIn();
    if (!isLandlord()) {
        header("Location: dashboard_tenant.php");
        exit();
    }
}

function getCurrentUser() {
    if (isLoggedIn()) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        return $stmt->fetch();
    }
    return null;
}
?>