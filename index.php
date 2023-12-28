<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ./login');
    exit;
}

if (isset($_POST['abmelden'])) {
    session_unset();
    $_SESSION['loggedin'] = false;
    session_destroy();
    header('Location: ./login');
    exit;
}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="/admin/static/style.css">

<head>
    <title>Admin</title>
</head>

<body>

    <!-- ----- Adminpanel Status ------------------------- -->
    <header>
        <?php if (isset($_SESSION['username'])) : ?>
            <p>Account: <?php echo $_SESSION['username']; ?></p>
        <?php endif; ?>
    </header>
    <!-- ----- INFOS ------------------------- -->
    <main>
        <h1>AdminPanel</h1>
        <p>Hier ist die Adminseite!</p>
    </main>
    <!-- ----- Abmelden ------------------------- -->
    <footer>
        <form method="post" action="">
            <input type="submit" name="abmelden" value="Abmelden">
        </form>
    </footer>
</body>

</html>