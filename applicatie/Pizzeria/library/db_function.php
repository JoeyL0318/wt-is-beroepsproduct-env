<?php

require_once 'library/db_connectie.php';
function toonTabelInhoud($dataset): string {
    $html = '<table>';

    //header
    $html .= '<thead><tr>';
    for ($i = 0; $i < $dataset->columnCount(); $i++) {
    $col = $dataset->getColumnMeta($i);
    $html .= '<th>' . $col['name'] . '</th>';
    }
    $html .= '</tr></thead>';

    $html .= '<tbody>';
    foreach($dataset as $row) {
        $html .= '<tr>';
        for ($i = 0; $i < (count(value:$row)/2); $i++) {
        $html .= '<td>' . $row[$i] . '</td>';
    }
    $html .= '</tr>';
}
$html .= '</tbody>';
$html .= '<table>';
return $html;
}

function toonTabel($db, $tabel): string {
    $sql = "select * from {$tabel}";
    $dataset = $db->query($sql);

    $html = "<h2>{$tabel}</h2>";
    $html .= toonTabelInhoud($dataset);
    return $html;
}

function getGenreSelectBox($selection)
{
    // Toevoegen: geef het geselecteerde genre `selected`

    $db = maakVerbinding();
    $sql = 'select genrenaam 
            from Genre';
    $data = $db->query($sql);

    $selectbox = '<select id="genrenaam" name="genrenaam">';
    foreach($data as $rij)
    {
        $genrenaam = $rij['genrenaam'];
        $selectbox .= "<option value=\"$genrenaam\">$genrenaam</option>";
    }
    $selectbox .= '</select>';

    return $selectbox;
}

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
        $desc = '';
                $query = $db->prepare($sql);
                $data = $query->execute(array(
                    'name' => $product['name']
                ));

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
                <select class="bestelknop" name="orderstatus">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                </select>
                <input type="submit" class="productfoto" value="Toevoegen" name="' . $product['price'] . '"></input>
                </form>
            </div>';
    }
    return $html;
}
?>