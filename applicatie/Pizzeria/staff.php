<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Personeel - Sole Machina</title>
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
        <div>
            <h2>Inloggen personeel insite</h2>
    <form>
        <label for="gebrnaam">E-mailadres</label>
        <input type="text" id="gebrnaam" name="gebrnaam" placeholder="E-mailadres" required><br><br>
        <label for="wachtwoord">Wachtwoord</label>
        <input type="password" id="wachtwoord" name="wachtwoord" placeholder="Wachtwoord" required><br><br>
        <input class="submit" type="submit" value="Log in">
    </form>
        </div>
    </main>
</body>
</html>