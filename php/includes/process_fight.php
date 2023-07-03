<?php
$response = $conn->query('SELECT*FROM User');
while ($donnees = $response->fetch())
{   
    $donnees['ID_User'];
    $donnees['Name'];
    $donnees['ID_Class'];
    $donnees['Level'];
};
$response = $conn->query('SELECT*FROM Class');
while ($donnees = $response->fetch())
{
    $donnees['Attack'];
    $donnees['HP'];
}
$response->closeCursor();
?>