<?php 

$jsonstring = $_GET["test"]; 
$filename = $_GET["filename"] . ".json";
$myfile = fopen($filename, "w") or die("Unable to open file!");
$txt = json_encode($jsonstring, JSON_PRETTY_PRINT);
fwrite($myfile, $txt);
fclose($myfile);
echo $jsonstring;
?>



