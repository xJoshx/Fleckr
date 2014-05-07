<?php

include('security.php');

include('connect_db.php');

//Máximo 1.5 megas
$max=1500000;

//Se recupera el usuario
$user  = $_SESSION["actualUser"];

//La path donde se sube a falta de la carpeta de usuario
define('ABSPATH', dirname(__FILE__));

//Si se trabaja en servidor
//$newDirectory="$DOCUMENT_ROOT/../$user/Default/$hour.$nameClean";

//La path definitiva
$directory = ABSPATH . "/$user";

//En este caso se recupera también la colección
$collection = $_POST["collection"];

//mkdir($newDirectory);
//$uploaddir = "$newDirectory/";

//if(isset($_POST['send'])){
    // Sólo permite imágenes y que sean menores que 1.5 MB
    if ((($_FILES["file"]["type"] == "image/gif") ||
    ($_FILES["file"]["type"] == "image/jpeg") ||
    ($_FILES["file"]["type"] == "image/png") ||
    ($_FILES["file"]["type"] == "image/pjpeg")) &&
    ($_FILES["file"]["size"] < $max)) {
    //Si hay un error en la subida, se muestras
      if ($_FILES["file"]["error"] > 0) {
        echo $_FILES["file"]["error"] . "";
      } else {
        // Con esto aseguro que no haya ninguna imagen repetida
        if (file_exists("$directory/" . $_FILES["file"]["name"])) {
          echo $_FILES["file"]["name"] . " already exists... :(";
        } else {
         // Si todo está bien, se sube la imagen
          move_uploaded_file($_FILES["file"]["tmp_name"],
          "$directory/" . $_FILES["file"]["name"]);
          
          //Se guarda en la base de datos un id único, el nombre de la foto, el usuario y su path
          $photoName = $_POST["name"];       
          $idPhoto = $photoName . $user;
          $location = "$directory/" . $_FILES["file"]["name"];
          $file_name = $_FILES["file"]["name"];
          $query = "INSERT INTO Fleckr.Photos VALUES ('$idPhoto','$photoName','$user','$location', '$file_name')";
          $result = mysql_query($query);
          
          //También se inserta en la colección que se ha pasado
          $query = "INSERT INTO Fleckr.User_Collection_Photos VALUES ('$user','$collection','$idPhoto')";
          
          $result = mysql_query($query);
          
		  header("Location: addPhotosCollection.php?collection=$collection");
        }
      }
    } else {
        // Si no sube una imagen o es demasiado grande, se muestra esto
        echo "This file exceeds the 1.5 MB limit.";
    }
//}

?>