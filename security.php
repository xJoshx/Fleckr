<?
	//Se reanuda la sesión
	@session_start();

	//Aquí se comprueba si existe una sesión activa
	if($_SESSION["authenticated"] != "Yes"){
	
	//Si no existe la sesión, se le manda a la página principal
	header("Location: mainPage.php");
	exit();
	}
?>