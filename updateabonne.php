<?php
// Inclusion du fichier connect.php qui contient la connexion à la base de données
include('connect.php');

// Vérification de la méthode de la requête
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Récupération des données du corps de la requête
    parse_str(file_get_contents("php://input"), $putData);

    // Vérification de l'existence des paramètres nécessaires
    if (isset($putData['idabonne'], $putData['nom'], $putData['postnom'], $putData['prenom'], $putData['genre'], $putData['telephone'], $putData['taille'], $putData['poids'], $putData['adresse'])) {
        // Protection contre les attaques XSS
        $id = htmlspecialchars($putData['idabonne']);
        $nom = htmlspecialchars($putData['nom']);
        $postnom = htmlspecialchars($putData['postnom']);
        $prenom = htmlspecialchars($putData['prenom']);
        $genre = htmlspecialchars($putData['genre']);
        $telephone = htmlspecialchars($putData['telephone']);
        $taille = htmlspecialchars($putData['taille']);
        $poids = htmlspecialchars($putData['poids']);
        $adresse = htmlspecialchars($putData['adresse']);

        // Requête SQL pour mettre à jour les données dans la table 'abonnees'
        $sql = "UPDATE abonnees SET nom = ?, postnom = ?, prenom = ?, genre = ?, telephone = ?, taille = ?, poids = ?, adresse = ? WHERE idabonne = ?";

        // Utilisation d'une requête préparée pour plus de sécurité
        $stmt = $connect->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssssssssi", $nom, $postnom, $prenom, $genre, $telephone, $taille, $poids, $adresse, $id);

            // Exécution de la requête SQL
            if ($stmt->execute()) {
                // Affichage d'un message en cas de réussite de la mise à jour
                echo "Mise à jour réussie.";
            } else {
                // Affichage d'un message d'erreur en cas d'échec de la mise à jour
                echo "Erreur lors de la mise à jour : " . $stmt->error;
            }

            // Fermeture de la requête préparée
            $stmt->close();
        } else {
            // Affichage d'un message d'erreur en cas d'échec de la préparation de la requête
            echo "Erreur lors de la préparation de la requête : " . $connect->error;
        }
    } else {
        echo "Paramètres insuffisants pour la mise à jour.\n";
    }
} else {
    // Affichage d'un message si la méthode HTTP n'est pas PUT
    echo "Méthode HTTP non autorisée. Utilisez la méthode PUT pour effectuer la mise à jour.\n";
}

// Fermeture de la connexion
$connect->close();
?>
