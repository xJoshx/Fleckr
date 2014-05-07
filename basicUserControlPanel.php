<?php
		include('security.php');	
		
		include('connect_db.php');
		
		$me = $_SESSION['actualUser'];
		echo "$me";
?>

<html>
	<head>
		<link rel="stylesheet" href="fleckrStyle.css" type="text/css" />
		<title>User control panel</title>
	</head>
	<body>
	<div id='logout'><a href='logout.php'>Logout</a></div>
	
	 <!-- Editar información personal -->
	
<p><a href="#editPersonalInformation"onclick="showContent('editPersonalInformation')">Edit personal information</a></p>
<?php 
	$query = "SELECT * FROM Fleckr.Users WHERE ID_USER = '$me'";
	$result = mysql_query($query);
	$rowUser = mysql_fetch_array($result);
?>	
	<div id="editPersonalInformation">
		<p>Name: <?php echo $rowUser['NAME']; ?></p>
		<p>Surname: <?php echo $rowUser["SURNAME"]; ?></p>
		<p>eMail: <?php echo $rowUser["MAIL"]; ?></p>
		<p>Photos default: <?php echo $rowUser["IMAGES_DEFAULT"]; ?></p>

<div id="userCustomBox">
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
	
<?php
	$query = "SELECT * FROM Fleckr.Send_mail WHERE ID_USER_TO = '$me'";
	$result = mysql_query($query);
?>
<p><a href="#myMessages"onclick="showContent('myMessages')">Show messages</a></p>
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
		
		<script type="text/javascript">
			function showContent(id) {
				var div = document.getElementById(id);
				
				div.style.display = "block";				
				
			}
		</script>
		
	</body>
</html>