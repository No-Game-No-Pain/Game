let draggedItem = null;

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
      event.currentTarget.appendChild(droppedItem);
      draggedItem = null;
    } else {
      console.error(`Element with id '${droppedItemId}' not found.`);
    }
  }

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

