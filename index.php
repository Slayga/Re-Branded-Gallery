<?php require_once("php/auth.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">

    <!-- Styling -->
    <link rel="stylesheet" href="css/style.css">
    <title>Home | Re-branded Gallery |</title>
</head>

<body>
    <!-- Header, sticky. Nested: h1, nav & logout or login button-->
    <header>
        <a href="./">
            <h1 class="hero">Re-Branded Gallery</h1>
        </a>
        <nav>
            <a href="./">Home</a>
            <a href="pages/gallery.php">Gallery</a>
            <a href="pages/about.php">About</a>
            <a href="pages/contact.php">Contact</a>
        </nav>
        <!-- This will shift depending on if the session is logged in or not-->
        <?php if ($isLoggedIn) { ?>
        <a href="php/logout.php" class="userA">Logout</a>
        <?php } else { ?>
        <a href="php/login.php" class="userA">Login</a>
        <?php } ?>
    </header>

    <!-- Main content -->
    <main>

    </main>

    <!-- Footer always at bottom of page -->
    <footer>
        <div class="left__split">
            <!-- Socials -->
            <nav class="socials">
                <a href="https://www.facebook.com/rebrandedgallery/" target="_blank">
                    <img src="img/socials/facebook-512px.png" alt="Facebook">
                </a>
                <a href="https://www.instagram.com/rebrandedgallery/" target="_blank">
                    <img src="img/socials/instagram-512px.png" alt="Instagram">
                </a>
                <a href="https://www.pinterest.com/rebrandedgallery/" target="_blank">
                    <img src="img/socials/pinterest-512px.png" alt="Pinterest">
                </a>
                <a href="https://www.twitter.com/rebrandedgallery/" target="_blank">
                    <img src="img/socials/twitter-512px.png" alt="Twitter">
                </a>
            </nav>
            <!-- All rights reserved for Re-Branded-->
            <p>&copy; Re-branded Gallery <?=date('Y')?> | All rights reserved</p>
        </div>
        <div class="right__split">
            <!-- Links to internal pages -->
            <nav>
                <a href="./">Home</a>
                <a href="pages/gallery.php">Gallery</a>
                <a href="pages/about.php">About</a>
                <a href="pages/contact.php">Contact</a>
                <a href="pages/cookies.php">Cookies</a>
            </nav>
        </div>
    </footer>
</body>

</html>