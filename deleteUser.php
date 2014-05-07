<?php
	
include('connect_db.php');

$user = $_GET["id"];

$query = "DELETE FROM Fleckr.Users WHERE ID_USER = '$user'";
$result = mysql_query($query);
//$dir = "/Fleckr/$user";
/*
$dir = "/Applications/XAMPP/xamppfiles/htdocs/Fleckr/userdelete";
function removeDirectory($path)
{
    $path = rtrim( strval( $path ), '/' ) ;
     
    $d = dir( $path );
     
    if( ! $d )
        return false;
     
    while ( false !== ($current = $d->read()) )
    {
        if( $current === '.' || $current === '..')
            continue;
         
        $file = $d->path . '/' . $current;
         
        if( is_dir($file) )
            removeDirectory($file);
         
        if( is_file($file) )
            unlink($file);
    }
     
    rmdir( $d->path );
    $d->close();
    return true;
}
 
//deleteDirectory('Nombre de la carpeta a borrar', true);
 
removeDirectory($dir);
*/

header("Location: adminMenu.php");

?>