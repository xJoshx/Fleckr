<?php

include('connect_db.php');

$notification = $_GET['notification'];
$user = $_GET['id'];

//Para borrar una notificación

$query = "DELETE FROM Fleckr.Notify WHERE ID_USER = '$user' AND CONTENT = '$notification' LIMIT 1";
$result = mysql_query($query);

header("Location: userControlPanel.php");

?>