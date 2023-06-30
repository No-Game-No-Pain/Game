<?php
include 'connect.php';
if (isset($_POST['ADD'])) {
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : null;
    $selectclass = isset($_POST['inputclass']) && !empty($_POST['inputclass']) ? $_POST['inputclass'] : null;
    if ($name && $selectclass) {
        $sql = "INSERT INTO `User` (`Name`, `Level`, `Team`, `ID_Class`, `ID_Personalized`) VALUES (:name, '1', NULL, :clas, '1')";
       $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':clas', $selectclass);
      
        // Exécution de la requête
        $stmt->execute();
    } 
    
}
elseif (isset($_POST['REMOVE']) && isset($_POST['users']) && !empty($_POST['users'])) {
    $selectedUser = $_POST['users'];
    $sql = "DELETE FROM `User` WHERE ID_User = :userId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userId', $selectedUser);
    $stmt->execute();
    
}
elseif (isset($_POST['addfaction'])) {
    $namefaction = isset($_POST['factionpersonalized']) ? htmlspecialchars($_POST['factionpersonalized']) : null;
    $inputfaction = isset($_POST['inputfaction']) && !empty($_POST['inputfaction']) ? $_POST['inputfaction'] : null;

    if ($namefaction && $inputfaction) {
        $sql = "INSERT INTO `Personalized` (`Name_Personalized`, `ID_Faction`) VALUES (:namef,:idfaction)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':namef', $namefaction);
        $stmt->bindParam(':idfaction', $inputfaction);

// Exécution de la requête
$stmt->execute();
}
}
elseif (isset($_POST['removefaction']) && isset($_POST['factionpersonalized']) && !empty($_POST['factionpersonalized'])) {
    $factionpersonalized = $_POST['factionpersonalized'];
    $sql = "DELETE FROM `Personalized` WHERE Name_Personalized = :namefaction";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':namefaction', $factionpersonalized);
    $stmt->execute();
}

header("Location: ../index.php?add");

?>