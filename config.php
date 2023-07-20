<?php
$servername = "localhost";
$username = "SNOMERTIN"; // Remplacez par votre nom d'utilisateur MySQL
$password = "Chocolat"; // Remplacez par votre mot de passe MySQL
$dbname = "garage_avis";

// Créer une connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}
?>

<?php
define('DB_HOST', 'localhost'); // Remplacez 'localhost' par le nom de l'hôte de votre base de données
define('DB_USER', 'SNOMERTIN'); // Remplacez 'votre_nom_utilisateur' par votre nom d'utilisateur MySQL
define('DB_PASSWORD', 'Chocolat'); // Remplacez 'votre_mot_de_passe' par votre mot de passe MySQL
define('DB_NAME', 'garage_avis'); // Remplacez 'garage_avis' par le nom de votre base de données
?>