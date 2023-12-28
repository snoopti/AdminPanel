<?php
session_start();

// Benutzer
$user_credentials = array(
    'admin' => '123123123',
);

$discordWebhookURL = 'WEBHOOK_HIER_EINSETZEN';

// Einloggen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_password = $_POST['passwort'] ?? '';
    $user_name = $_POST['name'] ?? '';

    if (array_key_exists($user_name, $user_credentials) && $user_credentials[$user_name] === $user_password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user_name;
        $currentDateTime = date('d.m.Y H:i:s');
        $message = "```✅ Login: $user_name | $currentDateTime```";
        sendDiscordWebhook($discordWebhookURL, $message);
        header('Location: ./');
        exit;
    } else {
        $currentDateTime = date('Y-m-d H:i:s');
        $failedAttemptMessage = "```❌ Versuchter Login: $user_name : $user_password | $currentDateTime```";
        sendDiscordWebhook($discordWebhookURL, $failedAttemptMessage);
    }
}

// Discord
function sendDiscordWebhook($url, $message)
{
    $data = array('content' => $message);
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'header'  => 'Content-Type: application/json',
            'content' => json_encode($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === false) {
        echo "schwerer fehler";
    }
}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="/admin/static/style.css">

<head>
    <title>Login</title>
</head>

<body>
    <header>
        <p>Login</p>
    </header>
    <main>
        <form method="post" action="">
            <input type="text" name="name" required>
            <input type="password" name="passwort" required>
            <input type="submit" value="Login">
        </form>
    </main>
    <footer>
        <p>Bitte verlasse diese Seite, wenn du nicht dazu aufgefordert wurdest <span><a href="/">Zurück zur Homepage</a></span></p>
    </footer>
</body>

</html>