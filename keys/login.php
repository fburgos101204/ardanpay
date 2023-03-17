<?php
  header("Access-Control-Allow-Origin:*");
  require_once ("../config/db.php");
  require_once ("../config/conexion.php");
 
date_default_timezone_set('America/Santo_Domingo');
$email = $_POST['email'];
$password = $_POST['password'];
$return_arr = array();
$fecha = date('Y-m-d H:i:s');

$sql = "SELECT * FROM mensajeros WHERE  username = '$email'";

$result_of_login_check = $con->query($sql);

if ($result_of_login_check->num_rows > 0) {
    $result_row = $result_of_login_check->fetch_object();
        if (password_verify($_POST['password'], $result_row->pass)) {

            $conductor = $result_row->id_mensajero;
            $row_array['id_mensajero'] = $result_row->id_mensajero;
        	$row_array['nombre'] = $result_row->nombre;
			$row_array['negocio'] = $result_row->negocio;
        	$row_array['apellido'] = $result_row->apellido;
        	$row_array['cedula'] = $result_row->cedula;
        	$row_array['telefono'] = $result_row->telefono;
        	$row_array['correo'] = $result_row->correo;
        	$row_array['username'] = $result_row->username;
        	$row_array['pass'] = $result_row->pass;
        	$row_array['token'] = $result_row->token;
        	$row_array['session_id'] = $result_row->session_id;
        	//$row_array['id_vehiculo'] = $result_row->id_vehiculo;
            array_push($return_arr,$row_array);
            echo json_encode($return_arr); 

            $query = $con->query("UPDATE mensajeros SET session_id = '2', last_login = '$fecha' WHERE id_mensajero = '$conductor'");

        } else {
          echo  $errors = "1";
        }
} else {
  echo $errors = "2";
}

$con->close();

?>