<?php
// Inclusion du fichier connect.php qui contient la connexion à la base de données
include('connect.php');

// Récupération des données du formulaire, en les protégeant contre les attaques XSS
$nom = htmlspecialchars($_POST["nom"]);
$postnom = htmlspecialchars($_POST["postnom"]);
$prenom = htmlspecialchars($_POST["prenom"]);
$genre = htmlspecialchars($_POST["genre"]);
$telephone = htmlspecialchars($_POST["telephone"]);
$taille = htmlspecialchars($_POST["taille"]);
$poids = htmlspecialchars($_POST["poids"]);
$adresse = htmlspecialchars($_POST["adresse"]);

// Requête SQL pour insérer les données dans la table 'abonnees'
$sql = "INSERT INTO abonnees (nom, postnom, prenom, genre, telephone, taille, poids, adresse) VALUES ('$nom', '$postnom', '$prenom', '$genre', '$telephone', '$taille', '$poids', '$adresse')";

// Exécution de la requête SQL
if ($connect->query($sql) === TRUE) {
    echo "Enregistrement réussi";
} else {
    echo "Erreur lors de l'enregistrement : " . $connect->error;
}

// Fermeture de la connexion
$connect->close();
?>
