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
//Extra toevoegen in winkelkar
if (isset($_POST['Marg'])) {
    addToCart('Marg'); 
}
if (isset($_POST['Knof'])) {
    addToCart('Knof'); 
}
if (isset($_POST['Hawa'])) {
    addToCart('Hawa'); 
}
if (isset($_POST['Comb'])) {
    addToCart('Comb'); 
}
if (isset($_POST['Pepp'])) {
    addToCart('Pepp'); 
}
if (isset($_POST['Vege'])) {
    addToCart('Vege'); 
}
if (isset($_POST['Spri'])) {
    addToCart('Spri'); 
}
if (isset($_POST['Coca'])) {
    addToCart('Coca'); 
}

// Verwijderen los item uit winkelkar.
if (isset($_POST['Mar'])) {
    removeOneFromCart('Marg'); 
}
if (isset($_POST['Kno'])) {
    removeOneFromCart('Knof'); 
}
if (isset($_POST['Haw'])) {
    removeOneFromCart('Hawa'); 
}
if (isset($_POST['Com'])) {
    removeOneFromCart('Comb'); 
}
if (isset($_POST['Pep'])) {
    removeOneFromCart('Pepp'); 
}
if (isset($_POST['Veg'])) {
    removeOneFromCart('Vege'); 
}
if (isset($_POST['Spr'])) {
    removeOneFromCart('Spri'); 
}
if (isset($_POST['Coc'])) {
    removeOneFromCart('Coca'); 
}
//product uit winkelkar verwijderen
if (isset($_POST['arg'])) {
    removeFromCart('Marg'); 
}
if (isset($_POST['nof'])) {
    removeFromCart('Knof'); 
}
if (isset($_POST['awa'])) {
    removeFromCart('Hawa'); 
}
if (isset($_POST['omb'])) {
    removeFromCart('Comb'); 
}
if (isset($_POST['epp'])) {
    removeFromCart('Pepp'); 
}
if (isset($_POST['ege'])) {
    removeFromCart('Vege'); 
}
if (isset($_POST['pri'])) {
    removeFromCart('Spri'); 
}
if (isset($_POST['oca'])) {
    removeFromCart('Coca'); 
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