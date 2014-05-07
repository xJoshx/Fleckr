<?php

	
include('connect_db.php');

$photo = $_GET["id"];
$collection = $_GET["collection"];

//Primero se borra la foto de la ternara User_Collections_Photos. Esto hace que si pertenece a otras colecciones, éstas no la pierdan

$query = "DELETE FROM Fleckr.User_Collection_Photos WHERE ID_PHOTO = '$photo' AND ID_COLLECTION = '$collection'";
$result = mysql_query($query);

//Luego se comprueba que la colección tenga fotos; si no tiene, se borra

$query2 = "SELECT * FROM Fleckr.User_Collection_Photos WHERE ID_COLLECTION = '$collection'";

$result2 = mysql_query($query2);

$row2 = mysql_fetch_array($result2);

if ($row2 == FALSE) {

	$query = "DELETE FROM Fleckr.Collections WHERE ID_COLLECTION = '$collection'";
	$result = mysql_query($query);
}

//Por último se comprueba que la foto exista en más colecciones: si no existe en más colecciones, se borra de la base de datos.

$query3 = "SELECT * FROM Fleckr.User_Collection_Photos WHERE ID_PHOTO = '$photo'";

$result3 = mysql_query($query3);

$row3 = mysql_fetch_array($result3);

if ($row3 == FALSE) {
	$query4 = "DELETE FROM Fleckr.Photos WHERE ID_PHOTO = '$photo'";
	$result4 = mysql_query($query4);
}

header("Location: userControlPanel.php");
?>