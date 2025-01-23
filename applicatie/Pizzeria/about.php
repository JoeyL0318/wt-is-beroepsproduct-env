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
    <title>Over ons - Sole Machina</title>
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
    <main class="middle">
        <h2>La nostra storia</h2>
        <p>In 1975 kwam ik naar Nederland vanuit Napoli, ik heb mijn liefde voor eten van mijn grootmoeder gekregen. 
            In Nederland kon ik in 1985 mijn droom van mijn eigen pizzeria waarmaken. Nu serveren wij al 39 jaar authentieke pizza uit Napels in hartje Arnhem.
        Al onze pizza is met passie bereid en bevat alleen verse ingrediënten!</p>
        <h2>Openingstijden:</h2>
            <p>Maandag t/m donderdag: 16:00-23:00</p>
            <p>Vrijdag: 15:00-00:00</p>
            <p>Zaterdag: 12:00-02:00</p>
            <p>Zondag: Gesloten</p>  
    </main>
</body>
</html>