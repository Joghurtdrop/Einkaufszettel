loadDoc("loadShoppingList.php", "list");
loadDoc("loadCategoryList.php", "categories");

function loadDoc(phpSource, id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		console.log(typeof this.responseText);		
    document.getElementById(id).innerHTML+=this.responseText;
	}	
  };
  xhttp.open("GET", phpSource, true);
  xhttp.send();
}