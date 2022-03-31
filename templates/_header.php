<!-- Get absolute path to directory in php -->
<?php 
$dir = dirname(__FILE__);
?>

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