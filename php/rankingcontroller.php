<?php 
if (isset($_POST['id_cliente'])) {
	require_once('../config/db.php');
	$class = new RankingController();
	$id_cliente = $_POST['id_cliente'];
	$rows = $class->read_historial($id_cliente);
    if ($rows->num_rows >= 1) {
    while($row = $rows->fetch_object()){ ?> 
	<tr> 
      <td style="white-space:nowrap;"><?php print($row->concepto); ?></td>
      <td style="white-space:nowrap;"><?php print(date("Y-m-d",strtotime($row->fecha))); ?></td>
      <td style="white-space:nowrap;"><?php print("RD$ ".number_format($row->capital)); ?></td>
      <td style="white-space:nowrap;"><?php print("RD$ ".number_format($row->interes)); ?></td>
      <td style="white-space:nowrap;"><?php print("RD$ ".number_format($row->mora,'2')); ?></td>
      <td style="white-space:nowrap;"><?php print("RD$ ".number_format($row->descuento,'2')); ?></td>
      <td style="white-space:nowrap;"><?php print("RD$ ".number_format($row->total_pagado,'2')); ?></td>
      <td style="white-space:nowrap;"><?php print("RD$ ".number_format($row->capital_restante)); ?></td>
	</tr>

<?php
	}}
}
else
{
	require_once('config/db.php');
}
class RankingController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function read($id_negocio)
	{
		$query = "SELECT CONCAT(clt.nombre,' ',clt.apellido) AS cliente, clt.id_cliente,
					SUM(cantidad_menos) as menos, SUM(cantidad_mas) as mas FROM ranking 
					INNER JOIN clientes AS clt ON ranking.id_cliente = clt.id_cliente
					WHERE clt.negocio = $id_negocio
					GROUP BY id_cliente";
		$run = $this->db_connection->query($query);
		return $run;
	}
	
	public function read_historial($id_cliente)
	{
		$query ="SELECT htp.* FROM historial_pagos as htp
					INNER JOIN prestamo AS prt ON htp.id_prestamo = prt.id_prestamo
					INNER JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente
						WHERE clt.id_cliente = $id_cliente 
						ORDER BY htp.id_historial DESC";
		$run = $this->db_connection->query($query);
		return $run;
	}
}


?>