<?php
include "./includes/connect.php";
?>
<div id="bgselect">
    <div id="team1">
        <h2 class="Imprint">Équipe 1</h2>
        <div class="dropdown">
            <select>
                <?php
                $reponse = $conn->query('SELECT*FROM Personalized');
                while ($donnees = $reponse->fetch())
                {
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
            <select>
                <?php
                $reponse = $conn->query('SELECT*FROM Personalized');
                while ($donnees = $reponse->fetch())
                {
                    echo '<option value="'.$donnees['ID_Personalized'].'">' .$donnees['Name_Personalized']. '</option>';
                }
                $reponse->closeCursor();
                ?>
            </select>
        </div>
    </div>
    <a href="index.php?add" id="returnbtn"><img src="./images/previouspage.png" alt="Page précédente"></a>
    <a href="index.php?game" type="submit" id="startgame"><img src="./images/pressstart.png" height="100%" alt="Appuyez pour lancer le jeu"></a> 
    <div id="dropbox"></div>   
    <div id="selecteam1" class="drop-target" ondragover="dragOver(event)" ondrop="drop(event)"></div>
    <div id="seleccentral" class="drop-target" ondragover="dragOver(event)" ondrop="drop(event)">
        <?php
            $reponse = $conn->query('SELECT * FROM User');
            while ($donnees = $reponse->fetch())
            {
                echo '<div class="players" class="drag-item" draggable="true" ondragstart="JoueurID(event)" id="item'.$donnees['ID_User'].'">';
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
                    echo '<img class="imgclass" src="../images/Hazel.png" alt="Hazel">';
                }
                elseif ($donnees['ID_Class'] == 6) {
                    echo '<img class="imgclass" src="../images/Cyber.png" alt="Cyber">';
                }             
                echo '<h4 id="playerlvl">Lvl.'.$donnees['Level'].'</h4>';
                echo '</div>';
                }
            $reponse->closeCursor();
        ?>
        <script>
            function allowDrop(event) {
                event.preventDefault();
            }
                    
            function drag(event) {
                event.dataTransfer.setData("text/plain", event.target.id);
            }
                    
            function drop(event) {
                event.preventDefault();
                            var joueurId = event.dataTransfer.getData("text/plain");
                            var joueur = document.getElementById(joueurId);
                            var targetTeam = event.target;
                    
                            // Vérification du nombre maximum de joueurs par équipe
                            var equipe1 = document.getElementById('selecteam1');
                            var equipe2 = document.getElementById('selecteam2');
                    
                            var joueursEquipe1Liste = equipe1.getElementsByTagName('div');
                            var joueursEquipe2Liste = equipe2.getElementsByTagName('div');
                    
                            if (targetTeam === equipe1 && joueursEquipe1Liste.length >= 5) {
                                alert("L'équipe 1 ne peut pas avoir plus de 5 joueurs.");
                                return;
                            }
                    
                            if (targetTeam === equipe2 && joueursEquipe2Liste.length >= 5) {
                                alert("L'équipe 2 ne peut pas avoir plus de 5 joueurs.");
                                return;
                            }
                    
                            // Si l'équipe a déjà 5 joueurs, remettre le joueur au milieu
                            if ((targetTeam === equipe1 && joueursEquipe1Liste.length === 5) || (targetTeam === equipe2 && joueursEquipe2Liste.length === 5)) {
                                var middleTeam = document.getElementById('seleccentral');
                                middleTeam.appendChild(joueur);
                            } else {
                                targetTeam.appendChild(joueur);
                            }
                        }
                    
                        function validerEquipes() {
                            var joueursEquipe1 = [];
                            var joueursEquipe2 = [];
                            var joueursEquipe1Factions = [];
                            var joueursEquipe2Factions = [];
                    
                            var equipe1 = document.getElementById('selecteam1');
                            var equipe2 = document.getElementById('selecteam2');
                    
                            var joueursEquipe1Liste = equipe1.getElementsByTagName('div');
                            var joueursEquipe2Liste = equipe2.getElementsByTagName('div');
                    
                            // Vérification du nombre minimum de joueurs par équipe
                            if (joueursEquipe1Liste.length < 1 || joueursEquipe2Liste.length < 1) {
                                alert('Il doit y avoir au moins 1 joueur par équipe. Veuillez ajouter des joueurs.');
                                return;
                            }
                    
                            // Vérification du nombre maximum de joueurs par équipe
                            if (joueursEquipe1Liste.length > 5 || joueursEquipe2Liste.length > 5) {
                                alert("Chaque équipe ne peut pas avoir plus de 5 joueurs.");
                                return;
                            }
                    
                            for (var i = 0; i < joueursEquipe1Liste.length; i++) {
                                var joueur = joueursEquipe1Liste[i];
                                var joueurId = joueur.id;
                                var factionSelect = joueur.parentElement.nextElementSibling.querySelector('select');
                                var factionId = factionSelect.value;
                    
                                joueursEquipe1.push(joueurId);
                                joueursEquipe1Factions.push(FactionId);
                            }
                    
                            for (var j = 0; j < joueursEquipe2Liste.length; j++) {
                                var joueur = joueursEquipe2Liste[j];
                                var joueurId = joueur.id;
                                var factionSelect = joueur.closest('.dropdown').querySelector('select');
                                var factionId = factionSelect.value;
                    
                                joueursEquipe2.push(joueurId);
                                joueursEquipe2Factions.push(factionId);
                            }
                    
                            // Vérification du choix des Factions
                            if (joueursEquipe1Factions.includes('selecteam1') || joueursEquipe2Factions.includes('selecteam2')) {
                                alert('Veuillez sélectionner une faction pour chaque joueur.');
                                return;
                            }
                    
                            // Envoyer les données vers le script PHP pour les enregistrer dans la base de données
                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "process_form.php", true);
                            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    window.location.href = "game.php"; // Rediriger vers la page de jeu après enregistrement des données
                                }
                            };
                            xhr.send("equipe1=" + JSON.stringify(joueursEquipe1) + "&equipe2=" + JSON.stringify(joueursEquipe2) + "&equipe1Factions=" + JSON.stringify(joueursEquipe1Factions) + "&equipe2Factions=" + JSON.stringify(joueursEquipe2Factions));
                        }
                    </script>
            </div>
        <div id="selecteam2" class="drop-target" ondragover="dragOver(event)" ondrop="drop(event)"></div>
    </div>
</div>
