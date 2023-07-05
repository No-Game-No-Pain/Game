<?php
// Inclure le fichier de connexion à la base de données
include "./connect.php";

// Vérifier si la variable POST "winner" existe
if (isset($_GET['winner'])) {
    // Récupérer la valeur de "winner"
    $winner = $_GET['1'];
    $niveau = $_GET['niveau'];

    // Requête SQL pour mettre à jour le niveau de l'équipe gagnante dans la table User
    $sql = "UPDATE User SET Level = $niveau + 1 WHERE Team = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam("s", $winner);

    if ($stmt->execute()) {
        // Mise à jour réussie
        echo "Le niveau de l'équipe $winner a été mis à jour avec succès.";
    } else {
        // Erreur lors de la mise à jour
        echo "Erreur lors de la mise à jour du niveau de l'équipe $winner : ";
    }

    $stmt->closeCursor();
} else {
    // Répondre avec un message d'erreur si "winner" n'a pas été envoyé
    echo "Erreur : Aucune équipe gagnante spécifiée.";
}

// Fermer la connexion à la base de données
?>


