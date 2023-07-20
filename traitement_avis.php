<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$hostname = "localhost";      
$username = "root"; 
$password = "";    
$database = "garage_avis";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $prenom = $_POST["prenom"];
    $avis = $_POST["avis"];
    $rating = $_POST["rating"];

    // Etablir la connexion à la base de données
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }

    // Préparer la requête SQL pour insérer l'avis dans la base de données
    $sql = "INSERT INTO avis (prenom, avis, verifie, rating) VALUES (?, ?, 0, ?)";

    // Préparer la déclaration SQL
    $stmt = $conn->prepare($sql);

    // Vérifier si la préparation de la requête a réussi
    if ($stmt) {
        // Lier les paramètres de la requête
        $stmt->bind_param("ssi", $prenom, $avis, $rating);

        // Exécuter la requête
        $stmt->execute();

       
    if ($stmt->errno) {
        echo "Erreur SQL : " . $stmt->error;
}

        // Fermer la déclaration
        $stmt->close();

        // Fermer la connexion à la base de données
        $conn->close();

        // Rediriger l'utilisateur vers la page d'accueil
        header("Location: index.php");
        exit();
    } else {
        // En cas d'erreur lors de la préparation de la requête
        echo "Erreur lors de la préparation de la requête : " . $conn->error;
    }
}

echo "Prénom: " . $prenom . "<br>";
echo "Avis: " . $avis . "<br>";
echo "Rating: " . $rating . "<br>";
?>
