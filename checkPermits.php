<?php

	include('connect_db.php');

	include('security.php'); 
	
	$me = $_SESSION["actualUser"];
	
	//Aquí se comprueban los permisos; si no ha sido autorizado, se enseña la página de error. Si ha sido autorizado, se redirige a la correspondiente página. También se controla que no entren los baneados.
	
	$query = "SELECT ID_USER, PERMITS FROM Fleckr.Authorize WHERE ID_USER = '$me' and ID_USER NOT IN (SELECT ID_USER FROM Fleckr.Ban WHERE ID_USER = '$me')";

	$result = mysql_query($query);
	
	$row = mysql_fetch_array($result);
	
	if (!$row) {
		header("Location: errorPage.php");
	}
	
	if ($row) {
		if ($row["PERMITS"] == "Basic") {
			header("Location: basicUserControlPanel.php");
		}	
		
		else if ($row["PERMITS"] == "Complete") {
			header("Location: userControlPanel.php");
		}
			
	}
?>