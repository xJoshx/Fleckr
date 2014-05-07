<?php
	
	include('connect_db.php');
	
	//Para mandar notificaciones
	
	$admin = 'Admin1';
	$id = $_GET['id'];
	$collection = $_GET['collection'];
	$content = "Your collection $collection has been deleted. Reason: continous reports. Plz don\'t do it again k thx";
	
	$query = "INSERT IGNORE INTO Fleckr.Notify VALUES ('$admin','$id', '$content')";
	
	$result = mysql_query($query);

	header("Location: adminMenu.php");
?>

