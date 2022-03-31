<?php require_once("auth.php"); ?>

<?php
// Logout user

// Destroy session and clear variables
session_destroy();
// This is technically necessary
$username = "";
$userId = "";
$isLoggedIn = false;
// Redirect to home
header("Location: ../");
?>