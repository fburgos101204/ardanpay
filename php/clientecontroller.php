<?php 
if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new ClienteController();
	$proceso = $_POST['proceso'];

	$solicitud =  (isset($_POST["solicitud"])) ?  $_POST['solicitud'] : "";

	$id_negocio =  (isset($_POST["id_negocio"])) ?  $_POST['id_negocio'] : 0;
	
	$id_cliente =  (isset($_POST["id_cliente"])) ?  $_POST['id_cliente'] : 0;

	$nombre =  (isset($_POST["nombre"])) ?  $_POST['nombre'] : '';
	$apellido =  (isset($_POST["apellido"])) ?  $_POST['apellido'] : '';
	$sexo =  (isset($_POST["sexo"])) ?  $_POST['sexo'] : '';
	$telefono =  (isset($_POST["telefono"])) ?  $_POST['telefono'] : '';
	$tipo_vivienda =  (isset($_POST["tipo_vivienda"])) ?  $_POST['tipo_vivienda'] : '';
	$cedula =  (isset($_POST["cedula"])) ?  $_POST['cedula'] : '';
	$correo =  (isset($_POST["correo"])) ?  $_POST['correo'] : 'sin correo electronico';
	$nacionalidad =  (isset($_POST["nacionalidad"])) ?  $_POST['nacionalidad'] : '';
	$direccion =  (isset($_POST["direccion"])) ?  $_POST['direccion'] : '';
	$fecha_nacimiento =  (isset($_POST["fecha_nacimiento"])) ?  $_POST['fecha_nacimiento'] : '';
	$celular =  (isset($_POST["celular"])) ?  $_POST['celular'] : '';
	$estado_civil =  (isset($_POST["estado_civil"])) ?  $_POST['estado_civil'] : '';
	$facebook =  (isset($_POST["facebook"])) ?  $_POST['facebook'] : 'sin facebook';
	$instagram =  (isset($_POST["instagram"])) ?  $_POST['instagram'] : 'sin instagram';
	$dependientes =  (isset($_POST["dependientes"])) ?  $_POST['dependientes'] : 0;
	$titulo =  (isset($_POST["titulo"])) ?  $_POST['titulo'] : '';
	$ocupacion =  (isset($_POST["ocupacion"])) ?  $_POST['ocupacion'] : '';
	$ingreso =  (isset($_POST["ingreso"])) ?  $_POST['ingreso'] : 0;
	$creador =  (isset($_POST["creador"])) ?  $_POST['creador'] : 0;

	$dir = "../docs/$cedula";

	if(!is_dir($dir))
	{
    	mkdir($dir,0777, true);
	}


	/*FOTOS Y DOCUMENTOS*/

	$img_cliente_tmp_name = (isset($_FILES["archivo_img"]["tmp_name"])) ?  $_FILES['archivo_img']["tmp_name"] : "";
  	$img_cliente_name = (isset($_FILES["archivo_img"]["name"])) ?  $_FILES['archivo_img']["name"] : $_POST['aux_img'];

  	$img_cliente_path = $dir."/".$img_cliente_name;


  	$cedula_cliente_tmp_name = (isset($_FILES["archivo_cedula"]["tmp_name"])) ?  $_FILES['archivo_cedula']["tmp_name"] : "";
  	$cedula_cliente_name = (isset($_FILES["archivo_cedula"]["name"])) ?  $_FILES['archivo_cedula']["name"] :  $_POST['aux_cedula'];


  	$cedula_cliente_path = $dir."/".$cedula_cliente_name;
	
  	if (!move_uploaded_file($img_cliente_tmp_name,$img_cliente_path)) {
  		$img_cliente_path = $img_cliente_name;
  	}

  	if (!move_uploaded_file($cedula_cliente_tmp_name,$cedula_cliente_path)) { 
  		$cedula_cliente_path = $cedula_cliente_name;
  	}



	if ($proceso == "delete") {
		$class->Delete($id_cliente);
	}
	else
	{
		if ($proceso == "save_cliente") {
			$id_cliente = 0;
			$id_ref = 0;
			$id_venta_vuelta = 0;
			$raw = $class->Proceso($proceso,$id_cliente,$nombre,$apellido,$sexo,$telefono,$tipo_vivienda,$cedula,$correo,$direccion,$fecha_nacimiento,$celular,$estado_civil,$facebook,$instagram,$dependientes,$titulo,$ocupacion,$ingreso,$cedula_cliente_path,$img_cliente_path, $creador,$id_negocio,$nacionalidad);
			while ($raws = $raw->fetch_object())
			{
				echo $id_venta_vuelta = $raws->id_vuelta;
			}
			
			if ($solicitud == "solicita") {

				$interes_sol = $_POST['interes_sol'];
				$t_interes_sol = $_POST['t_interes_sol'];
				$fecha_sol = $_POST['fecha_sol'];
				$monto = $_POST['monto'];
				$cuotas = $_POST['cuotas'];
				$ciclo_pago = $_POST['ciclo'];
				$class->Pr_solicitud($id_venta_vuelta,$monto,$cuotas,$ciclo_pago,$creador,$fecha_sol,$t_interes_sol,$interes_sol);

			}
		}
		else
		{
			$creador = 0;
			$class->Proceso($proceso,$id_cliente,$nombre,$apellido,$sexo,$telefono,$tipo_vivienda,$cedula,$correo,$direccion,$fecha_nacimiento,$celular,$estado_civil,$facebook,$instagram,$dependientes,$titulo,$ocupacion,$ingreso,$cedula_cliente_path,$img_cliente_path, $creador,$id_negocio,$nacionalidad);
		}

	}
}
else
{
	require_once('config/db.php');
}
class ClienteController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function read_all($negocio)
	{
		$query = "SELECT rf.id_ref,rf.nombre as nombre_ref, rf.telefono as telefono_ref,
					rf.tipo_ref, rf.parentesco, cl.*,CONCAT(ur.firstname,' ', ur.lastname) as creador_name
					FROM clientes as cl
					LEFT JOIN referencias as rf on cl.id_cliente = rf.id_cliente
					LEFT JOIN users as ur on cl.creador = ur.user_id
					WHERE cl.negocio = $negocio and cl.estado = 1";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function Proceso($proceso,$id_cliente,$nombre,$apellido,$sexo,$telefono,$tipo_vivienda,$cedula,$correo,$direccion,$fecha_nacimiento,$celular,$estado_civil,$facebook,$instagram,$dependientes,$titulo,$ocupacion,$ingreso,$path_cedula,$path_img_cliente, $creador,$id_negocio,$nacionalidad)
	{
		$query = "CALL  proceso_cliente(@id_vuelta,'$proceso',$id_cliente,'$nombre','$apellido','$sexo','$telefono','$tipo_vivienda','$cedula','$correo','$direccion','$fecha_nacimiento','$celular','$estado_civil','$facebook','$instagram',$dependientes,'$titulo','$ocupacion',$ingreso,'$path_cedula','$path_img_cliente', $creador,$id_negocio,'$nacionalidad')";
		$run = $this->db_connection->query($query);
		if ($proceso == "save_cliente") {
			$run = $this->db_connection->query("SELECT @id_vuelta AS id_vuelta");
			return $run;
		}
	}

	public function Pr_solicitud($id_venta_vuelta,$monto, $cuotas,$ciclo_pago,$creador,$fecha_sol,$t_interes_sol,$interes_sol)
	{
		$query = "INSERT INTO solicitud_prestamo (id_cliente,monto,cuotas,ciclo_pago,creador,fecha_inicio,t_interes,interes)
		VALUES($id_venta_vuelta,$monto, $cuotas,'$ciclo_pago',$creador,'$fecha_sol','$t_interes_sol',$interes_sol)";
		$run = $this->db_connection->query($query);
	}

	public function Delete($id)
	{
		$query = "UPDATE clientes SET estado = 0 WHERE id_cliente=$id";
		$run = $this->db_connection->query($query);
	}

}


?>