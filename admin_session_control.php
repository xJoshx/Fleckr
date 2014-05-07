<?php
	include('connect_db.php');

	/* Se valida el usuario con la base de datos; utilizando htmlentities me aseguro de que no hacen inyecciones html */
	
	$userLogin = $_POST["user"];
	$cleanUserLogin = htmlentities($userLogin);
		
	$query = "SELECT ID_ADMIN FROM Fleckr.Admin
	WHERE ID_ADMIN ='$cleanUserLogin'";
	
	$user = mysql_query($query);
	
	$nuser = mysql_num_rows($user);

	//Si existe el usuario, se valida también la contraseña
	if($nuser != 0){

		$sql = "SELECT ID_ADMIN
		FROM Fleckr.Admin
		WHERE ID_ADMIN = '".htmlentities($_POST["user"])."'
		and PASS = '".htmlentities($_POST["pass"])."'";
		$key = mysql_query($sql);
		$nkey = mysql_num_rows($key);
		
	//Si todo está correcto, se crea una sesión
	if($nkey != 0){
	session_start();
	
	//Estas dos variables se guardan para, si es necesario, comprobar que el usuario está logeado y para saber quién es el usuario activo
	
	$_SESSION["authenticated"] = "Yes";
	$_SESSION["actualUser"] = mysql_result($key,0,0); 
	
	//Se comprueban los permisos para redirigirle correctamente
	header ("Location: adminMenu.php");
	}
	else{
		echo "<script>alert('Ya pass is wrong. Plz check it out k thx.');
		window.location.href=\"loginUser.html\"</script>";
	}
	}else{
		echo"<script>alert('Dat person doesn't exists. Plz check it out k thx.');
		window.location.href=\"loginUser.html\"</script>";
	}

?>