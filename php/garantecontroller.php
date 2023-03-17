<?php 
if (isset($_POST['id_cliente_garante'])) {
	require_once('../config/db.php');
	$class = new GaranteController();
	$proceso = $_POST['duda'];
	$id_cliente = $_POST['id_cliente_garante'];
	if($proceso != "show_on"){
		if($proceso == "delete"){
			$id = $_POST['id_garante'];
			$class->Delete($id);
		}else{
			$nombre = $_POST['nombre_garante'];
			$cedula = $_POST['cedula_garante'];
			$direccion= $_POST['direccion_garante'];
			$parentesco = $_POST['garante_parentesco'];
			$class->proceso($proceso,$id,$nombre,$cedula,$direccion,$parentesco,$id_cliente);
		}
	}else{
		$results = $class->mostrar($id_cliente);
    	if ($results->num_rows >= 1) {
    		while($row = $results->fetch_object()){
				echo "<tr>";
				echo "<td nowrap>$row->nombre</td>";
				echo "<td nowrap>$row->cedula</td>";
				echo "<td nowrap>$row->direccion</td>";
				echo "<td nowrap>$row->parentesco</td>";
				echo "<td nowrap>
						<button class='btn btn-danger btn_drop_garante' onclick='delete_garante($row->id_garante)' type='button'><i class='fas fa-trash-alt'></i></button>
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
class GaranteController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function mostrar($id)
	{
		$query = "SELECT * FROM garante WHERE id_cliente = $id";
		$run = $this->db_connection->query($query);
		return $run;
	}
	public function proceso($proceso,$id,$nombre,$cedula,$direccion,$parentesco,$id_cliente)
	{
		if ($proceso == "save") {
			$query = "INSERT INTO garante(nombre,cedula,direccion,parentesco,id_cliente) 													VALUES('$nombre','$cedula','$direccion','$parentesco',$id_cliente)";
		}else if($proceso == "update")
		{
			$query = "UPDATE garante 
						SET nombre='$nombre',cedula='$cedula',direccion='$direccion',parentesco='$parentesco' 
						WHERE id_garante = $id";
		}
		
		$run = $this->db_connection->query($query);
		echo $query;
	}

	public function Delete($id)
	{
		$query = "DELETE FROM garante WHERE id_garante = $id";
		$run = $this->db_connection->query($query);
		echo $query;
	}

}

?>