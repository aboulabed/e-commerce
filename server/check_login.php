<?php
// Start the session
session_start();

// Check if the session variable is not set
if (!isset($_SESSION['user_name'])) {
    // Redirect to the registration page
    header('Location: register.php');
    exit(); // Stop further execution
}
