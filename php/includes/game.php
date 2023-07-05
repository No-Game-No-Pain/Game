<?php
include "./includes/connect.php";
?>
<div id="game">
<div id="muteButton" class="mutes" style="position: absolute;right: 0px;padding: 20px;top:0px">
        <img src="./images/mute.jpg" alt="mute">
    </div>
  <div id="restartacc"></div>
  <div id="equipe1">
  </div>
    <div id="equipe2">
  </div>
  <div id="historique"></div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
   //traitement de background
let backgroundChoice = localStorage.getItem('backgroundChoice');
console.log(backgroundChoice);

if (backgroundChoice) {
  // Appliquer le background récupéré
document.getElementById("game").style.backgroundImage = `url('${backgroundChoice}')`;}
else if(backgroundChoice == NULL){
  document.getElementById("game").style.backgroundImage = `url('./images/castlebridge.png')`;
}
var victory = new Audio('./images/Victory.mp3');
var backgroundSound = new Audio('./images/Gamemusic.mp3');
backgroundSound.loop = true;
var muteButton = document.getElementById('muteButton');
var isMuted = false;
backgroundSound.play ();
muteButton.addEventListener('click', function() {
  if (isMuted) {
    backgroundSound.volume = 1; // Rétablir le volume à 100%
    muteButton.src = "./images/mute.jpg"; // Mettre à jour l'image du bouton
  } else {
    backgroundSound.volume = 0; // Mettre le volume à 0 (mute)
    muteButton.src = "./images/unmute.jpg"; // Mettre à jour l'image du bouton
  }
  
  isMuted = !isMuted; // Inverser l'état du mute
});
    

const Equipen1 = <?php 
  $response = $conn->query('SELECT * FROM User WHERE Team = 1');
  $team1Data = array();
  while ($donnees = $response->fetch()) {
    $team1Data[] = array(
      'Team1' => $donnees['Team'] == 1,
      'ID_Class1' => $donnees['ID_Class'],
      'Name1' => $donnees['Name'],
      'Level1' => $donnees['Level']
    );
  }
  echo json_encode($team1Data);
?>;
  
const Equipen2 = <?php 
  $response = $conn->query('SELECT * FROM User WHERE Team = 2');
  $team2Data = array();
  while ($donnees = $response->fetch()) {
    $team2Data[] = array(
      'Team' => $donnees['Team'] == 2,
      'ID_Class' => $donnees['ID_Class'],
      'Name' => $donnees['Name'],
      'Level' => $donnees['Level']
    );
  }
  echo json_encode($team2Data);
?>;
const Classes = <?php
  $response = $conn->query('SELECT * FROM Class');
  $DataClasses = array();
  while ($donnees = $response->fetch()) {
    $DataClasses[] = array(
      'Class' => $donnees['ID_Class'],
      'Attack' => $donnees['Attack'],
      'HP' => $donnees['HP']
    );
  }
  echo json_encode($DataClasses);
?>;


equipe1 = Equipen1.map((data, index) => {
  const classData = getClassById(data.ID_Class1);
  return {
    nom: data.Name1,
    classe: classData,
    vie: classData ? classData.HP : null,
    attaque: getClassAttackById(data.ID_Class1)
  };
});
/*for (var i = 0; i < Equipen1.length; i++) {
  var joueur = Equipen1[i];
    // Accéder au niveau (Level) du joueur
    var niveau = joueur.Level1;

  // Utilisez le niveau comme bon vous semble
  console.log(niveau);}*/

equipe2 = Equipen2.map((data, index) => {
  const classData = getClassById(data.ID_Class);
  return {
    nom: data.Name,
    classe: classData,
    vie: classData ? classData.HP : null,
    attaque: getClassAttackById(data.ID_Class)
  };
});

function getClassById(id) {
  const classData = Classes.find((classItem) => classItem.Class === id);
  return classData ? classData : null;
}

function getClassAttackById(id) {
  const classData = Classes.find((classItem) => classItem.Class === id);
  return classData ? classData.Attack : null;
}

console.table(equipe1);
console.table(equipe2);
console.table(Classes);

var historiqueAttaques = [];

var equipe1Index = 0; // Indice de l'entité active de l'équipe 1
var equipe2Index = 0; // Indice de l'entité active de l'équipe 2

  // Créer la div pour afficher le résultat du combat
  var resultatCombatDiv = document.createElement("div");
  resultatCombatDiv.id = "resultatCombat";
  document.getElementById("game").appendChild(resultatCombatDiv);


