<?php
// Inclusion du fichier connect.php qui contient la connexion à la base de données
include('connect.php');

// Vérifie si les données POST ont été reçues
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire, en les protégeant contre les attaques XSS
    $email = htmlspecialchars($_POST["adresse"]);
    $password = htmlspecialchars($_POST["motDePasse"]);

    // Requête SQL pour vérifier les identifiants de connexion
    $sql = "SELECT * FROM user WHERE adresse = '$email' AND motDePasse = '$password'";

    // Exécution de la requête SQL
    $result = $connect->query($sql);

    // Vérification du nombre de lignes retournées par la requête
    if ($result->num_rows > 0) {
        // Les identifiants sont corrects, retournez un code de succès
        http_response_code(200);
        echo "Connexion réussie";
    } else {
        // Les identifiants sont incorrects, retournez un code d'erreur
        http_response_code(401);
        echo "Identifiants incorrects";
    }
} else {
    // Si la méthode HTTP n'est pas POST, retournez un code d'erreur
    http_response_code(405);
    echo "Méthode non autorisée";
}

// Fermeture de la connexion
$connect->close();
?>
