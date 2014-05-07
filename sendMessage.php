<?php

include('security.php');

include('connect_db.php');

$collection = $_GET["collection"];
$id = $_GET["id"];
$me = $_SESSION["actualUser"];
$type = $_GET["type"];

//Enviar mensajes de invitación o de eliminación de permisos sobre la colección. También para mandar mensajes entre usuarios para pedir acceso a una colección

if ($type == "invitation") {
	
	$query = "INSERT INTO Fleckr.Send_mail VALUES ('$me','$id','Plz take a look of my collection $collection k thx')";
	
	//echo $query;
	
	$result = mysql_query($query);
	
	header("Location: inviteUsersCollection.php?collection=$collection");
}

if ($type == "deleteInvitation") {
	$query = "INSERT INTO Fleckr.Send_mail VALUES ('$me','$id','Your permits have been removed from the collection $collection')";
	
	//echo $query;
	
	$result = mysql_query($query);
	
	$query2 = "	DELETE FROM Fleckr.Send_mail WHERE ID_COLLECTION = '$collection' AND ID_USER = '$id'";
	
	$result2 = mysql_query($query2);
	
	header("Location: inviteUsersCollection.php?collection=$collection");
}

if ($type == "request") {


	$query = "INSERT INTO Fleckr.Send_mail VALUES ('$me','$id','Let me take a look at your collection $collection. Thanks.')";

//echo $query;

	$result = mysql_query($query);

	$query = "SELECT * FROM Fleckr.Authorize WHERE ID_USER = '$me'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
		if ($row['PERMITS'] == 'Complete') {
			header("Location: userControlPanel.php");	
		}
		
		else if ($row['PERMITS'] == 'Basic') {
			header("Location: basicUserControlPanel.php");		
		}


}

?>