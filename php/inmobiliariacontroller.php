<?php 
if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new InmobiliariaController();
	$proceso = $_POST['proceso'];
	$id_casa = (isset($_POST["id_casa"])) ?  $_POST['id_casa'] : "";
	$id_cliente = (isset($_POST["id_cliente"])) ?  $_POST['id_cliente'] : 0;
	$tipo = (isset($_POST["tipo"])) ?  $_POST['tipo'] : "";
	$color = (isset($_POST["color"])) ?  $_POST['color'] : "";
	$direccion = (isset($_POST["direccion"])) ?  $_POST['direccion'] : "";
	$habitacion = (isset($_POST["habitacion"])) ?  $_POST['habitacion'] :0;
	$bano = (isset($_POST["baño"])) ?  $_POST['baño'] :0;
	$cocina = (isset($_POST["cocina"])) ?  $_POST['cocina'] : 0;
	$sala = (isset($_POST["sala"])) ?  $_POST['sala'] : 0;
	$comedor = (isset($_POST["comedor"])) ?  $_POST['comedor'] : 0;
	$descripcion = (isset($_POST["descripcion"])) ?  $_POST['descripcion'] : "";
	$creador = (isset($_POST["creador"])) ?  $_POST['creador'] : 0;
	
	$dir = "../inmobiliario";

		if(!is_dir($dir))
		{
			mkdir($dir,0777, true);
		}

		$part_frontal_tmp_name = (isset($_FILES["file_part_frontal"]["tmp_name"])) ?  $_FILES['file_part_frontal']["tmp_name"] : "";
		$part_frontal_name = (isset($_FILES["file_part_frontal"]["name"])) ?  $_FILES['file_part_frontal']["name"] : $_POST['aux_part_frontal'];
		$part_frontal_path = $dir."/".$part_frontal_name;
	
		$part_trasera_tmp_name = (isset($_FILES["file_part_trasera"]["tmp_name"])) ?  $_FILES['file_part_trasera']["tmp_name"] : "";
		$part_trasera_name = (isset($_FILES["file_part_trasera"]["name"])) ?  $_FILES['file_part_trasera']["name"] : $_POST['aux_part_trasera'];
		$part_trasera_path = $dir."/".$part_trasera_name;

		$lat_derecho_tmp_name = (isset($_FILES["file_lat_derecho"]["tmp_name"])) ?  $_FILES['file_lat_derecho']["tmp_name"] : "";
		$lat_derecho_name = (isset($_FILES["file_lat_derecho"]["name"])) ?  $_FILES['file_lat_derecho']["name"] : $_POST['aux_lat_derecho'];
		$lat_derecho_path = $dir."/".$lat_derecho_name;

		if (!move_uploaded_file($part_frontal_tmp_name,$part_frontal_path)) {
			$part_frontal_path = $part_frontal_name;
		}

		if (!move_uploaded_file($part_trasera_tmp_name,$part_trasera_path)) {
			$part_trasera_path = $part_trasera_name;
		}

		if (!move_uploaded_file($lat_derecho_tmp_name,$lat_derecho_path)) { 
			$lat_derecho_path = $lat_derecho_name;
		}
	
	
	

	if ($proceso == "delete") {
		$class->Delete($id_casa);
	}
	else
	{
		$raw = $class->Proceso($proceso,$id_casa,$id_cliente,$tipo,$color,$direccion,$habitacion,$bano,$cocina,$sala,$comedor, 													$descripcion,$creador,$part_frontal_path,$part_trasera_path,$lat_derecho_path);
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
class InmobiliariaController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function read_all($id_negocio)
	{
		$query = "SELECT inm.*,CONCAT(ur.firstname,' ', ur.lastname) AS creador_name,CONCAT(clt.nombre,' ', clt.apellido) AS cliente FROM inmobiliriaria AS inm
					INNER JOIN clientes AS clt ON inm.id_cliente = clt.id_cliente
					INNER JOIN users AS ur ON inm.creador = ur.user_id
					WHERE clt.negocio = $id_negocio AND clt.estado = 1";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function Proceso($proceso,$id_casa,$id_cliente,$tipo,$color,$direccion,$habitacion,$bano,$cocina,$sala,$comedor, 													$descripcion,$creador,$part_frontal_path,$part_trasera_path,$lat_derecho_path)
	{
		if($proceso == "save"){
			$query = "INSERT INTO inmobiliriaria (id_cliente,tipo,color,direccion,habitacion,bano,cocina,sala,comedor,descripcion,creador,foto_1,foto_2,foto_3) 					VALUES($id_cliente,'$tipo','$color','$direccion',$habitacion,$bano,$cocina,$sala,$comedor,'$descripcion',$creador,'$part_frontal_path','$part_trasera_path','$lat_derecho_path')";
			$run = $this->db_connection->query($query);
			$run = $this->db_connection->query("SELECT LAST_INSERT_ID() AS id_vuelta");
			return $run;
		}else{
			$query = "UPDATE inmobiliriaria 
						SET tipo = '$tipo', color = '$color', direccion = '$direccion', habitacion = $habitacion, bano = $bano, 							cocina = $cocina, sala = $sala, comedor = $comedor, descripcion = '$descripcion', foto_1 = 											'$part_frontal_path',foto_2 = '$part_trasera_path',foto_3 = '$lat_derecho_path'
						WHERE id_inmobiliaria = $id_casa;";
			$run = $this->db_connection->query($query);
			echo $query;
		}
	}

	public function Delete($id)
	{
		$query = "delete from inmobiliriaria where id_inmobiliaria=".$id;
		$run = $this->db_connection->query($query);
	}

}


?>