/*Drag and drop*/
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

/*Caroussel factions*/
    // Récupérer les éléments du carrousel
    var caroussel = document.querySelector('.caroussel');
    var backBtn = document.querySelector('#backcarou');
    var goBtn = document.querySelector('#gocarou');
    var carouContent = document.querySelectorAll('.caroucontent');
    
    var currentIndex = 0;
    
    // Masquer toutes les réponses du carrousel, sauf la première
    for (var i = 1; i < carouContent.length; i++) {
        carouContent[i].style.display = 'none';
    }
    
    // Fonction pour afficher la réponse suivante
    function showNext() {
        carouContent[currentIndex].style.display = 'none';
        currentIndex = (currentIndex + 1) % carouContent.length;
        carouContent[currentIndex].style.display = 'block';
    }
    
    // Fonction pour afficher la réponse précédente
    function showPrevious() {
        carouContent[currentIndex].style.display = 'none';
        currentIndex = (currentIndex - 1 + carouContent.length) % carouContent.length;
        carouContent[currentIndex].style.display = 'block';
    }
    
    // Ajouter les écouteurs d'événements aux boutons
    backBtn.addEventListener('click', showPrevious);
    goBtn.addEventListener('click', showNext);