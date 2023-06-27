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
        <div id="selecteam1" class="drop-target" ondragover="dragOver(event)" ondrop="drop(event)">
        </div>
        <div id="seleccentral" class="drop-target" ondragover="dragOver(event)" ondrop="drop(event)">
            <?php
                $reponse = $conn->query('SELECT * FROM User');
                while ($donnees = $reponse->fetch())
                {
                    echo '<div class="players" class="drag-item" draggable="true" ondragstart="dragStart(event)" id="item'.$donnees['ID_User'].'">';
                    echo '<h3 id="playername">'.$donnees['Name'].'</h3>';
                    echo '<h4 id="playerclass">'.$donnees['ID_Class'].'</h4>';
                    echo '<h4 id="playerlvl">Lvl.'.$donnees['Level'].'</h4>';
                    echo '</div>';
                }
                $reponse->closeCursor();
            ?>
        </div>
        <div id="selecteam2" class="drop-target" ondragover="dragOver(event)" ondrop="drop(event)"></div>
    </div>

    <a href="index.php?add" id="returnbtn"><img src="./images/previouspage.png" alt="Page précédente"></a>
    <div id="startgame">
        <a href="index.php?game"><img src="../images/pressstart.png" height="100%" alt="Appuyez pour lancer le jeu"></a>
    </div>
</div>
