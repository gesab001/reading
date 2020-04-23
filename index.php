<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<body>
<!--<form action="../cgi-bin/addnews.py" method="post">
<input type="text" name="keyword" placeholder="keyword"/>

<input type="text" name="title" placeholder="title"/>

<input type="text" name="url" placeholder="xml address"/>

<input type="submit" value="add"/>
<br>
<form action="../cgi-bin/deletenews.py" method="post">
<input type="text" name="keyword" placeholder="keyword"/>
<input type="submit" value="delete"/>
<br>
</form>-->
<!--<select id="selection" name="news" onchange="loadNews(this.value)"></select>
-->
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
	document.getElementById("demo").innerHTML = "its  not working";
	}
 };
 xhttp.open("GET", "wordlist.json", true);
 xhttp.send();
}

function loadSelection(myArr){
	var text = "";
	for (var x in myArr){
		text += "<li><h1>"+x+"</h1></li>";
	}
	document.getElementById("demo").innerHTML = text;
}
</script>

</body>

</html>