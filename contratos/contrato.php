<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<?php
if (isset($_GET['tp'])){
require_once('../config/db.php');
$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$id_prestamo = base64_decode($_GET['tp']);
$negocio = $_GET['tmp_negocio'];
$tipo_prestamo = base64_decode($_GET['tmp']);
$id_notario = $_GET['not'];
	
$query = "SELECT * FROM notario WHERE id_notario = $id_notario";
$rows = $con->query($query);
if ($rows->num_rows >= 1) {
while($row = $rows->fetch_object()){
	$nombre_notario = $row->nombre." ".$row->apellido;
	$codigo_colegio_notario = $row->codigo_colegio;
	$cedula_notario = $row->cedula;
}}
	
	
$query = "SELECT prt.*, clt.*,gtr.nombre as garante,gtr.cedula as ced_garante FROM prestamo AS prt
			LEFT JOIN clientes as clt on prt.id_cliente = clt.id_cliente
			LEFT JOIN garante as gtr on clt.id_cliente = gtr.id_cliente
			WHERE prt.id_prestamo = $id_prestamo";
$rows = $con->query($query);
if ($rows->num_rows >= 1) {
while($row = $rows->fetch_object()){ 
	$nombre_cliente = $row->nombre." ".$row->apellido;
	$ocupacion_cliente = $row->ocupacion;
	$cedula_cliente = $row->cedula;
	$direccion_cliente = $row->direccion;
	$nombre_garante = $row->garante;
	$cedula_garante = $row->ced_garante;
	$monto_prestar = $row->capital_inicial;
	$tasa_interes = $row->interes;
	$modalidad_pago = $row->ciclo_pago;
	$cantidad_cuotas = $row->cuota;
	$nacionalidad = $row->nacionalidad;
	$fecha_creado = $row->fecha_creado;
	
}}
	
if ($modalidad_pago == 1){ $modalidad_pago = 'Diario'; }
else if ($modalidad_pago == 7){ $modalidad_pago = 'Semanal'; }
else if ($modalidad_pago == 15){ $modalidad_pago = 'Quincenal'; }
else if ($modalidad_pago == 30){ $modalidad_pago = 'Mensual'; }
else if ($modalidad_pago == 365){ $modalidad_pago = 'Anual'; }
	
if($tipo_prestamo == "Prestamo Personal")
{
	$tpm_prestamo = $negocio."/contrato_personal/".$negocio."_contrato_personal.html";
}
else if($tipo_prestamo == "Prestamo Vehiculo")
{
	$tpm_prestamo = $negocio."/contrato_vehiculo/".$negocio."_contrato_vehiculo.html";
}
else if($tipo_prestamo == "Prestamo Inmobiliario")
{
	$tpm_prestamo = $negocio."/contrato_inmobiliario/".$negocio."_contrato_inmobiliario.html";
}
$html = file_get_contents($tpm_prestamo);
$html = str_replace('$nombre_notario',$nombre_notario,$html);
$html = str_replace('$codigo_colegio_notario',$codigo_colegio_notario,$html);
$html = str_replace('$cedula_notario',$cedula_notario,$html);
$html = str_replace('$nombre_cliente',$nombre_cliente,$html);
$html = str_replace('$ocupacion_cliente',$ocupacion_cliente,$html);
$html = str_replace('$cedula_cliente',$cedula_cliente,$html);
$html = str_replace('$direccion_cliente',$direccion_cliente,$html);
$html = str_replace('$nombre_garante',$nombre_garante,$html);
$html = str_replace('$cedula_garante',$cedula_garante,$html);
$html = str_replace('$monto_prestar',$monto_prestar,$html);
$html = str_replace('$tasa_interes',$tasa_interes,$html);
$html = str_replace('$modalidad_pago',$modalidad_pago,$html);
$html = str_replace('$cantidad_cuotas',$cantidad_cuotas,$html);
$html = str_replace('$nacionalidad',$nacionalidad,$html);
$html = str_replace('$fecha_creado',$fecha_creado,$html);
$html = str_replace('$nombre_prestador',$empresa,$html);
echo $html;

 }else{ echo "no llego"; } ?>