
loadDoc("loadShopList.php","shopList");

function loadDoc(phpSource, id) 
{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {	
    document.getElementById(id).innerHTML=this.responseText;
	}	
  };
  xhttp.open("GET", phpSource, true);
  xhttp.send();
}


function setSelectedShop(div)
{
	document.getElementById("selectedCategory").innerHTML=div.innerHTML;
	document.getElementById("selectedCategoryId").innerHTML=div.nextElementSibling.innerHTML;
}