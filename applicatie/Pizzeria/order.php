<?php 
session_start();
$titel = 'Ristorante Italiano';

if (isset($_SESSION['login'])) {
    $user = $_SESSION['login'];
    $titel = "Welkom {$user}";

    
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
    <title>Uw bestelling - Sole Machina</title>
</head>
<body class="grid-container">
    <header>
<h1>Sole Machina</h1>
<h3><?=$titel?></h3>
    </header>
    <nav>
<ul>
    <li><a href="menu.php">Menu</a></li>
    <li><a href="cart.php">Winkelwagen</a></li>
    <li><a href="login.php">Account</a></li>
    <li><a href="order.php">Mijn Order</a></li>
    <li><a href="about.php">Over ons</a></li>
    <li id="righttab"><a href="index.php">Home</a></li>
</ul>

    </nav>
    <main>
        <h2>Bekijk de status van uw bestelling</h2>
        <form>
            <label for="ordernr">Uw ordernummer</label>
                <input type="text" id="ordernr" name="ordernr" placeholder="Bijv. 82RTP1" required minlength="6" maxlength="6"><br><br>
                <input class="submit" type="submit" value="Bekijk status">
        </form>
        <p>Kunt u uw ordernummer niet vinden? Bel ons restaurant en wij helpen u graag!</p>
        <p><a href="tel:031803292309">0318-0329-2309</a></p>
    </main>
    <footer>
        <h2>Bestelling 82RTP1</h2>
        <p>Status: ontvangen</p>
        <p>Type: Bezorging</p>
        <p>Tijd: 18:00</p>
        <p>Ruitenberglaan 26</p>
        <p>6826CC</p>
        <p>Arnhem</p>
    </footer>
</body>
</html>