<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
<style>
div.scrollmenu {
  background-color: #333;
  overflow: auto;
  white-space: nowrap;
}

div.scrollmenu a {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px;
  text-decoration: none;
}

div.scrollmenu a:hover {
  background-color: #777;
}
</style>
</head>
<body>
<p id="storage"></p>
<input type="password" id="wordinput"></input>
<button onclick="start()">start</button>
<br><br>
<div class="scrollmenu" id="buttons"></div>
<br><br>
<div class="progress">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
  aria-valuemin="0" aria-valuemax="100" style="width:100%">
    100%
  </div>
</div>
<div class="text-center">
<h1 id="question"></h1>

<a id="prize" href="#"><img id="star" style="display:none" width="100px" src="./images/star.png"></a>
<div id="finish">
<p id="demo"></p>
<p id="prizesleft"></p>
<p id="prizeNumber"></p>
</div>
</div>
<p id="answer"></p>

<!--<button onclick="playAudio()" type="button">Play Audio</button>-->

<audio id="myAudio">
  <source src="horse.ogg" type="audio/ogg">
  <source src="./soundeffects/Correct-answer.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>

</body>


<script>
// Check browser support
var localStorage = window.localStorage;
var windowlocation = window.location.href;
var vocabulary = "";
try{
encrypted = windowlocation.split("?")[1];
ciphertext = encrypted.substring(5, encrypted.length);
//document.getElementById("demo").innerHTML = ciphertext;
var bytes = CryptoJS.AES.decrypt(ciphertext.toString(), 'secret');
var vocabulary = bytes.toString(CryptoJS.enc.Utf8);
}catch(err){

}
var progress = 100;
var audio = document.getElementById("myAudio"); 
var prizes = [];
var prizesname = [];
var question;
var player_answer;
var question_split;
var hidden_text;
var hidden_text_split;
var wordinput = document.getElementById("wordinput");
if (vocabulary.length>0){
  wordinput.value = vocabulary.toLowerCase();
}

if(localStorage.getItem("prizes")){
    //document.getElementById("storage").innerHTML = "yes";
	retrievePrizeList();

}else{
    getPrizes();
}




function startAgain(){
hideCongratsMessage();
document.getElementById("star").style.display = "none";
 progress = 100;
 var progressBarClass = document.getElementsByClassName("progress-bar");
 var width = "width:"+progress.toString() + "%";
 progressBarClass[0].setAttribute("style", width);
 progressBarClass[0].style.width = width;
 progressBarClass[0].innerHTML = progress.toString() + "%";

}

function savePrizeList(){
	  //save prizes to local web storage
	  if (typeof(Storage) !== "undefined") {
		  // Store

		  localStorage.setItem("prizes", JSON.stringify(prizes));
		  localStorage.setItem("prizesname", JSON.stringify(prizesname));
		  localStorage.setItem("test", "test");
	  } else {
		  document.getElementById("storage").innerHTML = "Sorry, your browser does not support Web Storage...";
	  }
}

function removeKey(key){
	  //save prizes to local web storage
	  if (typeof(Storage) !== "undefined") {
		  // Store
		  localStorage.removeItem(key);
		  localStorage.removeItem(key);

	  } else {
		  document.getElementById("storage").innerHTML = "Sorry, your browser does not support Web Storage...";
	  }
}

function retrievePrizeList(){
	if (typeof(Storage) !== "undefined") {
		prizes = JSON.parse(localStorage.getItem("prizes"));
		prizesname = JSON.parse(localStorage.getItem("prizesname"));
		var test = localStorage.getItem("test");
		//document.getElementById("storage").innerHTML = test;
	} else {
	  document.getElementById("storage").innerHTML = "Sorry, your browser does not support Web Storage...";
	}
}
function getPrizes() {
   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		var obj = JSON.parse(this.responseText);
      loadPrizes(obj);
	  //document.getElementById("storage").innerHTML = obj;
    }
   };
   xhttp.open("GET", "./prizes.json", true);
   xhttp.send();
}

function loadPrizes(json_data){
   for (var x in json_data){
      var name = x;
      var url = json_data[x];
	  prizes.push(url);
	  prizesname.push(name);
   }
}
function playAudio(soundfile) {
  audio.src = "./soundeffects/"+soundfile; 
  audio.play(); 
} 

