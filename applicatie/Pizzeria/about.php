<?php 
session_start();

require_once 'library/db_function.php';
$subtitle = subtitle();
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
<?php include('header.php');?>
<body class="grid-container">
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