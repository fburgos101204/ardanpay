<?php 
if (isset($_POST['seguridad_user'])) {
	require_once('../config/db.php');
	$class = new SecurityController();
	$user =  (isset($_POST["seguridad_user"])) ?  $_POST['seguridad_user'] : 0;
	$pass =  (isset($_POST["seguridad_pass"])) ?  $_POST['seguridad_pass'] : 0;
	$class->validar($user,$pass);
}
else
{
	require_once('config/db.php');
}
class SecurityController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}
	
	public function validar($user,$pass)
	{
		$res = null;
        $password = password_hash($pass, PASSWORD_DEFAULT);
		$query = "SELECT * FROM users WHERE user_name='$user' AND nivel = 1";
		$run = $this->db_connection->query($query);
        if($run->num_rows >= 1){ 
          while($row = $run->fetch_object()){
			if (password_verify($pass, $row->user_password_hash)) {
				$res = 1;
			}
		  }
		}
		echo $res;
	}
}
?>