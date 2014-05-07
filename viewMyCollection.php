<?php

			include('connect_db.php');
	
			include('security.php');
			
			$me = $_SESSION["actualUser"];
			
			$collection = $_GET['collection'];
			
			//El número de la última página
			$pagenum = $_GET["pagenum"];
			
			
			//Resultados por página
			$page_rows = $_GET["rows"];
			
			if ($page_rows == 0) {
				$page_rows = $_POST["rows"]; 
					if ($page_rows == 0) 
						//Por defecto muestra 4
						$page_rows = 4;
			}
			
//			echo "Rows: $page_rows";
			
			//Se ajusta el tamaño de la ruta hasta el directorio
			$pathSize = 37;
			
			$presentation = $_GET["presentation"];
			
			if ($presentation == 'Yes') {
				header("Location: slideshow.php?collection=$collection");
			}
			
?>

<html>
	<head>
			<link rel="stylesheet" href="fleckrStyle.css" type="text/css" />
	</head>
	<body>
			<div id='logout'><a href='logout.php'>Logout</a></div>
			<?php 
			$query = "SELECT * FROM Fleckr.Authorize WHERE ID_USER = '$me'";
			$result = mysql_query($query);
			$row = mysql_fetch_array($result);
				if ($row['PERMITS'] == 'Complete') {
					echo "<div id='logout'><a href='userControlPanel.php'>Back</a></div>";		
				}
				
				else if ($row['PERMITS'] == 'Basic') {
					echo "<div id='logout'><a href='basicUserControlPanel.php'>Back</a></div>";		
				}
			
			?>
			<form method="post" action="viewMyCollection.php?collection=<?echo $collection;?>">
				<input type="text" name="rows" id="rows" />
				<input type="submit" name="set" id="set" value="Set!" />
			</form>
			
			<form method="post" action="viewMyCollection.php?collection=<?echo $collection;?>&presentation=Yes">
				<input type="submit" name="presentation" value="Presentation" id="presentation"/>
			</form>
			
			<form method="post" action="viewMyCollection.php?collection=<?echo $collection;?>&presentation=No">
				<input type="submit" name="presentation" value="No presentation" id="presentation"/>
			</form>
		<?php
						
//			else{
			//Se comprueba la última página, y si no está puesta se pone a 1 
			if (!(isset($pagenum))) 
 				$pagenum = 1; 

			//Se cogen nombre y path de las fotos
			$query = "SELECT NAME, LOCATION FROM Fleckr.Photos WHERE ID_PHOTO IN (SELECT ID_PHOTO FROM Fleckr.User_Collection_Photos WHERE ID_COLLECTION = '$collection')";

			$result = mysql_query($query);

			$rows = mysql_num_rows($result); 
			
			//Cuál va a ser la última página 
			$last = ceil($rows/$page_rows); 

			//Para comprobar los límites (esto es, que no esté por debajo de la primera ni por encima de la última)
			if ($pagenum < 1) 
				$pagenum = 1; 

			elseif ($pagenum > $last)  
				$pagenum = $last; 
				
			//El rango que mostrará de páginas
			$max = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows; 
			
			$query2 = "SELECT * FROM Fleckr.Photos WHERE ID_PHOTO IN (SELECT ID_PHOTO FROM Fleckr.User_Collection_Photos WHERE ID_COLLECTION = '$collection') $max";
			
			$result2 = mysql_query($query2);
						
			?>
			
			<table>
			
			<?php
			$countRows = 0;
			
			echo "<tr>";
			//Mostrar los resultados
			while($row2 = mysql_fetch_array($result2)) 
			 {
			 	$user = $row2["ID_USER"];
			 	$file = $row2["FILE_NAME"];
			 	//$originalPath = $row2["LOCATION"];
			 	//$path = substr($originalPath, $pathSize, strlen($originalPath));
			 	$path = "/Fleckr/$user/$file";
			 	
				echo "<td><img class='imagesCollection'src='$path' alt=", $row2['NAME'], " /></td>";
				$countRows++;
			 } 
			
			echo "</tr>";
			?>
			
			</table>
			
			<?php
			//Dónde está el usuario y el número máximo de páginas
			echo "<p> --Page $pagenum of $last-- </p>";

			//Se generan los links de página siguiente y página anterior

			if ($pagenum == 1) 
			{
			}
		
			else 
 			{	
				echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=1&collection=$collection&rows=$page_rows'> <<-First</a> -";
				echo " ";
				$previous = $pagenum-1;
				echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$previous&collection=$collection&rows=$page_rows'> <-Previous</a> ";
			} 
		
			if ($pagenum == $last) 
			{
			} 
		
			else 
			{
				$next = $pagenum+1;

				echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$next&collection=$collection&rows=$page_rows'>Next -></a> -";

				echo " ";

				echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$last&collection=$collection&rows=$page_rows'>Last ->></a> ";
			}
//		 }
		?>
		
	</body>
</html>