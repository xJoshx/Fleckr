<?php

if(isset($_POST['register'])){

	header("Location: loginUser.html");

	include('connect_db.php');

	$user = $_POST["User"];
	$pass = $_POST["Pass"];
	
	//Se inserta el usuario en la bd
	$query = "INSERT IGNORE INTO Fleckr.Users VALUES ('$user','$pass','','','',5)";

	echo "$consulta";

	$result = mysql_query($query);
	
	//Se crea la colección por defecto
	$collectionDefault = $user . "default";
	$query = "INSERT INTO Fleckr.Collections VALUES ('$collectionDefault','No','No','Admin1','$user','0','No','0','0')";
	
	echo "$consulta";
	
	$result = mysql_query($query);
	
	//Se crea el directorio que almacenará las fotos
	define('ABSPATH', dirname(__FILE__));
	$directory = ABSPATH . "/$user";
	mkdir($directory);
}
?>