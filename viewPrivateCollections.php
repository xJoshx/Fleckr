<?php

	include('security.php');

	include('connect_db.php');		
	
	//Muestra las colecciones privadas a las que se tiene acceso
	
	$me = $_SESSION['actualUser'];

	echo "<p>--- VIEW PRIVATE COLLECTIONS ---</p>	";
	
	$query = "SELECT * FROM Fleckr.Allow WHERE ID_USER = '$me'";
	$result = mysql_query($query);
?>

<html>

	<head><link rel="stylesheet" href="fleckrStyle.css" type="text/css" /></head>

	<body>
		<div id="viewPrivateCollections">
			<div id='customTable'>
				<table border='1' align='center'><br> 
					<tr><th>View private collections</tr>
					<tr><th>User<th>Name<th>View</tr>
<?php 

	while ($row = mysql_fetch_array($result)) {				
		echo '<tr><td>', $row['ID_USER'], "</td><td>" ,$row['ID_COLLECTION'], "<td><a href='viewMyCollection.php?collection=", $row['ID_COLLECTION'], "&'>View!</a></td></tr>";	
	}	

 ?>
 			</table>
 		</div>
 	</div>
 	
 </body>
 
 </html>