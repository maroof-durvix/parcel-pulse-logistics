<?php

// Database Configuration - Auto-Detects Localhost vs InfinityFree Live Server
$http_host = $_SERVER['HTTP_HOST'] ?? '';
$is_localhost = (
    strpos($http_host, 'localhost') !== false || 
    strpos($http_host, '127.0.0.1') !== false ||
    php_sapi_name() === 'cli'
);

if ($is_localhost) {
    // Localhost Environment (Laragon / XAMPP / PHP CLI)
    $host   = getenv('DB_HOST') ?: "localhost";
    $user   = getenv('DB_USER') ?: "root";
    $pass   = getenv('DB_PASS') !== false ? getenv('DB_PASS') : "";
    $dbname = getenv('DB_NAME') ?: "parcel_pulse";
} else {
    // InfinityFree Live Hosting Environment (Auto-Connected)
    $host   = getenv('DB_HOST') ?: "sql312.infinityfree.com";
    $user   = getenv('DB_USER') ?: "if0_43354517";
    $pass   = getenv('DB_PASS') ?: "BSLOhSgWPv8ek79";
    $dbname = getenv('DB_NAME') ?: "if0_43354517_parcel_pulse";
}

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error . " (Host: $host, DB: $dbname)");
}

$conn->set_charset("utf8mb4");

?>
