<?php
// Inclusion du fichier connect.php qui contient la connexion à la base de données
include('connect.php');

// Récupération des données du formulaire, en les protégeant contre les attaques XSS
$montantPayer = htmlspecialchars($_POST["montantPayer"]);
$montantApayer = htmlspecialchars($_POST["montantApayer"]);
$mois = htmlspecialchars($_POST["mois"]);
// $solde = htmlspecialchars($_POST["solde"]);
$idabonne = htmlspecialchars($_POST["idabonne"]);

// Requête SQL pour insérer les données dans la table 'paiement'
$sql = "INSERT INTO paiement (montantPayer, montantApayer, mois, idabonne) VALUES ('$montantPayer', '$montantApayer', '$mois', '$idabonne')";

// Exécution de la requête SQL
if ($connect->query($sql) === TRUE) {
    echo "Enregistrement réussi";
} else {
    echo "Erreur lors de l'enregistrement : " . $connect->error;
}

// Fermeture de la connexion
$connect->close();
?>
