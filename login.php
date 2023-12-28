<?php
session_start();

$profiles = array(
    'username123' => 'passwort123'
);

$discordHook = 'https://discord.com/api/webhooks/1189786963830644756/9wjnccqs-fPNQkzOgZIFQNGTYqnFnS7RJ2EPDuMfwri9YsUMADTtPfdJZVIDzGAuJkNr';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_password = $_POST['password'] ?? '';
    $user_name = $_POST['name'] ?? '';

    if (array_key_exists($user_name, $profiles) && $profiles[$user_name] === $user_password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user_name;
        $currentDateTime = date('d.m.Y H:i:s');
        $message = "```✅ Login: $user_name | $currentDateTime```";
        sendDiscord($discordHook, $message);
        header('Location: ./index.php');
        exit;
    } else
        $currentDateTime = date('d.m.Y H:i:s');
    $failMessage = "```❌ Versuchter Login: $user_name : $user_password | $currentDateTime```";
    sendDiscord($discordHook, $failMessage);
}

function sendDiscord($url, $message)
{
    $data = array('content' => $message);
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($data)
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === false) {
        echo "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <header>Login</header>
    <main>
        <form action="" method="post">
            <input type="text" name="name" required>
            <input type="password" name="password" required>
            <input type="submit" value="Login">
        </form>
    </main>
</body>

</html>