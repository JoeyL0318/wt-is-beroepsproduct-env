<?php 
session_start();
require_once 'library/db_connectie.php';
require_once 'library/db_function.php';

$subtitle = subtitle();

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

$htmlp = menuItem('Pizza');
$htmld = menuItem('Drank');
$htmlm = menuItem('Maaltijd');
$htmlv = menuItem('Voorgerecht');

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
<?=include('header.php')?>
    <main>
        <h2>Pizza</h2>
        <div class="flex-container">
            <?=$htmlp?>
            </div>
        <h2>Maaltijd</h2>
        <div class="flex-container">
        <?=$htmlm?>
        </div>
        <h2>Voorgerechten</h2>
        <div class="flex-container">
        <?=$htmlv?> 
        </div>
        <h2>Drinken</h2>
        <div class="flex-container">
        <?=$htmld?>
        </div>
    </main>
</body>
</html>