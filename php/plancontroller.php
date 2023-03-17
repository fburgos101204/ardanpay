<?php 
if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new PlanController();
	$proceso = $_POST['proceso'];
	
	$id_plan =  (isset($_POST["id_plan"])) ?  $_POST['id_plan'] : 0;
	$plan =  (isset($_POST["plan_name"])) ?  $_POST['plan_name'] : '';
	$descripcion =  (isset($_POST["descripcion"])) ?  $_POST['descripcion'] : '';
	$cant_usuario =  (isset($_POST["cant_usuario"])) ?  $_POST['cant_usuario'] : 0;
	$cant_prestamo =  (isset($_POST["cant_prestamo"])) ?  $_POST['cant_prestamo'] : 0;
	$precio =  (isset($_POST["precio"])) ?  $_POST['precio'] : 0;
	
	
  $ck_inicio = (isset($_POST["ck_inicio"])) ?  $_POST['ck_inicio'] : "off";
	
  $ck_sol_prestamo = (isset($_POST["ck_sol_prestamo"])) ?  $_POST['ck_sol_prestamo'] : "off";
	
  $ck_prestamo_personal = (isset($_POST["ck_prestamo_personal"])) ?  $_POST['ck_prestamo_personal'] : "off";
	
  $ck_prestamo_inmobilirario = (isset($_POST["ck_prestamo_inmobilirario"])) ?  $_POST['ck_prestamo_inmobilirario'] : "off";
	
  $ck_prestamo_vehiculo = (isset($_POST["ck_prestamo_vehiculo"])) ?  $_POST['ck_prestamo_vehiculo'] : "off";
	
  $ck_historial_pago = (isset($_POST["ck_historial_pago"])) ?  $_POST['ck_historial_pago'] : "off";
	
  $ck_historial_retiro = (isset($_POST["ck_historial_retiro"])) ?  $_POST['ck_historial_retiro'] : "off";
	
  $ck_cliente = (isset($_POST["ck_cliente"])) ?  $_POST['ck_cliente'] : "off";
	
  $ck_vehiculo = (isset($_POST["ck_vehiculo"])) ?  $_POST['ck_vehiculo'] : "off";
	
  $ck_inmobilirario = (isset($_POST["ck_inmobilirario"])) ?  $_POST['ck_inmobilirario'] : "off";
	
  $ck_caja = (isset($_POST["ck_caja"])) ?  $_POST['ck_caja'] : "off";
	
  $ck_banco = (isset($_POST["ck_banco"])) ?  $_POST['ck_banco'] : "off";
	
  $ck_notario = (isset($_POST["ck_notario"])) ?  $_POST['ck_notario'] : "off";
	
  $ck_mensajero = (isset($_POST["ck_mensajero"])) ?  $_POST['ck_mensajero'] : "off";
	
  $ck_ruta = (isset($_POST["ck_ruta"])) ?  $_POST['ck_ruta'] : "off";

  $ck_ranking = (isset($_POST["ck_ranking"])) ?  $_POST['ck_ranking'] : "off";
	
  //$ck_calculador = (isset($_POST["ck_calculador"])) ?  $_POST['ck_calculador'] : "off"; ,"calculador":"'.$ck_calculador.'"
	
  $ck_user = (isset($_POST["ck_user"])) ?  $_POST['ck_user'] : "off";

  $ck_config = (isset($_POST["ck_config"])) ?  $_POST['ck_config'] : "off";
	
  $ck_cambio_mora = (isset($_POST["ck_cambio_mora"])) ?  $_POST['ck_cambio_mora'] : "off";

  $ck_cambio_fecha_pagar = (isset($_POST["ck_cambio_fecha_pagar"])) ?  $_POST['ck_cambio_fecha_pagar'] : "off";
	  
  $ck_modificar_prestamo = (isset($_POST["ck_modificar_prestamo"])) ?  $_POST['ck_modificar_prestamo'] : "off";
	
  $ck_modificar_cliente = (isset($_POST["ck_modificar_cliente"])) ?  $_POST['ck_modificar_cliente'] : "off";
	
  $ck_eliminar_cliente = (isset($_POST["ck_eliminar_cliente"])) ?  $_POST['ck_eliminar_cliente'] : "off";
	
  $ck_grafica_estadistica = (isset($_POST["ck_grafica_estadistica"])) ?  $_POST['ck_grafica_estadistica'] : "off";
	
  $ck_fecha_inicio_prestamo = (isset($_POST["ck_fecha_inicio_prestamo"])) ?  $_POST['ck_fecha_inicio_prestamo'] : "off";
	
  $ck_whatsapp = (isset($_POST["ck_whatsapp"])) ?  $_POST['ck_whatsapp'] : "off";
	
  $permisos = '{"inicio":"'.$ck_inicio.'","sol_prestamo":"'.$ck_sol_prestamo.'","prestamo_personal":"'.$ck_prestamo_personal.'","prestamo_inmobilirario":"'.$ck_prestamo_inmobilirario.'","prestamo_vehiculo":"'.$ck_prestamo_vehiculo.'","historial_pago":"'.$ck_historial_pago.'","historial_retiro":"'.$ck_historial_retiro.'","cliente":"'.$ck_cliente.'","vehiculo":"'.$ck_vehiculo.'","inmobilirario":"'.$ck_inmobilirario.'","caja":"'.$ck_caja.'","banco":"'.$ck_banco.'","notario":"'.$ck_notario.'","usuario":"'.$ck_user.'","configuracion":"'.$ck_config.'","cambio_mora":"'.$ck_cambio_mora.'","cambio_fecha_pagar":"'.$ck_cambio_fecha_pagar.'","modificar_prestamo":"'.$ck_modificar_prestamo.'","modificar_cliente":"'.$ck_modificar_cliente.'","eliminar_cliente":"'.$ck_eliminar_cliente.'","grafica_estadistica":"'.$ck_grafica_estadistica.'","fecha_inicio_prestamo":"'.$ck_fecha_inicio_prestamo.'","mensajero":"'.$ck_mensajero.'","ruta":"'.$ck_ruta.'","ranking":"'.$ck_ranking.'","whatsapp":"'.$ck_whatsapp.'"}';

	if ($proceso == "delete") {
		$class->delete($id_plan);
	}else{
		$class->proceso($proceso,$id_plan,$plan,$cant_usuario,$cant_prestamo,$permisos,$precio);
	}
}
else
{
	require_once('config/db.php');
}
class PlanController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function read_plan()
	{
		$query = "SELECT * FROM planes";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function proceso($proceso,$id_plan,$plan,$cant_usuario,$cant_prestamo,$permisos,$precio)
	{
		if ($proceso == "save_plan") {
			$query = "INSERT INTO planes (plan,cant_user,cant_prestamo,precio,permisos)
			VALUES('$plan',$cant_usuario,$cant_prestamo,$precio,'$permisos')";
		}else if($proceso == "update_plan")
		{
			$query = "UPDATE planes SET plan='$plan', permisos='$permisos',precio = $precio, cant_user = $cant_usuario, cant_prestamo = $cant_prestamo
					WHERE id_plan = $id_plan";
		}
		
		$run = $this->db_connection->query($query);
		echo $query;
	}
	
	public function delete($id_plan)
	{
		$query = "DELETE  FROM planes WHERE id_plan = $id_plan";
		$run = $this->db_connection->query($query);
		echo $query;
	}
}


?>