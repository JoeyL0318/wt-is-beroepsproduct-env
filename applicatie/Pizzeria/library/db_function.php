<?php

require_once 'library/db_connectie.php';

function sanitize($value): string
{
    return htmlspecialchars(strip_tags($value));
}

function subtitle() : string {
    if (isset($_SESSION['login'])) {
    $user = $_SESSION['login'];
    return "Welkom {$user}";
} else {
    return 'Ristorante Italiano'; 
    } 
}

function orderDetails($orderid) {
    $orderDetails = [
        'order_id' => null,
        'statusdesc' => null,
        'datetime' => null,
        'address' => null,
        'error' => '',
    ];

        $db = maakVerbinding();
        $sql = 'SELECT order_id, datetime, status, address FROM Pizza_order WHERE order_id = :orderid';
        $query = $db->prepare($sql);
        $data = $query->execute(array(
            'orderid' => $orderid
        ));
        if ($rij = $query->fetch()) {
            $orderDetails['order_id'] = $rij['order_id'];
            $orderDetails['status'] = $rij['status'];
            $orderDetails['address'] = $rij['address'];
            $date = strtotime($rij['datetime']);
            $orderDetails['datetime'] = date('j F Y, H:i',$date);
            $status = $rij['status'];
            if ($status == 1) {
                $orderDetails['statusdesc'] = 'Ontvangen door het restaurant';
            } elseif ($status == 2) {
                $orderDetails['statusdesc'] = 'Bezorger onderweg';
            } elseif ($status == 3) {
                $orderDetails['statusdesc'] = 'Bezorgd op het opgegeven adres';
            }
        } else {
            $orderDetails['error'] = 'Geen bestelling gevonden';
        }
    return $orderDetails;
}

function productInfo($category) {
    $menu[$category] = null;
    $db = maakVerbinding();
    $sql = 'SELECT name, price, type_id
            FROM Product
            WHERE type_id = :category';
    $query = $db->prepare($sql);
    $data = $query->execute(array(
        'category' => $category
    ));
    $row = $query->fetchAll();
    if ($row) {
        foreach ($row as $product) {
            $menu[$category][$product['name']] = [
                'name' => $product['name'],
                'price' => $product['price']
            ];
        }
    }
    return $menu;
}

function menuItem($category) {
    $menu = productInfo($category);
    $db = maakVerbinding();
    $sql = 'SELECT ingredient_name FROM Product_Ingredient WHERE product_name = :name';
    $html = '';
    foreach($menu[$category] as $product) {
        if (!isset($_SESSION['cart'][substr($product['name'],0,4)])) {
            $_SESSION['cart'][substr($product['name'],0,4)] = [
                'quantity' => 0,    
                'name' => $product['name'],
                'price' => $product['price']
            ]; 
        }
        $query = $db->prepare($sql);
                $data = $query->execute(array(
                    'name' => $product['name']
                ));
        $desc = '';

                $row = $query->fetchAll();
                if ($row) {
                    foreach ($row as $ingredient) {
                        $desc .= $ingredient['ingredient_name'] . ' ';
                    }
                }

             $html .= '<div class="menugrid">
                <p class="producttitel">' . $product['name'] . '</p>
                <p class="productdesc">' . $desc . '</p>
                <p class="productprijs">' . $product['price'] . '</p>
                <form method="post">
                <input type="submit" class="bestelknop" value="Toevoegen" name="' . substr($product['name'],0,4) . '">
                </form>
                <p class="productfoto"> ' . $_SESSION['cart'][substr($product['name'],0,4)]['quantity'] . '</p>
            </div>';
    }
    return $html;
}

function addToCart($product) {
    if (!isset($_SESSION['cart'][$product])) {
        $_SESSION['cart'][$product] = [
            'quantity' => 0
        ]; 
    }
        $_SESSION['cart'][$product]['quantity']++;
}

function removeOneFromCart($product) {
    if ($_SESSION['cart'][$product]['quantity'] > 0) {
    $_SESSION['cart'][$product]['quantity']--;
    }
}
function removeFromCart($product) {
    $_SESSION['cart'][$product]['quantity'] = 0;
}

function showCart() {
    $html = '';
    $cartFilled = false;
    if (empty($_SESSION['cart'])) {
        $html = '<p>Op dit moment is uw winkelwagen leeg <a class = inlinehref href="menu.php">bekijk het menu en voeg items toe!</a></p>';
    } else {
    foreach ($_SESSION['cart'] as $product) {
        if ($product['quantity'] >= 1) {
            $totprijs = $product['quantity'] * $product['price'];
            $html .= '
             <div class="cart">
             <p class="text2">Aantal</p>
             <p class="text3">Tot. prijs</p>
            <p class="producttitel">' . $product['name'] .'</p>
            <p class="productfoto">' . $product['quantity'] .'</p>
            <p class="productprijs">€' . $totprijs . '</p>
            <form method="post">
            <input type="submit" class="bestelknop" value="-" name="' . substr($product['name'],0,3) . '">
            </form>
            <form method="post">
            <input type="submit" class="bestelknop" value="+" name="' . substr($product['name'],0,4) . '">
            </form>
            <form method="post">
            <input type="submit" class="bestelknop" value="Verwijderen" name="' . substr($product['name'],1,3) . '">
            </form>
            </div>
            ';
            $cartFilled = true;
        } 
        }
    }
    if (!$cartFilled) {
        $html = '<p>Op dit moment is uw winkelwagen leeg <a class = inlinehref href="menu.php">bekijk het menu en voeg items toe!</a></p>';
        } 
    return $html;
}

function placeOrder($name, $adress) {
    $db = maakVerbinding();
    $user = null;
    $sql = "INSERT INTO Pizza_Order VALUES
                (:user, :client_name, 'henk', :datetime, '1', :adress)";
    $date = date("Y-m-d H:i:s");
    if(isset($_SESSION['login'])) {
        $user = $_SESSION['login']; 
    }
    $query = $db->prepare($sql);
    $data = $query->execute(array(
        'client_name' => $name,
        'adress' => $adress,
        'user' => $user,
        'datetime' => $date
    ));
}

function findHighestOrder() {
    $db = maakVerbinding();
    $sql = 'SELECT MAX(order_id) AS nr
            FROM Pizza_Order';
    $query = $db->prepare($sql);
    $data = $query->execute();
    $row = $query->fetch();
    $ordernr = $row['nr'];

    return $ordernr;
}

function placeProductOrder($winkelwagen) {
    $newnr = findHighestOrder();
    $db = maakVerbinding();
    $sql = 'INSERT INTO Pizza_Order_Product (order_id, product_name, quantity) VALUES (:order_id, :product_name, :quantity)';
    $query = $db->prepare($sql);
    foreach ($winkelwagen as $product => $item) { 
        if($item['quantity'] > 0) {
    $data = $query->execute(array(
        'order_id' => $newnr,
        'product_name' => $item['name'],
        'quantity' => $item['quantity']
    ));
    unset($_SESSION['cart']);
    header("location: order.php?ordernr=$newnr&statuscheck=statuscheck");
        }
    }
}