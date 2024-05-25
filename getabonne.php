<?php
// Inclusion du fichier connect.php qui contient la connexion à la base de données
include('connect.php');

// Requête SQL pour sélectionner toutes les lignes de la table 'etudiants'
$rqt = "SELECT * FROM  abonnees";


// Exécution de la requête SQL
$rqt2 = mysqli_query($connect, $rqt) or die(mysqli_error($connect));

// Initialisation d'un tableau pour stocker les résultats de la requête
$result = array();

// Parcours des résultats de la requête et stockage dans le tableau $result
while ($fetchData = $rqt2->fetch_assoc()) {
    $result[] = $fetchData;
}

// Conversion du tableau en format JSON et affichage
echo json_encode($result);
?>