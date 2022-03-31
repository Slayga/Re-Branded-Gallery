<?php require_once("auth.php"); ?>

<?php
// Check if user is logged in, then redirect back to home.
if ($isLoggedIn) {
    header("Location: ../");
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">

    <!-- Styling -->
    <link rel="stylesheet" href="../css/style.css">
    <title>Login | Re-branded Gallery |</title>
</head>

<body>
    <!-- Header -->
    <header>
        <a href="../">
            <h1 class="hero">Re-branded Gallery</h1>
        </a>
        <nav>
            <a href="../">Home</a>
            <a href="../pages/gallery.php">Gallery</a>
            <a href="../pages/about.php">About</a>
            <a href="../pages/contact.php">Contact</a>
        </nav>
        <!-- This will shift depending on if the session is logged in or not-->
        <?php if ($isLoggedIn) { ?>
        <a href="logout.php" class="userA">Logout</a>
        <?php } else { ?>
        <a href="login.php" class="userA">Login</a>
        <?php } ?>
    </header>

    <!-- Main content -->
    <main>
        <!-- Login form to authenticate user || redirect to signup -->
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="login" name="login">
        </form>
        <?php // if (isset($error)){if($error === "401") echo "Bad Login";} ?>
        <!-- Echo Bad Login on error code 401 from GET -->
        <?php if (isset($_GET['error'])) {if ($_GET['error'] === "401") { 
                echo "<span class='error'>Bad Login</span>";
            } 
        } ?>
        <div class="redirect">
            <p>Not a member? <a href="signup.php">Signup</a></p>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <!-- All rights reserved for Re-Branded-->
        <p>&copy; Re-branded Gallery <?=date('Y')?> | All rights reserved</p>
    </footer>

</body>

</html>