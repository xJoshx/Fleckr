<?php

include('security.php');

include('connect_db.php');
	

$type = $_GET["type"];
$collection = $_GET["collection"];
$id = $_GET["id"];

//Para dar o eliminar permisos

if ($type == "allow") {
	
	$query = "INSERT INTO Fleckr.Allow VALUES ('$collection','$id')";
	
	//echo $query;
	
	$result = mysql_query($query);
	
	header("Location: sendMessage.php?id=$id&collection=$collection&type=invitation");
	
	//header("Location: inviteUsersCollection.php?collection=$collection");
}

if ($type == "deleteAllow") {

	$query = "DELETE FROM Fleckr.Allow WHERE ID_COLLECTION = '$collection' AND ID_USER = '$id'";
	
	//echo $query;
	
	$result = mysql_query($query);
	
	//header("Location: inviteUsersCollection.php?collection=$collection");
	header("Location: sendMessage.php?id=$id&collection=$collection&type=deleteInvitation");
}

?>