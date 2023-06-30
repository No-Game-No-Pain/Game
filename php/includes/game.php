<?php
include "./includes/connect.php";
include "./includes/process_fight.php";
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
          if($donnees['Team']== 2){
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
        }
  
  ?>

  </div>
  <div id="historique"></div>
  <script>
    const Equipen1 = <?php 
      $response = $conn->query('SELECT * FROM User');
      $team1Data = array();
        while ($donnees = $response->fetch()) {
        $team1Data[] = $donnees['Team'] == 1;}
          echo json_encode($team1Data)

    ?>;
    console.log(Equipen1);

    const Equipen2 = <?php 
      $response = $conn->query('SELECT * FROM User');
      $team2Data = array();
        while ($donnees = $response->fetch()) {
        $team2Data[] = array( 'Team'=>$donnees['Team'] == 2,
                              'ID_Class' => $donnees['ID_Class'],
                              'Name' => $donnees['Name'],
                              
                            );}
          echo json_encode($team2Data)

    ?>;
    console.table(Equipen2)
          

    /* ---- */
          

// Exemple de données d'entités
var equipe1 = [
  { nom: "Entité 1", classe: "Guerrier", vie: 100, attaque: 20 },
  { nom: "Entité 2", classe: "Mage", vie: 80, attaque: 30 },
  { nom: "Entité 3", classe: "Archer", vie: 90, attaque: 25 },
  { nom: "Entité 4", classe: "Voleur", vie: 70, attaque: 15 },
  { nom: "Entité 5", classe: "Paladin", vie: 120, attaque: 18 }
];

var equipe2 = [
  { nom: "Entité 6", classe: "Guerrier", vie: 110, attaque: 22 },
  { nom: "Entité 7", classe: "Mage", vie: 75, attaque: 35 },
  { nom: "Entité 8", classe: "Archer", vie: 85, attaque: 28 },
  { nom: "Entité 9", classe: "Voleur", vie: 60, attaque: 17 },
  { nom: "Entité 10", classe: "Paladin", vie: 100, attaque: 20 }
];

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
    equipe1Container.appendChild(entiteElement);
  });

  equipe2.forEach(function(entite) {
    var entiteElement = creerElementEntite(entite);
    equipe2Container.appendChild(entiteElement);
  });
}

// Crée un élément HTML représentant une entité
function creerElementEntite(entite) {
  var entiteElement = document.createElement("div");
  entiteElement.classList.add("entite");

  var imageElement = document.createElement("img");
  imageElement.src =
    "./images/buccaneer" + ".png";
  entiteElement.appendChild(imageElement);

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

    let pourcentageAttaque = Math.floor(Math.random() * 21) + 10; // Valeur aléatoire entre 10 et 30
    let degats = Math.floor(attaquant.attaque * (pourcentageAttaque / 100));

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
    attaqueElement.textContent =
      attaque.attaquant.nom + " attaque " + attaque.cible.nom;
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
      } else {
        resultatCombat.textContent = "Équipe 1 gagne !";
      }

      return;
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



  </script>

</div>
