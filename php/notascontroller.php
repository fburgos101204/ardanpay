<?php 
date_default_timezone_set("America/Santo_Domingo");
if (isset($_POST['id_prestamo'])) {
	require_once('../config/db.php');
	$class = new NotaController();
	$proceso = $_POST['duda'];
	$id_prestamo = $_POST['id_prestamo'];
	$nota = $_POST['nota'];
	$fecha = date("Y-m-d h:i:s");
	if($proceso != "show_on"){
		if($proceso == "delete"){
			$id = $_POST['id_nota'];
			$class->Delete($id);
		}else{
			$nota = $_POST['nota'];
			$id_prestramo = $_POST['id_prestramo'];
			$class->proceso($nota,$id_prestamo,$proceso);
		}
	}else{
		$results = $class->mostrar($id_prestamo);
    	if ($results->num_rows >= 1) {
    		while($row = $results->fetch_object()){
				echo "<tr>";
				echo "<td nowrap>$row->nota</td>";
				echo "<td nowrap>$row->fecha</td>";
				echo "<td nowrap>
					  </td>";
				echo "</tr>";
				
			}
		}
	}
}
else
{
	require_once('config/db.php');
}
class NotaController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function mostrar($id)
	{
		$query = "SELECT * FROM notas WHERE id_prestamo = $id ORDER BY id DESC";
		$run = $this->db_connection->query($query);
		return $run;
	}
	public function proceso($nota,$id_prestamo,$proceso)
	{
		if ($proceso == "save") {
			$query = "INSERT INTO notas(nota,id_prestamo) 												
			VALUES('$nota','$id_prestamo')";
			$query1 = "UPDATE prestamo SET nota = '$nota', fecha_nota = '$fecha' WHERE id_prestamo = '$id_prestamo'";												
		}else if($proceso == "update")
		{
			$query = "UPDATE notas set nota = '$nota' where id = '$id_nota'";
		}
		echo $query;
	    echo $query1;
		$run = $this->db_connection->query($query);
		$run1 = $this->db_connection->query($query1);
	}

	public function Delete($id_ref)
	{
		$query = "DELETE FROM notas WHERE id =$id_nota";
		$run = $this->db_connection->query($query);
	}

}

?>