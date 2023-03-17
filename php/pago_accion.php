<?php 
if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new PagoAccionController();
	$proceso = $_POST['proceso'];
	if($proceso == "proceso_anulado")
	{
		$id_metodo = (isset($_POST['id_metodo'])) ? $_POST['id_metodo'] : 0;
		$metodo = (isset($_POST['metodo'])) ? $_POST['metodo'] : "";
		$no_cuota = (isset($_POST['no_cuota'])) ? $_POST['no_cuota'] : 0; 
		$id_prestamo = (isset($_POST['id_prestamo'])) ? $_POST['id_prestamo'] : "";
		$id_historial = (isset($_POST['id_historial'])) ? $_POST['id_historial'] : "";
		$capital_pagado = (isset($_POST['capital_pagado'])) ? $_POST['capital_pagado'] : ""; 
		$total_pagado = (isset($_POST['total_pagado'])) ? $_POST['total_pagado'] : "";
		$concepto = (isset($_POST['concepto'])) ? $_POST['concepto'] : "";
		$class->anular_pago($id_metodo,$metodo,$id_historial,$capital_pagado,$total_pagado,$no_cuota,$id_prestamo,$concepto);
	}
	else if($proceso == "saldar_deuda")
	{
		$creador = (isset($_POST['creador_cap'])) ? $_POST['creador_cap'] : 0;
		$id_prestamo = (isset($_POST['id_prestamo_saldar_cap'])) ? $_POST['id_prestamo_saldar_cap'] : 0;
		$cap_pendiente = (isset($_POST['cap_pediente'])) ? $_POST['cap_pediente'] : 0;
		
		$tipo_pago = (isset($_POST['tipo_pago_capt'])) ? $_POST['tipo_pago_capt'] : 0;
		
		$id_caja = (isset($_POST['id_caja_capt'])) ? $_POST['id_caja_capt'] : 0;
		
		$banco_pago = (isset($_POST['banco_pago_capt'])) ? $_POST['banco_pago_capt'] : 0;
		
		$no_cheque = (isset($_POST['no_cheque_capt'])) ? $_POST['no_cheque_capt'] : 0;
		
		if($tipo_pago == "Efectivo"){ $banco_pago = 0; $no_cheque = 'Sin codigo'; }
		else{ $id_caja = 0; }
		
		
		$class->saldar_prestamo($id_prestamo,$cap_pendiente,$id_caja,$banco_pago,$no_cheque,$creador,$tipo_pago);

	}
}
else
{
	require_once('config/db.php');
}
class PagoAccionController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}
	
	public function saldar_prestamo($id_prestamo,$cap_pendiente,$id_caja,$banco_pago,$no_cheque,$creador,$tipo_pago)
	{
		$query = "UPDATE prestamo SET capital_pendiente = 0,estado = 'Completado' WHERE id_prestamo = $id_prestamo ";
		$run = $this->db_connection->query($query);
		echo $query;
		$query = "INSERT INTO historial_pagos (id_prestamo,concepto,capital,total_pagado,capital_restante,tipo_pago,creador,estado,caja,banco,no_deposito)
					VALUES($id_prestamo,'Saldar Deuda en Legal',$cap_pendiente,$cap_pendiente,0,'$tipo_pago',$creador,'Pagada',$id_caja,$banco_pago,'$no_cheque')";
		$run = $this->db_connection->query($query);
		echo $query;
	}
	
	public function anular_pago($id_metodo,$metodo,$id_historial,$capital_pagado,$total_pagado,$no_cuota,$id_prestamo,$concepto)
	{
		$query = "UPDATE historial_pagos SET estado = 'Anulada' WHERE id_historial = $id_historial";
		$run = $this->db_connection->query($query);
		echo $query;

		if ($no_cuota > 0) {
			$query = "UPDATE amortizacion SET estado = 'Pendiente' WHERE id_prestamo = $id_prestamo AND no_cuota=$no_cuota";
    		$run = $this->db_connection->query($query);
    		echo $query;
		}

		if ($concepto == "Reajuste Capital") {
			$query = "UPDATE prestamo SET capital_pendiente = capital_pendiente-$capital_pagado WHERE id_prestamo = $id_prestamo";
		}else{
			$query = "UPDATE prestamo SET capital_pendiente = capital_pendiente+$capital_pagado WHERE id_prestamo = $id_prestamo";
		}
		
		$run = $this->db_connection->query($query);
		echo $query;

		if ($metodo == "caja") {

		if ($concepto == "Reajuste Capital") {
			$query = "UPDATE caja SET monto = monto+$capital_pagado WHERE id_caja = $id_metodo";
		}else{

			$query = "UPDATE caja SET monto = monto+$total_pagado WHERE id_caja = $id_metodo";
		}
			$run = $this->db_connection->query($query);
			echo $query;

		}else if($metodo == "banco")
		{

		if ($concepto == "Reajuste Capital") {
			$query = "UPDATE banco SET monto = monto+$capital_pagado WHERE id_banco = $id_metodo";
		}else{
			$query = "UPDATE banco SET monto = monto+$total_pagado WHERE id_banco = $id_metodo";
		}
			$run = $this->db_connection->query($query);
			echo $query;
		}
	}

}


?>