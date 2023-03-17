<?php
  header("Access-Control-Allow-Origin:*");
  require_once ("../config/db.php");
  require_once ("../config/conexion.php");
 
date_default_timezone_set('America/Santo_Domingo');
$id = $_GET['id'];
$return_arr = array();

$sql = "SELECT * FROM negocio AS ngc INNER JOIN configuracion AS WHERE id_historial = '$id'";

$result_of_login_check = $con->query($sql);

if ($result_of_login_check->num_rows > 0) {
    $result_row = $result_of_login_check->fetch_object();

            $row_array['id_historial'] = $result_row->id_historial;
        	$row_array['caja'] = $result_row->caja;
			$row_array['id_prestamo'] = $result_row->id_prestamo;
        	$row_array['concepto'] = $result_row->concepto;
        	$row_array['fecha'] = $result_row->fecha;
        	$row_array['capital'] = $result_row->capital;
        	$row_array['interes'] = $result_row->interes;
        	$row_array['mora'] = $result_row->mora;
        	$row_array['descuento'] = $result_row->descuento;
        	$row_array['total_pagado'] = $result_row->total_pagado;
        	$row_array['capital_restante'] = $result_row->capital_restante;
	        $row_array['tipo_pago'] = $result_row->tipo_pago;
	        $row_array['banco'] = $result_row->banco;
	        $row_array['no_deposito'] = $result_row->no_deposito;
	        $row_array['nota'] = $result_row->nota;
	        $row_array['creador'] = $result_row->creador;
	        $row_array['no_cuota'] = $result_row->no_cuota;
	        $row_array['estado'] = $result_row->estado;
	
            array_push($return_arr,$row_array);
            echo json_encode($return_arr); 
} else {
  echo $errors = "2";
}
$con->close();
?>