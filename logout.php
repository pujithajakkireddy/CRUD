<?php
// logout.php
// Script to log out users.
require_once 'includes/header.php';

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to the home page
header("Location: index.php");
exit();
?>

