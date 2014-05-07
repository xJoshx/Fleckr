<?php

include('connect_db.php');

$collection = $_GET["collection"];

//Para borrar una colección de golpe

$query = "DELETE FROM Fleckr.Collections WHERE ID_COLLECTION = '$collection'";
$result = mysql_query($query);

$query2 = "DELETE FROM Fleckr.User_Collection_Photos WHERE ID_COLLECTION = '$collection'";
$result2 = mysql_query($query2);

header("Location: userControlPanel.php")

?>