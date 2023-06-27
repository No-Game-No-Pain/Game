<div id="bgselect">
    <div id="team1">
        <h2 class="Imprint">Équipe 1</h2>
        <div id="flexfac">
            <img class="divided" src="./images/play.png" alt="Bouton play">
            <h2>Nom de faction</h2>
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
            <h2>Nom de faction</h2>
            <img class="divided rotated" src="./images/play.png" alt="Bouton play">
        </div>
    </div>

    <div class="dropbox">
        <div id="selecteam1" class="drop-target" ondragover="dragOver(event)" ondrop="drop(event)">
        </div>
        <div id="seleccentral" class="drop-target" ondragover="dragOver(event)" ondrop="drop(event)">
            <div class="players" class="drag-item" draggable="true" ondragstart="dragStart(event)" id="item1">
            <?php
                try {
                    $connexion = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
                    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $requete = "SELECT * FROM User";
                    $resultat = $connexion->query($requete);

                    while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
                        echo "ID : " . $row['Name'] . "<br>";
                        echo "Nom : " . $row['ID_Class'] . "<br>";
                        echo "Email : " . $row['Level'] . "<br>";
                        echo "<br>";
                    }

                    $resultat->closeCursor();
                } catch (PDOException $e) {
                    echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
                }

                $connexion = null;
            ?>
            </div>
        </div>
        <div id="selecteam2" class="drop-target" ondragover="dragOver(event)" ondrop="drop(event)"></div>
    </div>

    <a href="index.php?add" id="returnbtn"><img src="./images/previouspage.png" alt="Page précédente"></a>
    <div id="startgame">
        <a href="index.php?game"><img src="../images/pressstart.png" height="100%" alt="Appuyez pour lancer le jeu"></a>
    </div>
</div>
