<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $prenom = $_POST['prenom'];
    $avis = $_POST['avis'];
    $rating = $_POST['rating'];

    // Etablir la connexion à la base de données
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }

    // Requête SQL pour insérer l'avis dans la base de données avec la note non vérifiée (0)
    $sql = "INSERT INTO avis (prenom, avis, verifie) VALUES ('$prenom', '$avis', 0)";

    // Exécuter la requête SQL
    if ($conn->query($sql) === TRUE) {
        // Rediriger l'utilisateur vers la page d'accueil après l'envoi de l'avis
        header("Location: index.php");
        exit;
    } else {
        echo "Erreur lors de l'envoi de l'avis : " . $conn->error;
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
