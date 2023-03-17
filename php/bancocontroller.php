<?php 
if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new BancoController();
	$proceso = $_POST['proceso'];
	
	$id_banco =  (isset($_POST["id_banco"])) ?  $_POST['id_banco'] : 0;
	$id_negocio =  (isset($_POST["id_negocio"])) ?  $_POST['id_negocio'] : 0;
	$banco_name =  (isset($_POST["banco_name"])) ?  $_POST['banco_name'] : 0;
	$banco_titular =  (isset($_POST["banco_titular"])) ?  $_POST['banco_titular'] : 0;
	$fecha_venci =  (isset($_POST["fecha_venci"])) ?  $_POST['fecha_venci'] : 0;
	$banco_monto =  (isset($_POST["banco_monto"])) ?  $_POST['banco_monto'] : 0;
	$creador =  (isset($_POST["creador_banco"])) ?  $_POST['creador_banco'] : 0;


	$monto_pagar =  (isset($_POST["monto_pagar"])) ?  $_POST['monto_pagar'] : 0;
	
	if ($proceso == "delete") {
		$class->delete($id_banco);
	}else if($proceso == "pagar_cuota")
	{
		$class->pagar($id_banco,$monto_pagar);
	}
	else{
		$class->proceso($proceso,$id_banco,$banco_name,$banco_titular,$fecha_venci,$banco_monto,$creador,$id_negocio);
	}

}
else
{
	require_once('config/db.php');
}
class BancoController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function read_banco($id_negocio)
	{
		$query = "SELECT bcn.* FROM banco AS bcn
					WHERE bcn.negocio = $id_negocio";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function proceso($proceso,$id_banco,$banco_name,$banco_titular,$fecha_venci,$banco_monto,$creador,$id_negocio)
	{
		if ($proceso == "save_banco") {
			$query = "INSERT INTO banco (banco,titular,fecha_vencimiento,monto,creador,negocio)
					VALUES('$banco_name','$banco_titular','$fecha_venci',$banco_monto,$creador,$id_negocio)";
		}else if($proceso == "update_banco")
		{
			$query = "UPDATE banco 
			SET banco='$banco_name', titular='$banco_titular',
			fecha_vencimiento = '$fecha_venci',
			monto=$banco_monto
			WHERE id_banco=$id_banco";
		}
		
		$run = $this->db_connection->query($query);
		echo $query;
	}

	public function pagar($id_banco,$monto_pagar)
	{
		$query = "UPDATE banco SET monto = monto + $monto_pagar WHERE id_banco = $id_banco";
		$run = $this->db_connection->query($query);
		echo $query;
	}
	
	public function delete($id_banco)
	{
		$query = "DELETE  FROM banco WHERE id_banco=$id_banco";
		$run = $this->db_connection->query($query);
		echo $query;
	}
}


?>