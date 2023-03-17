<?php 
if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new NegocioController();
	$proceso = $_POST['proceso'];
	$id_negocio = (isset($_POST["id_negocio"])) ?  $_POST['id_negocio'] : 0;
	$nombre = (isset($_POST["nombre"])) ?  $_POST['nombre'] : '';
	$estado = (isset($_POST["estado_negocio"])) ?  $_POST['estado_negocio'] : '0';
	$plan_negocio = (isset($_POST["plan_negocio"])) ?  $_POST['plan_negocio'] : '0';
	$proximo_pago = (isset($_POST["proximo_pago"])) ?  $_POST['proximo_pago'] : date("Y-m-d");
	$modalidad = (isset($_POST["modalidad"])) ?  $_POST['modalidad'] : '30';
	$email = (isset($_POST["email"])) ?  $_POST['email'] : '30';
	$telefono = (isset($_POST["telefono"])) ?  $_POST['telefono'] : '30';
	
	if ($proceso == "delete") {
		$class->Delete($id_negocio);
	}
	else
	{
		$class->Proceso($proceso,$id_negocio,$nombre,$estado,$plan_negocio,$proximo_pago,$modalidad,$email,$telefono);
	}
}
else
{
	require_once('config/db.php');
}
class NegocioController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function read_all()
	{
		$query = "SELECT ngpl.fecha_pago,ngpl.modalidad,ngc.*,pln.plan,pln.id_plan,pln.precio,pln.cant_user,
					pln.cant_prestamo FROM negocio AS ngc
					LEFT JOIN negocio_plan AS ngpl ON ngc.id_negocio = ngpl.id_negocio
					LEFT JOIN planes AS pln ON ngpl.id_plan = pln.id_plan";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function Proceso($proceso,$id_negocio,$nombre,$estado,$plan_negocio,$proximo_pago,$modalidad,$email,$telefono)
	{
		$query = "";
		if($proceso == "save"){ 
			$query = "INSERT INTO negocio (nombre,estado,email,telefono)
						VALUES('$nombre',$estado,'$email','$telefono')";
		}
		else if($proceso == "update"){ 
			$query = "UPDATE negocio 
			SET nombre='$nombre',estado=$estado,email='$email',telefono='$telefono' 
			WHERE id_negocio=$id_negocio";
			$run = $this->db_connection->query($query);
			
			$query = "UPDATE negocio_plan SET id_plan = $plan_negocio,fecha_pago = '$proximo_pago', modalidad = $modalidad
						WHERE id_negocio = $id_negocio";
			
			$run = $this->db_connection->query($query);
		}
		$run = $this->db_connection->query($query);
		echo $this->db_connection->insert_id;
		if($proceso == "save"){
			$insert_id = $this->db_connection->insert_id;
			$query = "INSERT INTO configuracion (id_negocio,empresa,logo,icono,style,rnc,telefono,direccion,correo,tipo_mora, mora,font,barcolor) 										VALUES($insert_id,'$nombre','https://xilus.com.do/app-xilus/img/xiluslogo.png','https://xilus.com.do/app-xilus/img/xiluslogo.png','info','','$telefono','','',1,0,'white','dark')";
			$run = $this->db_connection->query($query);
			
			$query = "INSERT INTO negocio_plan(id_negocio,id_plan,fecha_pago,modalidad)
						VALUES($insert_id,$plan_negocio,'$proximo_pago',$modalidad)";
			$run = $this->db_connection->query($query);
		}
		
	}

	public function Delete($id)
	{
		$query = "DELETE FROM negocio WHERE id_negocio=".$id;
		$run = $this->db_connection->query($query);
		$query = "DELETE FROM configuracion WHERE id_negocio=".$id;
		$run = $this->db_connection->query($query);
	}
}


?>