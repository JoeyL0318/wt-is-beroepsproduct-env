<?php 
session_start();
require_once 'library/db_connectie.php';
require_once 'library/db_function.php';

$subtitle = subtitle();
$error = '';
$order_id = '';
$adress = '';
$statusdesc = '';
$date = '';
$html = '';
$html1 = '';
$db = maakVerbinding();

if (!isset($_SESSION['login'])) {
    header('location: staff.php'); 
}

if (isset($_GET['manageorder'])) {
    if(isset($_GET['actbestelling'])) {
        unset($_GET['actbestelling']);
    }
    $orderid = isset($_GET['ordernr']) ? sanitize($_GET['ordernr']) : null;
    $orderdesc = orderDetails($orderid);
    $order_id = $orderdesc['order_id'];
    $adress = $orderdesc['address'];
    $statusdesc = $orderdesc['statusdesc'];
    $date = $orderdesc['datetime'];
    $error = $orderdesc['error'];
}

if (isset($_POST['updstatus'])) {
    $status = $_POST['orderstatus'];
    $sql = 'UPDATE Pizza_Order
            SET status = :status
            WHERE order_id = :orderid';
    $query = $db->prepare($sql);
    $result = $query->execute(array(
        'orderid' => $orderid,
        'status' => $status
    ));
    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_GET['sactbestelling'])) {
    if(isset($_GET['actbestelling'])) {
        unset($_GET['actbestelling']);
    }
}
if (isset($_GET['actbestelling'])) {
    if(isset($_GET['sactbestelling'])) {
        unset($_GET['sactbestelling']);
    }
$sql2 = 'SELECT order_id, datetime, address
        FROM Pizza_Order
        WHERE status = 1 OR status = 2';
$query2 = $db->prepare($sql2);
$result = $query2->execute();

$rij = $query2->fetchAll();
if ($rij) {
    foreach ($rij as $order) {
        $order_id = $order['order_id'];
        $adate = strtotime($order['datetime']);
        $date = date('j F Y, H:i',$adate);
        
        $html .= '  <div class="persgrid">
                <p class="ordernr">Nr: ' . $order_id . '</p>
                <p class="ordertijd">Tijd: ' . $date . '</p>';
            $html1 = '';
            $sql3 = 'SELECT *
            FROM Pizza_Order_Product
            WHERE order_id = :orderid';
            $query3 = $db->prepare($sql3);
            $result2 = $query3->execute(array(
                'orderid' => $order_id
            ));

    $rij2 = $query3->fetchAll();
        if ($rij2) {
            foreach ($rij2 as $order2) {
                $itemnaam = $order2['product_name'];
                $aantal = $order2['quantity'];
                $html1 .= $itemnaam . ' - ' . $aantal . '<br>';
                }
            }
            $html .= $html1;
            $html .= '</div>'; 
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
            <h2><?=$subtitle?></h2>
<div class="LRgrid">
    <div class="links">
    <h3>Bestellingen</h3>
        <form method="">
            <input type="submit" class="submit" value="Bekijk alle bestellingen" name="actbestelling">
        </form>
        <form method="">
            <input type="submit" class="submit" value="stoppen" name="sactbestelling">
        </form>
        <?=$html?>
        </div>
        <div class="rechts">
            <h3>Bestelling Beheren</h3>
            <?=$error?>
            <form>
                <label for="ordernr">Ordernummer</label>
                <input type="text" id="ordernr" name="ordernr" placeholder="Ordernummer" required maxlength="6"><br><br>
                <input class="submit" type="submit" value="Beheer bestelling" name="manageorder">
            </form>
            <div class="persgrid">
                <p class="ordernr"> Nr: <?=$order_id?></p>
                <form class="ordertijd" method="post">
                    <label for="orderstatus">Status:</label>
                    <select id="orderstatus" name="orderstatus">
                    <option value="1">Ontvangen</option>
                    <option value="2">Onderweg</option>
                    <option value="3">Bezorgd</option>
                    <input class="submit" type="submit" value="Status Bijwerken" name="updstatus">
                </select>
                </form>
                    <div class="orderextra">
                        <p><?=$adress?></p>
                        <p><?=$date?></p>
                        <p><?=$statusdesc?></p>
                    </div>
            </div>
        </div>
    </div>
    </main>
</body>
</html>