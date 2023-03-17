<?php
  header("Access-Control-Allow-Origin:*");
  require_once ("../config/dbi.php");
  require_once ("../config/conexion.php");

if(isset($_GET['id']))
{	
	$id = $_GET['id'];
	$psw = $_GET['password'];
    $passwo = password_hash($psw, PASSWORD_DEFAULT);
    $sqlUpdatePass = 'UPDATE mensajeros SET pass ="'.$passwo.'" WHERE id_mensajero='.$id;
    $query = mysqli_query($con,$sqlUpdatePass);
	echo $passwo;
	echo $id;
}

mysqli_close($con);

?>