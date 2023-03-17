<?php
     
if (isset($_POST["duda"])) {  

  require_once("../config/db.php");
  $cre = new CbUserController();

  $firstname = (isset($_POST['firstname'])) ? $_POST['firstname'] : "";
  $lastname  = (isset($_POST['lastname'])) ? $_POST['lastname'] : "";
  $user_name = (isset($_POST['user_name'])) ? $_POST['user_name'] : "";
  $user_email = (isset($_POST['user_email'])) ? $_POST['user_email'] : "";
  $negocio = (isset($_POST['negocio'])) ? $_POST['negocio'] : "";
  $nivel = (isset($_POST['nivel'])) ? $_POST['nivel'] : "";
  $ps = (isset($_POST['ps'])) ? $_POST['ps'] : "";
  $psw = (isset($_POST['psw'])) ? $_POST['psw'] : "";
  $id = (isset($_POST['users_id'])) ? $_POST['users_id'] : 0;
  $user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : 0;
	
  $ck_inicio = (isset($_POST["ck_inicio"])) ?  $_POST['ck_inicio'] : "off";
	
  $ck_sol_prestamo = (isset($_POST["ck_sol_prestamo"])) ?  $_POST['ck_sol_prestamo'] : "off";
	
  $ck_prestamo_personal = (isset($_POST["ck_prestamo_personal"])) ?  $_POST['ck_prestamo_personal'] : "off";
	
  $ck_prestamo_inmobilirario = (isset($_POST["ck_prestamo_inmobilirario"])) ?  $_POST['ck_prestamo_inmobilirario'] : "off";

    $ck_prestamo_semanal = (isset($_POST["ck_prestamo_semanal"])) ?  $_POST['ck_prestamo_semanal'] : "off";	
	
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

  $ck_negocio = (isset($_POST["ck_negocio"])) ?  $_POST['ck_negocio'] : "off";
	
  $ck_plan = (isset($_POST["ck_plan"])) ?  $_POST['ck_plan'] : "off";
	
  $ck_p_efectivo = (isset($_POST["ck_p_efectivo"])) ?  $_POST['ck_p_efectivo'] : "off";
	
  $ck_p_tarjeta = (isset($_POST["ck_p_tarjeta"])) ?  $_POST['ck_p_tarjeta'] : "off";
	
  $ck_r_estado_negocio = (isset($_POST["ck_r_estado_negocio"])) ?  $_POST['ck_r_estado_negocio'] : "off";
	
  $ck_r_pago_servicio = (isset($_POST["ck_r_pago_servicio"])) ?  $_POST['ck_r_pago_servicio'] : "off";

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
	
  $ck_eliminar_pago = (isset($_POST["ck_eliminar_pago"])) ?  $_POST['ck_eliminar_pago'] : "off";
	

	
	
  $permisos = '{"inicio":"'.$ck_inicio.'","sol_prestamo":"'.$ck_sol_prestamo.'","prestamo_personal":"'.$ck_prestamo_personal.'","prestamo_inmobilirario":"'.$ck_prestamo_inmobilirario.'","prestamo_semanal":"'.$ck_prestamo_semanal.'","prestamo_vehiculo":"'.$ck_prestamo_vehiculo.'","historial_pago":"'.$ck_historial_pago.'","historial_retiro":"'.$ck_historial_retiro.'","cliente":"'.$ck_cliente.'","vehiculo":"'.$ck_vehiculo.'","inmobilirario":"'.$ck_inmobilirario.'","caja":"'.$ck_caja.'","banco":"'.$ck_banco.'","notario":"'.$ck_notario.'","usuario":"'.$ck_user.'","configuracion":"'.$ck_config.'","cambio_mora":"'.$ck_cambio_mora.'","cambio_fecha_pagar":"'.$ck_cambio_fecha_pagar.'","modificar_prestamo":"'.$ck_modificar_prestamo.'","modificar_cliente":"'.$ck_modificar_cliente.'","eliminar_cliente":"'.$ck_eliminar_cliente.'","grafica_estadistica":"'.$ck_grafica_estadistica.'","fecha_inicio_prestamo":"'.$ck_fecha_inicio_prestamo.'","mensajero":"'.$ck_mensajero.'","ruta":"'.$ck_ruta.'","negocio":"'.$ck_negocio.'","ranking":"'.$ck_ranking.'","plan":"'.$ck_plan.'","pago_efectivo":"'.$ck_p_efectivo.'","pago_tarjeta":"'.$ck_p_tarjeta.'","reporte_estado_negocio":"'.$ck_r_estado_negocio.'","reporte_pago_servicio":"'.$ck_r_pago_servicio.'","eliminar_pago":"'.$ck_eliminar_pago.'"}';

if ($_POST["duda"] == 'save'){

 $cre->create($firstname, $lastname, $user_name, $user_email, $nivel, $ps,$permisos,$negocio);

}else if ($_POST["duda"] == 'update'){

  $cre->update($user_id, $firstname, $lastname, $user_name, $user_email, $nivel,$permisos,$negocio);

}else{
  $cre->pass($psw,$id);
}

}else{
    require_once("config/db.php");
}

class CbUserController {

    public function __construct(){ 
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $conn;
     }
    
    public function readAll($id_negocio)
	{
		if($id_negocio == 0)
		{
			$query = "SELECT urs.*, ngc.nombre as negocios FROM users AS urs
						LEFT JOIN negocio AS ngc ON urs.negocio = ngc.id_negocio
						WHERE urs.negocio != 0 AND  urs.hidden != 1";
		}
		else
		{
			$query = "SELECT * FROM users WHERE negocio = $id_negocio and hidden != 1";
		}
        $result = $this->db_connection->query($query);
        return $result;    
    }
	 public function readAll_0(){
        $query = "SELECT urs.* FROM users AS urs
					WHERE urs.hidden != 1 and urs.negocio = 0";
        $result = $this->db_connection->query($query);
        return $result;    
    }    

    function create( $firstname, $lastname, $user_name, $user_email, $nivel, $ps,$permisos,$negocio){ 

        $password = password_hash($ps, PASSWORD_DEFAULT);
        $fecha = date('Y-m-d');
        $sqlInsert = "INSERT INTO users(firstname, lastname, user_name, user_email, nivel, user_password_hash, date_added, estado,permisos,negocio) VALUES ('$firstname', '$lastname', '$user_name', '$user_email', '$nivel','$password','$fecha','1','$permisos',$negocio)";
       $result = $this->db_connection->query($sqlInsert);
       echo $sqlInsert;
    }

    public function pass($psw, $id){

        $passwo = password_hash($psw, PASSWORD_DEFAULT);
        $sqlUpdatePass = "UPDATE users SET user_password_hash ='$passwo' WHERE user_id='$id' ";
        $result = $this->db_connection->query($sqlUpdatePass);
    }

   public function update($user_id, $firstname, $lastname, $user_name, $user_email, $nivel,$permisos,$negocio){   

        $sqlUpdate = "UPDATE users "
                . "     SET firstname    = '".$firstname."', "
                . "         lastname        = '".$lastname."', "        
                . "         user_name     = '".$user_name."', "
                . "         user_email  = '".$user_email."', "
                . "         nivel = '".$nivel."', permisos ='".$permisos."', negocio =".$negocio
                . "     WHERE   user_id  = '".$user_id."'";
        $result = $this->db_connection->query($sqlUpdate);
       echo $sqlUpdate;
        
    }
       
}