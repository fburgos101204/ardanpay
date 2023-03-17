<?php 
if (isset($_POST['duda'])) {
	require_once('../config/db.php');
	$class = new MensajeroController();
	$proceso = $_POST['duda'];
	
	$creador =  (isset($_POST["creador"])) ?  $_POST['creador'] : 0;
	
	$id_mensajero =  (isset($_POST["id_mensajero"])) ?  $_POST['id_mensajero'] : 0;
	
	$id_negocio =  (isset($_POST["id_negocio"])) ?  $_POST['id_negocio'] : 0;
	
	$nombre =  (isset($_POST["nombre"])) ?  $_POST['nombre'] : 0;
	
	$apellido =  (isset($_POST["apellido"])) ?  $_POST['apellido'] : 0;
	
	$cedula =  (isset($_POST["cedula"])) ?  $_POST['cedula'] : 0;
	
	$telefono =  (isset($_POST["telefono"])) ? $_POST['telefono'] : 0;
	
	$correo =  (isset($_POST["correo"])) ? $_POST['correo'] : 0;
	
	$direccion =  (isset($_POST["direccion"])) ? $_POST['direccion'] : 0;
	
	$imei =  (isset($_POST["imei"])) ? $_POST['imei'] : 0;
	
	$dispositivo =  (isset($_POST["dispositivo"])) ? $_POST['dispositivo'] : 0;
	
	$username =  (isset($_POST["username"])) ? $_POST['username'] : 0;
	
	$pass =  (isset($_POST["pass"])) ? $_POST['pass'] : 0;
	
	if ($proceso == "password")
	{
		$id_mensajero =  (isset($_POST["id_mensajero_pass"])) ? $_POST['id_mensajero_pass'] : '';
		$pass =  (isset($_POST["mensajero_pass"])) ? $_POST['mensajero_pass'] : '';
		$class->pass($pass, $id_mensajero);
	}
	else if ($proceso == "delete")
	{
		$class->delete($id_mensajero);
	}
	else{
		$class->proceso($proceso,$id_mensajero,$id_negocio,$nombre,$apellido,$cedula,$telefono,
						$correo,$direccion,$imei,$dispositivo,$username,$pass,$creador);
	}

}
else
{
	require_once('config/db.php');
}
class MensajeroController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function read_mensajero($id_negocio)
	{
		$query = "SELECT * FROM mensajeros WHERE negocio = $id_negocio";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function proceso($proceso,$id_mensajero,$id_negocio,$nombre,$apellido,$cedula,$telefono,
							$correo,$direccion,$imei,$dispositivo,$username,$pass,$creador)
	{
        $password = password_hash($pass, PASSWORD_DEFAULT);
		if ($proceso == "save_mensajero")
		{
			$query = "INSERT INTO mensajeros (negocio,nombre,apellido,cedula,telefono,correo,
												direccion,imei,dispositivo,username,pass,creador)					   								VALUES($id_negocio,'$nombre','$apellido','$cedula','$telefono','$correo',
								'$direccion','$imei','$dispositivo','$username','$password',$creador)";
		}
		else if($proceso == "update_mensajero")
		{
			$query = "UPDATE mensajeros SET nombre = '$nombre', apellido = '$apellido',cedula = '$cedula',
			telefono = '$telefono',correo = '$correo', direccion = '$direccion',
			imei = '$imei',dispositivo = '$dispositivo',username = '$username' 
			WHERE id_mensajero = $id_mensajero";
		}
		$run = $this->db_connection->query($query);
		echo $query;
	}

	public function pass($pass, $id)
	{
        $password = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "UPDATE mensajeros SET pass ='$password' WHERE id_mensajero = $id";
        $result = $this->db_connection->query($sql);
		echo $sql;
    }
	
	public function delete($id_mensajero)
	{
		$query = "DELETE FROM mensajeros WHERE id_mensajero = $id_mensajero";
		$run = $this->db_connection->query($query);
		echo $query;
	}
}
?>