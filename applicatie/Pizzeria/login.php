<?php

require_once 'library/db_connectie.php';
session_start();
$melding = '';
$titel = 'Ristorante Italiano';
$html = '';
function sanitize($value): string
{
    return htmlspecialchars(strip_tags($value));
}

if (isset($_SESSION['login'])) {
    $user = $_SESSION['login'];
    $melding = 'User is logged in';
    $titel = "Welkom {$user}";
    $html = '<form method="post" action="">
        <input class="submit" type="submit" value="logout">
        </form>';  
} else {
    $html = ' <div>
            <h2>Inloggen</h2>
    <form method="post" action="">
        <label for="naam">Gebruikersnaam</label>
        <input type="text" id="naam" name="naam" placeholder="Gebruikersnaam" required><br><br>
        <label for="pass">Wachtwoord</label>
        <input type="password" id="wachtwoord" name="wachtwoord" placeholder="Wachtwoord" required><br><br>
        <input class="submit" type="submit" value="login">
    </form>
        </div>
        <div>
            <h2>Registreren</h2>
            <form method="post" action="">
                <label for="mailadres">E-mailadres</label>
                <input type="text" id="mailadres" name="mailadres" placeholder="E-mailadres" required><br><br>
                <label for="wachtwoord">Kies uw wachtwoord (min. 8 tekens)</label>
                <input type="password" id="wachtwoord" name="wachtwoord" placeholder="Wachtwoord" minlength="8" maxlength="20" required><br><br>
                <label for="bwachtwoord">Bevestig wachtwoord</label>
                <input type="password" id="bwachtwoord" name="bwachtwoord" placeholder="Wachtwoord" minlength="8" maxlength="20" required><br><br>
                <label for="strhuis">Straat en huisnummer</label>
                <input type="text" id="strhuis" name="strhuis" placeholder="Bijv. Parkweide 14" required><br><br>
                <label for="postcode">Postcode</label>
                <input type="text" id="postcode" name="postcode" placeholder="Bijv. 6718DJ" maxlength="6" required><br><br>
                <label for="plaats">Plaats</label>
                <input type="text" id="plaats" name="plaats" placeholder="Bijv. Ede" required><br><br>

                <input class="submit" type="submit" value="Registreren" onclick="">
            </form>
        </div>';
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

if (isset($_POST['logout'])) {
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Log in - Sole Machina</title>
</head>
<body class="grid-container">
    <header>
<h1>Sole Machina</h1>
<h3><?=$titel?></h3>
    </header>
    <nav>
<ul>
    <li><a href="menu.html">Menu</a></li>
    <li><a href="cart.php">Winkelwagen</a></li>
    <li><a href="login.html">Account</a></li>
    <li><a href="bestelling.html">Mijn Order</a></li>
    <li><a href="about.html">Over ons</a></li>
    <li id="righttab"><a href="index.html">Home</a></li>
</ul>
    </nav>
    <main>
        <?= $melding?>
        <?=$html?>
    </main>
</body>
</html>