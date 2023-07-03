<?php
include "./includes/connect.php";
?>
<div id="game">
<div id="muteButton" class="mutes" style="position: absolute;right: 0px;padding: 20px;top:0px">
        <img src="./images/mute.jpg" alt="mute">
    </div>
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
else{
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
    equipe1Container.appendChild(entiteElement);
  });

  equipe2.forEach(function(entite) {
    var entiteElement = creerElementEntite(entite);
    entiteElement.classList.add("class_" + entite.classe.Class); // Ajouter la classe correspondante
    equipe2Container.appendChild(entiteElement);
  });
}

// Crée un élément HTML représentant une entité
function creerElementEntite(entite) {
  var entiteElement = document.createElement("div");
  entiteElement.classList.add("entite");

  var imageElement = document.createElement("img");
var classId = entite.classe.Class; // Obtient l'ID de la classe de l'entité

// Condition pour déterminer quelle image charger en fonction de la classe de l'entité
if (classId === 1) {
  imageElement.src = "../images/Buccaneer.png";
} else if (classId === 2) {
  imageElement.src = "../images/Mage.png";
} else if (classId === 3) {
  imageElement.src = "../images/Gunner.png";
} else if (classId === 4) {
  imageElement.src = "../images/Cowboy.png";
} else if (classId === 5) {
  imageElement.src = "../images/Hazel.png";
} else {
  imageElement.src = "../images/Cyber.png";
}

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
      } else {
        resultatCombat.textContent = "Équipe 1 gagne !";
        backgroundSound.volume = 0; 
        victory.play ();
      }
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

function fetchLvlUpEquipe(team) {
  fetch('http://localhost:8000/index.php?game', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(team),
  })
    .then(response => response.json())
    .then(data => {
      console.log('Mise à jour réussie :', data);
      // Effectuez les actions nécessaires après la mise à jour, par exemple, afficher un message de succès ou recharger la page
    })
    .catch(error => {
      console.error('Erreur lors de la mise à jour :', error);
      // Gérez les erreurs de la requête, par exemple, afficher un message d'erreur à l'utilisateur
    });
}

// Exemple d'utilisation après la fin du combat
if (equipeTousMorts(equipe1Shuffled)) {
  // L'équipe 2 a gagné, mettez à jour le niveau de l'équipe 2
  fetchLvlUpEquipe(equipe2);
} else {
  // L'équipe 1 a gagné, mettez à jour le niveau de l'équipe 1
  fetchLvlUpEquipe(equipe1);
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

  </script>

</div>
