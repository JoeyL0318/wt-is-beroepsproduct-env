<?php

$vandaag = date_create('now');
$sinterklaas = date_create('2024-12-05');
$datediff = date_diff($vandaag,$sinterklaas);
$santaklaus = $datediff->format("%a dagen");

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>PHP voorbeeld</title>
</head>
<body>
    Het duurt nog <?= $santaklaus ?> tot sinterklaas.
</body>
</html>
