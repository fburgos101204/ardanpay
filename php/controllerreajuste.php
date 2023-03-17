<?php 
if (isset($_POST['reajuste_id']) || isset($_POST["id_prestamo_id"]) || isset($_POST["id_prestamo_change"])) {
	require_once('../config/db.php');
	$class = new ReajusteController();
	

	if (isset($_POST["reajuste_id"])) {

		$id_prestamo =  (isset($_POST["reajuste_id"])) ?  $_POST['reajuste_id'] : 0;
		$nuevo_monto =  (isset($_POST["nuevo_monto"])) ?  $_POST['nuevo_monto'] : 0;
		$fecha_reajuste =  (isset($_POST["fecha_reajuste"])) ?  $_POST['fecha_reajuste'] : date('Y-m-d');


		$new_capital =  (isset($_POST["new_capital"])) ?  $_POST['new_capital'] : 0;

		$tipo_pago_reajuste =  (isset($_POST["tipo_pago_reajuste"])) ?  $_POST['tipo_pago_reajuste'] : "";

		$id_caja =  (isset($_POST["id_caja_reajuste"])) ?  $_POST['id_caja_reajuste'] : 0;

		$banco =  (isset($_POST["banco_pago_reajuste"])) ?  $_POST['banco_pago_reajuste'] : 0;
		
		$no_cheque =  (isset($_POST["no_cheque_reajuste"])) ?  $_POST['no_cheque_reajuste'] : "";

		$class->proceso($id_prestamo,$new_capital,$nuevo_monto,$fecha_reajuste,$tipo_pago_reajuste,$id_caja,$banco,$no_cheque);

	}else if(isset($_POST["id_prestamo_id"])) {

		$id_prestamo =  (isset($_POST["id_prestamo_id"])) ?  $_POST['id_prestamo_id'] : 0;
		$class->delete_amort($id_prestamo);
	}else if(isset($_POST["id_prestamo_change"]))
	{
		$id_prestamo =  (isset($_POST["id_prestamo_change"])) ?  $_POST['id_prestamo_change'] : 0;
		$class->change_amort($id_prestamo);
	}
}
else
{
	require_once('config/db.php');
}
class ReajusteController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function proceso($id_prestamo,$new_capital,$nuevo_monto,$fecha_reajuste,$tipo_pago_reajuste,$id_caja,$banco,$no_cheque)
	{
		$query = "UPDATE historial_pagos SET estado = 'Prestamo Anterior' WHERE id_prestamo = $id_prestamo AND concepto != 'Reajuste Capital' AND estado != 'Anulada'";
		$run = $this->db_connection->query($query);
		echo $query;

		$query = "UPDATE prestamo SET capital_pendiente=capital_pendiente+$nuevo_monto, fecha_aux='$fecha_reajuste' WHERE id_prestamo = $id_prestamo";
		$run = $this->db_connection->query($query);
		echo $query;

		$query = "DELETE FROM amortizacion WHERE id_prestamo=$id_prestamo";
		$run = $this->db_connection->query($query);
		echo $query;

		if ($tipo_pago_reajuste == "Efectivo") {
			$query = "INSERT historial_pagos (id_prestamo,concepto,capital,tipo_pago,caja,capital_restante)
					VALUES($id_prestamo,'Reajuste Capital',$nuevo_monto,'$tipo_pago_reajuste',$id_caja,$new_capital)";
		}else{
			$query = "INSERT historial_pagos (id_prestamo,concepto,capital,tipo_pago,banco,no_deposito,capital_restante)
					VALUES($id_prestamo,'Reajuste Capital',$nuevo_monto,'$tipo_pago_reajuste',$banco,'$no_cheque',$new_capital)";
		}
		
		$run = $this->db_connection->query($query);
		echo $query;

		if ($tipo_pago_reajuste != "Efectivo") {
			$query = "UPDATE banco SET monto = monto - $nuevo_monto WHERE id_banco = $banco";
		}else{
			$query ="UPDATE caja SET monto = monto - $nuevo_monto WHERE id_caja = $id_caja";
		}
		
		$run = $this->db_connection->query($query);
		echo $query;


	}
	public function delete_amort($id_prestamo)
	{
		$query = "DELETE FROM amortizacion WHERE id_prestamo = $id_prestamo";
		$run = $this->db_connection->query($query);
		echo $query;
	}

	public function change_amort($id_prestamo)
	{
		
		$query = "SELECT * FROM historial_pagos WHERE id_prestamo = $id_prestamo AND estado = 'Prestamo Anterior'";
		$run = $this->db_connection->query($query);
		echo $query;

    	if ($run->num_rows >= 1) {
    		while($row = $run->fetch_object()){
    			$query = "UPDATE amortizacion SET estado = 'Pagada' WHERE id_prestamo = $id_prestamo AND no_cuota = $row->no_cuota";
				$eject = $this->db_connection->query($query);
    			echo $query;
    		}}

    	$query = "UPDATE historial_pagos SET estado = 'Pagada' WHERE id_prestamo = $id_prestamo AND estado = 'Prestamo Anterior'";
		echo $query;
		$run = $this->db_connection->query($query);
	}
}


?>