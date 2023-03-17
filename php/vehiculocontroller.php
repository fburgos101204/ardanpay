<?php 
if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new VehiculoController();
	$proceso = $_POST['proceso'];
	if	($proceso == "delete"){
		$id_vehiculo =  (isset($_POST["id_vehiculo"])) ?  $_POST['id_vehiculo'] : 0;
		$class->delete($id_vehiculo);
	}
	else{
		
		$id_cliente =  (isset($_POST["id_cliente"])) ?  $_POST['id_cliente'] : $_POST['id_vehiculo'];
		$marca =  (isset($_POST["marca_vehiculo"])) ?  $_POST['marca_vehiculo'] : 0;
		$modelo =  (isset($_POST["modelo_vehiculo"])) ?  $_POST['modelo_vehiculo'] : 0;
		$tiempo =  (isset($_POST["año_vehiculo"])) ?  $_POST['año_vehiculo'] : 0;
		$color =  (isset($_POST["color_vehiculo"])) ?  $_POST['color_vehiculo'] : 0;
		$matricula =  (isset($_POST["matricula_vehiculo"])) ?  $_POST['matricula_vehiculo'] : 0;
		$tipo =  (isset($_POST["tipo_vehiculo"])) ?  $_POST['tipo_vehiculo'] : 0;

		$dir = "../vehiculo/$matricula";

		if(!is_dir($dir))
		{
			mkdir($dir,0777, true);
		}

		$part_frontal_tmp_name = (isset($_FILES["file_part_frontal"]["tmp_name"])) ?  $_FILES['file_part_frontal']["tmp_name"] : "";
		$part_frontal_name = (isset($_FILES["file_part_frontal"]["name"])) ?  $_FILES['file_part_frontal']["name"] : $_POST['aux_part_frontal'];
		$part_frontal_path = $dir."/".$part_frontal_name;

		$lat_izquierda_tmp_name = (isset($_FILES["file_lat_izquierda"]["tmp_name"])) ?  $_FILES['file_lat_izquierda']["tmp_name"] : "";
		$lat_izquierda_name = (isset($_FILES["file_lat_izquierda"]["name"])) ?  $_FILES['file_lat_izquierda']["name"] :  $_POST['aux_lat_izquierda'];
		$lat_izquierda_path = $dir."/".$lat_izquierda_name;

		$part_trasera_tmp_name = (isset($_FILES["file_part_trasera"]["tmp_name"])) ?  $_FILES['file_part_trasera']["tmp_name"] : "";
		$part_trasera_name = (isset($_FILES["file_part_trasera"]["name"])) ?  $_FILES['file_part_trasera']["name"] : $_POST['aux_part_trasera'];
		$part_trasera_path = $dir."/".$part_trasera_name;

		$lat_derecho_tmp_name = (isset($_FILES["file_lat_derecho"]["tmp_name"])) ?  $_FILES['file_lat_derecho']["tmp_name"] : "";
		$lat_derecho_name = (isset($_FILES["file_lat_derecho"]["name"])) ?  $_FILES['file_lat_derecho']["name"] : $_POST['aux_lat_derecho'];
		$lat_derecho_path = $dir."/".$lat_derecho_name;

		if (!move_uploaded_file($part_frontal_tmp_name,$part_frontal_path)) {
			$part_frontal_path = $part_frontal_name;
		}

		if (!move_uploaded_file($lat_izquierda_tmp_name,$lat_izquierda_path)) {
			$lat_izquierda_path = $lat_izquierda_name;
		}

		if (!move_uploaded_file($part_trasera_tmp_name,$part_trasera_path)) {
			$part_trasera_path = $part_trasera_name;
		}

		if (!move_uploaded_file($lat_derecho_tmp_name,$lat_derecho_path)) { 
			$lat_derecho_path = $lat_derecho_name;
		}

		$raw = $class->Proceso($proceso,$id_cliente,$marca,$modelo,$tiempo,$color,$tipo,$matricula,$part_frontal_path,$lat_izquierda_path,$part_trasera_path,$lat_derecho_path);
		if($proceso != "update")
		{
			while ($raws = $raw->fetch_object())
			{
				echo $raws->id_vuelta;
			}
		}
		
	}

}
else
{
	require_once('config/db.php');
}
class VehiculoController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function read_all($id_negocio)
	{
		$query = "SELECT CONCAT(clt.nombre,' ',clt.apellido) as cliente, vhl.* FROM vehiculo AS vhl
					INNER JOIN clientes as clt on vhl.id_cliente = clt.id_cliente
					WHERE clt.negocio = $id_negocio AND clt.estado = 1";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function proceso($proceso,$id_cliente,$marca,$modelo,$tiempo,$color,$tipo,$matricula,$foto_1,$foto_2,$foto_3,$foto_4)
	{
		if($proceso == "update"){
			$query = "UPDATE vehiculo SET marca='$marca',modelo='$modelo',tiempo='$tiempo',color='$color',tipo='$tipo',matricula='$matricula',foto_1='$foto_1',foto_2='$foto_2',foto_3='$foto_3',foto_4='$foto_4' WHERE id_vehiculo = $id_cliente";
			$run = $this->db_connection->query($query);
			echo $query;
		}else{
			$query = "INSERT INTO vehiculo (id_cliente,marca,modelo,tiempo,color,tipo,matricula,foto_1,foto_2,foto_3,foto_4)
		VALUES($id_cliente,'$marca','$modelo','$tiempo','$color','$tipo','$matricula','$foto_1','$foto_2','$foto_3','$foto_4')";
			$run = $this->db_connection->query($query);
			$run = $this->db_connection->query("SELECT LAST_INSERT_ID() AS id_vuelta");
			return $run;
		}
	}
	
	public function delete($id_vehiculo)
	{
		$query = "DELETE  FROM vehiculo WHERE id_vehiculo=$id_vehiculo";
		$run = $this->db_connection->query($query);
		echo $query;
	}
}


?>