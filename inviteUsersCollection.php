<html>

<head>		<link rel="stylesheet" href="fleckrStyle.css" type="text/css" /></head>

<body>
<div id='logout'><a href='logout.php'>Logout</a></div>
<div id='logout'><a href='userControlPanel.php'>Back</a></div>

<?php
	include('security.php');

	include('connect_db.php');
	
	$collection = $_GET["collection"];
	$me = $_SESSION["actualUser"];
	
	//Se muestran los usuarios que no han sido invitados y que no son el usuario propietario de la colección
	
	$query = "SELECT * FROM Fleckr.Users WHERE ID_USER NOT IN (SELECT ID_USER FROM Allow WHERE ID_COLLECTION = '$collection') AND Users.ID_USER != '$me'";
	$result = mysql_query($query);
?>
		<div id='customTable'>
		<table border='1' align='center'><br> 
		<tr><th>Users not allowed</tr>
		<tr><th>User<th>Permit</tr> 
		
<?php
	while ($row = mysql_fetch_array($result)) {
		echo '<tr><td>', $row['ID_USER'], "</td>\n <td><a href='allowFunctions.php?id=", $row['ID_USER'], "&collection=$collection&type=allow'>Permit!</a></td></tr>";
		}
?>
	</table>
</div>
		
		
<?php

		$query = "SELECT * FROM Allow WHERE ID_COLLECTION = '$collection'";
		$result = mysql_query($query);
?>

	<div id='customTable'>
		<table border='1' align='center'><br> 
			<tr><th>Users allowed</tr>
			<tr><th>User<th>Collection<th>Delete permissions</tr> 
	
<?php

	
	//Se muestran los usuarios invitados a una determinada colección y se da la posibilidad de borrarlos
	
			while ($row = mysql_fetch_array($result)) {
				echo "<tr><td>", $row['ID_USER'], "</td>\n <td>", $row['ID_COLLECTION'], "</td><td><a href='allowFunctions.php?id=", $row["ID_USER"],"&collection=$collection&type=deleteAllow'>No permit</a></td></tr>";
				}
?>
		</table>
	</div>
		
		<div>
</body>


</html>
