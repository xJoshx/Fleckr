<?php

//Para banear o desbanear

$actionType = $_GET['type'];

if ($actionType == 1) {
	
	header("Location: adminMenu.php");
	
	include('connect_db.php');
	
	$admin = 'Admin1';
	$id = $_GET['id'];
	
	$consulta = "INSERT IGNORE INTO Fleckr.Ban VALUES ('$admin','$id')";
	
	echo "$consulta";
	
	$resultado = mysql_query($consulta);
}


if ($actionType == 2) {

	header("Location: adminMenu.php");

	include('connect_db.php');

	$id = $_GET['id'];
	$admin = $_GET['admin'];
	
	$consulta = "DELETE FROM Fleckr.Ban WHERE Ban.ID_ADMIN = '$admin' AND Ban.ID_USER = '$id' LIMIT 1";

	$resultado = mysql_query($consulta);	
	
}


?>
