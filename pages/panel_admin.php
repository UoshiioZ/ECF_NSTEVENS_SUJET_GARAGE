<?php
// Vérification de la connexion à la base de données 'garage_avis'
$connexion_avis = mysqli_connect('localhost', 'root', '', 'garage_avis');

// Vérification de la connexion à la base de données 'garage_contact'
$connexion_contact = mysqli_connect('localhost', 'root', '', 'garage_contact');

// Vérification de la connexion à la base de données 'garage_avis'
if (!$connexion_avis) {
    die("La connexion à la base de données 'garage_avis' a échoué : " . mysqli_connect_error());
}

// Vérification de la connexion à la base de données 'garage_contact'
if (!$connexion_contact) {
    die("La connexion à la base de données 'garage_contact' a échoué : " . mysqli_connect_error());
}

// Récupérer les avis depuis la table 'garage_avis'
$requete_avis = "SELECT * FROM garage_avis";
$resultat_avis = mysqli_query($connexion_avis, $requete_avis);

// Récupérer les messages du formulaire de contact depuis la table 'garage_contact'
$requete_messages = "SELECT * FROM garage_contact";
$resultat_messages = mysqli_query($connexion_contact, $requete_messages);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panneau Administrateur</title>
    <style>
        body {
            background-color: #040013;
            font-family: Arial, sans-serif;
            color: #fff;
            padding: 20px;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .avis-container, .messages-container {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 5px;
        }

        .avis-item, .message-item {
            margin-bottom: 15px;
        }

        .avis-item .titre {
            font-size: 18px;
            font-weight: bold;
        }

        .avis-item .contenu {
            font-size: 16px;
        }

        .message-item .nom, .message-item .prenom {
            font-size: 18px;
            font-weight: bold;
        }

        .message-item .email {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>Panneau Administrateur</h1>

    <div class="section">
        <div class="section-title">Avis</div>
        <div class="avis-container">
            <?php if ($resultat_avis && mysqli_num_rows($resultat_avis) > 0) : ?>
                <?php while ($row_avis = mysqli_fetch_assoc($resultat_avis)) : ?>
                    <div class="avis-item">
                        <div class="titre"><?php echo $row_avis['titre']; ?></div>
                        <div class="contenu"><?php echo $row_avis['contenu']; ?></div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>Aucun avis trouvé dans la base de données.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Messages reçus</div>
        <div class="messages-container">
            <?php if ($resultat_messages && mysqli_num_rows($resultat_messages) > 0) : ?>
                <?php while ($row_message = mysqli_fetch_assoc($resultat_messages)) : ?>
                    <div class="message-item">
                        <div class="prenom"><?php echo $row_message['prenom']; ?></div>
                        <div class="nom"><?php echo $row_message['nom']; ?></div>
                        <div class="email"><?php echo $row_message['email']; ?></div>
                        <div class="message"><?php echo $row_message['message']; ?></div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>Aucun message trouvé dans la base de données.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
