<?php 
session_start();
require_once 'library/db_connectie.php';

$titel = 'Ristorante Italiano';
$html = '';
if (isset($_SESSION['login'])) {
    $user = $_SESSION['login'];
    $titel = "Welkom {$user}";
}
if (isset($_SESSION['pizmar'])) {
    echo $_SESSION['pizmar'];
}

if (isset($_SESSION['pizmar'])) {
    if ($_SESSION['pizmar'] >= 1) {
        $totprijs = $_SESSION['pizmar'] * 9;
        $html .= '
        <div class="cart">
            <p class="producttitel">Pizza Marinara</p>
            <img class="productfoto" src="images/pizzamarina.png" alt="pizza Marinara">
            <p class="productprijs">€' . $totprijs . '</p>
            <form>
            <label for="amount">Aantal</label>
            <select id="amount" name="amount">
            <option value="one">1</option>
            <option value="two">2</option>
            <option value="thr">3</option>
            <option value="fou">4</option>
            <option value="fiv">5</option>
            <option value="six">6</option>
            <option value="sev">7</option>
            <option value="eig">8</option>
            <option value="nin">9</option>
            <option value="ten">10</option>
            </select>
            </form>
    </div>
        ';
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
        <p>Op dit moment is uw winkelwagen leeg <a class = inlinehref href="menu.php">bekijk het menu en voeg items toe!</a></p>
        <?=$html?>
    </main>
    <footer>
        <a class="basicback" href="pay.php"><h2>Bestelling afronden</h2></a>
    </footer>
</body>
</html>