// Affiche les entités de chaque équipe dans le HTML
function afficherEntites() {
  var equipe1Container = document.getElementById("equipe1");
  var equipe2Container = document.getElementById("equipe2");

  equipe1.forEach(function(entite) {
    var entiteElement = creerElementEntite(entite);
    entiteElement.classList.add("class_" + entite.classe.Class); // Ajouter la classe correspondante

    var imageContainer = entiteElement.querySelector(".image-container"); // Sélectionner la div contenant l'image
    imageContainer.classList.add("class_" + entite.classe.Class); // Ajouter la classe correspondante à la div de l'image
    imageContainer.classList.add("equipe" + 1); // Ajouter la classe correspondante à l'équipe

    equipe1Container.appendChild(entiteElement);
  });

  equipe2.forEach(function(entite) {
    var entiteElement = creerElementEntite(entite);
    entiteElement.classList.add("class_" + entite.classe.Class); // Ajouter la classe correspondante

    var imageContainer = entiteElement.querySelector(".image-container"); // Sélectionner la div contenant l'image
    imageContainer.classList.add("class_" + entite.classe.Class); // Ajouter la classe correspondante à la div de l'image
    imageContainer.classList.add("equipe" + 2); // Ajouter la classe correspondante à l'équipe

    equipe2Container.appendChild(entiteElement);
  });
}


// Crée un élément HTML représentant une entité
function creerElementEntite(entite) {
  var entiteElement = document.createElement("div");
  entiteElement.classList.add("entite");

  var imageContainer = document.createElement("div");
  imageContainer.classList.add("image-container");

  var classId = entite.classe.Class; // Obtient l'ID de la classe de l'entité

  if (classId === 1) {
    imageContainer.style.backgroundImage = "url('../images/Buccaneer-sprite.png')";
  } else if (classId === 2) {
    imageContainer.style.backgroundImage = "url('../images/Mage-sprite.png')";
  } else if (classId === 3) {
    imageContainer.style.backgroundImage = "url('../images/Gunner-sprite.png')";
  } else if (classId === 4) {
    imageContainer.style.backgroundImage = "url('../images/Cowboy-sprite.png')";
  } else if (classId === 5) {
    imageContainer.style.backgroundImage = "url('../images/Hazel-sprite.png')";
  } else {
    imageContainer.style.backgroundImage = "url('../images/Cyber-sprite.png')";
  }

  entiteElement.appendChild(imageContainer);

  var nomElement = document.createElement("span");
  nomElement.classList.add("nom");
  nomElement.textContent = entite.nom;
  entiteElement.appendChild(nomElement);

  var vieElement = document.createElement("div");
  vieElement.classList.add("vie");
  var vieRemplieElement = document.createElement("span");
  vieRemplieElement.style.width = (entite.vie / 100) * 100 + "%";
  vieElement.appendChild(vieRemplieElement);
  entiteElement.appendChild(vieElement);

  // Fonction pour mettre à jour la barre de vie
  function mettreAJourBarreDeVie() {
    vieRemplieElement.style.width = (entite.vie / 100) * 100 + "%";
  }

  // Définir une propriété sur l'entité pour mettre à jour la barre de vie
  entite.mettreAJourBarreDeVie = mettreAJourBarreDeVie;

  return entiteElement;
}

// Effectue une attaque entre l'attaquant et la cible
function effectuerAttaque(attaquant, cible) {
  if (
    attaquant &&
    cible &&
    attaquant.attaque !== undefined &&
    cible.vie !== undefined
  ) {
    if (cible.vie <= 0) {
      return; // Ignore l'attaque si la cible est déjà vaincue
    }
    let attaque = {
      attaquant: attaquant,
      cible: cible
    };

    let degats = Math.floor(attaquant.attaque);

    cible.vie -= degats;

    if (equipe1.includes(cible)) {
      equipe1.splice(equipe1.indexOf(cible), 1);
    } else {
      equipe2.splice(equipe2.indexOf(cible), 1);
    }
    if (cible.vie <= 0) {
      cible.vie = 0;
    }

    historiqueAttaques.push(attaque);

    if (cible.mettreAJourBarreDeVie) {
      cible.mettreAJourBarreDeVie(); // Met à jour la barre de vie de la cible si la méthode existe
    }
  }
}

