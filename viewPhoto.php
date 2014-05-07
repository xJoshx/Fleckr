
<?php
	include('security.php');
	
	include('connect_db.php');

	//Muestra por pantalla una foto

	$photo = $_GET["id"];
	
	$query = "SELECT * FROM Fleckr.Photos WHERE ID_PHOTO = '$photo'";
	
	$result = mysql_query($query);
	
	$row = mysql_fetch_array($result);
	
	//$originalPath = $row["LOCATION"];
	//$path = substr($originalPath, 37, strlen($originalPath));
	$user = $row["ID_USER"];
	$image = $row["FILE_NAME"];
	$path = "/Fleckr/$user/$image";
?>

<html>
	<head>		<link rel="stylesheet" href="fleckrStyle.css" type="text/css" /></head>

	<body>
		<div id="showPhoto"><img src="<?echo $path;?>" alt="<?echo $user;?>" /><br />
		<p><?echo $row["NAME"];?></p></div>
	</body>
</html>