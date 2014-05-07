<?php

include('security.php');
	
include('connect_db.php');

//Para editar la información personal

$user = $_SESSION["actualUser"];
$name = $_POST["name"];
$surname = $_POST["surname"];
$email = $_POST["email"];
$pdefault = $_POST["pdefault"];

$query = "SELECT * FROM Fleckr.Users WHERE ID_USER = '$user'";
$result = mysql_query($query);
$information = mysql_fetch_array($result);	


if (empty($name)) {
	$name = $information["NAME"];
}


if (empty($surname)) {
	$surname = $information["SURNAME"];
}


if (empty($email)) {
	$email = $information["MAIL"];
}


if (empty($pdefault)) {
	$pdefault = $information["IMAGES_DEFAULT"];
}

$query = "UPDATE Fleckr.Users SET NAME = '$name', SURNAME = '$surname', MAIL = '$email', IMAGES_DEFAULT = '$pdefault' WHERE ID_USER = '$user'";
$result = mysql_query($query);
	
$query2 = "SELECT * FROM Fleckr.Authorize WHERE ID_USER = '$user'";
$result2 = mysql_query($query2);
$row = mysql_fetch_array($result2);

	if ($row['PERMITS'] == 'Complete') {
		header("Location: userControlPanel.php");
	}
	
	else if ($row['PERMITS'] == 'Basic') {
		header("Location: basicUserControlPanel.php");
	}

?>