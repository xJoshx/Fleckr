<?php

include('connect_db.php');

include('security.php');

$actionType = $_GET['type'];
$me = $_SESSION["actualUser"];
$defaultCollection = $me . "default";
$collection = $_GET['collection'];

if ($actionType == 'Delete'){
		
	//Primero, selecciono las filas que pertenecen a la colección que se desea eliminar y las que pertenecen a la colección por defecto	
	
	$query = "SELECT * FROM User_Collection_Photos WHERE ID_COLLECTION = '$collection'";

	$result = mysql_query($query);
	
	$query2 = "SELECT * FROM User_Collection_Photos WHERE ID_COLLECTION = '$defaultCollection'"; 

	$result2 = mysql_query($query2);
	
	//Compruebo que las fotos no pertenezcan a ambas colecciones; si pertenecen a ambas, flag se pone a 1.
	
	while ($row = mysql_fetch_array($result)) {
		$aux = $row["ID_PHOTO"];
		$flag = 0;
		while ($row2 = mysql_fetch_array($result2)) {
			if ($aux == $row["ID_PHOTO"]) {
				$flag = 1;
			}
		}
	}
		//Si no hay ninguna que pertenezca a ambas, se borra la colección y las fotos.
		
	if ($flag == 0) {
		$query3 = "DELETE FROM Fleckr.Collection WHERE ID_COLLECTION = '$collection' LIMIT 1";
			
		$result3 = mysql_query($query3);
			
		while ($row = mysql_fetch_array($result)) {
			$photo = $row["ID_PHOTO"];
			$query = "DELETE FROM Fleckr.Photos WHERE ID_PHOTO = '$photo' LIMIT 1";
			$result = mysql_query($query);	
			
		//Falta borrar de la carpeta
		}
	}
		
	//Si pertenece a ambas, no hace falta borrar las fotos de la carpeta default, así que solo se borra la colección.
		
	if ($flag == 1) {
		$query3 = "DELETE FROM Fleckr.Collection WHERE ID_COLLECTION = '$collection' LIMIT 1";
			
		$result3 = mysql_query($query3);
			
	}

	//Por último, elimino las fotos que hayan podido quedarse sueltas (por ejemplo, que se subieran a dos colecciones que no son la de por defecto y se hayan eliminado las dos)

	$query4 = "SELECT * FROM Fleckr.Photos WHERE ID_PHOTO NOT IN (SELECT * FROM Fleckr.User_Collection_Photos)";
	
	$result4 = mysql_query($query4);

	while ($row4 = mysql_fetch_array($result4)) {
		$aux = $row4["ID_PHOTO"];
		$query4 = "DELETE FROM Fleckr.Photos WHERE ID_PHOTO = '$aux' LIMIT 1";
		
		$result4 = mysql_query($query4);
	}
	
	header("Location: userControlPanel.php");
}

if ($actionType == 'deletePhoto') {
	
}

?>