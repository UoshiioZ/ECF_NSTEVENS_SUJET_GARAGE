<?php


$hostname = "localhost";      
$username = "root"; 
$password = "";    
$database = "garage_contact";


$connexion = mysqli_connect($hostname, $username, $password, $database);


if (!$connexion) {
    die("Échec de la connexion : " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Préparer la requête d'insertion
    $requete = "INSERT INTO formulaire_contact (prenom, nom, telephone, email, message) VALUES ('$prenom', '$nom', '$telephone', '$email', '$message')";

    // Exécuter la requête d'insertion
    if (mysqli_query($connexion, $requete)) {
        // Les données ont été insérées avec succès
        echo "Les données ont été insérées dans la base de données.";
    } else {
        // Une erreur s'est produite lors de l'insertion
        echo "Erreur lors de l'insertion des données : " . mysqli_error($connexion);
    }

    // Fermer la connexion
    mysqli_close($connexion);
}
?>

