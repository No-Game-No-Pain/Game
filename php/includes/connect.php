<?php  
$servername = 'db';     
$username = 'root';     
$password = 'root';     
$database = 'EdenAttack';      
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);    
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
