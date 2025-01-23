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
    <title>Home - Sole Machina</title>
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
    <li id="righttab"><a href="staff.php">Personeel</a></li>
</ul>
    </nav>
    <main class="flex-container">
        <img src="images/actieposter1.png" alt="1+1 gratis actie, gebruik code lekkerzeg24">
        <img src="images/actieposter2.png" alt="Onze pizzeria">
        <img src="images/actieposter4.png" alt="Onze pizza chef">
    </main>
    <footer>
        <h2>Contact:</h2>
        <ul class="centrline">
            <li><a href="tel:031803292309">Telefoon: 0318-0329-2309</a></li>
            <li><a href="mailto:j.lam2@student.han.nl" target="blank" rel="noopener noreferrer">Mail ons</a></li>
            <li><a href="https://www.google.com/maps/place/Oude+Stationsstraat,+Arnhem/@51.9840314,5.9025446,215m/data=!3m1!1e3!4m6!3m5!1s0x47c7a5b6c0215cb7:0x41aeb1ba813116c2!8m2!3d51.9840118!4d5.903139!16s%2Fg%2F1tfb5t7m?entry=ttu&g_ep=EgoyMDI0MTExOS4yIKXMDSoASAFQAw%3D%3D" target="blank" rel="noopener noreferrer">675 Oude Stationsstraat 6811KE Arnhem</a></li>
        </ul>
    </footer>
</body>
</html>