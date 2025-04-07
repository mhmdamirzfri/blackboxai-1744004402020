<?php
require_once 'functions.php';
startSession();

if (isLoggedIn()) {
    header("Location: " . (isLandlord() ? "dashboard_landlord.php" : "dashboard_tenant.php"));
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>