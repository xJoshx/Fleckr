<?php
	include('security.php');
	
	include('connect_db.php');		
		
	$me = $_SESSION['actualUser'];
		
	echo "$me";
?>

<html>
	<head>
		<link rel="stylesheet" href="fleckrStyle.css" type="text/css" />
	</head>
	<body>
	<div id='logout'><a href='logout.php'>Logout</a></div>


	 <!-- Imágenes definidas en el perfil -->
	
	<p>--- WELCOME ---</p>
	
		<?php
		
		$query2 = "SELECT * FROM Fleckr.Users WHERE ID_USER = '$me'";
		$result2 = mysql_query($query2);
		$row2 = mysql_fetch_array($result2);
		$images_default = $row2["IMAGES_DEFAULT"];
		
		$query = "SELECT * FROM Fleckr.Photos WHERE ID_USER = '$me' ORDER BY rand() LIMIT $images_default";
		$result = mysql_query($query);
		?>
	<div id="myImagesDefault">
		<div id='imagesDefault'>
		<?php
			
			while ($row = mysql_fetch_array($result)) {
				$image = $row["FILE_NAME"];
				$name = $row["NAME"];
				$path = "/Fleckr/$me/$image";
				echo "<img class='imagesDefault'src='$path' alt='$name' />";
			}
		?>
		</table>
		</div>
	</div>

<p><a href="#uploadPhoto" onclick="showContent('uploadPhoto')">Upload Photo</a></p>
<div id="userCustomBox">
	<div id="uploadPhoto">
	<form action="upload.php" method="post" enctype="multipart/form-data"> 
		<input name="file" id="file" type="file"/><br>
		Image name: <input id="name" name="name" type="text" size="40" maxlength="50" />
		<input id="send"type="submit" value="Send Photos"/>
	</form>
	</div>
</div>		

		 <!-- Editar información personal -->

<p><a href="#editPersonalInformation" onclick="showContent('editPersonalInformation')">Edit personal information</a></p>
<?php 
	$query = "SELECT * FROM Fleckr.Users WHERE ID_USER = '$me'";
	$result = mysql_query($query);
	$rowUser = mysql_fetch_array($result);
?>	
<div id="userCustomBox">
	<div id="editPersonalInformation">
		<p>Name: <?php echo $rowUser['NAME']; ?></p>
		<p>Surname: <?php echo $rowUser["SURNAME"]; ?></p>
		<p>eMail: <?php echo $rowUser["MAIL"]; ?></p>
		<p>Photos default: <?php echo $rowUser["IMAGES_DEFAULT"]; ?></p>

		<form method="post" action="editPersonalInformation.php" name="Form">
			<p>Name</p><input type="text" name="name" id="name" />
			<p>Surname</p><input type="text" name="surname" id="surname" />
			<p>eMail</p><input type="text" name="email" id="email" />
			<p>Photos default</p><input type="text" name="pdefault" id="pdefault" />
			<input id="edit" type="submit" value="Edit!"/>
		</form>
	</div>		
</div>

	 <!-- Leer los mensajes -->
	
<p><a href="#myMessages"onclick="showContent('myMessages')">Show messages</a></p>

		<?php
			$query = "SELECT * FROM Fleckr.Send_mail WHERE ID_USER_TO = '$me'";
			$result = mysql_query($query);
		?>
	<div id="myMessages">
		<div id='customTable'>
			<table border='1' align='center'><br> 
			<tr><th>Messages</tr>
			<tr><th>From<th>Content<th>Delete</tr> 
			
		<?php
		
			while ($row = mysql_fetch_array($result)) {
				echo '<tr><td>', $row['ID_USER'], "</td><td>", $row['CONTENT'] ,"</td><td><a href='deleteMessage.php?id=", $row['ID_USER'],"&idTo=", $row['ID_USER_TO'],"&content=", $row['CONTENT'] ,"'>Delete</a></td></tr>";
			}
		?>
		</table>
		</div>
	</div>
	
	<!-- Las notificaciones son estas -->
	
<p><a href="#myNotifications"onclick="showContent('myNotifications')">Show Notifications</a></p>
	<?php
		$query = "SELECT * FROM Fleckr.Notify WHERE ID_USER = '$me'";
		$result = mysql_query($query);
	?>
<div id="myNotifications">
	<div id='customTable'>
		<table border='1' align='center'><br> 
		<tr><th>Messages</tr>
		<tr><th>From<th>Content<th>Delete</tr> 
		
	<?php
	
		while ($row = mysql_fetch_array($result)) {
		$notification = $row['CONTENT'];
			echo '<tr><td>', $row['ID_ADMIN'], "</td><td>", $row['CONTENT'] ,"</td><td><a href='deleteNotification.php?notification=$notification&id=$me'>Delete!</a></td></tr>";
		}
	?>
	</table>
	</div>
</div>	
		 <!-- Crear una colección -->
	
<p><a href="#createCollection" onclick="showContent('createCollection')">Create collection</a></p>
	<div id="userCustomBox">
		<div id="createCollection">
		<form method="post" action="createCollection.php" name="Form">
			<p>Collection Name</p><input type="text" name="collection" id="collection" />
			<p>Width</p><input type="text" name="width" id="widht" />
			<p>Height</p><input type="text" name="height" id="height" />
			<input id="create" type="submit" value="Create!"/>
		</form>		
		</div>
		
	<?php
	
	$query = "SELECT * FROM Fleckr.Collections WHERE ID_USER = '$me' and Disabled = 'No'";
	$result = mysql_query($query);
	
	?>
