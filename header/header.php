<?php
date_default_timezone_set("America/Santo_Domingo");
session_start();
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
require_once ("config/db.php");
require_once ("config/conexion.php");

$negocio = $_SESSION['negocio'];
$config = "SELECT * FROM configuracion WHERE id_negocio = $negocio";
$result_config = $con->query($config);
$result_cfg = $result_config->fetch_object();
$logo = $result_cfg->logo;
$correo = $result_cfg->correo;
$correo = $result_cfg->correo;
$rnc = $result_cfg->rnc;
$mora_empresa = $result_cfg->mora;
$empresa = $result_cfg->empresa;
$font = $result_cfg->font;


/*$lit_usr = "SELECT COUNT(urs.user_id) AS actual, ngs.limite_usuario FROM negocio AS ngs 
			INNER JOIN users AS urs ON ngs.id_negocio = urs.negocio
			WHERE ngs.id_negocio = $negocio";

$result_usr = $con->query($lit_usr);
$result_usr = $result_usr->fetch_object();
$usuario_permitido = $result_usr->actual;
$limite_usuario = $result_usr->limite_usuario;*/


$user_id = $_SESSION['user_id'];

$avalible = "SELECT permisos FROM users WHERE user_id = $user_id";
$result_avalible = $con->query($avalible);
$result = $result_avalible->fetch_object();
$permisos = $result->permisos;
$permisos = json_decode($permisos);

if($negocio != 0){
	
	/*Configuracion de PLAN*/
	$avalible_muestra = "SELECT pln.permisos,ngp.fecha_pago,pln.cant_user,pln.cant_prestamo FROM planes AS pln
					 	LEFT JOIN negocio_plan AS  ngp ON pln.id_plan = ngp.id_plan
						WHERE ngp.id_negocio = $negocio";
	$result_muestra = $con->query($avalible_muestra);
	$result_permisos = $result_muestra->fetch_object();
	$permisos_muestra = $result_permisos->permisos;
	$fecha_vence_plan = $result_permisos->fecha_pago;
	$cant_user = $result_permisos->cant_user;
	$cant_prestamo = $result_permisos->cant_prestamo;
	$permisos_muestra = json_decode($permisos_muestra);
	/*Configuracion de PLAN*/
	
	/*Cantidad Actual de Prestamos*/
	$avalible_cant_prestamo = "SELECT COUNT(prt.id_prestamo) AS cant_prt FROM clientes AS clt
						INNER JOIN prestamo AS prt ON clt.id_cliente = prt.id_cliente
						WHERE clt.negocio = $negocio and (prt.estado = 'Al Dia' or prt.estado = 'Atrasado')";
	$result_cant_prestamo = $con->query($avalible_cant_prestamo);
	$result_conteo_cant_prestamo = $result_cant_prestamo->fetch_object();
	$cant_prestamor_actual = $result_conteo_cant_prestamo->cant_prt;
	/*Cantidad Actual de Prestamos*/
	
	
	/*Cantidad Actual de Usuarios*/
	$avalible_cant_user = "SELECT COUNT(user_id) AS cnt_user FROM users WHERE negocio = $negocio";
	$result_cant_user = $con->query($avalible_cant_user);
	$result_conteo_cant_user = $result_cant_user->fetch_object();
	$cant_user_actual = $result_conteo_cant_user->cnt_user;
	/*Cantidad Actual de Usuarios*/
	
	
}

$tipo_mora = $result_cfg->tipo_mora;
$mora_empresa = $mora_empresa/100;
$barcolor = $result_cfg->barcolor;
$telefono_empresa  = $result_cfg->telefono;
$direccion = $result_cfg->direccion;
$usuario = $_SESSION['firstname'].' '.$_SESSION['lastname'][0].'.';
$nivel = $_SESSION['nivel'];
$horario = date('h:i:s A');
$tipo = 'info';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=3.0, minimum-scale=0.86">
  <link rel="icon" type="image/png" href="<?php echo $logo; ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <title><?php echo $empresa; ?></title>

  <meta name="theme-color" content="#025E93">
  <meta name="MobileOptimized" content="width">
  <meta name="HandheldFriendly" content="true">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link rel="shortcut icon" type="image/png" href="<?php echo $logo; ?>">
  <link rel="apple-touch-icon" href="<?php echo $logo; ?>">
  <link rel="apple-touch-startup-image" href="<?php echo $logo; ?>">
  <link rel="manifest" href="./manifest.json">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <link href="select2/css/select2.css" rel="stylesheet"/>
  <script src="select2/js/select2.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
  <link href="css/g_style.css" rel="stylesheet"/>

</head>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<style>
	.btn-round,.btn-circle
	{
	   	padding: 8px 12px !important;
		border-radius: 100% !important;
	}
</style>

	
<body id="page-top">