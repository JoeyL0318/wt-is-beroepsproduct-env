<?php 
session_start();
require_once 'library/db_connectie.php';
require_once 'library/db_function.php';

$titel = 'Ristorante Italiano';
$html = showCart();
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
        <title>Winkelwagen - Sole Machina</title>
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
        <h2>Uw winkelwagen</h2>
        <?=$html?>
    </main>
    <footer>
        <a class="basicback" href="pay.php"><h2>Bestelling afronden</h2></a>
    </footer>
</body>
</html>