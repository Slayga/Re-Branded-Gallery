<?php require_once("auth.php"); ?>

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
    <title>Home | Re-branded Gallery |</title>
</head>

<body>
    <!-- Header -->
    <header>
        <h1>Re-branded Gallery</h1>
        <nav>
            <a href="../index.php">Home</a>
            <a href="../pages/gallery.php">Gallery</a>
            <a href="../pages/about.php">About</a>
            <a href="../pages/contact.php">Contact</a>
        </nav>
        <!-- This will shift depending on if the session is logged in or not-->
        <?php if ($isLoggedIn) { ?>
        <a href="logout.php">Logout</a>
        <?php } else { ?>
        <a href="login.php">Login</a>
        <?php } ?>
    </header>

    <main>

    </main>
</body>

</html>