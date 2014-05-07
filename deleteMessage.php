<?php

	include('security.php');

	include('connect_db.php');		
	
	//Para eliminar mensajes de usuarios (invitaciones, peticiones)
	
	$user = $_GET["id"];
	$userTo = $_GET["idTo"]; 
	$content = $_GET["content"];
	
	$query = "DELETE FROM Fleckr.Send_mail WHERE ID_USER = '$user' AND ID_USER_TO = '$userTo' AND CONTENT = '$content' LIMIT 1";
	
	//echo "$query";
	
	$result = mysql_query($query);

	header("Location: checkPermits.php");
?>