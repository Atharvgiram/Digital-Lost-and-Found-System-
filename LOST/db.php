<?php
// Database connection file (db.php)

$host = "localhost";      // Database host
$user = "root";           // Default WAMP/XAMPP username
$pass = "";               // Default WAMP/XAMPP password (keep blank if no password set)
$dbname = "lost_found";   // Database name

// Create OOP connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
