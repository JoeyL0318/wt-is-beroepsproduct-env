<?php 
session_start();
require_once 'library/db_connectie.php';

$titel = 'Ristorante Italiano';
$melding = '';

if (isset($_SESSION['login'])) {
    $user = $_SESSION['login'];
    $titel = "Welkom {$user}";
}

if (isset($_POST['pizmar'])) {
    $knop = $_POST['pizmar'];

    if (!isset($_SESSION[$knop])) {
        $_SESSION[$knop] = 0;
    }
    if ($_SESSION[$knop] < 11) {
    $_SESSION[$knop]++; 
    } else {
        $melding = 'Maximaal aantal van dit item bereikt';
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
    <title>Menukaart - Sole Machina</title>
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
        <?=$melding?>
        <h2>Pizza</h2>
        <div class="flex-container">
            <div class="menugrid">
                <p class="producttitel">Pizza Margherita</p>
                <p class="productdesc">Tomatensaus, kaas en basilicum</p>
                <p class="productprijs">€9,00</p>
                <form method="post">
                <button type="submit" class="bestelknop" name="pizmar">+</button>
                </form>
                <img class="productfoto" src="images/pizzamarg.png" alt="pizza Margherita">
            </div>
            <div class="menugrid">
                <p class="producttitel">Pizza Marinara</p>
                <p class="productdesc">Tomatensaus en basilicum</p>
                <p class="productprijs">€9,00</p>
                <button class="bestelknop">+</button>
                <img class="productfoto" src="images/pizzamarina.png" alt="pizza marinara">
            </div>
            <div class="menugrid">
                <p class="producttitel">Pizza Salami</p>
                <p class="productdesc">Tomatensaus, kaas en salami</p>
                <p class="productprijs">€9,50</p>
                <button class="bestelknop">+</button>
                <img class="productfoto" src="images/pepperoni.png" alt="pizza salami">
            </div>
            <div class="menugrid">
                <p class="producttitel">Pizza Napoli</p>
                <p class="productdesc">Tomatensaus, kaas en ansjovis</p>
                <p class="productprijs">€10,00</p>
                <button class="bestelknop" value="PIZNAP" name="PIZNAP" formmethod="POST">+</button>
                <img class="productfoto" src="images/pizzamarg.png" alt="pizza napoli">
            </div>
            <div class="menugrid">
                <p class="producttitel">Pizza Mixed Grill</p>
                <p class="productdesc">Tomatensaus, mozzarella, rundergehakt & bacon</p>
                <p class="productprijs">€11,00</p>
                <button class="bestelknop">+</button>
                <img class="productfoto" src="images/pizzamixgr.png" alt="pizza mixed grill">
            </div>
            <div class="menugrid">
                <p class="producttitel">Pizza Vegetariana</p>
                <p class="productdesc">Tomatensaus, kaas en diverse groentes</p>
                <p class="productprijs">€10,50</p>
                <button class="bestelknop">+</button>
                <img class="productfoto" src="images/pizzaveg.png" alt="pizza vegetariana">
            </div>
            <div class="menugrid">
                <p class="producttitel">Pizza Sole Machina</p>
                <p class="productdesc">Tomatensaus, mozzarella, ui en rundergehakt</p>
                <p class="productprijs">€11,00</p>
                <button class="bestelknop">+</button>
                <img class="productfoto" src="images/pizzasole.png" alt="pizza sole machina">
            </div>
        </div>
        <h2>Pasta</h2>
        <div class="flex-container">
            <div class="menugrid">
                    <p class="producttitel">Spaghetti Bolognese</p>
                    <p class="productdesc">Tomatensaus, gehakt en verse groente</p>
                    <p class="productprijs">€13,00</p>
                    <button class="bestelknop">+</button>
                    <img class="productfoto" src="images/spagbolo.png" alt="spaghetti bolognese">
            </div>
            <div class="menugrid">
                <p class="producttitel">Spaghetti Carbonara</p>
                <p class="productdesc">Roomsaus, spek en ei</p>
                <p class="productprijs">€13,00</p>
                <button class="bestelknop">+</button>
                <img class="productfoto" src="images/spaghetticarbo.png" alt="Spaghetti carbonara">
            </div>
            <div class="menugrid">
                <p class="producttitel">Tagliatelle Pesto</p>
                <p class="productdesc">Verse pasta met pesto</p>
                <p class="productprijs">€14,00</p>
                <button class="bestelknop">+</button>
                <img class="productfoto" src="images/tagpesto.png" alt="Tagliatelle pesto">
            </div>
            <div class="menugrid">
                <p class="producttitel">Penne Pollo</p>
                <p class="productdesc">Parkrika, roomsaus en kipfilet</p>
                <p class="productprijs">€14,00</p>
                <button class="bestelknop">+</button>
                <img class="productfoto" src="images/penpol.png" alt="Penne pollo">
            </div>
        </div>
        <h2>Drinken</h2>
        <div class="flex-container">
            <div class="menugrid">
                    <p class="producttitel">Blikje Pepsi</p>
                    <p class="productdesc">33cl €0,15 statiegeld</p>
                    <p class="productprijs">€2,15</p>
                    <button class="bestelknop">+</button>
                    <img class="productfoto" src="images/pepsican.png" alt="Blik pepsi">
            </div>
            <div class="menugrid">
                <p class="producttitel">Blikje Pepsi-max</p>
                <p class="productdesc">33cl €0,15 statiegeld</p>
                <p class="productprijs">€2,15</p>
                <button class="bestelknop">+</button>
                <img class="productfoto" src="images/pepsimaxcan.png" alt="Blik pepsi max">
            </div>
            <div class="menugrid">
                <p class="producttitel">Blikje 7-up</p>
                <p class="productdesc">33cl €0,15 statiegeld</p>
                <p class="productprijs">€2,15</p>
                <button class="bestelknop">+</button>
                <img class="productfoto" src="images/sevenupcan.png" alt="Blik seven-up">
            </div>
            <div class="menugrid">
                <p class="producttitel">Blikje Fanta</p>
                <p class="productdesc">33cl €0,15 statiegeld</p>
                <p class="productprijs">€2,15</p>
                <button class="bestelknop">+</button>
                <img class="productfoto" src="images/fantacan.png" alt="Blik fanta">
            </div>
            <div class="menugrid">
                <p class="producttitel">Blikje Fanta-zero</p>
                <p class="productdesc">33cl €0,15 statiegeld</p>
                <p class="productprijs">€2,15</p>
                <button class="bestelknop">+</button>
                <img class="productfoto" src="images/fantazerocan.png" alt="Blik fanta zero sugar">
            </div>
            <div class="menugrid">
                <p class="producttitel">Fles spa-blauw</p>
                <p class="productdesc">50cl €0,15 statiegeld</p>
                <p class="productprijs">€2,65</p>
                <button class="bestelknop">+</button>
                <img class="productfoto" src="images/spablauw.png" alt="Fles spa niet-bruisend">
            </div>
            <div class="menugrid">
                <p class="producttitel">Fles spa-rood</p>
                <p class="productdesc">50cl €0,15 statiegeld</p>
                <p class="productprijs">€2,65</p>
                <button class="bestelknop">+</button>
                <img class="productfoto" src="images/sparood.png" alt="Fles spa bruisend">
            </div>
        </div>
    </main>
</body>
</html>