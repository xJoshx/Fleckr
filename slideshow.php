<?php

	include('connect_db.php');
	
	include('security.php');
	
	$me = $_SESSION["actualUser"];
	
	$collection = $_GET["collection"];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Slideshow</title>
        <link rel="stylesheet" href="slideshow.css" type="text/css" media="screen" />        
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
        <script type="text/javascript" src="jquery.cycle.js"></script>
        <script type="text/javascript" src="slideshow.js"></script>
    </head>
    <body>
    
    <?php 
    $query = "SELECT * FROM Fleckr.Authorize WHERE ID_USER = '$me'";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
    	if ($row['PERMITS'] == 'Complete') {
    		echo "<div id='logout'><a href='viewMyCollection.php?collection=$collection'>Back</a></div>";		
    	}
    	
    	else if ($row['PERMITS'] == 'Basic') {
    		echo "<div id='logout'><a href='viewMyCollection.php?collection=$collection'>Back</a></div>";		
    	}
    
    ?>
    
        <div id="slideshow">
            <div class="slides">
                <ul>
                <?php
                
	               	$query = "SELECT ID_USER, NAME, FILE_NAME FROM Fleckr.Photos WHERE ID_PHOTO IN (SELECT ID_PHOTO FROM Fleckr.User_Collection_Photos WHERE ID_COLLECTION = '$collection')";
//                	echo $query;
                	$result = mysql_query($query);
                	
                	while($row = mysql_fetch_array($result)) 
                	{ 
                		$user = $row["ID_USER"];
                		$file = $row["FILE_NAME"];
               			$path = "/Fleckr/$user/$file";
                		echo "<li id=", $row['NAME'],">
                		    <h2>", $row['NAME'],"</h2>
                		    <p>
                				<img src='$path' alt=", $row['NAME']," />
                		    </p>
                		</li>";
                	}
                
                ?>
                                
                </ul>
            </div>
            <ul class="slides-nav">
            <?php
            	   	$query = "SELECT NAME FROM Fleckr.Photos WHERE ID_PHOTO IN (SELECT ID_PHOTO FROM Fleckr.User_Collection_Photos WHERE ID_COLLECTION = '$collection')";
            	
//            	                	echo $query;
            		$result = mysql_query($query);
            		
            		while($row = mysql_fetch_array($result)) 
            		{
            			$name = $row['NAME']; 
						echo "<li><a href='#$name'>$name</a></li>";
            		}
            ?>
            </ul>
        </div>
    </body>
</html>