<?php
$servername = "localhost";
$username = "votre_nom_utilisateur"; // Remplacez par votre nom d'utilisateur MySQL
$password = "votre_mot_de_passe"; // Remplacez par votre mot de passe MySQL
$dbname = "garage_avis";

// Créer une connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}
?>

