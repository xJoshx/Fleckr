<?php

include('security.php');
	
include('connect_db.php');

//Para crear una colección por defecto

$collectionName = $_POST["collection"];
$width = $_POST["width"];
$height = $_POST["height"];
$user = $_SESSION["actualUser"];

$query = "INSERT INTO Fleckr.Collections VALUES ('$collectionName','No','No','Admin1','$user','0','No', '$width', '$height')";

$result = mysql_query($query);
	
header("Location: userControlPanel.php");

?>