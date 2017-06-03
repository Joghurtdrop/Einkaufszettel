/* function to add new items to the list */
function newItem() {
    var newitem = document.createElement("div");
    newitem.className = "column";
    newitem.setAttribute("draggable","true");
    newitem.innerText = "Essiggurken";

    document.getElementById("trace").appendChild(newitem);
    refreshItems();
}

function handleDragStart(e) {
    this.style.opacity = '0.4';

    dragSrcEl = this;

    e.dataTransfer.effectAllowed = 'move';
    e.dataTransfer.setData('text', this.innerHTML);
}

function handleDragOver(e) {
    if (e.preventDefault) {
        e.preventDefault();
    }

    e.dataTransfer.dropEffect = 'move';

    return false;
}

function handleDragEnter(e) {
    this.classList.add('over');
}

function handleDragLeave(e) {
    this.classList.remove('over');
}

function handleDrop(e) {
    if (e.stopPropagation) {
        e.stopPropagation();
    }
    if (dragSrcEl != this) {
        dragSrcEl.innerHTML = this.innerHTML;
        this.innerHTML = e.dataTransfer.getData('text/plain');
    }
    return false;
}

function handleDragEnd(e) {
    this.style.opacity = '1.0';
    var cols = document.querySelectorAll('.column');
    [].forEach.call(cols, function (col) {
        col.classList.remove('over');
    });
}

function refreshItems() {
    var cols = document.querySelectorAll('.column');
    [].forEach.call(cols, function(col){
        col.addEventListener('dragstart', handleDragStart, false)
        col.addEventListener('dragenter', handleDragEnter, false)
        col.addEventListener('dragover', handleDragOver, false)
        col.addEventListener('dragleave', handleDragLeave, false)
        col.addEventListener('drop', handleDrop, false)
        col.addEventListener('dragend', handleDragEnd, false)
    });
}
refreshItems();
