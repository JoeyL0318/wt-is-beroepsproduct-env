
<!DOCTYPE = html>
<html lang="nl"><head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Componinst - nieuw</title>
    <link href="css/normalize.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
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


</body></html>