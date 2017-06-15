loadDoc("loadShoppingList.php", "list");
loadDoc("loadCategoryList.php", "categories");

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

function setCategory(div)
{
	document.getElementById("selectedCategory").innerHTML=div.innerHTML;
	document.getElementById("selectedCategoryId").innerHTML=div.nextElementSibling.innerHTML;
}


function removeProduct(a)
{
	console.log(a.parentNode.parentNode.lastChild.previousSibling.innerHTML);
	var productId=a.parentNode.parentNode.lastChild.previousSibling.innerHTML;
	$.ajax({
		type: "POST",
		url: "removeProduct.php",
		data:{
			id:productId
		},
		error: function(){
			console.log("error: removal failed");
		}
	});	
	loadDoc("loadShoppingList.php",document.getElementById("list"));
}


function addEntry()
{
	console.log($("#selectedCategoryId"));
	$.ajax({
		type: "POST",
		url: "addListEntry.php",
		data:{
			productName:$('#productNameInput').val(),
			productNumber:$("#numberInput").val(),
			categoryId:$("#selectedCategoryId").html()
		},
		success:function(result){
			console.log(result);
			loadDoc("loadShoppingList.php", "list");
		},
		error: function(){
			console.log("error: removal failed");
		}
	});	
}