document.getElementById('shoppingList').className+='active';
loadDoc("loadShoppingList.php", "list");
loadDoc("loadCategoryList.php", "categories");

$(document).ready(function(){
	$('.overlay').fadeIn("slow");
})

$('.Input').keyup(function(){
	var empty=false;
	$('.Input').each(function(){
		if($(this).val()==''){
			empty=true;
		}
	});
	if(empty){
		$('#addButton').addClass('not-active');
		$('.tooltip:hover #tooltipAddButton').css('visibility', 'visible');		
	}
	else{
		$('#addButton').removeClass('not-active');		
		$('#.tooltip:hover #tooltipAddButton').css('visibility', 'hidden');		
	}
})

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


function updateEntry(Id, newNumber)
{	
	$.ajax({
		type: "POST",
		url: "updateListEntry.php",
		data:{
			productId:Id,
			number:newNumber
		},
		success:function(result){
			loadDoc("loadShoppingList.php", "list");
		},
		error: function(){
			console.log("error: update failed");
		}
	});	
}


function addEntry()
{
	console.log('ich werde immerhin aufgerufen');
	$.ajax({
		type: "POST",
		url: "addListEntry.php",
		data:{
			productName:$('#productNameInput').val(),
			productNumber:$("#numberInput").val(),
			categoryId:$("#selectedCategoryId").html()
		},
		success:function(result){
			console.log('result: '+result)
			loadDoc("loadShoppingList.php", "list");
			productName:$('#productNameInput').val("");
			productNumber:$("#numberInput").val("");		
		},
		error: function(){
			console.log("error: adding failed");
		}
	});	
}

function removeEntry(a)
{
	updateEntry(a.parentNode.parentNode.lastElementChild.innerHTML,0);
}

function incrementEntry(a)
{	
	newNumber=parseInt(a.parentNode.parentNode.firstElementChild.innerHTML)+1;
	updateEntry(a.parentNode.parentNode.lastElementChild.innerHTML, newNumber);
}

function decrementEntry(a)
{
	newNumber=parseInt(a.parentNode.parentNode.firstElementChild.innerHTML)-1;
	updateEntry(a.parentNode.parentNode.lastElementChild.innerHTML, newNumber);
}
