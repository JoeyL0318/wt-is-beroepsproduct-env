<?php

require_once 'db_connectie.php';
function sanitize($value): string
{
    return htmlspecialchars(strip_tags($value));
}

$melding = '';
var_dump($_POST );
if (isset($_POST['registreren'])) {
    $username = isset($_POST['naam']) ? sanitize($_POST['naam']) : null;
    $password = isset($_POST['wachtwoord']) ? sanitize($_POST['wachtwoord']) : null;

    if ($username === null || $password === null) {
        $melding = 'missing username or password';
    } else {
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);

        $db = maakVerbinding();
        $sql = 'insert into login (username, password) values (:username, :passwordhash)';
        $query = $db->prepare($sql);
        $succes = $query->execute(array(
            'username' => $username,
            'passwordhash' => $passwordhash
        ));
        if ($succes) {
            $melding = "gebruiker geregistreerd";
        } else {
            $melding = "registratie mislukt";
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
                <td><input type="submit" name="registreren" value="registreren"></td>
            </tr>
        </table>
    </form>
    <?= $melding ?>
</body>

</html>