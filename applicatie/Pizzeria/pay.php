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
    <header>
<h1>Sole Machina</h1>
<h3>-Ristorante Italiano-</h3>
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
        <h2>Bestelling afronden <i class="fa-solid fa-pizza-slice"></i></h2>
        <form>
            <h3>Wie bent u?</h3>
                <label for="vnaam">Voornaam</label>
                <input type="text" id="vnaam" name="vnaam" placeholder="Uw voornaam" required minlength="3" maxlength="15"><br><br>
                <label for="tnaam">Tussenvoegsel(s)</label>
                <input type="text" id="tnaam" name="tnaam" placeholder="Tussenvoegsel(s)"><br><br>
                <label for="anaam">Achternaam</label>
                <input type="text" id="anaam" name="anaam" placeholder="Uw achternaam" required maxlength="20"><br><br>
                <label for="mail">E-mail</label>
                <input type="text" id="mail" name="mail" placeholder="Mailadres@gmail.com" required><br><br>
                <label for="telnr">Telefoon</label>
                <input type="text" id="telnr" name="telnr" placeholder="Bijv. 06 12345678"><br><br>
                <label for="birthdate">Geboortedatum</label>
                <input type="date" id="birthdate" name="birthdate" min="1933-01-01" required><br><br>
                <h3>Uw adres</h3>
                <label for="strhuis">Straat en huisnummer</label>
                <input type="text" id="strhuis" name="strhuis" placeholder="Bijv. Parkweide 14" required><br><br>
                <label for="postcode">Postcode</label>
                <input type="text" id="postcode" name="postcode" placeholder="Bijv. 6718DJ" maxlength="6" required><br><br>
                <label for="plaats">Plaats</label>
                <input type="text" id="plaats" name="plaats" placeholder="Bijv. Ede" required><br><br>
                <h3>Ontvangst</h3>
                <label for="typorder">Type bestelling</label>
                <select id="typorder" name="typorder">
                <option value="AFH">Afhalen</option>
                <option value="BEZ">Bezorging</option>
                </select>
                <label for="ordertime">Tijd</label>
                <select id="ordertime" name="ordertime">
                <option value="AFH">16:00</option>
                <option value="BEZ">16:30</option>
                <option value="AFH">17:00</option>
                <option value="BEZ">17:30</option>
                <option value="AFH">18:00</option>
                <option value="BEZ">18:30</option>
                <option value="AFH">19:00</option>
                <option value="BEZ">19:30</option>
                <option value="AFH">20:00</option>
                <option value="BEZ">20:30</option>
                <option value="AFH">21:00</option>
                <option value="BEZ">21:30</option>
                <option value="AFH">22:00</option>
                <option value="BEZ">22:30</option>
                </select>
                <label for="opm">Opmerkingen voor het restaurant</label>
                <input type="text" id="opm" name="opm" placeholder="(Max 150 tekens)" maxlength="150"><br><br>
                <label for="korting">Kortingscode of voucher</label>
                <input type="text" id="korting" name="korting" placeholder="Kortingscode"><br><br>
                <input class="submit" type="submit" value="Betalen met iDeal">
                <input class="submit" type="submit" value="Betalen met PayPal">
                <input class="submit" type="submit" value="Betalen met credit card">
        </form>
    </main>
</body>
</html>