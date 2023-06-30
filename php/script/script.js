









let draggedItem = null;
let team1Counter = 0;
let team2Counter = 0;

function dragStart(event) {
  draggedItem = event.target;
  event.dataTransfer.setData('text/plain', event.target.id);
}

function dragOver(event) {
  event.preventDefault();
}

function drop(event) {
  event.preventDefault();

  const droppedItemId = event.dataTransfer.getData('text/plain');
  const droppedItem = document.getElementById(droppedItemId);

  if (droppedItem) {
    const currentTeam = droppedItem.parentNode; // Récupérer l'équipe actuelle du joueur

    if (event.currentTarget.id === 'selecteam1' && team1Counter < 5) {
      if (currentTeam.id === 'selecteam2') {
        team2Counter--;
      }
      event.currentTarget.appendChild(droppedItem);
      team1Counter++;
    } else if (event.currentTarget.id === 'selecteam2' && team2Counter < 5) {
      if (currentTeam.id === 'selecteam1') {
        team1Counter--;
      }
      event.currentTarget.appendChild(droppedItem);
      team2Counter++;
    } else if (event.currentTarget.id === 'seleccentral') {
      // Déplacer l'élément dans la div centrale
      seleccentral.appendChild(droppedItem);
      team1Counter -= (currentTeam.id === 'selecteam1' ? 1 : 0);
      team2Counter -= (currentTeam.id === 'selecteam2' ? 1 : 0);
    } else {
    }

    draggedItem = null;
  } else {
  }
}

function resetDivs() {
  const seleccentral = document.getElementById('seleccentral');
  const selecteam1 = document.getElementById('selecteam1');
  const selecteam2 = document.getElementById('selecteam2');

  while (selecteam1.firstChild) {
    seleccentral.appendChild(selecteam1.firstChild);
  }
  while (selecteam2.firstChild) {
    seleccentral.appendChild(selecteam2.firstChild);
  }

  team1Counter = 0;
  team2Counter = 0;
}

document.addEventListener('DOMContentLoaded', function() {
  // Appel de la fonction resetDivs() une fois que le document est chargé
  resetDivs();
});

    document.addEventListener("DOMContentLoaded", function() {
        var slider = document.querySelector(".slider");
        var slides = slider.getElementsByClassName("slide");

        var settings = {
            slidesToShow: 3, // Nombre de slides affichées simultanément
            slidesToScroll: 1, // Nombre de slides à faire défiler à la fois
            // Ajoutez d'autres options selon vos besoins
        };

        // Fonction pour initialiser le slider
        function initSlider() {
            // Vérifie si le nombre de slides est supérieur au nombre de slides à afficher simultanément
            if (slides.length > settings.slidesToShow) {
                // Ajoutez des styles CSS appropriés pour créer le slider
                slider.style.overflow = "hidden";
                slider.style.whiteSpace = "nowrap";

                // Parcours des slides et ajout de styles CSS
                for (var i = 0; i < slides.length; i++) {
                    slides[i].style.display = "inline-block";
                    slides[i].style.verticalAlign = "top";
                    slides[i].style.width = (100 / settings.slidesToShow) + "%";
                }
            }
        }

        // Appel de la fonction d'initialisation du slider
        initSlider();
    });

