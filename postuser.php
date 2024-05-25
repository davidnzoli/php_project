<?php
// Inclusion du fichier connect.php qui contient la connexion à la base de données
include('connect.php');

// Récupération des données du formulaire, en les protégeant contre les attaques XSS
$nomComplet = htmlspecialchars($_POST["nomComplet"]);
$age = htmlspecialchars($_POST["age"]);
$nomSalleDeSport = htmlspecialchars($_POST["nomSalleDeSport"]);
$adresse = htmlspecialchars($_POST["adresse"]);
$numeroTel = htmlspecialchars($_POST["numeroTel"]);
$motDePasse = htmlspecialchars($_POST["motDePasse"]);

// Requête SQL pour insérer les données dans la table 'user'
$sql = "INSERT INTO user (nomComplet, age, nomSalleDeSport, adresse, numeroTel, motDePasse) VALUES ('$nomComplet', '$age', '$nomSalleDeSport', '$adresse', '$numeroTel', '$motDePasse')";

// Exécution de la requête SQL
if ($connect->query($sql) === TRUE) {
    echo "Enregistrement réussi";
} else {
    echo "Erreur lors de l'enregistrement : " . $connect->error;
}

// Fermeture de la connexion
$connect->close();
?>
