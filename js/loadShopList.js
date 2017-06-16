loadDoc("ShopCategoryList.php", "verticallist");


function loadDoc(phpSource, id) 
{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		//console.log(typeof this.responseText);		
      document.getElementById(id).innerHTML=this.responseText;
	}	
  };
  xhttp.open("GET", phpSource, true);
  xhttp.send();
}

function loadList(){
	loadDoc(
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
			}
		};
		xhttp.open("GET", "updateShopList.php?position="+pos+"&shopid="+shop+"&userid="+user+"&categoryid="+category, true);
		xhttp.send();
	});
}

function removeFromDb(pos, category){
	var user = 1;
	var shop = 1;
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) 
		{
		}
	};
	xhttp.open("GET", "removeFromShopList.php?position="+pos+"&shopid="+shop+"&userid="+user+"&categoryid="+category, true);
	xhttp.send();
	
}