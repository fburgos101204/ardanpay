<?php 
if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new CajaController();
	$proceso = $_POST['proceso'];
	
	$id_caja =  (isset($_POST["id_caja"])) ?  $_POST['id_caja'] : 0;
	$id_negocio =  (isset($_POST["id_negocio"])) ?  $_POST['id_negocio'] : 0;
	$nombre =  (isset($_POST["caja_name"])) ?  $_POST['caja_name'] : 0;
	$monto =  (isset($_POST["monto_caja"])) ?  $_POST['monto_caja'] : 0;
	$monto_pagar =  (isset($_POST["monto_pagar"])) ?  $_POST['monto_pagar'] : 0;
	$creador =  (isset($_POST["creador_caja"])) ?  $_POST['creador_caja'] : 0;


	if ($proceso == "delete") {
		$class->delete($id_caja);
	}else if($proceso == "pagar_cuota")
	{
		$class->pagar($id_caja,$monto_pagar);
	}
	else{
		$class->proceso($proceso,$id_caja,$nombre,$monto,$creador,$id_negocio);
	}

}
else
{
	require_once('config/db.php');
}
class CajaController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function read_caja($id_negocio)
	{
		$query = "SELECT  cj.* FROM caja AS cj
					WHERE cj.negocio = $id_negocio";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function proceso($proceso,$id_caja,$nombre,$monto,$creador,$id_negocio)
	{
		if ($proceso == "save_caja") {
			$query = "INSERT INTO caja (nombre,monto,creador,negocio)
					VALUES('$nombre',$monto,$creador,$id_negocio)";
		}else if($proceso == "update_caja")
		{
			$query = "UPDATE caja SET nombre='$nombre', monto=$monto 
					WHERE id_caja=$id_caja";
		}
		
		$run = $this->db_connection->query($query);
		echo $query;
	}

	public function pagar($id_caja,$monto_pagar)
	{
		$query = "UPDATE caja SET monto = monto + $monto_pagar WHERE id_caja = $id_caja";
		$run = $this->db_connection->query($query);
		echo $query;
	}
	
	public function delete($id_caja)
	{
		$query = "DELETE  FROM caja WHERE id_caja=$id_caja";
		$run = $this->db_connection->query($query);
		echo $query;
	}
}


?>