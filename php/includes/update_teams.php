
<?php
include "./connect.php";
// Récupérer les données envoyées par la requête AJAX
$joueurId = $_GET['user'];
$equipeId = $_GET['equipe'];
$faction= $_GET['selectedValue'];
// Effectuer l'insertion dans la base de données
$stmt = $conn->prepare("UPDATE User SET Team = :equipeId, ID_Personalized = :faction WHERE ID_User = :joueurId");
$stmt->bindParam(':equipeId', $equipeId);
$stmt->bindParam(':joueurId', $joueurId);
$stmt->bindParam(':faction', $faction);
$stmt->execute();
echo '200';
?>

