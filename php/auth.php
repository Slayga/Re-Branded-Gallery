<?php 
// Access _SESSION variable
session_start();
// Basic Authentication and Functions for users that are logged in

// Return connection object
function sqlConnect($dbName, $dbServer="localhost", $dbUser="root", $dbPass=""){
        $connect=mysqli_connect($dbServer,$dbUser,$dbPass,$dbName);
        return $connect;
    }

// To salt them passwords
function extraSalt($username, $password ){
    // Extra (extra) salt. This is technically not efficient, but it's a simple example.
    $salt = "ThisIsJustAPreDefinedExtraSaltForSequrityReasonsOrSomethingItWillAtleastMakeTheMD5Unique.WowYouStillReadingThis?JustKeepItUpUntilIGetBoredOfWritingThisWhichIsRightNowAfterThisSentenceBYE";
    
    // Return that hash with extra salting
    return md5($username.$password.$salt);
}


// This will check if the current session is already logged in
$username = $_SESSION["username"] ?? "";
$userId = $_SESSION["userId"] ?? "";
$isLoggedIn = $_SESSION["loggedIn"] ?? false;

// On submitting a post form
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Signup form
    if (isset($_POST["signup"]) && isset($_POST["username"]) && isset($_POST["password"])) {
        // For local calls in file
        $username = $_POST["username"];
        $password = extraSalt($username, $_POST["password"]);
        $loginOnSignUp = $_POST["loginOnSignUp"];

        // Check if username is already taken in database if not create new user
        $connection = sqlConnect("anamazinggallery");
        $sqlSelect = "SELECT * FROM tblusers WHERE username='$username'";
        // Picks all table with username as requested, then checks if it returned zero rows of that username
        if (mysqli_num_rows(mysqli_query($connection, $sqlSelect)) === 0){
            // Then its good to register the user
            $sqlSelect = "INSERT INTO tblusers (username, password) VALUES ('$username', '$password')";
            
            // If user want to login after signup...
            if ($loginOnSignUp) {
                $userInfo = mysqli_fetch_assoc(mysqli_query($connection, $sqlSelect));
                $isLoggedIn = true;
                $_SESSION["loggedIn"] = true;
                $_SESSION["userId"] = $userInfo["userId"];
                $_SESSION["username"] = $userInfo["username"];
                $_SESSION["level"] = $userInfo["level"];
            }
        }
    }
    // Login form
    else if (isset($_POST["login"]) && isset($_POST["username"]) && isset($_POST["password"])) {
        // For local calls in file
        $username = $_POST["username"];
        $password = extraSalt($username, $_POST["password"]);

        // Check if username and password is correct
        $connection = sqlConnect("anamazinggallery");
        $sqlSelect = "SELECT * FROM tblusers WHERE username='$username' AND password='$password'";
        // Picks all table with username as requested, then checks if it returned 1 rows of that username
        if (mysqli_num_rows(mysqli_query($connection, $sqlSelect)) === 1){
            // Then its good to login the user
            $userInfo = mysqli_fetch_assoc(mysqli_query($connection, $sqlSelect));
            $isLoggedIn = true;
            $_SESSION["loggedIn"] = true;
            $_SESSION["userId"] = $userInfo["userId"];
            $_SESSION["username"] = $userInfo["username"];
            $_SESSION["level"] = $userInfo["level"];
            // If the form has been submitted and evaluated
            header("Location: ../");
        }
        // If the username or password was incorrect send back to login page
        else {

            header("Location: login.php?error=401");
        }
    } 
    // Logout form
    else if (isset($_POST["logout"])) {
        $isLoggedIn = false;
        session_destroy();
    } 
    else{
        // If no form is submitted??Wut then
        // How is that possible??
        header("Location: error.php?error=500");
    }
    
}
?>

<?php 
// ======= //
// Rewrite //
// ======= //

// Start session
session_start();
function defalut_session_vars(){
    // Set global variables depending on session
    global $username;
    global $userId;
    global $isLoggedIn;
    $username = $_SESSION["username"] ?? "";
    $userId = $_SESSION["userId"] ?? "";
    $isLoggedIn = $_SESSION["loggedIn"] ?? false;

}
// Function to call when logging in
function loginForm($username, $password){
    // Connect to database
    $connection = sqlConnect("anamazinggallery");
    // Escape username and password
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    // Select all users with username and password
    $sqlSelect = "SELECT * FROM tblusers WHERE username='$username' AND password='$password'";
    // If there is one user with that username and password
    if (mysqli_num_rows(mysqli_query($connection, $sqlSelect)) === 1){
        // Then login the user
        $userInfo = mysqli_fetch_assoc(mysqli_query($connection, $sqlSelect));
        $isLoggedIn = true;
        $_SESSION["loggedIn"] = true;
        $_SESSION["userId"] = $userInfo["userId"];
        $_SESSION["username"] = $userInfo["username"];
        




?>