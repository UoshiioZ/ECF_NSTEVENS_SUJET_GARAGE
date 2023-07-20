<?php
$connection = mysqli_connect('localhost','root');

mysqli_select_db($connection,"garage_avis");

$user = $_POST['prenom'];
$avis = $_POST['avis'];
$rate = $_POST['rating'];
$verif = $_POST['verifie'];

$query = "INSERT INTO avis (prenom, avis, verifie, rating) VALUES (?, ?, 0, ?)";

mysqli_query($connection,$query);

echo "MESSAGE IS SEND";


?>