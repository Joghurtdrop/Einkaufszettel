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
		$('#tooltipAddButton').css('display', 'block');		
	}
	else{
		$('#addButton').removeClass('not-active');		
		$('#tooltipAddButton').css('display', 'none');		
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
	$.ajax({
		type: "POST",
		url: "addListEntry.php",
		data:{
			productName:$('#productNameInput').val(),
			productNumber:$("#numberInput").val(),
			categoryId:$("#selectedCategoryId").html()
		},
		success:function(result){
			loadDoc("loadShoppingList.php", "list");
			productName:$('#productNameInput').val("");
			productNumber:$("#numberInput").val("");	
			$('#addButton').addClass('not-active');
			$('#tooltipAddButton').css('display', 'block');				
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
	if(newNumber<=9999)
	{
		updateEntry(a.parentNode.parentNode.lastElementChild.innerHTML, newNumber);		
	}
}

function decrementEntry(a)
{
	newNumber=parseInt(a.parentNode.parentNode.firstElementChild.innerHTML)-1;
	updateEntry(a.parentNode.parentNode.lastElementChild.innerHTML, newNumber);
}


function openPrint(){
	var w=screen.width*0.8;
	var left = (screen.width/2)-(w/2);
	var h=screen.height*0.8;
	window.open("/Einkaufszettel/sites/shoppingList/printversion.php","Dein Einkaufszettel - Druckversion", 'height='+h+',width='+w+',scrollbars=yes,status=yes,left='+left+'menubar=yes');
}