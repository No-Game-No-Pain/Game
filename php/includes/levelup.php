<?php
include "./connect.php";
// Récupérer les données envoyées par la requête AJAX
$idUser = $_GET['user'];
$level = $_GET['level'];
$levelup = $level + 1;
// Effectuer l'insertion dans la base de données
$stmt = $conn->prepare("UPDATE User SET Level = :levelup WHERE ID_User = :id");
$stmt->bindParam(':levelup', $levelup);
$stmt->bindParam(':id', $idUser);

$stmt->execute();
echo '200';
?>