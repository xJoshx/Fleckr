<?php

include('connect_db.php');

$actionType = $_GET['type'];

$admin = 'Admin1';

$id = $_GET['user'];

$collection = $_GET['collection'];

//Para habilitar o deshabilitar colecciones; también se manda desde aquí el mensaje al usuario.

if ($actionType == 'No') {
	
	header("Location: adminMenu.php");
	
	$query = "UPDATE Collections SET DISABLED = 'Yes' WHERE ID_COLLECTION = '$collection'";
	
	$result = mysql_query($query);
	
	$content = "Your collection $collection has been disabled.";
	
	$query = "INSERT IGNORE INTO Fleckr.Notify VALUES ('$admin','$id', '$content')";
	
	$result = mysql_query($query);
}


if ($actionType == 'Yes') {

	header("Location: adminMenu.php");
	
	$query = "UPDATE Collections SET DISABLED = 'No' WHERE ID_COLLECTION = '$collection'";

	$result = mysql_query($query);	
	
	$content = "Your collection $collection is enabled now.";
	
	$query = "INSERT IGNORE INTO Fleckr.Notify VALUES ('$admin','$id', '$content')";
	
	$result = mysql_query($query);
	
}

?>