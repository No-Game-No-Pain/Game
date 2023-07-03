<?php
// Establish a connection to the MySQL database
include "./connect.php";

// Retrieve form data
$Team1 = $_POST['1'];
$TeamNULL = $_POST['NULL'];
$Team2 = $_POST['2'];


// Prepare and execute the SQL statement
$sql = "INSERT INTO User (`Team`) VALUES (:team1, :teamNULL, :team2)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':team1', $Team1);
$stmt->bindParam(':teamNULL', $TeamNULL);
$stmt ->bindParam(':team2', $Team2);

try {
    $stmt->execute();
    echo "Data inserted successfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>

