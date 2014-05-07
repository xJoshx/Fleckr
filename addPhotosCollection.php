<?php

include('security.php');
	
include('connect_db.php');

//Para añadir fotos a la colección

?>

<html>
	<head>
		<link rel="stylesheet" href="fleckrStyle.css" type="text/css" />
	</head>
	
	<body>

<?php
	$collection = $_GET["collection"];
	//echo $collection;
?>

<div id='logout'><a href='logout.php'>Logout</a></div>
<div id='logout'><a href='userControlPanel.php'>Back</a></div>
<div id="userCustomBox1">
	<div id="uploadPhoto1">
	<form action="uploadToCollection.php?id=<?echo $collection;?>" method="post" enctype="multipart/form-data"> 
		<input name="file" id="file" type="file"/><br>
		Image name: <input id="name" name="name" type="text" size="40" maxlength="50" />
		<input type="hidden" id="collection" name="collection" value="<?echo $collection?>" />
		<input id="send"type="submit" value="Send Photos"/>
	</form>
	</div>
</div>	

<?php
$me = $_SESSION["actualUser"];

//Se muestran las fotos del usuario

$query = "SELECT * FROM Fleckr.Photos WHERE ID_USER = '$me'";
$result = mysql_query($query);
?>

<div id="collections1">
	<div id='customTable'>
		<table border='1' align='center'><br> 
		<tr><th>Photos Uploaded</tr>
		<tr><th>Name<th>Add<th>View</tr>
		
	<?php
		
		while ($row = mysql_fetch_array($result)) {
		
			//Para calcular el nombre de la imagen
			$lenght = strlen($row["ID_PHOTO"]);
			$userLenght = strlen($me);
			$finalLenght = $lenght - $userLenght;
			$name = substr($row["ID_PHOTO"], 0, $finalLenght);	
			/**/
			
			echo "<tr><td>$name</td><td><a href='addPhoto.php?collection=$collection&id=", $row['ID_PHOTO'],"'>Add!</a></td><td><a href='viewPhoto.php?id=", $row["ID_PHOTO"],"'>View!</a></td></tr>";
		}
	?>
	</div>
</div>

<div id="collections1">
	<div id='customTable'>
		<table border='1' align='center'><br> 
		<tr><th>Photos in this collection</tr>
		<tr><th>Name<th>View</tr>
		
	<?php
	
	//Se muestran las fotos de la colección actual
		$query2 = "SELECT * FROM User_Collection_Photos WHERE ID_COLLECTION = '$collection'";
		$result2 = mysql_query($query2);
		
		while ($row2 = mysql_fetch_array($result2)) {
			//Para calcular el nombre de la imagen
			$lenght = strlen($row2["ID_PHOTO"]);
			$userLenght = strlen($me);
			$finalLenght = $lenght - $userLenght;
			$name = substr($row2["ID_PHOTO"], 0, $finalLenght);	
			/**/
			
			echo "<tr><td>$name</td><td><a href='viewPhoto.php?id=", $row2["ID_PHOTO"],"'>View!</a></td></tr>";
		}
	?>
	</div>
</div>

	</body>
</html>