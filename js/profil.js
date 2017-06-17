
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



function setSelectedShop(el)
{
	$.ajax({
		type: "POST",
		url: "setSelectedShop.php",
		data:{
			selectedShopId:el.lastElementChild.innerHTML
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