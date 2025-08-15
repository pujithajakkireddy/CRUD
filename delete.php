<?php
// delete.php
// Script to delete posts.
require_once 'includes/header.php';
require_once 'includes/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if a post ID is provided in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid post ID.");
}

$postId = $_GET['id'];

try {
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
    $stmt->execute(['id' => $postId]);
    
    header("Location: index.php");
    exit();

} catch (PDOException $e) {
    die("Error deleting post: " . $e->getMessage());
}
?>
