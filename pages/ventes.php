<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECF NOS VOITURES</title>
    <link rel="stylesheet" href="..\css\style.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">
        <a href="..\index.php"><img src="../assets/images/LogoB.png" alt="Logo Garage V.Parrot"></a>
        </div>
        <nav>
            <ul>
            <li><a href="..\index.php">Accueil</a></li>
                <li <?php if (basename($_SERVER['PHP_SELF']) == 'ventes.php') echo 'class="active"'; ?>><a href="pages\ventes.php">Voiture d'occasion</a></li>
                <li><a class="login-button" href="pages\login.php">Se connecter</a></li>
            </ul>
        </nav>
    </header>

    <!-- Le contenu de la page -->

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Garage V.Parrot. Tous droits réservés.</p>
    </footer>
</body>
</html>