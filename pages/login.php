<?php
// Vérification des identifiants soumis
$messageErreur = '';
if (isset($_POST['nom_utilisateur']) && isset($_POST['mot_de_passe'])) {
    $username = $_POST['nom_utilisateur'];
    $password = $_POST['mot_de_passe'];

    // Connexion à la base de données
    $connexion = mysqli_connect('localhost', 'root', '', 'garage_admin');

    // Vérification de la connexion à la base de données
    if (!$connexion) {
        die("La connexion à la base de données a échoué : " . mysqli_connect_error());
    }

    // Requête préparée pour récupérer l'administrateur avec le nom d'utilisateur donné
    $requete = "SELECT * FROM administrateurs WHERE nom_utilisateur = ? LIMIT 1";
    $stmt = mysqli_prepare($connexion, $requete);

    // Vérification de la préparation de la requête
    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . mysqli_error($connexion));
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $resultat = mysqli_stmt_get_result($stmt);

    // Vérification du résultat de la requête
    if ($resultat && mysqli_num_rows($resultat) > 0) {
        $row = mysqli_fetch_assoc($resultat);
        $admin_username = $row['nom_utilisateur'];
        $admin_password = $row['mot_de_passe'];

        // Vérification du mot de passe
        if ($password === $admin_password) {
            // Les identifiants sont corrects, on redirige vers le panneau administrateur
            header('Location: panel_admin.php');
            exit();
        } else {
            // Le mot de passe est incorrect
            $messageErreur = "Mot de passe incorrect. Veuillez réessayer.";
        }
    } else {
        // Aucun administrateur trouvé avec le nom d'utilisateur donné
        $messageErreur = "Nom d'utilisateur incorrect. Veuillez réessayer.";
    }

    // Fermer la connexion à la base de données
    mysqli_stmt_close($stmt);
    mysqli_close($connexion);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion Administrateur</title>
    <style>
        body {
            background-color: #040013;
            font-family: Arial, sans-serif;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            max-width: 400px;
            padding: 20px;
            border: 2px solid #fff;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.1);
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.3);
        }

        .login-container h1 {
            text-align: center;
        }

        .login-container label {
            display: block;
            margin-bottom: 5px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #fff;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.5);
            color: #040013;
        }

        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #f9ca3f;
            color: #040013;
            cursor: pointer;
            font-weight: bold;
        }

        .login-container input[type="submit"]:hover {
            background-color: #ffd966;
        }

        .login-container p.error-message {
            color: #ff8080;
            margin-top: -10px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Connexion Administrateur</h1>
        <?php if (!empty($messageErreur)) : ?>
            <p class="error-message"><?php echo $messageErreur; ?></p>
        <?php endif; ?>
        <form method="post" action="">
            <label>Nom d'utilisateur:</label>
            <input type="text" name="nom_utilisateur" required>

            <label>Mot de passe:</label>
            <input type="password" name="mot_de_passe" required>

            <input type="submit" value="Se connecter">
        </form>
    </div>
</body>
</html>