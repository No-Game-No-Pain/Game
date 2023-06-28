<?php
include "./includes/connect.php";
?>
<div id="bgselect">
    <div id="team1">
        <h2 class="Imprint">Équipe 1</h2>
        <div id="flexfac">
            <img class="divided" src="./images/play.png" alt="Bouton play">
            <?php
            $reponse = $conn->query('SELECT*FROM Personalized');
            while ($donnees = $reponse->fetch())
            {
                echo '<div class="slide">' .$donnees['Name_Personalized']. '</div>';
            }
            $reponse->closeCursor();
            ?>
            <img class="divided rotated" src="./images/play.png" alt="Bouton play">
        </div>
    </div>
    <div id="choix">
        <h2 class="Imprint">Choix des équipes</h2>
    </div>
    <div id="team2">
        <h2 class="Imprint">Équipe 2</h2>
        <div id="flexfac">
            <img class="divided" src="./images/play.png" alt="Bouton play">
            <?php
            $reponse = $conn->query('SELECT*FROM Personalized');
            while ($donnees = $reponse->fetch())
            {
                echo $donnees['Name_Personalized'];
            }
            $reponse->closeCursor();
            ?>
            <img class="divided rotated" src="./images/play.png" alt="Bouton play">
        </div>
    </div>

    <div class="dropbox">
        <div id="selecteam1" class="drop-target" ondragover="dragOver(event)" ondrop="drop(event)"></div>
        <div id="seleccentral" class="drop-target" ondragover="dragOver(event)" ondrop="drop(event)">
            <?php
                $reponse = $conn->query('SELECT * FROM User');
                while ($donnees = $reponse->fetch())
                {
                    echo '<div class="players" class="drag-item" draggable="true" ondragstart="dragStart(event)" id="item'.$donnees['ID_User'].'">';
                    echo '<h3 id="playername">'.$donnees['Name'].'</h3>';
                    if ($donnees['ID_Class'] == 1) {
                        echo '<img class="imgclass" src="../images/Buccaneer.png" alt="Buccaneer">';
                    }
                    elseif ($donnees['ID_Class'] == 2) {
                        echo '<img class="imgclass" src="../images/Mage.png" alt="Mage">';
                    }
                    elseif ($donnees['ID_Class'] == 3) {
                        echo '<img class="imgclass" src="../images/Gunner.png" alt="Gunner">';
                    }
                    elseif ($donnees['ID_Class'] == 4) {
                        echo '<img class="imgclass" src="../images/Cowboy.png" alt="Cowboy">';
                    }
                    elseif ($donnees['ID_Class'] == 5) {
                        echo '<img class="imgclass" src*="../images/Hazel.png" alt="Hazel">';
                    }
                    elseif ($donnees['ID_Class'] == 6) {
                        echo '<img class="imgclass" src="../images/Cyber.png" alt="Cyber">';
                    }             
                    echo '<h4 id="playerlvl">Lvl.'.$donnees['Level'].'</h4>';
                    echo '</div>';
                }
                $reponse->closeCursor();
            ?>
        </div>
        <div id="selecteam2" class="drop-target" ondragover="dragOver(event)" ondrop="drop(event)"></div>
    </div>

    <a href="index.php?add" id="returnbtn"><img src="./images/previouspage.png" alt="Page précédente"></a>
    <a href="index.php?game" id="startgame"><img src="../images/pressstart.png" alt="Appuyez pour lancer le jeu"></a>
</div>
