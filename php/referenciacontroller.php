<?php 
if (isset($_POST['id_cliente_referencia'])) {
	require_once('../config/db.php');
	$class = new ReferenciaController();
	$proceso = $_POST['duda'];
	$id_cliente = $_POST['id_cliente_referencia'];
	if($proceso != "show_on"){
		if($proceso == "delete"){
			$id = $_POST['id_referencia'];
			$class->Delete($id);
		}else{
			$nombre = $_POST['nombre_referencia'];
			$telefono = $_POST['telefono_referencia'];
			$tipo = $_POST['tipo_referencia'];
			$parentesco = $_POST['parentesco_referencia'];
			$class->proceso($proceso,$id,$nombre,$telefono,$tipo,$parentesco,$id_cliente);
		}
	}else{
		$results = $class->mostrar($id_cliente);
    	if ($results->num_rows >= 1) {
    		while($row = $results->fetch_object()){
				echo "<tr>";
				echo "<td nowrap>$row->nombre</td>";
				echo "<td nowrap>$row->telefono</td>";
				echo "<td nowrap>$row->tipo_ref</td>";
				echo "<td nowrap>$row->parentesco</td>";
				echo "<td nowrap>
						<button class='btn btn-danger btn_drop_garante' onclick='delete_referencia($row->id_ref)' type='button'><i class='fas fa-trash-alt'></i></button>
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
class ReferenciaController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function mostrar($id)
	{
		$query = "SELECT * FROM referencias WHERE id_cliente = $id";
		$run = $this->db_connection->query($query);
		return $run;
	}
	public function proceso($proceso,$id,$nombre,$telefono,$tipo,$parentesco,$id_cliente)
	{
		if ($proceso == "save") {
			$query = "INSERT INTO referencias(nombre,telefono,tipo_ref,parentesco,id_cliente) 												VALUES('$nombre','$telefono','$tipo','$parentesco',$id_cliente)";
		}else if($proceso == "update")
		{
			$query = "UPDATE referencias 
				SET nombre='$nombre', telefono='$telefono',tipo_ref='$tipo',parentesco='$parentesco'
				WHERE id_ref= $id";
		}
		echo $query;
		$run = $this->db_connection->query($query);
	}

	public function Delete($id_ref)
	{
		$query = "DELETE FROM referencias WHERE id_ref=$id_ref";
		$run = $this->db_connection->query($query);
	}

}

?>