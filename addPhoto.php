<?php

	include('security.php');
	
	include('connect_db.php');

	//Para subir fotos a la colección directamente. Se inserta en la bd el usuario, la colección y la foto.

	$me = $_SESSION['actualUser'];
	$collection = $_GET["collection"];
	$photo = $_GET["id"];	
	
	$query = "INSERT IGNORE INTO Fleckr.User_Collection_Photos VALUES ('$me','$collection','$photo')";
	
	$result = mysql_query($query);
	
	//echo $query;
	
	header("Location: addPhotosCollection.php?collection=$collection");
?>