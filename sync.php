<?php 

$jsonstring = $_GET["test"]; 
$filename = $_GET["filename"] . ".json";
$myfile = fopen($filename, "w") or die("Unable to open file!");
$txt = $jsonstring;
fwrite($myfile, $txt);
fclose($myfile);
echo $jsonstring;
?>



