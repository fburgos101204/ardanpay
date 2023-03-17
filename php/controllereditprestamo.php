<?php 
if (isset($_POST["proceso"])) {
	require_once('../config/db.php');
	$class = new EditPrestamoController();

	$id_prestamo =  (isset($_POST["id_presta"])) ?  $_POST['id_presta'] : 0;
	$t_interes =  (isset($_POST["edit_t_interes"])) ?  $_POST['edit_t_interes'] : 0;
	$cuotas =  (isset($_POST["edit_cuotas"])) ?  $_POST['edit_cuotas'] : 0;
	$interes_porcentaje =  (isset($_POST["edit_interes_porcentaje"])) ?  $_POST['edit_interes_porcentaje'] : 0;
	$ciclo_pago =  (isset($_POST["edit_ciclo_pago"])) ?  $_POST['edit_ciclo_pago'] : 0;
	$fecha =  (isset($_POST["edit_fecha"])) ?  $_POST['edit_fecha'] : 0;
	

	$class->change_prestamo($id_prestamo,$t_interes,$cuotas,$interes_porcentaje,$ciclo_pago,$fecha);

}
else
{
	require_once('config/db.php');
}
class EditPrestamoController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function change_prestamo($id_prestamo,$t_interes,$cuota,$interes,$ciclo_pago,$fecha)
	{
		$query = "DELETE FROM amortizacion WHERE id_prestamo = $id_prestamo";
		echo $query;
		$run = $this->db_connection->query($query);
    	$query = "UPDATE prestamo SET interes=$interes,cuota=$cuota,tipo_interes='$t_interes',ciclo_pago=$ciclo_pago,fecha_aux='$fecha',proximo_pago='$fecha' WHERE id_prestamo = $id_prestamo";
		echo $query;
		$run = $this->db_connection->query($query);
		$query = "UPDATE historial_pagos SET estado = 'Prestamo Anterior' WHERE id_prestamo = $id_prestamo AND concepto != 'Reajuste Capital' AND estado != 'Anulada'";
		$run = $this->db_connection->query($query);
		echo $query;
	}
}


?>