function start(){ 
   	startAgain();
	question = wordinput.value.toLowerCase();
	question_split = question.split("");
	hidden_text = "";
	for (var x=0; x<question_split.length;x++){
	  hidden_text += question[x].replace(question[x], "___ ");
	}
	hidden_text_split = hidden_text.split(" ");

	document.getElementById("question").innerHTML = hidden_text;
	wordinput.value = "";
}


loadButtons();

function loadButtons(){
	var buttons_array = [];
	var button;
	var letter;
	for (var x=0; x<26;x++){
	  letter = (x+10).toString(36);
	  button = "<button type='button' class='btn btn-success btn-lg'  value='"+letter+"' onclick='display(this.value)'>"+letter+"</button>";
	  buttons_array.push(button);
	}

	text = "";
	for (var i=0; i<buttons_array.length; i++){
	  text += buttons_array[i];
	}
	document.getElementById("buttons").innerHTML = text;
	var header = document.getElementById("scrollmenu");

}
function displayStar(){
	  document.getElementById("star").style.display = "inline-block";
}

function randomPrize(){
	  var prizeNumber = Math.floor((Math.random() * prizes.length) + 1);

	  return prizeNumber;
}

function removePrize(prizeNumber){
	  prizes.splice(prizeNumber-1, 1); //remove given prize
	  prizesname.splice(prizeNumber-1, 1); //remove given prize
}

function createCongratsMessage(prizeNumber){
	var message = "<p>YOU DID IT</p>";
	message = message + "<p>YOU WON A " + prizesname[prizeNumber-1]+"</p><p>Click on the star to reveal your prize</p>";
	return message;
}

function displayCongratsMessage(message){
    document.getElementById("demo").style.display = "inline-block";
    document.getElementById("demo").innerHTML = message;
}

function hideCongratsMessage(message){
    document.getElementById("demo").style.display = "none";
}
function changePrizeImage(prizeNumber){
 document.getElementById("prize").href = prizes[prizeNumber-1];
}

function displayPrizesLeft(){
	  document.getElementById("prizesleft").innerHTML = "Prizes left: " + prizes.length; 
}
function givePrize(){
      displayStar();
	  var prizeNumber = randomPrize();
	  changePrizeImage(prizeNumber);
      var congratulations = createCongratsMessage(prizeNumber)
	  displayCongratsMessage(congratulations);
	  removePrize(prizeNumber);



	  displayPrizesLeft();
	  savePrizeList();
	  retrievePrizeList();


}

function playerLost(){
document.getElementById("finish").innerHTML = "<p>SORRY, TRY AGAIN</p>";
playAudio("Sad_Trombone-Joe_Lamb-665429450.mp3");
}

function changeProgressBar(){
var progressBarClass = document.getElementsByClassName("progress-bar");
progress = progress - 10;
var width = "width:"+progress.toString() + "%";
progressBarClass[0].setAttribute("style", width);
progressBarClass[0].style.width = width;
progressBarClass[0].innerHTML = progress.toString() + "%";
if (progress<70){
progressBarClass[0].className = "progress-bar progress-bar-warning";
}
if (progress<40){
progressBarClass[0].className = "progress-bar progress-bar-danger";
}
if (progress==0){
	playerLost();
}
}
function display(letter){
 var correct = 0;
 for (var x=0; x<question_split.length; x++){
	  if (question_split[x]==letter){
	   //find the index of the letter;
	    var indexOfLetter = x; 
	   //reveal the letter in the hidden text
	   hidden_text_split[indexOfLetter] = letter;
	   correct+= 1;
	  }
 }  
 if (correct==0){
   playAudio("Wrong-answer-sound-effect.mp3");
   changeProgressBar();
 }else{
   playAudio("Right-answer-ding-ding-sound-effect.mp3");
   var text = hidden_text_split.join(" ");
   document.getElementById("question").innerHTML = text;
   if(hidden_text_split.includes("___")){
      //document.getElementById("finish").innerHTML = "not finish";
   }else{

      playAudio("Correct-answer.mp3");
	  givePrize();
	  
   }
 }
   
}

</script>

</html>