// Affiche l'historique des attaques dans le HTML
function afficherHistoriqueAttaques() {
  var historiqueContainer = document.getElementById("historique");
  historiqueContainer.innerHTML = ""; // Efface le contenu précédent

  historiqueAttaques.forEach(function(attaque) {
    var attaqueElement = document.createElement("div");
    var attaquantNom = attaque.attaquant.nom;
    var cibleNom = attaque.cible.nom;
    var degats = attaque.attaquant.attaque;
    attaqueElement.textContent = attaquantNom + " attaque et inflige  " + degats  +" points de dégâts à "+ cibleNom ;
    historiqueContainer.appendChild(attaqueElement);
  });

  // Faire défiler vers le bas pour afficher le dernier élément
  var dernierElement = historiqueContainer.lastChild;
  dernierElement.scrollIntoView();
}
// Démarrage du combat
afficherEntites();
demarrerCombat();
afficherHistoriqueAttaques();

function demarrerCombat() {
  var equipe1Copy = equipe1.slice(); // Copie de l'équipe 1
  var equipe2Copy = equipe2.slice(); // Copie de l'équipe 2

  // Mélange aléatoire des deux équipes
  var equipe1Shuffled = shuffle(equipe1Copy);
  var equipe2Shuffled = shuffle(equipe2Copy);

  var equipe1Index = 0; // Indice du joueur actif de l'équipe 1
  var equipe2Index = 0; // Indice du joueur actif de l'équipe 2

  var equipeQuiAttaque = equipe1Shuffled;
  var equipeCible = equipe2Shuffled;

  var intervalID;

  // Fonction pour effectuer une attaque à intervalles réguliers
  intervalID = setInterval(function() {
    // Vérifier si tous les joueurs d'une équipe sont morts
    if (
      equipeTousMorts(equipe1Shuffled) ||
      equipeTousMorts(equipe2Shuffled)
    ) {
      // Arrêter l'exécution de l'attaque à intervalles réguliers
      clearInterval(intervalID);

      // Afficher les équipes victorieuses
      var resultatCombat = document.getElementById("resultatCombat");
      
      if (equipeTousMorts(equipe1Shuffled)) {
        resultatCombat.textContent = "Équipe 2 gagne !";
        backgroundSound.volume = 0; 
        victory.play ();



        <?php
                        $reponse = $conn->query('SELECT * FROM `User` WHERE Team = 2;');
                        $userData = array();
                        
                        while ($donnees = $reponse->fetch()) {
                          $userData[] = array(
                            'ID_User' => $donnees['ID_User'],
                            'Level' => $donnees['Level']
                        );
                        }
                        
                        $reponse->closeCursor();
                        ?>
                       const userData = <?php echo json_encode($userData); ?>;
    console.log(userData);

    for (let i = 0; i < userData.length; i++) {
        const idUser = userData[i].ID_User;
        const level = userData[i].Level;
        const url = "./includes/levelup.php?user=" + idUser + "&level=" + level;
        let xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
        xhr.send();
        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log("Post successfully created!");
            }
        };
    }
      } else {
        resultatCombat.textContent = "Équipe 1 gagne !";
        backgroundSound.volume = 0; 
        victory.play ();

                <?php
                     $reponse = $conn->query('SELECT * FROM `User` WHERE Team = 1;');
                     $userData = array();  
                    while ($donnees = $reponse->fetch()) {
                   $userData[] = array(
                  'ID_User' => $donnees['ID_User'],
                 'Level' => $donnees['Level']
                );
                }
                                
                $reponse->closeCursor();
               ?>
                              const userData = <?php echo json_encode($userData); ?>;
            console.log(userData);

            for (let i = 0; i < userData.length; i++) {
                const idUser = userData[i].ID_User;
                const level = userData[i].Level;
                const url = "./includes/levelup.php?user=" + idUser + "&level=" + level;
                let xhr = new XMLHttpRequest();
                xhr.open('GET', url, true);
                xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
                xhr.send();
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        console.log("Post successfully created!");
                    }
                };
            }


      }
        // Boutons accueil et restart
        // Bouton ACC
      var bouton = document.createElement("button");
        bouton.innerHTML = "<span class='glowing-txt'>A<span class='faulty-letter'>CC</span>UEIL</span>"; // Texte du bouton
        bouton.id = "btnacc";

        bouton.addEventListener("click", function() {
        // Rediriger vers une autre page au clic sur le bouton
        window.location.href = "index.php?"; // Remplacez l'URL par l'adresse de la page de destination
        });

        // Ajouter le bouton à un élément existant de la page
        var conteneur = document.getElementById("restartacc"); // Remplacez "conteneur" par l'ID de l'élément où vous souhaitez ajouter le bouton
        conteneur.appendChild(bouton);

              // Bouton RESTART
      var bouton = document.createElement("button");
        bouton.innerHTML = "<span class='glowing-txt2'>R<span class='faulty-letter2'>E</span>START</span>"; // Texte du bouton
        bouton.id = "btnrestart";

        bouton.addEventListener("click", function() {
          // Rediriger vers une autre page au clic sur le bouton
          window.location.href = "index.php?select"; // Remplacez l'URL par l'adresse de la page de destination
        });

        // Ajouter le bouton à un élément existant de la page
        var conteneur = document.getElementById("restartacc"); // Remplacez "conteneur" par l'ID de l'élément où vous souhaitez ajouter le bouton
        conteneur.appendChild(bouton);
    }
    

    // Attaque de l'équipe qui attaque
    var attaquant, cible;

    if (equipeQuiAttaque === equipe1Shuffled) {
      attaquant = equipe1Shuffled[equipe1Index];
      cible = equipe2Shuffled[equipe2Index];
    } else {
      attaquant = equipe2Shuffled[equipe2Index];
      cible = equipe1Shuffled[equipe1Index];
    }

    // Effectuer l'attaque
    effectuerAttaque(attaquant, cible);

    // Passer au joueur suivant de l'équipe qui attaque
    if (equipeQuiAttaque === equipe1Shuffled) {
      equipe1Index = (equipe1Index + 1) % equipe1Shuffled.length;
    } else {
      equipe2Index = (equipe2Index + 1) % equipe2Shuffled.length;
    }

    // Changer l'équipe qui attaque et l'équipe cible
    var tempEquipeQuiAttaque = equipeQuiAttaque;
    equipeQuiAttaque = equipeCible;
    equipeCible = tempEquipeQuiAttaque;

    // Vérifier si tous les joueurs d'une équipe ont attaqué
    if (
      equipe1Index === 0 &&
      equipe2Index === 0 &&
      equipeQuiAttaque === equipe1Shuffled
    ) {
      // Mélanger aléatoirement les équipes
      equipe1Shuffled = shuffle(equipe1Shuffled);
      equipe2Shuffled = shuffle(equipe2Shuffled);

      // Choisir de manière aléatoire l'attaquant et la cible pour le prochain tour
      equipe1Index = Math.floor(Math.random() * equipe1Shuffled.length);
      equipe2Index = Math.floor(Math.random() * equipe2Shuffled.length);
    }

    // Afficher l'historique des attaques à chaque tour de boucle
    afficherHistoriqueAttaques();
  }, 400); // Interval en millisecondes (ici, 50 millisecondes)
}

// Vérifie si tous les joueurs d'une équipe ont une vie inférieure ou égale à zéro
function equipeTousMorts(equipe) {
  return equipe.every(function(joueur) {
    return joueur.vie <= 0;
  });
}

// Fonction de mélange aléatoire (algorithme de Fisher-Yates)
function shuffle(array) {
  var currentIndex = array.length,
    temporaryValue,
    randomIndex;

  while (currentIndex !== 0) {
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}

});

function updateLevelT1(winnerT1) {
        var xhr = new XMLHttpRequest();
        var url = './includes/update_levelT1.php';
        var lvl = 'niveau';

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Succès de la requête AJAX
                console.log(xhr.responseText);
            }
        };

        xhr.open('GET', url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('winner=' + encodeURIComponent(winnerT1));
    }


    function updateLevelT2(winnerT2) {
        var xhr = new XMLHttpRequest();
        var url = './includes/update_levelT2.php';
        var lvl = 'niveau';

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Succès de la requête AJAX
                console.log(xhr.responseText);
            }
        };

        xhr.open('GET', url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('winner=' + encodeURIComponent(winnerT2));
    }


  </script>

</div>
