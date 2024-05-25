<?php
// Inclusion du fichier connect.php qui contient la connexion à la base de données
include('connect.php');

// Vérification de la méthode de la requête
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Récupération des données du corps de la requête
    parse_str(file_get_contents("php://input"), $putData);

    if (isset($putData['iduser'], $putData['nomComplet'], $putData['age'], $putData['nomSalleDeSport'], $putData['adresse'], $putData['numeroTel'], $putData['motDePasse'])) {
        // Protection contre les attaques XSS
        $id = htmlspecialchars($putData['iduser']);
        $nomComplet = htmlspecialchars($putData['nomComplet']);
        $age = htmlspecialchars($putData['age']);
        $nomSalleDeSport = htmlspecialchars($putData['nomSalleDeSport']);
        $adresse = htmlspecialchars($putData['adresse']);
        $numeroTel = htmlspecialchars($putData['numeroTel']);
        $motDePasse = htmlspecialchars($putData['motDePasse']);

        // Requête SQL pour mettre à jour les données dans la table 'users'
        $sql = "UPDATE user SET nomComplet = ?, age = ?, nomSalleDeSport = ?, adresse = ?, numeroTel = ?, motDePasse = ? WHERE iduser = ?";

        // Utilisation d'une requête préparée pour plus de sécurité
        $stmt = $connect->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssssssi", $nomComplet, $age, $nomSalleDeSport, $adresse, $numeroTel, $motDePasse, $id);

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
