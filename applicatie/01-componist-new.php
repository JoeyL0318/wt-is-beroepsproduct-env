<?php

require_once 'db_connectie.php';
if (isset($_POST['opslaan'])); {
// 4 kolommen, dus ook 4 variabelen
$componistId    = $_POST['componistId'];
$naam           = $_POST['naam'];
$geboortedatum  = $_POST['geboortedatum'];
$schoolId       = $_POST['schoolId'];

// Controleer niet verplichte velden
if (empty($geboortedatum)) {
    $geboortedatum = null;
}
if (empty($schoolId)) {
    $schoolId = null;
}

$db = maakVerbinding();

// Insert query
$sql = 'INSERT INTO componist (componistId, naam, geboortedatum, schoolId)
        VALUES (:componistId, :naam, :geboortedatum, :schoolId);'; 
$query = $db->prepare($sql);
$data_array = [
    'componistId' => $componistId,
    'naam' => $naam,
    'geboortedatum' => $geboortedatum,
    'schoolId' => $schoolId,
];
$succes = $query->execute($data_array);

if ($succes) {
    $melding = 'Gegevens zijn opgeslagen in de database.';
    }
}
    else {
    $melding = '';
    }
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Componinst - nieuw</title>
    <link href="css/normalize.css" rel="stylesheet" >
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div>
    <form action="01-componist-new.php" method="post">
        <label for="componistId">componistId</label>
        <input type="text" id="componistId" name="componistId"><br>

        <label for="naam">naam</label>
        <input type="text" id="naam" name="naam"><br>

        <label for="geboortedatum">geboortedatum</label>
        <input type="date" id="geboortedatum" name="geboortedatum"><br>

        <label for="schoolId">schoolId</label>
        <input type="text" id="schoolId" name="schoolId"><br>

        <input type="reset" id="reset" name="reset" value="wissen">
        <input type="submit" id="opslaan" name="opslaan" value="opslaan">    
    </form>
    </div>
    <?= $melding ?>
</body>
</html>