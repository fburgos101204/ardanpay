<?php 
if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new PrestamosController();
	$proceso = $_POST['proceso'];
	if ($proceso == "asunto_legal") {
		$id_prestamo = $_POST['id_prestamo'];
		$class->cancel_prestamo($id_prestamo,"Asunto Legal");
	}else if ($proceso == "cancelar") {
		$id_prestamo = $_POST['id_prestamo'];
		$class->cancel_prestamo($id_prestamo,"Cancelado");
	}else{
		if(isset($_POST['id_vehiculo_prestamo']) || isset($_POST['id_inmobiliario_prestamo'])){
			$id_cliente =  (isset($_POST["id_vehiculo_prestamo"])) ?  $_POST['id_vehiculo_prestamo'] : $_POST['id_inmobiliario_prestamo'];
		}else{
			$id_cliente =  (isset($_POST["id_cliente"])) ?  $_POST['id_cliente'] : 0;
		}
		$fecha =  (isset($_POST["fecha_reajuste"])) ?  $_POST['fecha_reajuste'] : date("Y-m-d");
		$monto =  (isset($_POST["new_capital"])) ?  $_POST['new_capital'] : 0;
		$cuotas =  (isset($_POST["id_cuotas"])) ?  $_POST['id_cuotas'] : 0;
		$interes =  (isset($_POST["interes_porcentaje"])) ?  $_POST['interes_porcentaje'] : 0;
		$t_interes =  (isset($_POST["t_interes_valida"])) ?  $_POST['t_interes_valida'] : 0;
		$creador =  (isset($_POST["creador"])) ?  $_POST['creador'] : 0;
		$modalidad =  (isset($_POST["id_ciclo_pago"])) ?  $_POST['id_ciclo_pago'] : 0;
		$fecha_creacion =  (isset($_POST["fecha_creacion"])) ?  $_POST['fecha_creacion'] : 0;
		
		$tipo_prestamo =  (isset($_POST["tipo_prestamo"])) ?  $_POST['tipo_prestamo'] : "Prestamo Personal";

		$rows = $class->crear_prestamo($id_cliente,$fecha,$monto,$cuotas,$modalidad,$interes,$t_interes,$tipo_prestamo,$creador,$fecha_creacion);

    	if ($rows->num_rows >= 1) {
   			while($row = $rows->fetch_object()){
   				$id_prestamo = $row->last_id;
   				echo $id_prestamo;
   			}}


		$metodo =  (isset($_POST["tipo"])) ?  $_POST['tipo'] : 0;
		$id_metodo =  (isset($_POST["id_metodo"])) ?  $_POST['id_metodo'] : 0;
		$codigo =  (isset($_POST["cd_pr"])) ?  $_POST['cd_pr'] : 0;
		
		$class->retiro_prestamo($id_prestamo,$metodo,$id_metodo,$monto,$codigo,$creador,$tipo_prestamo);
	}
}
else
{
	require_once('config/db.php');
}
class PrestamosController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function read_all_prestamo()
	{
		$query = "SELECT CONCAT(clt.nombre, ' ', clt.apellido) as cliente,rft.nombre, prt.* FROM prestamo as prt
					INNER JOIN clientes as clt on prt.id_cliente = clt.id_cliente
					INNER JOIN referencias as rft on clt.id_cliente = rft.id_cliente";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function read_detalle_prestamo($id_cliente)
	{
		$query = "SELECT prt.* FROM historial_pagos AS prt
					INNER JOIN prestamo as rft on prt.id_prestamo = rft.id_prestamo
					INNER JOIN clientes as clt on rft.id_cliente = clt.id_cliente
					WHERE clt.id_cliente=$id_cliente";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function cancel_prestamo($id_prestamo,$asunto)
	{
		$query = "UPDATE prestamo SET estado='$asunto' WHERE id_prestamo=$id_prestamo" ;
		$run = $this->db_connection->query($query);
		echo $query;
	}

	public function crear_prestamo($id_cliente,$fecha,$monto,$cuotas,$modalidad,$interes,$t_interes,$tipo_prestamo,$creador,$fecha_creacion)
	{
		$query = "INSERT INTO prestamo (id_cliente,tipo_prestamo,fecha_aux,fecha,proximo_pago,capital_inicial,capital_pendiente,cuota,ciclo_pago,interes,tipo_interes,creador,estado,fecha_creado)
				VALUES($id_cliente,'$tipo_prestamo','$fecha','$fecha','$fecha',$monto,$monto,$cuotas,$modalidad,$interes,'$t_interes',$creador,'Al Dia','$fecha_creacion')";
		$run = $this->db_connection->query($query);
		$query = "SELECT LAST_INSERT_ID() AS last_id";
		$run = $this->db_connection->query($query);
		return $run;
		
	}


	public function retiro_prestamo($id_prestamo,$metodo,$id_metodo,$monto,$codigo,$creador,$concepto_retiro)
	{
		$query = "INSERT INTO retiros_prestamo (metodo, id_metodo,monto,codigo,id_prestamo,creador,	concepto_retiro)
					VALUES('$metodo',$id_metodo,$monto,'$codigo',$id_prestamo,$creador,'$concepto_retiro')";
		$run = $this->db_connection->query($query);
		if ($metodo == "Banco") {
			$query = "UPDATE banco SET monto = monto - $monto WHERE id_banco = $id_metodo";
			$run = $this->db_connection->query($query);
		}else if($metodo = "Caja"){
			$query = "UPDATE caja SET monto = monto - $monto WHERE id_caja = $id_metodo";
			$run = $this->db_connection->query($query);
		}
	}

}


?>