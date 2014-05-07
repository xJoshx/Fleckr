<?php
	include('connect_db.php');
	
	include('security.php');
	
	include('admin_session_control.php');
?>

<html>
	<head>
		<link rel="stylesheet" href="fleckrStyle.css" type="text/css" />
	</head>
	<body>
	
	<?php 
		
		/* Se muestran las personas baneadas y las que no lo están */
		
		$query = 'SELECT ID_USER FROM Users WHERE ID_USER NOT IN (SELECT ID_USER FROM Ban)';
		$result = mysql_query($query);
	?>
	<div id='customTable'>
		<table border='1' align='center'>
			<tr><th>Users not banned</th></tr>
			<tr><th>User<th>Ban</tr>
	<?php
	
	while ($rowBan = mysql_fetch_array($result)) {
	
		echo '<tr><td>', $rowBan['ID_USER'], "</td>\n <td><a href='banFunctions.php?id=", $rowBan['ID_USER'], "&admin=&type=1'>Ban!</a></td></tr>";
	
		}
	?>
		</table>
	</div>
	
	<?php
		$query = 'SELECT * FROM Ban';
		$result = mysql_query($query);
	?>		
		<div id='customTable'>
			
		<table border='1' align='center'>
		<tr><th>Users banned</th></tr>
		<tr><th>Admin<th>User<th>Unban</tr>
	<?php	
		while ($rowUnban = mysql_fetch_array($result)) {
			
		echo '<tr><td>', $rowUnban['ID_ADMIN'], "</td>\n<td>"; 
		echo $rowUnban['ID_USER'], "</td>\n <td><a href='banFunctions.php?id=", $rowUnban['ID_USER'], "&admin=", $rowUnban['ID_ADMIN'], "&type=2'>Unban</a></td></tr>";
			
		}
	?>	
		</table>
	</div>
	
	<?php
		
		/***************/
				
				
		/* Para ver las personas autorizadas y desautorizadas */
		
		$query = 'SELECT ID_USER FROM Users WHERE ID_USER NOT IN (SELECT ID_USER FROM Authorize)';
		$result = mysql_query($query);
	?>	
		<div id='customTable'>
			
		<table border='1' align='center'>
		<tr><th>Users not authorized</th></tr>
		<tr><th>User<th>Authorize</tr>
		
	<?php	
		while($rowUnauthorize = mysql_fetch_array($result)) {
		
		echo "<tr><td>", $rowUnauthorize['ID_USER'], "</td>\n <td><a href='authorizeFunctions.php?id=", $rowUnauthorize['ID_USER'], "&admin=&type=authorize'>Authorize!</a></td></tr>";
			
		}
	?>	
		</table>
	</div>
	
	<?php	
		$query = 'SELECT * FROM Authorize';
		$result = mysql_query($query);
	?>				
		<div id='customTable'>
					
		<table border='1' align='center'>
		<tr><th>Users authorized</th></tr>
		<tr><th>Admin<th>User<th>Permits<th>Unauthorize</tr>
	<?php	
		while ($rowAuthorize = mysql_fetch_array($result)) {
					
		echo "<tr><td>", $rowAuthorize['ID_ADMIN'], "</td>\n<td>"; 
		echo $rowAuthorize['ID_USER'], "</td>\n <td><a href='authorizeFunctions.php?id=", $rowAuthorize['ID_USER'], "&type=changePermits'>", $rowAuthorize['PERMITS'], "</a></td><td><a href='authorizeFunctions.php?id=", $rowAuthorize['ID_USER'], "&admin=", $rowAuthorize['ID_ADMIN'], "&type=unauthorize'>Unauthorize</a></td></tr>";
					
		}
	?>				
		</table>			
	</div>
		
	<?php			
		/************/		
		
		/*Para mostrar la lista de usuarios y, si es necesario, notificarles*/
					
		$query = 'SELECT * FROM Users';
		$result = mysql_query($query);
	?>				
		<div id='customTable'>
					
		<table border='1' align='center'><tr>
		<tr><th>Notify users</th></tr>
		<th>User<th>Notify</tr>
	<?php	
		while ($row = mysql_fetch_array($result)) {
		
		echo "<tr><td>", $row['ID_USER'], "</td>\n <td><a href='notifyFunctions.php?id=", $row['ID_USER'], "'>Notify!</a></td></tr>";
					
		}
	?>				
		</table>
	</div>
	
	<?php		
		/**/
		
		/*Para deshabilitar una colección*/
					
		$query1 = 'SELECT * FROM Collections';
		$result1 = mysql_query($query1);
	?>	
	<div id='customTable'>
		<table border='1' align='center'>
		<tr><th>Disable collection</th></tr>
		<tr><th>Collection<th>User<th>Notifications<th>Notified<td>Disabled<td>Disable</tr>

	<?php	
		while ($row = mysql_fetch_array($result1)) {
		
		echo "<tr><td>", $row['ID_COLLECTION'], "</td>\n <td>", $row['ID_USER'], "</td>\n <td>", $row['Notifications'], "</td>\n <td>", $row['IS_NOTIFIED'], "</td>\n <td>", $row['DISABLED'], "</td>\n <td><a href='collectionFunctions.php?collection=", $row['ID_COLLECTION'], "&type=", $row['DISABLED'], "&user=", $row['ID_USER'], "'>Disable!</a></td></tr>";
		
		if ($row['Notifications'] > 1 && $row['IS_NOTIFIED'] == 'No') {
		$rowToModify = $row['ID_COLLECTION'];
		$query2 = "UPDATE Collections SET IS_NOTIFIED = 'Yes' WHERE ID_COLLECTION = '$rowToModify'";
		$result2 = mysql_query($query2);
		echo "<script>
			alert('The collection ", $row['ID_COLLECTION'], " has ", $row['Notifications'], " alerts');
		</script>";
				
			}		
		}
	?>			
	</table>
</div>


<?php			
	/************/		
	
	/*Para mostrar la lista de usuarios y proceder a borrar su cuenta*/
				
	$query = 'SELECT * FROM Users';
	$result = mysql_query($query);
?>				
	<div id='customTable'>
				
	<table border='1' align='center'><tr>
	<tr><th>Delete users</th></tr>
	<th>User<th>Delete</tr>
<?php	
	while ($row = mysql_fetch_array($result)) {
	
	echo "<tr><td>", $row['ID_USER'], "</td>\n <td><a href='deleteUser.php?id=", $row['ID_USER'], "'>Delete!</a></td></tr>";
				
	}
?>				
	</table>
</div>

<?php			
	/************/		
	
	/*Para mostrar la lista de colecciones y proceder a borrar su cuenta*/
				
	$query = 'SELECT * FROM Fleckr.User_Collection_Photos';
	$result = mysql_query($query);
?>				
	<div id='customTable'>
				
	<table border='1' align='center'><tr>
	<tr><th>Delete collections</th></tr>
	<th>User<th>Collection<th>Delete</tr>
<?php	
	while ($row = mysql_fetch_array($result)) {
	
	echo "<tr><td>", $row['ID_USER'], "</td><td>", $row['ID_COLLECTION'], "</td>\n <td><a href='deleteCollectionAdmin.php?collection=", $row['ID_COLLECTION'], "&id=", $row['ID_USER'], "'>Delete!</a></td></tr>";
				
	}
?>				
	</table>
</div>
	</body>
</html>