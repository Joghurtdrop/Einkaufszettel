loadDoc("loadShoppingList.php", "list");
loadDoc("loadCategoryList.php", "categories");

function loadDoc(phpSource, id) 
{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		console.log(typeof this.responseText);		
    document.getElementById(id).innerHTML=this.responseText;
	}	
  };
  xhttp.open("GET", phpSource, true);
  xhttp.send();
}

function setCategory(div)
{
	document.getElementById("selectedCategory").innerHTML=div.innerHTML;
}


function removeProduct(a)
{
	console.log(a.parentNode.parentNode);
	var product=a.parentNode.siblingAbove.innerHTML;
	$.ajax({
		type: "POST",
		url: "removeProduct.php",
		data:{
			name:product			
		},
		error: function(){
			console.log("error: removal failed");
		}
	});	
	loadDoc("loadShoppingList.php",document.getElementById("list"));
}