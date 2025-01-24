<?php 
session_start();
require_once 'library/db_connectie.php';
require_once 'library/db_function.php';

$subtitle = subtitle();
$order_id = '';
$adress = '';
$statusdesc = '';
$date = '';
$error = '';

if (isset($_GET['statuscheck'])) {
    $orderid = isset($_GET['ordernr']) ? sanitize($_GET['ordernr']) : null;
    $orderdesc = orderDetails($orderid);
    $order_id = $orderdesc['order_id'];
    $adress = $orderdesc['address'];
    $statusdesc = $orderdesc['statusdesc'];
    $date = $orderdesc['datetime'];
    $error = $orderdesc['error'];
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
<?=include('header.php')?>
    <main>
        <h2>Bekijk de status van uw bestelling</h2>
        <?=$error?>
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
        <p>Status: <?=$statusdesc?></p>
        <p>Besteld op: <?=$date?></p>
        <p>Adres: <?=$adress?></p>
    </footer>
</body>
</html>