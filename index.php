<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ./login.php');
    exit;
}

if (isset($_POST['logout'])) {
    session_unset();
    $_SESSION['loggedin'] = false;
    session_destroy();
    header('Location: ./login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <?php
        if (isset($_SESSION['username'])) : ?>
            <p> Account: <?php echo $_SESSION['username']; ?></p>
        <?php endif; ?>
    </header>
    <main>
        <h1>AdminPanel</h1>
        <p>Nur für Admins!</p>
    </main>
</body>

</html>