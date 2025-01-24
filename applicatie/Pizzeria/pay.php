<?php
session_start();
require_once 'library/db_function.php';

$subtitle = subtitle();

if (isset($_POST['orderplc'])) {
    $name = isset($_POST['name']) ? sanitize($_POST['name']) : null;
    $address = isset($_POST['delad']) ? sanitize($_POST['delad']) : null;
    placeOrder($name, $address);
    placeProductOrder($_SESSION['cart']);
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
    <title>Afronden - Sole Machina</title>
</head>
<body class="grid-container">
<?php include('header.php');?>
    <main>
        <h2>Bestelling afronden <i class="fa-solid fa-pizza-slice"></i></h2>
        <form method="post">
            <h3>Wie bent u?</h3>
                <label for="vnaam">Volledige naam</label>
                <input type="text" id="name" name="name" placeholder="Uw naam" required minlength="3" maxlength="30"><br><br>
                <h3>Uw adres</h3>
                <label for="strhuis">Volledig adres</label>
                <input type="text" id="delad" name="delad" placeholder="Bijv. Parkweide 14 8172DJ Ede" required><br><br>
                <input class="submit" type="submit" value="Bestelling plaatsen" name="orderplc">
        </form>
    </main>
</body>
</html>