<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Insite - Sole Machina</title>
</head>
<body class="grid-container">
    <header>
<h1>Sole Machina</h1>
<h3>-Personeel Insite-</h3>
    </header>
    <nav>
<ul>
    <li><a href="menu.html">Menu</a></li>
    <li><a href="winkelwagen.html">Winkelwagen</a></li>
    <li><a href="login.html">Account</a></li>
    <li><a href="bestelling.html">Mijn Order</a></li>
    <li><a href="about.html">Over ons</a></li>
    <li id="righttab"><a href="index.html">Home</a></li>
</ul>
    </nav>
    <main>
            <h2>Welkom User</h2>
<div class="LRgrid">
        <div class="links">
            <h3>Actuele Bestellingen</h3>
            <p>Er zijn op dit moment geen bestellingen</p>
            <div class="persgrid">
                <p class="ordernr"> Nr: 82RTP1</p>
                <p class="ordertijd">T: 18:00</p>
                <P class="itemnaam">Pizza Margherita</p>
                <p class="itemaantal">A: 1x</p>
                <P class="orderextra">Opm: Deurbel is kapot</p>
                <p class="ordertype">Type: Bezorging</p>
            </div>
        </div>
        <div class="rechts">
            <h3>Bestelling Beheren</h3>
            <form>
                <label for="ordernr">Ordernummer</label>
                <input type="text" id="ordernr" name="ordernr" placeholder="Ordernummer" required maxlength="6" minlength="6"><br><br>
                <input class="submit" type="submit" value="Beheer bestelling" onclick="">
            </form>
            <div class="persgrid">
                <p class="ordernr"> Nr: 82RTP1</p>
                <form class="ordertijd">
                    <label for="orderstatus">Status:</label>
                    <select id="orderstatus" name="orderstatus">
                    <option value="ONT">Ontvangen</option>
                    <option value="BER">In de oven</option>
                    <option value="ONDW">Onderweg</option>
                    <option value="DEL">Bezorgd</option>
                    <option value="AFH">Klaar voor afhalen</option>
                    <input class="submit" type="submit" value="Status Bijwerken" onclick="">
                </select>
                </form>
                <P class="itemnaam">MAIL</p>
                    <div class="orderextra">
                        <p>ADRES</p>
                        <p>POSTCODE</p>
                        <p>PLAATS</p>
                    </div>
                <p class="ordertype">TYPE</p>
            </div>
        </div>
    </div>
    </main>
</body>
</html>