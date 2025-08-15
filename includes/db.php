<?php
// includes/db.php
// This file handles the database connection.

$host = 'localhost';
$dbname = 'blog';
$user = 'root'; 
$password = ''; 

// Data Source Name for PDO
// This line has been updated to include your MySQL port.
$dsn = "mysql:host=$host;dbname=$dbname;port=3307;charset=utf8mb4";

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $user, $password);

    // Set PDO attributes for better error handling and security
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // If connection fails, display an error message and exit
    die("Database connection failed: " . $e->getMessage());
}

?>

