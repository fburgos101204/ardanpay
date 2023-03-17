<?php 
if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new RutaController();
	$proceso = $_POST['proceso'];
	
	$id_ruta =  (isset($_POST["id_ruta"])) ?  $_POST['id_ruta'] : 0;
	$id_mensajero =  (isset($_POST["id_mensajero"])) ?  $_POST['id_mensajero'] : 0;
	$id_cliente =  (isset($_POST["id_cliente"])) ?  $_POST['id_cliente'] : 0;
	$direccion =  (isset($_POST["direccion"])) ?  $_POST['direccion'] : $_POST['dir_ruta'];
	$id_negocio =  (isset($_POST["id_negocio"])) ?  $_POST['id_negocio'] : 0;

	if ($proceso == "delete") {
		$class->delete_ruta($id_ruta);
	}
	else if($proceso == "desasignar_mensajero")
	{
		$class->desasignar_mensajero($id_mensajero,$id_ruta);
	}
	else if($proceso == "desasignar_cliente")
	{
		$class->desasignar_cliente($id_cliente,$id_ruta);
	}
	else if($proceso == "asignar_mensajero")
	{
		$class->asignar_mensajero($id_ruta,$id_mensajero);
	}
	else if($proceso == "asignar_cliente")
	{
		$class->asignar_cliente($id_ruta,$id_cliente);
	}
	else{
		$class->proceso($proceso,$id_ruta,$direccion,$id_negocio);
	}

}
else
{
	require_once('config/db.php');
}
class RutaController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function read_rutas($id_negocio)
	{
		$query = "SELECT rt.id_ruta, COUNT(rt_clt.id_cliente) AS total_cliente, COUNT(rt_mjs.id_mensajero) AS total_mensajero, 						rt.direccion FROM ruta AS rt
					LEFT JOIN ruta_cliente AS rt_clt ON rt.id_ruta = rt_clt.id_ruta
					LEFT JOIN ruta_mensajero AS rt_mjs ON rt.id_ruta = rt_mjs.id_ruta
					WHERE rt.negocio = $id_negocio
					GROUP BY rt.id_ruta ASC";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function proceso($proceso,$id_ruta,$direccion,$id_negocio)
	{
		if ($proceso == "save_ruta") {
			$query = "INSERT INTO ruta (direccion,negocio)
					VALUES('$direccion',$id_negocio)";
		}else if($proceso == "update_ruta")
		{
			$query = "UPDATE ruta SET direccion='$direccion'
						WHERE id_ruta = $id_ruta";
		}
		
		$run = $this->db_connection->query($query);
		echo $query;
	}

	public function asignar_cliente($id_ruta,$id_cliente)
	{
		$query = "INSERT INTO ruta_cliente(id_ruta,id_cliente)
					VALUES($id_ruta,$id_cliente)";
		$run = $this->db_connection->query($query);
		echo $query;
	}
	
	
	public function desasignar_cliente($id_cliente,$id_ruta)
	{
		$query = "DELETE FROM ruta_cliente WHERE id_cliente = $id_cliente AND id_ruta = $id_ruta";
		$run = $this->db_connection->query($query);
		echo $query;
	}
	
	public function asignar_mensajero($id_ruta,$id_mensajero)
	{
		$query = "INSERT INTO ruta_mensajero(id_ruta,id_mensajero)
					VALUES($id_ruta,$id_mensajero)";
		$run = $this->db_connection->query($query);
		echo $query;
	}
	
	public function desasignar_mensajero($id_mensajero,$id_ruta)
	{
		$query = "DELETE FROM ruta_mensajero WHERE id_mensajero = $id_mensajero AND id_ruta = $id_ruta";
		$run = $this->db_connection->query($query);
		echo $query;
	}
	
	public function delete_ruta($id_ruta)
	{
		$query = "DELETE FROM ruta WHERE id_ruta = $id_ruta";
		$run = $this->db_connection->query($query);
		echo $query;
	}
}


?>