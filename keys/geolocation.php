<?php
  header("Access-Control-Allow-Origin:*");
  require_once ("../config/db.php");
  require_once ("../config/conexion.php");

date_default_timezone_set('America/Santo_Domingo');
$id_chofer = $_GET['id_chofer'];
$lat = $_GET['lat'];
$long = $_GET['long'];
$fecha = date('Y-m-d h:i:s A');

$insert ="INSERT INTO location_driver (id_mensajero,latitud,longitud,fecha) VALUES ('$id_chofer','$lat','$long','$fecha')";
$cons1 = $con->query($insert);

$update ="UPDATE mensajeros SET lat = '$lat',lng = '$long', last_update = '$fecha'   WHERE id_mensajero = '$id_chofer'";
$cons = $con->query($update);
$con->close();
?>