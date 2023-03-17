<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (isset($_GET['tmp']))
{
    include "php/historial_pagos.php";
    $close = new Historial_Pagos();
	
	$negocio = $_GET['negocio'];
		
	$result_config = $close->read_new_negocio($negocio);
	$result_cfg = $result_config->fetch_object();
	$mora_empresa = ($result_cfg->mora/100);
	$tipo_mora = $result_cfg->tipo_mora;
	
    $id_prestamo = $_GET['tmp'];
    $tipo_prestamo = $_GET['tp'];
    $raws = $close->read_cliente_prestamo($id_prestamo,$tipo_prestamo);
    if ($raws->num_rows >= 1) {
    while($ron = $raws->fetch_object()){
        $id_cliente = $ron->id_cliente;
        $cliente = $ron->cliente;
        $phone = $ron->celular;
		$photo = $ron->path_img_cliente;
        $fecha_inicio = $ron->fecha;
        $capital_inicial = $ron->capital_inicial;
        $capital_pendiente = $ron->capital_pendiente;
        $proximo_pago = $ron->proximo_pago;
        $estado = $ron->estado;
        $interes_porcentaje = $ron->interes;
        $tipo_interes = $ron->tipo_interes;
        $cuotas = $ron->cuota;
        $no_cuota = $ron->no_cuota;
        $balance = $ron->balance;
        $abono_capital = $ron->abono_capital;
        $interes = $ron->interes_cantidad;
        $fecha_aux = $ron->fecha_aux;
        $fecha_pagar = $ron->fecha_pago;
        $ciclo_pago = $ron->ciclo_pago;
    }}
	$date1 = new DateTime($proximo_pago);
    $date2 = new DateTime(date("Y-m-d"));
    $diff = $date1->diff($date2);
    $aumentos = -1;

    if ($date2 > $date1 && $ciclo_pago == 1) { $aumentos = $diff->days; }
    if ($date2 > $date1 && $ciclo_pago == 7) { $aumentos =  intval($diff->days/7); }
    if ($date2 > $date1 && $ciclo_pago == 15) { $aumentos =  intval($diff->days/15); }
    if ($date2 > $date1 && $ciclo_pago == 30) { $aumentos =  $diff->m ; }
    if ($date2 > $date1 && $ciclo_pago == 365) { $aumentos =  $diff->y; }
	  
	$aumentos_dias_pasados = $diff->days;
	  
    if ($date2 > $date1 && $aumentos_dias_pasados >= 6 && $estado != "Cancelado" && $estado != "Asunto Legal") {
		
      if ($tipo_mora == 2) { $monto_trabajar = $capital_inicial;  }
      else if($tipo_mora == 1) { $monto_trabajar = ($interes+$abono_capital); }
      else { $monto_trabajar = 0; }
      if ($aumentos != 0) {
        $mora_app = $aumentos*$mora_empresa*$monto_trabajar; 
      }else{
        $mora_app = $mora_empresa*$monto_trabajar; 
      }
    }
    else{
      $mora_app = 0;
    }
	echo $mora_app;
}
?>