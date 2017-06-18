
loadDoc("loadShopListProfile.php","listholder");

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


function deleteShop(el)
{
	$.ajax({
		type: "POST",
		url: "deleteShopProfile.php",
		data:{
			shopId:el.parentNode.lastElementChild.innerHTML
		},
		success:function(result){
			loadDoc("loadShopListProfile.php", "listholder");		
		},
		error: function(){
			console.log("error: update failed");
		}
	});	
}

function setSelectedShop(el)
{
	$.ajax({
		type: "POST",
		url: "setSelectedShop.php",
		data:{
			selectedShopId:el.parentNode.lastElementChild.innerHTML
		},
		success:function(result){
			$("#selectedShop").html(JSON.parse(result).name);
			$("#selectedShopId").html(JSON.parse(result).selectedShop);			
		},
		error: function(){
			console.log("error: update failed");
		}
	});	
}

function addShop(el)
{
	if($('newShopName').val()!="")
	{		
		$.ajax({
			type: "POST",
			url: "addShopProfile.php",
			data:{
				name:$('#newShopName').val()
			},
			success:function(result){
				window.location='deinMarkt.php';
			},
			error: function(){
				console.log("error: update failed");
			}
		});	
	}
}
