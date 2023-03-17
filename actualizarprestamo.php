<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (isset($_POST['id_prestamo']))
{
    include "php/historial_pagos.php";

	$id_prestamo =  (isset($_POST["id_prestamo"])) ?  $_POST['id_prestamo'] : 0;
	$tipo_prestamo =  (isset($_POST["tipo_prestamo"])) ?  $_POST['tipo_prestamo'] : 0;
	echo $id_prestamo;
	echo $tipo_prestamo;
	
    $du = new Historial_Pagos();
    $raws = $du->read_cliente_prestamo($id_prestamo,$tipo_prestamo);
    if ($raws->num_rows >= 1) {
    while($ron = $raws->fetch_object()){
        $id_cliente = $ron->id_cliente;
		$estas = $ron->esta;
		$faltas = $ron->faltas;
        $cliente = $ron->cliente;
        $cedula = $ron->cedula;
        $phone = $ron->celular;
		$photo = $ron->path_img_cliente;
        $fecha_creacion = $ron->fecha_creado;
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
	  
    $close = new Historial_Pagos();

    $ruws = $close->historial($id_prestamo);

    $aumento = $ruws->num_rows;

    $catn = $close->cantidad_reajustes($id_prestamo);

    $cantidad_reajuste = $catn->num_rows;
		
    if ($catn->num_rows >= 1) {
    while($ron = $catn->fetch_object()){
		$cant_p_inicial = $ron->capital_restante;
		break;
	}}else{ $cant_p_inicial = 0; } 

    $fecha = date($fecha_aux);
   

    // will output 2 days
    

    if ($ciclo_pago == 1) {

      $nuevafecha = strtotime('+'.$aumento.' day',strtotime($fecha));
      
      
    }else if ($ciclo_pago == 7) {

      $nuevafecha = strtotime(($aumento*7).' day',strtotime($fecha));
      

    }else if ($ciclo_pago == 15) {
      $nuevafecha = strtotime('+'.($aumento*15).' day',strtotime($fecha));
      

    }else if ($ciclo_pago == 30) {

      $nuevafecha = strtotime('+'.($aumento*30).' day',strtotime($fecha));
      

    }else if ($ciclo_pago == 365) {

      $nuevafecha = strtotime('+'.($aumento*365).' day',strtotime($fecha));
      
    }

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
	  
    if ($date2 > $date1 && $aumentos_dias_pasados >= 6 && $estado != "Cancelado" && $estado != "Asunto Legal")
	{
      $du->update_prestamo($id_prestamo,"Atrasado");
    }
    else
	{
      if ($estado != "Cancelado" && $estado != "Asunto Legal")
	  {
      	$du->update_prestamo($id_prestamo,"Al Dia");
      }

    }
    $proximo_pago = date ('Y-m-d',$nuevafecha);
    $du->update_last_pago($proximo_pago,$id_prestamo);

	if($capital_pendiente == 0 && $estado != "Cancelado" && $estado != "Asunto Legal")
	{
		//aqui diremos si esta completo o no
		$du->completar_prestamo($id_prestamo);
	}
}
?>