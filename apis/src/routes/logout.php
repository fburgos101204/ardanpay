<?php
  header("Access-Control-Allow-Origin:*");
  require_once ("../config/dbi.php");
  require_once ("../config/conexion.php");

$id = $_GET['id'];
$query = $con->query("UPDATE mensajeros SET session_id = 1 WHERE id_mensajero = '$id'");
$con->close();

?>