<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";
// Set the idle time threshold in seconds (e.g., 600 seconds = 10 minutes)
$idleThreshold = 300;

// Check if the user is logged in and has a last activity timestamp
if (isset($_SESSION['last_activity'])) {
    $lastActivity = $_SESSION['last_activity'];
    $currentTime = time();

    // Calculate the idle time in seconds
    $idleTime = $currentTime - $lastActivity;

    // If idle time exceeds the threshold, log out and redirect to the login page
    if ($idleTime > $idleThreshold) {
        session_destroy();
        header("Location: ../index.php"); // Reload the page to homepage immediately
        exit();
    }
}
?>