<p><a href="#collections" onclick="showContent('collections')">Show Collections</a></p>
<div id="collections">
	<div id='customTable'>
		<table border='1' align='center'><br> 
		<tr><th>Collections</tr>
		<tr><th>Name<th>Resolution<th>Add Photos<th>Invite users<th>Delete<th>Public?<th>View</tr>
		
	<?php
	
		while ($row = mysql_fetch_array($result)) {
		$resolution = $row['WIDTH'] . "x" . $row['HEIGHT'];
			echo '<tr><td>', $row['ID_COLLECTION'], "</td><td>$resolution</td><td><a href='addPhotosCollection.php?collection=", $row['ID_COLLECTION'],"'>Add</a></td><td><a href='inviteUsersCollection.php?collection=", $row['ID_COLLECTION'],"'>Invite</a></td><td><a href='deleteCollection.php?collection=", $row['ID_COLLECTION'], "&type=Delete'>Delete!</a></td><td><a href='publicFunctions.php?collection=", $row["ID_COLLECTION"],"'>",$row["PUBLIC"],"</a></td><td><a href='viewMyCollection.php?collection=", $row["ID_COLLECTION"],"'>View!</a></td></tr>";
		}
	?>
	</table>
	</div>
</div>

	 <!-- Ver las colecciones públicas -->

<p><a href="#publicCollections"onclick="showContent('publicCollections')">Public collections</a></p>
		<?php
			$query = "SELECT * FROM Fleckr.Collections WHERE PUBLIC = 'Yes' AND ID_USER != '$me' and Disabled = 'No'";
			$result = mysql_query($query);
		?>
	<div id="publicCollections">
		<div id='customTable'>
			<table border='1' align='center'><br> 
			<tr><th>Public collections</tr>
			<tr><th>User<th>Name<th>View</tr> 
			
		<?php
		
			while ($row = mysql_fetch_array($result)) {
				echo '<tr><td>', $row['ID_USER'], "</td><td>", $row['ID_COLLECTION'] ,"<td><a href='viewMyCollection.php?collection=", $row['ID_COLLECTION'], "'>View!</a></td></tr>";
			}
		?>
			</table>
		</div>
	</div>
	
		 <!-- Pedir permisos para ver las privadas -->
	
<p><a href="#privateCollections" onclick="showContent('privateCollections')">Private Collections</a></p>
		<?php
		
			$query = "SELECT * FROM Fleckr.Collections WHERE PUBLIC = 'No' AND ID_USER NOT IN (SELECT ID_USER FROM Users WHERE ID_USER = '$me') and Disabled = 'No'";
			$result = mysql_query($query);

		?>
	<div id="privateCollections">
		<div id='customTable'>
			<table border='1' align='center'><br> 
			<tr><th>Private collections</tr>
			<tr><th>User<th>Name<th>Request permission</tr>
			
		<?php
		
		//Para imprimir la tabla de colecciones privadas. 
		
			while ($row = mysql_fetch_array($result)) {
							
				echo '<tr><td>', $row['ID_USER'], "</td><td>" ,$row['ID_COLLECTION'], "<td><a href='sendMessage.php?collection=", $row['ID_COLLECTION'], "&id=", $row["ID_USER"],"&type=request'>Request!</a></td></tr>";			

			}
		?>
			</table>
		</div>
	</div>
	
	<!-- Para ver las colecciones privadas -->
	
	<div id="viewPrivateCollections">
	
		<p><a href="viewPrivateCollections.php">View Private collections</a></p>
	
	</div>
	
	<!-- Borrar fotos -->
	
	<p><a href="#deletePhotos" onclick="showContent('deletePhotos')">Delete Photos</a></p>
	<?php
	$me = $_SESSION["actualUser"];
	
	//Se muestran las fotos del usuario
	
	$query = "SELECT * FROM Fleckr.User_Collection_Photos WHERE ID_USER = '$me'";
	$result = mysql_query($query);
	
	?>
	
	<div id="deletePhotos">
		<div id='customTable'>
			<table border='1' align='center'><br> 
			<tr><th>Photos Uploaded</tr>
			<tr><th>Name<th>Collection<th>Delete<th>View</tr>
			
		<?php
			
			while ($row = mysql_fetch_array($result)) {
			
				//Para calcular el nombre de la imagen
				$lenght = strlen($row["ID_PHOTO"]);
				$userLenght = strlen($me);
				$finalLenght = $lenght - $userLenght;
				$name = substr($row["ID_PHOTO"], 0, $finalLenght);
				$collection = $row["ID_COLLECTION"];	
				/**/
				
				echo "<tr><td>$name</td><td>$collection</td><td><a href='deletePhoto.php?collection=$collection&id=", $row['ID_PHOTO'],"'>Delete!</a></td><td><a href='viewPhoto.php?id=", $row["ID_PHOTO"],"'>View!</a></td></tr>";
			}
		?>
		</div>
	</div>
	
	<script type="text/javascript">
		function showContent(id) {
			var div = document.getElementById(id);
			
			div.style.display = "block";				
			
		}
	</script>
	
	
	</body>
</html>