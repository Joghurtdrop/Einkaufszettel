/* function to add new items to the list */
function newItem(e) {
	var doppelt = true;
    var newitem = document.createElement("div");
    newitem.className = "column";
    newitem.setAttribute("draggable","true");
	newitem.id = e.innerText;
	newitem.innerHTML = e.innerText+"<div onclick=\"removeItem(this)\" class=\"icon\">\
					<i class=\"material-icons md-18\">&#xE928;\
					</i>\
				</div>";

	var cols = document.querySelectorAll('.column');
	[].forEach.call(cols, function(col) {
		if (col.id == newitem.id){
			alert(col.id+" liegt bereits auf Ihrem Einkaufsweg!");
			doppelt = false;
		}
	});
	if (doppelt){
		document.getElementById("trace").appendChild(newitem);
	}
    refreshItems();
}

function removeItem(e){
	e.parentNode.remove();
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
	console.log
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
		schubser(e,this);
    }
    return false;
}

function schubser(e, that){
	var newid = dragSrcEl.id;
        dragSrcEl.innerHTML = that.innerHTML;
		dragSrcEl.id = that.id;
        that.innerHTML = e.dataTransfer.getData('text/plain');
		that.id=newid;
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
