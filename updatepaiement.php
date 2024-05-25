<?php
// Inclusion du fichier connect.php qui contient la connexion à la base de données
include('connect.php');

// Vérification de la méthode de la requête
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du corps de la requête
    $idpaiement = $_POST['idpaiement'];
    $montantPayer = $_POST['montantPayer'];
    $montantApayer = $_POST['montantApayer'];
    $mois = $_POST['mois'];
    $idabonne = $_POST['idabonne'];

    // Requête SQL pour mettre à jour les données dans la table 'paiement'
    $sql = "UPDATE paiement SET montantPayer=?, montantApayer=?, mois=?, idabonne=? WHERE idpaiement=?";

    // Utilisation d'une requête préparée pour plus de sécurité
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sssss", $montantPayer, $montantApayer, $mois, $idabonne, $idpaiement);

    // Exécution de la requête SQL
    if ($stmt->execute()) {
        // Affichage d'un message en cas de réussite de la mise à jour
        echo "Paiement mis à jour avec succès.";
    } else {
        // Affichage d'un message d'erreur en cas d'échec de la mise à jour
        echo "Erreur lors de la mise à jour du paiement : " . $stmt->error;
    }

    // Fermeture de la requête préparée
    $stmt->close();
} else {
    // Affichage d'un message si la méthode HTTP n'est pas POST
    echo "Méthode HTTP non autorisée. Utilisez la méthode POST pour effectuer la mise à jour.";
}

// Fermeture de la connexion
$connect->close();
?>
