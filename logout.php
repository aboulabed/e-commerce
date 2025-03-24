<?php
session_start();
session_unset(); // Clear all session variables
session_destroy(); // Destroy the session
echo "<script>window.location.href='login.php';</script>";
exit(); // Stop further execution
