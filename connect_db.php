<?php
	$server = 'localhost';
	$user = 'root';
	$pass = '';
	$database = 'Fleckr';
	
	//La configuración por defecto para conectarse a la bd
	
	$id = mysql_connect($server, $user, $pass) or die("impossible to connect with MySQL"); 
	$db = mysql_select_db($database) or die("error in database");	
	
?>