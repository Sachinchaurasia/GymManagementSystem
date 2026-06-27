<?php
// Start session ONLY if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check whether user_id session exists
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Store session id
$session_id = $_SESSION['user_id'];
?>