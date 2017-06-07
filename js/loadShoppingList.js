loadDoc("loadList.php");

function loadDoc(phpSource) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		console.log(typeof this.responseText);		
    document.getElementById("list").innerHTML+=this.responseText;
	}	
  };
  xhttp.open("GET", phpSource, true);
  xhttp.send();
}