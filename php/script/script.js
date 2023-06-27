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

