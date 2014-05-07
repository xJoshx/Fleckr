<?php

include('security.php');
	
include('connect_db.php');

$collection = $_GET["collection"];

//Aquí se reportan las colecciones: se añade una notificación

$query = "SELECT * FROM Fleckr.Collections WHERE ID_COLLECTION = '$collection'";

//echo $query;

$result = mysql_query($query);

$row = mysql_fetch_array($result);

$notifications = $row["Notifications"] + 1;

//echo $notifications;

$query2 = "UPDATE Fleckr.Collections SET Notifications = '$notifications' WHERE ID_COLLECTION = '$collection'";

$result2 = mysql_query($query2);

//echo $query2;

header("Location: viewMyCollection.php?collection=$collection");

?>