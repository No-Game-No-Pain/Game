
<?php
include "./connect.php";
// Récupérer les données envoyées par la requête AJAX
$joueurId = $_GET['user'];
$equipeId = $_GET['equipe'];
// Effectuer l'insertion dans la base de données
$stmt = $conn->prepare("UPDATE User SET Team = :equipeId WHERE ID_User = :joueurId");
$stmt->bindParam(':equipeId', $equipeId);
$stmt->bindParam(':joueurId', $joueurId);
$stmt->execute();
echo '200';
?>

