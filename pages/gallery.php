<!-- Require auth.php -->
<?php require_once("../php/auth.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Create header like index.php -->
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

    <main>

    </main>

    <!-- Footer like index.php -->
    <footer>
        <!-- All rights reserved for Re-Branded-->
        <p>&copy; Re-branded Gallery <?=date('Y')?> | All rights reserved</p>
    </footer>


</body>

</html>