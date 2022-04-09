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

    <!-- Script -->
    <script src="js/app.js" defer></script>

    <title>Home | Re-branded Gallery |</title>
</head>

<body>
    <!-- Main content -->
    <main>
        <section class="front">
            <div class="wrapper">
                <h2>Re-Branded Gallery</h2>
                <i>Made by <strong>Gabriel Engberg</strong></i>
                <a href="#about" class="continue">
                    <span class="arrow"></span>
                    <span class="arrow"></span>
                    <span class="arrow"></span>
                </a>
            </div>
        </section>

        <section class="about" id="about">
        </section>

        <section class=" get-started">
            <!-- Shift between signup and upload, depending on the session -->
            <?php if ($isLoggedIn) { ?>
            <!-- Some anchor tag to gallery.php or upload page -->
            <a href=""></a>
            <?php } else { ?>
            <a href="pages/signup.php" class="signup">Signup</a>
            <?php } ?>
        </section>

        <section class="contact">
            <!-- Contact form split into two parts: info and form. -->
            <div class="left__split">
                <!-- Info about contact -->
                <h2>Contact</h2>
            </div>
            <div class="right__split">
                <!-- Contact form -->
                <h2>Contact form</h2>
            </div>
        </section>

    </main>

    <!-- Footer with socials and internal links -->
    <footer>
        <div class="left__split">
            <!-- Social links -->
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
            <!-- All rights reserved for Re-Branded -->
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