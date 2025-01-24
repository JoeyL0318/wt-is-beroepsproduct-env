<?php

require_once 'library/db_connectie.php';
require_once 'library/db_function.php';

session_start();
$melding = '';
$subtitle = subtitle();
$html = "";

if (isset($_SESSION['login'])) {
    $user = $_SESSION['login'];
    $melding = 'User is logged in <br>';
    $html = '<a href="logout.php">Log Uit</a>';  

    $db = maakVerbinding();
    $sql = 'SELECT * FROM Pizza_order WHERE client_username = :user';
    $query = $db->prepare($sql);
    $data = $query->execute(array(
        'user' => $user
    ));
    $rij = $query->fetchAll();
    if ($rij) {
        foreach ($rij as $order) {
        $order_id = $order['order_id'];
        $status = $order['status'];
        $adres = $order['address'];
        $date = strtotime($order['datetime']);
        $normaldate = date('j F Y, H:i',$date);
        
        if ($status == 1) {
            $statusomschr = 'Ontvangen';
        } elseif ($status == 2) {
            $statusomschr = 'Bezorger onderweg';
        } elseif ($status == 3) {
            $statusomschr = 'Bezorgd';
        }
            $html .= '<div class="order">
        <h2>Bestelling ' . $order_id . '</h2>
        <p>Status: ' . $statusomschr . '</p>
        <p>Besteld op: ' . $normaldate . '</p>
        <p>Adres: ' . $adres . '</p>
    </div>';
        }
    }
} else {
    $html = ' <div>
            <h2>Inloggen</h2>
    <form method="post" action="">
        <label for="naam">Gebruikersnaam</label>
        <input type="text" id="naam" name="naam" placeholder="Gebruikersnaam" required><br><br>
        <label for="pass">Wachtwoord</label>
        <input type="password" id="wachtwoord" name="wachtwoord" placeholder="Wachtwoord" required><br><br>
        <input class="submit" type="submit" value="login" name="login">
    </form>
        </div>
        <div>
            <h2>Registreren</h2>
            <form method="post" action="">
                <label for="naam">Gebruikersnaam</label>
                <input type="text" id="naam" name="naam" placeholder="Gebruikersnaam" required><br><br>
                <label for="wachtwoord">Kies uw wachtwoord (min. 8 tekens)</label>
                <input type="password" id="wachtwoord" name="wachtwoord" placeholder="Wachtwoord" minlength="8" maxlength="20" required><br><br>
                <label for="adres">Adres</label>
                <input type="text" id="adres" name="adres" placeholder="Bijv. Parkweide 14 6718DJ Ede" required><br><br>
                <label for="fname">Voornaam</label>
                <input type="text" id="fname" name="fname" placeholder="Voornaam" required><br><br>
                <label for="lname">Achternaam</label>
                <input type="text" id="lname" name="lname" placeholder="Achternaam" required><br><br>
                <input class="submit" type="submit" name="registreren" value="registreren">
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
        $sql = 'SELECT * FROM [User] WHERE username = :username';
        $query = $db->prepare($sql);
        $data = $query->execute(array(
            'username' => $username
        ));

        if ($rij = $query->fetch()) {
            if (password_verify($password, $rij['password'])) {
                $rol = $rij['role'];
                $_SESSION['login'] = $username;
                $_SESSION['role'] = $rol;
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                $melding = 'password not found';
            }
        } else {
            $melding = 'username not found';
        }
    }
}

if (isset($_POST['registreren'])) {
    $username = isset($_POST['naam']) ? sanitize($_POST['naam']) : null;
    $password = isset($_POST['wachtwoord']) ? sanitize($_POST['wachtwoord']) : null;
    $address = isset($_POST['adres']) ? sanitize($_POST['adres']) : null;
    $fname = isset($_POST['fname']) ? sanitize($_POST['fname']) : null;
    $lname = isset($_POST['lname']) ? sanitize($_POST['lname']) : null;
    $client = 'Client';
    
    if ($username === null || $password === null || $address === null || $fname === null || $lname === null) {
        $melding = 'Er ontbreekt informatie, uw registratie is mislukt.';
    } else {
    $passwordhash = password_hash($password, PASSWORD_DEFAULT);

    $db = maakVerbinding();
    $sql = "insert into [User] (username, password, first_name, last_name, address, role) values (:username, :password, :fname, :lname, :address, :role)";
    $query = $db->prepare($sql);
    $succes = $query->execute(array(
        'username' => $username,
        'password' => $passwordhash,
        'fname' => $fname,
        'lname' => $lname,
        'address' => $address,
        'role' => $client,
    ));
    if ($succes) {
        echo "<meta http-equiv='refresh' content='0'>";
        $melding = "gebruiker geregistreerd";
    } else {
        $melding = "registratie mislukt";
         }
     } 
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
<?=include('header.php')?>
    <main>
        <?= $melding?>
        <?=$html?>
    </main>
</body>
</html>