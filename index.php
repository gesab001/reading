<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
<body>

<p id="test"></p>
<p id="dateUpdate"></p>
<ol id="demo"></ol>


<script>

var xhttp = new XMLHttpRequest();
var news;
loadSelectionTitles();


function loadSelectionTitles(){
   xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       var myArr = JSON.parse(this.responseText);
       loadSelection(myArr);
	  
    }else{
	//document.getElementById("demo").innerHTML = "its  not working";
	}
 };
 xhttp.open("GET", "wordlist.json", true);
 xhttp.send();
}

function loadSelection(myArr){
	var text = "";
	
	for (var x in myArr){
	    var ciphertext = CryptoJS.AES.encrypt(x, 'secret');
		text += "<li><a href='./hangman/index.html?word="+ciphertext+"'><h1>"+x+"</h1></a></li>";
	}
	document.getElementById("demo").innerHTML = text;
}
</script>

</body>

</html>