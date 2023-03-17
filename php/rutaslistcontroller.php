<?php 
if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new RutaListController();
	$proceso = $_POST['proceso'];
	$id_ruta =  (isset($_POST["id_ruta"])) ?  $_POST['id_ruta'] : 0;

	if ($proceso == "list_cliente")
	{
          $rows = $class->read_clientes($id_ruta);
          if ($rows->num_rows >= 1) {
          	while($row = $rows->fetch_object()){ ?>
        		<tr>
          			<td style="white-space:nowrap;"><?php print($row->nombre).' '.($row->apellido); ?></td>
          			<td style="white-space:nowrap;"><?php print($row->telefono); ?></td>
          			<td style="white-space:nowrap;"><?php print($row->cedula); ?></td>
          			<td style="white-space:nowrap;"><?php print($row->correo); ?></td>
          			<td style="white-space:nowrap;"><?php print($row->direccion); ?></td>
          			<td style="white-space:nowrap;">
            			<button type="button" class="btn btn-danger btn-circle" 
									onclick="des_cliente('<?php print($row->id_cliente); ?>')">
						<i class="fas fa-trash-alt"></i></button>
          			</td>
       	 		</tr>
<?php 		}
		  }
	}
	else if($proceso == "list_mensajero")
	{
          $rows = $class->read_mensajero($id_ruta);
          if ($rows->num_rows >= 1) {
          	while($row = $rows->fetch_object()){ ?>
        		<tr>
          			<td style="white-space:nowrap;"><?php print($row->nombre." ".$row->apellido); ?></td>
      				<td style="white-space:nowrap;"><?php print($row->username); ?></td>
      				<td style="white-space:nowrap;"><?php print($row->cedula); ?></td>
      				<td style="white-space:nowrap;"><?php print($row->telefono); ?></td>
      				<td style="white-space:nowrap;"><?php print($row->correo); ?></td>
      				<td style="white-space:nowrap;"><?php print($row->imei); ?></td>
          			<td style="white-space:nowrap;">
            			<button type="button" class="btn btn-danger btn-circle" 
									onclick="des_mensajero('<?php print($row->id_mensajero); ?>')">
						<i class="fas fa-trash-alt"></i></button>
          			</td>
       	 		</tr>
<?php 		}
		  }
	}

}
else
{
	require_once('config/db.php');
}
class RutaListController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function read_clientes($id_ruta)
	{
		$query = "SELECT clt.* FROM clientes AS clt
					INNER JOIN ruta_cliente AS rt_clt ON clt.id_cliente = rt_clt.id_cliente
					WHERE rt_clt.id_ruta = $id_ruta
					GROUP BY rt_clt.id_cliente ASC";
		$run = $this->db_connection->query($query);
		return $run;
	}
	
	public function read_mensajero($id_ruta)
	{
		$query = "SELECT mjs.* FROM mensajeros AS mjs
					INNER JOIN ruta_mensajero AS rt_mjs ON mjs.id_mensajero = rt_mjs.id_mensajero
					WHERE rt_mjs.id_ruta = $id_ruta
					GROUP BY rt_mjs.id_mensajero ASC";
		$run = $this->db_connection->query($query);
		return $run;
	}
}


?>