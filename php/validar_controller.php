<?php 
if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new ValidarController();
	$proceso = $_POST['proceso'];
	$correo =  (isset($_POST["user_email"])) ?  $_POST['user_email'] : 0;
	$user =  (isset($_POST["user_name"])) ?  $_POST['user_name'] : 0;
	if($proceso == "user"){ 
		$result = $class->validate_user($user);
		echo $result->num_rows; 
	}
	else if($proceso == "email"){ 
		$result = $class->validate_email($correo); 
		echo $result->num_rows;
	}
}
else
{
	require_once('config/db.php');
}
class ValidarController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function validate_user($user)
	{
		$query = "SELECT * FROM users WHERE user_name = '$user'";
		$run = $this->db_connection->query($query);
		return $run;
	}
	
	public function validate_email($email)
	{
		$query = "SELECT * FROM users WHERE user_email = '$email'";
		$run = $this->db_connection->query($query);
		return $run;
	}

}


?>