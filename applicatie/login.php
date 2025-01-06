<?php

require_once 'db_connectie.php';
session_start();
$melding = '';
function sanitize($value): string
{
    return htmlspecialchars(strip_tags($value));
}

if (isset($_SESSION['login'])) {
    $melding = 'User is logged in';
}

if (isset($_POST['login'])) {
    $username = isset($_POST['naam']) ? sanitize($_POST['naam']) : null;
    $password = isset($_POST['wachtwoord']) ? sanitize($_POST['wachtwoord']) : null;

    if ($username === null || $password === null) {
        $melding = 'missing username or password';
    } else {
        $db = maakVerbinding();
        $sql = 'SELECT * FROM LOGIN WHERE username = :username';
        $query = $db->prepare($sql);
        $data = $query->execute(array(
            'username' => $username
        ));

        if ($rij = $query->fetch()) {
            if (password_verify($password, $rij['password'])) {
                $melding = 'combination correct';
                $_SESSION['login'] = $username;
            } else {
                $melding = 'password not found';
            }
        } else {
            $melding = 'username not found';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
</head>

<body>
    <form method="post" action="">
        <table>
            <tr>
                <td><label for="naam">naam</label></td>
                <td><input type="text" id="naam" name="naam"></td>
            </tr>
            <tr>
                <td><label for="wachtwoord">wachtwoord</label></td>
                <td><input type="password" id="wachtwoord" name="wachtwoord"></td>
            </tr>
            <tr>
                <td> </td>
                <td><input type="submit" name="login" value="login"></td>
            </tr>
        </table>
    </form>
    <?= $melding ?>
</body>

</html>