<?php

require_once 'db_connectie.php';
function sanitize($value): string {
    return htmlspecialchars(strip_tags($value));
}

$melding = '';
if (isset($_POST['registreren'])) {
    $username = isset($_POST['naam']) ? sanitize($_POST['naam']) : null;
    $password = isset($_POST['pass']) ? sanitize($_POST['pass']) : null;
    
    if ($username === null || $password === null) {
        $melding = 'missing username or password';
    } else {
    $passwordhash = password_hash($password, PASSWORD_DEFAULT);

    $db = maakVerbinding();
    $sql = 'insert into login (username, password) values (:username, :passwordhash)';
    $query = $db->prepare($sql);
    $succes = $query->execute(array(
        'username' => $username,
        'password' => $passwordhash
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
    <body>
        <form method="post" action="">
        <input type="text" name="naam" id="naam" required placeholder="gebruikersnaam">
        <input type="password" name="pass" id="pass" required placeholder="wachtwoord">
        <input type="submit" name="registreren" value="registreren">
        </form>
        <?=$melding?>
    </body>
</html>