<?php 
session_start();
require_once 'library/db_connectie.php';

$titel = 'Ristorante Italiano';
$melding = '';
$order_id = '';
$adres = '';
$statusomschr = '';
$normaldate = '';
$html = '';


function sanitize($value): string
{
    return htmlspecialchars(strip_tags($value));
}

if (isset($_SESSION['login'])) {
    $user = $_SESSION['login'];
    $titel = "Welkom {$user}";
}


if (isset($_GET['statuscheck'])) {
    $orderid = isset($_GET['ordernr']) ? sanitize($_GET['ordernr']) : null;
    if ($_GET['ordernr' === null]) {
        $melding = 'Vul een ordernummer in.';
    } else {
        $db = maakVerbinding();
        $sql = 'SELECT * FROM Pizza_order WHERE order_id = :orderid';
        $query = $db->prepare($sql);
        $data = $query->execute(array(
            'orderid' => $orderid
        ));
        if ($rij = $query->fetch()) {
            $order_id = $rij['order_id'];
            $status = $rij['status'];
            $adres = $rij['address'];
            $date = strtotime($rij['datetime']);
            $normaldate = date('j F Y, H:i',$date);
            if ($status == 1) {
                $statusomschr = 'Ontvangen';
            } elseif ($status == 2) {
                $statusomschr = 'Bezorger onderweg';
            } elseif ($status == 3) {
                $statusomschr = 'Bezorgd';
            }
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
        <form method="" action="">
            <label for="ordernr">Uw ordernummer</label>
                <input type="text" id="ordernr" name="ordernr" placeholder="Bijv. 82RTP1" required maxlength="6"><br><br>
                <input class="submit" type="submit" value="statuscheck" name="statuscheck">
        </form>
        <p>Kunt u uw ordernummer niet vinden? Bel ons restaurant en wij helpen u graag!</p>
        <p><a href="tel:031803292309">0318-0329-2309</a></p>
    </main>
    <footer class="order">
        <h2>Bestelling <?=$order_id?> </h2>
        <p>Status: <?=$statusomschr?></p>
        <p>Besteld op: <?=$normaldate?></p>
        <p>Adres: <?=$adres?></p>
    </footer>
</body>
</html>