<?php

//Para autorizar o desautorizar a los usuarios. También para cambiar los permisos. Las cuentas pueden ser básicas o completas.

include('connect_db.php');

$actionType = $_GET['type'];

$admin = 'Admin1';
$id = $_GET['id'];

if ($actionType == 'authorize') {
	
	header("Location: adminMenu.php");
	
	$query = "INSERT IGNORE INTO Fleckr.Authorize VALUES ('$admin','$id', 'Basic')";
	
	$result = mysql_query($query);
}


if ($actionType == 'unauthorize') {

	header("Location: adminMenu.php");
	
	$query = "DELETE FROM Fleckr.Authorize WHERE Authorize.ID_ADMIN = '$admin' AND Authorize.ID_USER = '$id' LIMIT 1";

	$result = mysql_query($query);	
	
}

if ($actionType == 'changePermits') {

	$query = "SELECT * FROM Fleckr.Authorize WHERE ID_USER = '$id'";
	
	$result = mysql_query($query);
	
	$row = mysql_fetch_array($result);
	
	if ($row['PERMITS'] == 'Basic') {
		$query2 = "UPDATE Fleckr.Authorize SET PERMITS = 'Complete' WHERE ID_USER = '$id'";
		$result2 = mysql_query($query2);
		
	}
	
	else if ($row['PERMITS'] == 'Complete') {
		$query2 = "UPDATE Fleckr.Authorize SET PERMITS = 'Basic' WHERE ID_USER = '$id'";
		$result2 = mysql_query($query2);
	}
	
	header("Location: adminMenu.php");
		
}

?>