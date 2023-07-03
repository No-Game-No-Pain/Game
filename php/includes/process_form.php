<?php
include "./includes/connect.php";

// Retrieve the data from the form
$selecteam1 = $_POST['selecteam1'];
$selecteam2 = $_POST['seleccentral'];
$selecteam3 = $_POST['selecteam2'];

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define the SQL query to insert the data into your database
$sql = "INSERT INTO User (Team) 
        VALUES ('$selecteam1'=>'1', '$selecteam2'=>'NULL', '$selecteam3'=>'2')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
