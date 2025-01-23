<?php 
session_start();
require_once 'library/db_connectie.php';

$titel = '';
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
} else {
    header('location: staff.php');
}


if (isset($_GET['manageorder'])) {
    $orderid = isset($_GET['ordernr']) ? sanitize($_GET['ordernr']) : null;
    if ($_GET['ordernr'] === null) {
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
    <title>Insite - Sole Machina</title>
</head>
<body class="grid-container">
    <header>
<h1>Sole Machina</h1>
<h3>-Personeel Insite-</h3>
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
            <h2><?=$titel?></h2>
            <?=$melding?>
<div class="LRgrid">
        <div class="links">
            <h3>Actuele Bestellingen</h3>
            <p>Er zijn op dit moment geen bestellingen</p>
            <div class="persgrid">
                <p class="ordernr"> Nr: </p>
                <p class="ordertijd">T: 18:00</p>
                <P class="itemnaam">Pizza Margherita</p>
                <p class="itemaantal">A: 1x</p>
            </div>
        </div>
        <div class="rechts">
            <h3>Bestelling Beheren</h3>
            <form>
                <label for="ordernr">Ordernummer</label>
                <input type="text" id="ordernr" name="ordernr" placeholder="Ordernummer" required maxlength="6"><br><br>
                <input class="submit" type="submit" value="Beheer bestelling" name="manageorder">
            </form>
            <div class="persgrid">
                <p class="ordernr"> Nr: <?=$order_id?></p>
                <form class="ordertijd">
                    <label for="orderstatus">Status:</label>
                    <select id="orderstatus" name="orderstatus">
                    <option value="1">Ontvangen</option>
                    <option value="2">Onderweg</option>
                    <option value="3">Bezorgd</option>
                    <input class="submit" type="submit" value="Status Bijwerken" name="updstatus">
                </select>
                </form>
                    <div class="orderextra">
                        <p><?=$adres?></p>
                        <p><?=$normaldate?></p>
                        <p><?=$statusomschr?></p>
                    </div>
            </div>
        </div>
    </div>
    </main>
</body>
</html>