<?php
include "./includes/connect.php";
?>
<div id="game">
  <div id="equipe1">
  <?php 
    $response = $conn->query('SELECT * FROM User');
    while ($donnees = $response->fetch()) {
      if($donnees['Team']== 1){
            echo '<div id="teamgauche">';
            echo '<h3>'. $donnees['Name'] . '</h3>';
            echo '<h2>'. $donnees['Team'] . '</h2>';
            if ($donnees['Team']==1 & $donnees['ID_Class'] == 1) {
              echo '<img class="imgclass" src="../images/Buccaneer.png" alt="Buccaneer">';
            }
            elseif ($donnees['Team']==1 & $donnees['ID_Class'] == 2) {
              echo '<img class="imgclass" src="../images/Mage.png" alt="Mage">';
            }
            elseif ($donnees['Team']==1 & $donnees['ID_Class'] == 3) {
              echo '<img class="imgclass" src="../images/Gunner.png" alt="Gunner">';
            }
            elseif ($donnees['Team']==1 & $donnees['ID_Class'] == 4) {
              echo '<img class="imgclass" src="../images/Cowboy.png" alt="Cowboy">';
            }
            elseif ($donnees['Team']==1 & $donnees['ID_Class'] == 5) {
              echo '<img class="imgclass skale" src="../images/Hazel.png" alt="Hazel">';
            }
            elseif ($donnees['Team']==1 & $donnees['ID_Class'] == 6) {
              echo '<img class="imgclass" src="../images/Cyber.png" alt="Cyber">';
            }
            echo '</div>';
        }
      }
        ?>
        </div>
        <div id="equipe2">
        <?php
        $response = $conn->query('SELECT * FROM User');
        while ($donnees = $response->fetch()) {
            echo '<div id="teamdroite">';
            echo '<h3>'. $donnees['Name'] . '</h3>';
            echo '<h2>'. $donnees['Team'] . '</h2>';
            if ($donnees['Team']==2 & $donnees['ID_Class'] == 1) {
              echo '<img class="imgclass skale" src="../images/Buccaneer.png" alt="Buccaneer">';
            }
            elseif ($donnees['Team']==2 & $donnees['ID_Class'] == 2) {
              echo '<img class="imgclass skale" src="../images/Mage.png" alt="Mage">';
            }
            elseif ($donnees['Team']==2 & $donnees['ID_Class'] == 3) {
              echo '<img class="imgclass skale" src="../images/Gunner.png" alt="Gunner">';
            }
            elseif ($donnees['Team']==2 & $donnees['ID_Class'] == 4) {
              echo '<img class="imgclas skale" src="../images/Cowboy.png" alt="Cowboy">';
            }
            elseif ($donnees['Team']==2 & $donnees['ID_Class'] == 5) {
              echo '<img class="imgclass" src="../images/Hazel.png" alt="Hazel">';
            }
            elseif ($donnees['Team']==2 & $donnees['ID_Class'] == 6) {
              echo '<img class="imgclass skale" src="../images/Cyber.png" alt="Cyber">';
            }
            echo '</div>';
          }
    
    
  ?>

  </div>
  <div id="historique"></div>

  <script src="../script/game.js"></script>

</div>
