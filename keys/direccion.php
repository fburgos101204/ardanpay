<?php
  header("Access-Control-Allow-Origin:*");
  require_once ("../config/db.php");
  require_once ("../config/conexion.php");

date_default_timezone_set('America/Santo_Domingo');
    $id_cliente = $_GET['id_cliente'];
    $tipo = $_GET['tipo'];
    $lat = $_GET['lat'];
    $long = $_GET['long'];
    $fecha =  date("Y-m-d H:i:s");

    $url="https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$long."&sensor=false&key=AIzaSyB-ac3xmSzZIrXLNF-46hKymj56tKQH-s0";

     $response = file_get_contents($url);
     $json = json_decode($response,true);
     

     $direc = $json['results'][0]['formatted_address'];
     $zip =  $json['results'][1]['address_components'][0]['long_name']; // Zip code
     $ciudad = $json['results'][1]['address_components'][1]['long_name']; // ciudad
     $calle = $json['results'][0]['address_components'][0]['long_name']; // calle
     $direccion = utf8_decode($direc);

      header('Location: https://laundryappmovil.com/driverapp/apis/address_add.php?id_cliente='.$id_cliente.'&tipo='.$tipo.'&lat='.$lat.'&long='.$long.'&direccion='.$direccion.'&zip='.$zip.'&ciudad='.$ciudad.'&calle='.$calle);


 
?>