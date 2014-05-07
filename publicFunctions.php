<?php

include('security.php');
	
include('connect_db.php');

$collection = $_GET["collection"];

//Para poner como pública o privada una colección

$query = "SELECT * FROM Fleckr.Collections WHERE ID_COLLECTION = '$collection'";

$result = mysql_query($query);

$row = mysql_fetch_array($result);

$public = $row["PUBLIC"];

//echo $public;

if ($public == "Yes") {
	$query2 = "UPDATE Fleckr.Collections SET PUBLIC = 'No' WHERE ID_COLLECTION = '$collection'";
	
//	echo $query2;
	
	$result = mysql_query($query2);
	
	header("Location: userControlPanel.php");
}

if ($public == "No") {
	$query2 = "UPDATE Fleckr.Collections SET PUBLIC = 'Yes' WHERE ID_COLLECTION = '$collection'";

//	echo $query2;
	
	$result = mysql_query($query2);
	
	header("Location: userControlPanel.php");
}

?>