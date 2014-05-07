<?php

	//Se reanuda la sesión
	session_start();
	//Se destruye la sesión
	session_destroy();
	//Se manda a la página de inicio
	header("Location: mainPage.html");
	
?>