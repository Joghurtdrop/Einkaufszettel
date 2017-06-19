/* function to add new items to the list */
function newItem(e) {
	var doppelt = true;
   /* var newitem = document.createElement("div");
    newitem.className = "column";
    newitem.setAttribute("draggable","true");
	newitem.id = e.id;
	newitem.innerHTML = e.innerText+"<div onclick=\"removeItem(this)\" class=\"icon\">\
					<i class=\"material-icons md-18\">&#xE92B;\
					</i>\
				</div>";*/
	var pos = 0;
	var cols = document.querySelectorAll('.column');
	[].forEach.call(cols, function(col) {
		if (col.id == e.id){
			alert(col.innerText+" liegt bereits auf deinem Einkaufsweg!");
			doppelt = false;
		}
			pos++;
	});
	if (doppelt){
		//document.getElementById("trace").appendChild(newitem);
		addToDb(++pos,e.id);
		loadList();
	}
	
	
	saveList();
    refreshItems();
}

function removeItem(e){
	var levelup = e.parentNode;
	
	var node = levelup.parentNode.firstChild;
	var pos=0;
	while (node && node != levelup){
		node = node.nextElementSibling;
		pos++;
		
	} 	
	//e.parentNode.remove();
	//saveList();
	removeFromDb(pos, levelup.id);
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
	
	var rootEL = document.getElementById('trace');
	var target = e.target;
	
	if( target && target !== dragSrcEl ){
		var rect = e.target.getBoundingClientRect();
		var next = (e.clientY - rect.top)/(rect.bottom - rect.top) > .5;
		if (target.nextSibling !== null ){
			rootEL.insertBefore(dragSrcEl, next && target.nextSibling || target);
		} else {
			rootEL.insertBefore(dragSrcEl, next && target || target.nextSibling);
		}
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

function handleDragEnd(e) {
    this.style.opacity = '1.0';
    var cols = document.querySelectorAll('.column');
    [].forEach.call(cols, function (col) {
        col.classList.remove('over');
    });
	
	saveList();
	refreshItems();
}

function refreshItems() {
    var cols = document.querySelectorAll('.column');
    [].forEach.call(cols, function(col){
        col.addEventListener('dragstart', handleDragStart, false)
        col.addEventListener('dragenter', handleDragEnter, false)
        col.addEventListener('dragover', handleDragOver, false)
        col.addEventListener('dragleave', handleDragLeave, false)
        //col.addEventListener('drop', handleDrop, false)
        col.addEventListener('dragend', handleDragEnd, false)
    });

}

function loadDoc(phpSource, id) 
{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		
      document.getElementById(id).innerHTML=this.responseText;
	  refreshItems();
	}	
  };
  xhttp.open("GET", phpSource, true);
  xhttp.send();
  
}

function loadList(){
	loadDoc("ShopTraceList.php", "trace")
}

function saveList(){
	var user = 1;
	var shop = 1;
	var pos = 0;
	var cols = document.querySelectorAll('.column');
	
	[].forEach.call(cols,function(col){
		++pos;
		category = col.id;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) 
			{
				loadList();
			}
		};
		xhttp.open("GET", "updateShopList.php?position="+pos+"&shopid="+shop+"&userid="+user+"&categoryid="+category, true);
		xhttp.send();
	});
	
	
}

function addToDb(pos,category){

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) 
		{
			loadList();
		}
	};
	xhttp.open("GET", "addShopEntry.php?position="+pos+"&categoryid="+category, true);
	xhttp.send();

}

function removeFromDb(pos, category){
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) 
		{
			loadList();
			
		}
	};
	xhttp.open("GET", "removeFromShopList.php?position="+pos+"&categoryid="+category, true);
	xhttp.send();
	
}

loadDoc("ShopCategoryList.php", "verticallist");
loadList();
refreshItems();