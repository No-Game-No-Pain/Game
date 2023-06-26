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
                <h3>Nom personne</h3>
                <img src="" alt="Sprite">
                <h3>Lvl.°</h3>
            </div>
        </div>
        <div id="selecteam2" class="drop-target" ondragover="dragOver(event)" ondrop="drop(event)"></div>
    </div>


    <div id="startgame">
        <a href=""><img src="./images/pressstart.png" height="100%" alt="Appuyez pour lancer le jeu"></a>
    </div>
</div>
