<?php
include "./includes/connect.php";
$stmt = $conn->prepare("UPDATE User SET Team = null");
$stmt->execute();
?>
<div id="bgselect">
    <div id="team1">
            <h2 class="Imprint">Équipe 1</h2>
            <div class="dropdown">
                <select class="selectFac" name="FactionG1" id="FactionG1">
                    <?php
                    $reponse = $conn->query('SELECT * FROM Personalized');
                    while ($donnees = $reponse->fetch()) {
                        echo '<option value="'.$donnees['ID_Personalized'].'">' .$donnees['Name_Personalized']. '</option>';
                    }
                    $reponse->closeCursor();
                    ?>
                </select>
            </div>
        
    </div>
    <div id="choix">
        <h2 class="Imprint">Choix des équipes</h2>
    </div>
    <div id="team2">
        
            <h2 class="Imprint">Équipe 2</h2>
            <div class="dropdown">
                <select class="selectFac" id="FactionG2" name="FactionG2">
                    <?php
                    $reponse = $conn->query('SELECT * FROM Personalized');
                    while ($donnees = $reponse->fetch()) {
                        echo '<option value="'.$donnees['ID_Personalized'].'">' .$donnees['Name_Personalized']. '</option>';
                    }
                    $reponse->closeCursor();
                    ?>
                </select>
            </div>
        
    </div>
    
    <a href="index.php?game" type="submit" name="start" id="startgame"><img src="./images/pressstart.png" height="100%" alt="Appuyez pour lancer le jeu"></a> 
    <div id="dropbox"></div>   
    <div id="selecteam1" class="drop-target" ondragover="dragOver(event)" ondrop="drop(event)"></div>
    <div id="seleccentral" class="drop-target" ondragover="dragOver(event)" ondrop="drop(event)">
        <?php
        $reponse = $conn->query('SELECT * FROM User');
        while ($donnees = $reponse->fetch()) {
            echo '<div class="players" class="drag-item" draggable="true" ondragstart="JoueurID(event)" id="user-'.$donnees['ID_User'].'" data-id="'.$donnees['ID_User'].'">';
            echo '<h3 id="playername">'.$donnees['Name'].'</h3>';
            if ($donnees['ID_Class'] == 1) {
                echo '<img class="imgclass" src="../images/Buccaneer.png" alt="Buccaneer">';
            } elseif ($donnees['ID_Class'] == 2) {
                echo '<img class="imgclass" src="../images/Mage.png" alt="Mage">';
            } elseif ($donnees['ID_Class'] == 3) {
                echo '<img class="imgclass" src="../images/Gunner.png" alt="Gunner">';
            } elseif ($donnees['ID_Class'] == 4) {
                echo '<img class="imgclass" src="../images/Cowboy.png" alt="Cowboy">';
            } elseif ($donnees['ID_Class'] == 5) {
                echo '<img class="imgclass" src="../images/Hazel.png" alt="Hazel">';
            } elseif ($donnees['ID_Class'] == 6) {
                echo '<img class="imgclass" src="../images/Cyber.png" alt="Cyber">';
            }             
            echo '<h4 id="playerlvl">Lvl.'.$donnees['Level'].'</h4>';
            echo '</div>';
        }
        $reponse->closeCursor();
        ?>
    </div>
    <div id="selecteam2" class="drop-target" ondragover="dragOver(event)" ondrop="drop(event)"></div>
    <a href="index.php?add" id="returnbtn"><img src="./images/previouspage.png" alt="Page précédente"></a>
</div>
<script>

    function JoueurID(event) {
        event.dataTransfer.setData("text/plain", event.target.id);
    }

    function allowDrop(event) {
        event.preventDefault();
    }

    function dragOver(event) {
        event.preventDefault();
    }

    function drop(event) {
        event.preventDefault();
        var joueurId = event.dataTransfer.getData("text/plain");
        var joueur = document.getElementById(joueurId);
        var targetTeam = event.target;

        // Vérification du nombre maximum de joueurs par équipe
        var equipe1 = document.getElementById('selecteam1');
        var equipe2 = document.getElementById('selecteam2');
        var selectCentral = document.getElementById('seleccentral');

        var joueursEquipe1Liste = equipe1.children;
        var joueursEquipe2Liste = equipe2.children;
        var selectElement1 = document.getElementById("FactionG1");
        var selectedValue1 = selectElement1.value;
        console.log(selectedValue1);
        var selectElement2 = document.getElementById("FactionG2");
        var selectedValue2 = selectElement2.value;
        console.log(selectedValue2);

        if (targetTeam !== equipe1 && targetTeam !== equipe2 && targetTeam !== selectCentral) {
            return; // Ignorer le glisser-déposer si la cible n'est ni selecteam1, ni selecteam2, ni selectcentral
        }

        if (targetTeam === equipe1 && joueursEquipe1Liste.length >= 5) {
            alert("L'équipe 1 ne peut pas avoir plus de 5 joueurs.");
            return;
        }

        if (targetTeam === equipe2 && joueursEquipe2Liste.length >= 5) {
            alert("L'équipe 2 ne peut pas avoir plus de 5 joueurs.");
            return;
        }
            // Vérification du nombre minimum de joueurs par équipe

        // Si l'équipe a déjà 5 joueurs, remettre le joueur au milieu
        if ((targetTeam === equipe1 && joueursEquipe1Liste.length === 5) || (targetTeam === equipe2 && joueursEquipe2Liste.length === 5)) {
            selectCentral.appendChild(joueur);
        } else {
            var id = joueur.getAttribute('data-id')
            var team = null;
            var faction = 1;
            targetTeam.appendChild(joueur);
            if(targetTeam === equipe1){
                team = 1;
                faction = selectedValue1;
            }else if(targetTeam === equipe2){
                team = 2;
                faction = selectedValue2;
            }
            if(id !== '' && team !== null){
                /*let postObj = { 
                    parseInt: id, 
                    equipe: team
                }
                let post = JSON.stringify(postObj)*/
                const url = "./includes/update_teams.php?user="+id+"&equipe="+team+"&selectedValue="+faction
                let xhr = new XMLHttpRequest()
                xhr.open('GET', url, true)
                xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8')
                xhr.send();
                xhr.onload = function () {
                    if(xhr.status === 200) {
                        console.log("Post successfully created!") 
                    }
                }
                /*fetch("./includes/update_teams.php", {
                    method: 'post',
                    body: post,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                }).then((response) => {
                    return response.json()
                }).then((res) => {
                    if (res.status === 200) {
                        console.log("Post successfully created!")
                    }
                }).catch((error) => {
                    console.log(error)
                })*/
            }
        }
    }
    function launchGame(event) {
    if (!checkTeams()) {
        event.preventDefault(); // Annule le comportement par défaut du lien
        alert("Il doit y avoir au moins 1 joueur par équipe. Veuillez ajouter des joueurs.");
    }
}

// Récupère le lien de lancement du jeu
var startGameLink = document.getElementById('startgame');

// Ajoute un événement de clic au lien
startGameLink.addEventListener('click', launchGame);

function checkTeams() {
    var equipe1 = document.getElementById('selecteam1');
    var equipe2 = document.getElementById('selecteam2');

    var joueursEquipe1Liste = equipe1.children;
    var joueursEquipe2Liste = equipe2.children;

    if (joueursEquipe1Liste.length < 1 || joueursEquipe2Liste.length < 1) {
        return false; // Empêche le lancement du lien
    }

    return true; // Permet le lancement du lien
}

</script>

