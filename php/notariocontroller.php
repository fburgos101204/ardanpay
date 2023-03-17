<?php 
if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new NotarioController();
	$proceso = $_POST['proceso'];
	$id_notario = $_POST['id_notario'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$codigo = $_POST['codigo'];
	$cedula = $_POST['cedula'];
	$negocio = $_POST['id_negocio'];
	$creador = $_POST['creador'];

	if ($proceso == "delete") {
		$class->Delete($id_notario);
	}
	else
	{
		if ($proceso == "save") {
			$id_mensajero = 0;
		}
		else
		{
			$creador = 0;
		}
		$class->Proceso($proceso,$id_notario,$nombre,$apellido,$cedula,$codigo,$creador,$negocio);
	}
}
else
{
	require_once('config/db.php');
}
class NotarioController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function read_all($negocio)
	{
		$query = "SELECT nt.*,  CONCAT(us.firstname, ' ', us.lastname) as creadorn FROM notario AS nt
					INNER JOIN users AS us ON nt.creador = us.user_id
					WHERE nt.negocio = $negocio";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function Proceso($proceso,$id_notario,$nombre,$apellido,$cedula,$codigo,$creador,$negocio)
	{
		$query = "";
		if($proceso == "save"){ 
			$query = "INSERT INTO notario (nombre,apellido,cedula,codigo_colegio,creador,negocio) 													VALUES('$nombre','$apellido','$cedula','$codigo',$creador,$negocio)";
		}
		else if($proceso == "update"){ 
			$query = "UPDATE notario 
			SET nombre='$nombre',apellido='$apellido',
			cedula='$cedula', codigo_colegio='$codigo'
			WHERE id_notario=$id_notario"; 
		}
		$run = $this->db_connection->query($query);
		echo mysqli_error($this->db_connection);
		echo $query;
	}

	public function Delete($id)
	{
		$query = "DELETE FROM notario WHERE id_notario=".$id;
		$run = $this->db_connection->query($query);
	}
}


?>