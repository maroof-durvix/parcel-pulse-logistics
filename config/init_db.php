<?php
// config/init_db.php
require_once 'db.php';

// First, create database if it doesn't exist
$sql_db = "CREATE DATABASE IF NOT EXISTS parcel_pulse";
if ($conn->query($sql_db) === TRUE) {
    echo "Database created successfully or already exists.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db("parcel_pulse");

// Read the SQL file
$sqlFile = __DIR__ . '/database.sql';
if (!file_exists($sqlFile)) {
    die("database.sql file not found.");
}

$sql = file_get_contents($sqlFile);

// Execute multi query
if ($conn->multi_query($sql)) {
    do {
        // Store first result set
        if ($result = $conn->store_result()) {
            $result->free();
        }
        // if there are more result-sets, the print a divider
        if ($conn->more_results()) {
            // keep going
        }
    } while ($conn->next_result());
    echo "Tables created successfully!<br>";
    echo "<a href='../index.php'>Go to Home</a>";
} else {
    echo "Error creating tables: " . $conn->error;
}

$conn->close();
?>
