<?php
include "./includes/connect.php";

// Retrieve the data from the POST request
$equipe1 = json_decode($_POST['equipe1'], true);
$equipe2 = json_decode($_POST['equipe2'], true);
$equipe1Factions = json_decode($_POST['equipe1Factions'], true);
$equipe2Factions = json_decode($_POST['equipe2Factions'], true);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data for each player in team 1
foreach ($equipe1 as $joueurId) {
    // Retrieve the faction ID for the player
    $factionId = $equipe1Factions[$joueurId];

    // Define the SQL query to insert the data into the database
    $sql = "INSERT INTO User (Team, Faction) 
            VALUES ('1', '$factionId')";

    // Execute the query
    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Insert data for each player in team 2
foreach ($equipe2 as $joueurId) {
    // Retrieve the faction ID for the player
    $factionId = $equipe2Factions[$joueurId];

    // Define the SQL query to insert the data into the database
    $sql = "INSERT INTO User (Team, Faction) 
            VALUES ('2', '$factionId')";

    // Execute the query
    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

// Redirect to the game page after data is inserted
header("Location: game.php");
exit();
?>

