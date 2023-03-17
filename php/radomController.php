<?php 

require_once('../config/db.php');
$class = new radomController();
$random =  $_POST['random'];
$class->save($random);
	
class radomController{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function save($random){
		$fecha = date('Y-m-d');
		$query = "INSERT INTO mora_modificada (codigo_generado,fecha,codigo_ingresado)
					VALUES('$random',$fecha,$random)";
		$run = $this->db_connection->query($query);
		echo $query;
	}

}


?>