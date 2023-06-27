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
        { nom: "Entité 10", classe: "Paladin", vie: 130, attaque: 20 }
      ];

        var historiqueAttaques = [];
      
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
        imageElement.src = "chemin/vers/image/" + entite.classe.toLowerCase() + ".png";
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
          // Effectue une attaque entre l'attaquant et la cible
// Effectue une attaque entre l'attaquant et la cible
function effectuerAttaque(attaquant, cible) {
    // Logique pour effectuer l'attaque
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
  
    historiqueAttaques.push(attaque);
  
    cible.mettreAJourBarreDeVie(); // Met à jour la barre de vie de la cible
  }
  
      
      
          // Affiche l'historique des attaques dans le HTML
          function afficherHistoriqueAttaques() {
            var historiqueContainer = document.getElementById("historique");
            historiqueContainer.innerHTML = ""; // Efface le contenu précédent
      
            historiqueAttaques.forEach(function(attaque) {
              var attaqueElement = document.createElement("div");
              attaqueElement.textContent = attaque.attaquant.nom + " attaque " + attaque.cible.nom;
              historiqueContainer.appendChild(attaqueElement);
            });
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
          
            // Boucle jusqu'à ce que tous les joueurs d'une équipe aient une vie <= 0
            while (!equipeTousMorts(equipe1Shuffled) && !equipeTousMorts(equipe2Shuffled)) {
              // Attaque de l'équipe qui attaque
              var attaquant = equipeQuiAttaque === equipe1Shuffled ? equipe1Shuffled[equipe1Index] : equipe2Shuffled[equipe2Index];
              var cible = equipeCible[Math.floor(Math.random() * equipeCible.length)];
          
              // Effectuer l'attaque
              effectuerAttaque(attaquant, cible, equipeQuiAttaque, equipeCible);
          
              // Vérifier si la cible est vaincue
              if (cible.vie <= 0) {
                // Retirer la cible de son équipe
                var equipeCibleIndex = equipeCible.indexOf(cible);
                if (equipeCibleIndex !== -1) {
                  equipeCible.splice(equipeCibleIndex, 1);
                }
              }
          
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
          
              // Afficher l'historique des attaques à chaque tour de boucle
              afficherHistoriqueAttaques();
            }
          
            // Afficher les équipes victorieuses
            if (equipeTousMorts(equipe1Shuffled)) {
              console.log("Équipe 2 gagne !");
            } else {
              console.log("Équipe 1 gagne !");
            }
          }
          
          // Vérifie si tous les joueurs d'une équipe ont une vie inférieure ou égale à zéro
          function equipeTousMorts(equipe) {
            return equipe.every(function(joueur) {
              return joueur.vie <= 0;
            });
          }
          
      // Fonction de mélange aléatoire (algorithme de Fisher-Yates)
      function shuffle(array) {
        var currentIndex = array.length, temporaryValue, randomIndex;
      
        while (currentIndex !== 0) {
          randomIndex = Math.floor(Math.random() * currentIndex);
          currentIndex -= 1;
      
          temporaryValue = array[currentIndex];
          array[currentIndex] = array[randomIndex];
          array[randomIndex] = temporaryValue;
        }
      
        return array;
      }