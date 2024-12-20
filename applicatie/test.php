<?php

    require_once 'db_connectie.php';
    require_once './library/db_function.php';

    $genrenaam = isset($_GET['genrenaam']) ? $_GET['genrenaam'] :''; /*als je tussen de lege '' een standaard meegeeft, wordt niet alles, maar jou keuze laten zien als standaard.*/
    
    $db = maakVerbinding();

    $sql = 'SELECT stuknr, titel, genrenaam, n.omschrijving, c.naam
FROM stuk s
LEFT OUTER JOIN niveau n on s.niveaucode = n.niveaucode
INNER JOIN Componist c on s.componistId = c.componistId
WHERE genrenaam LIKE :genrenaam';

$dataset = $db->prepare($sql);
$dataset->execute(
    [
    'genrenaam' => '%' . $genrenaam . '%'
    ]
);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>PHP voorbeeld</title>
    <link rel="stylesheet" href="/library/tabel.css">
</head>
<body>
    <form action = '' method="get">
    <select id="genrenaam" name="genrenaam">
    <?php echo getGenreSelectBox($genrenaam); ?>
    </select>
    <input type="submit" value="zoek">
    </form>
    <?php
    echo toonTabelInhoud(dataset: $dataset);
    echo toonTabel($db, 'stuk');
    echo toonTabel($db, 'componist');
    ?>
</body>
</html>