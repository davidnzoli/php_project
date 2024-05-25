<?php
// Inclusion du fichier connect.php qui contient la connexion à la base de données
include('connect.php');

// Vérification si le paramètre 'id' est présent dans la requête GET
if (isset($_GET['idabonne'])) {
    // Récupération de la valeur de 'id' et protection contre les attaques XSS
    $id = htmlspecialchars($_GET['idabonne']);

    // Requête préparée de suppression dans la table 'abonnees' où 'id' correspond à la valeur récupérée
    $sql = "DELETE FROM abonnees WHERE idabonne = ?";
    
    // Utilisation d'une requête préparée pour plus de sécurité
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id); // "i" indique que le paramètre est un entier

    // Exécution de la requête de suppression
    if ($stmt->execute()) {
        // Affichage d'un message en cas de réussite de la suppression
        echo "Suppression réussie.";
    } else {
        // Affichage d'un message d'erreur en cas d'échec de la suppression
        echo "Erreur lors de la suppression : " . $stmt->error;
    }

    // Fermeture de la connexion et de la requête préparée
    $stmt->close();
} else {
    // Affichage d'un message si le paramètre 'id' n'est pas spécifié dans la requête GET
    echo "ID non spécifié pour la suppression.";
}

// Fermeture de la connexion
$connect->close();
?>
