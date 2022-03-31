<!-- Require auth.php -->
<?php require_once("auth.php"); ?>

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
        <!-- Get all images from img/gallery and place them in a 3*x grid-->
        <?php
        $dir = dirname(__FILE__);
        $files = scandir($dir . "/img/gallery");
        $files = array_diff($files, array('.', '..'));
        $count = count($files);
        $cols = 3;
        $rows = ceil($count / $cols);
        ?>
        <!-- Display all the images in random order -->
        <?php for ($i = 0; $i < $rows; $i++) : ?>
        <div class="row">
            <?php for ($j = 0; $j < $cols; $j++) : ?>
            <?php $index = $i * $cols + $j; ?>
            <?php if ($index < $count) : ?>
            <div class="col">
                <img src="../img/gallery/<?= $files[$index] ?>" alt="">
            </div>
            <?php endif; ?>
            <?php endfor; ?>
        </div>
        <?php endfor; ?>


    </main>

    <!-- Footer like index.php -->
    <footer>
        <!-- All rights reserved for Re-Branded-->
        <p>&copy; Re-branded Gallery <?=date('Y')?> | All rights reserved</p>
    </footer>


</body>

</html>