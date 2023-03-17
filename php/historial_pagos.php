<?php 
if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new Historial_Pagos();
	/*********PRESTAMO***********/
	$proceso = $_POST['proceso'];

	$id_cliente =  (isset($_POST["id_cliente"])) ?  $_POST['id_cliente'] : 0;
	
	$id_caja =  (isset($_POST["id_caja"])) ?  $_POST['id_caja'] : 0;

	$id_prestamo =  (isset($_POST["id_prestamo"])) ?  $_POST['id_prestamo'] : 0;

	$concepto =  (isset($_POST["concepto"])) ?  $_POST['concepto'] : "SIN CONCEPTO";
	
	$capital =  (isset($_POST["capital"])) ?  $_POST['capital'] : 0;

	$interes =  (isset($_POST["interes"])) ?  $_POST['interes'] : 0;

	$fecha =  (isset($_POST["fecha"])) ?  $_POST['fecha'] : date("Y-m-d");

	$mora =  (isset($_POST["mora"])) ?  $_POST['mora'] : 0;

	$descuento =  (isset($_POST["descuento"])) ?  $_POST['descuento'] : 0;
	echo $descuento;

	$creador =  (isset($_POST["pago_selector"])) ?  $_POST['pago_selector'] : 0;

	$capital_restante =  (isset($_POST["capital_restante"])) ?  $_POST['capital_restante'] : 0;
	$capital_restante -= $capital;
	$tipo_pago =  (isset($_POST["tipo_pago"])) ?  $_POST['tipo_pago'] : "";

	$banco =  (isset($_POST["banco"])) ?  $_POST['banco'] : "";

	$no_deposito =  (isset($_POST["no_deposito"])) ?  $_POST['no_deposito'] : "";

	$no_cuota =  (isset($_POST["no_cuota"])) ?  $_POST['no_cuota'] :0;
	
	$id_mensajero =  (isset($_POST["id_mensajero"])) ?  $_POST['id_mensajero'] :1;
	
	$nota =  (isset($_POST["nota"])) ?  $_POST['nota'] : "";

	if ($capital_restante <= 0) {
		$capital_restante = 0;
	} 

	$total_pagado =  $capital + $interes + $mora - $descuento;
	$class->pagar_cuota($id_cliente,$id_caja,$no_cuota,$id_prestamo,$concepto,$fecha,$capital,$interes,$mora,$descuento,$total_pagado,$capital_restante,$tipo_pago,$banco,$no_deposito,$nota,$creador,$id_mensajero);
}
else
{
	require_once('config/db.php');
}
class Historial_Pagos
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}


	public function pagar_cuota($id_cliente,$caja,$no_cuota,$id_prestamo,$concepto,$fecha,$capital,$interes,$mora,$descuento,$total_pagado,$capital_restante,$tipo_pago,$banco,$no_deposito,$nota,$creador,$id_mensajero)
	{
		echo $descuento;
		$query = "UPDATE prestamo SET capital_pendiente = $capital_restante WHERE id_prestamo = $id_prestamo";
		$run = $this->db_connection->query($query);
		$query = "UPDATE amortizacion SET estado = 'Pagada'
					WHERE id_prestamo = $id_prestamo AND no_cuota = $no_cuota";
		$run = $this->db_connection->query($query);
		$query = "INSERT INTO historial_pagos (caja, id_prestamo,concepto,fecha,capital,interes,mora,descuento,total_pagado,capital_restante,tipo_pago,banco,no_deposito,nota,creador,no_cuota,	id_mensajero)
			VALUES ('$caja','$id_prestamo','$concepto','$fecha','$capital','$interes','$mora','$descuento','$total_pagado','$capital_restante','$tipo_pago','$banco','$no_deposito','$nota','$creador','$no_cuota','$id_mensajero')";
		$run = $this->db_connection->query($query);
		echo $this->db_connection->insert_id;
		
		if($mora != 0){ $cant_max = 0; $cant_menor = 1; }
		else{ $cant_max = 1; $cant_menor = 0; }
		
		$query = "INSERT INTO ranking (id_cliente,cantidad_mas,cantidad_menos)
					VALUES($id_cliente,$cant_max,$cant_menor)";
		$run = $this->db_connection->query($query);
	}
	public function read_historial($id_prestamo)
	{
		
		$query = "SELECT * FROM historial_pagos WHERE id_prestamo = $id_prestamo AND estado !='Anulada' ORDER BY id_historial DESC";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function read_amortazion($id_prestamo)
	{
		$query = "SELECT * FROM amortizacion WHERE id_prestamo = $id_prestamo ORDER BY no_cuota asc";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function read_historial_complete($id_negocio)
	{
		$query = "SELECT htpg.*,banc.banco as banco_pagado, cja.nombre as caja_pagada,CONCAT(clt.nombre, ' ',clt.apellido) as cliente,CONCAT(urs.firstname, ' ',urs.lastname) as creado , me.id_mensajero, CONCAT(me.nombre,' ',me.apellido) as mensajero
		    FROM historial_pagos AS htpg
			INNER JOIN prestamo AS prt ON htpg.id_prestamo = prt.id_prestamo
			INNER JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente
			LEFT JOIN caja AS cja ON htpg.caja = cja.id_caja
			LEFT JOIN banco AS banc ON htpg.banco = banc.id_banco
			LEFT JOIN users AS urs ON htpg.creador = urs.user_id
			LEFT JOIN mensajeros AS me ON htpg.id_mensajero = me.id_mensajero
			WHERE clt.negocio = $id_negocio
			GROUP BY htpg.id_historial ORDER BY htpg.id_historial DESC";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function read_cliente_prestamo($id_prestamo,$tipo)
	{
		$query = "SELECT prt.fecha_creado,clt.cedula,clt.id_cliente,clt.path_img_cliente,CONCAT(clt.nombre, ' ', clt.apellido) as cliente,clt.celular, (cuota - COUNT(amrt.no_cuota)) as no_cuota, prt.*,amrt.fecha as fecha_pago,amrt.balance,amrt.abono_capital,amrt.interes as interes_cantidad, amrt.fecha as proximo_pagos,prt.nota,prt.fecha_nota,
				cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) AS faltas,
				(CASE
				WHEN prt.proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) >= 1 THEN  'Atrasado'
				WHEN  prt.proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) = 0 and TIMESTAMPDIFF(day, DATE_FORMAT(NOW(), '%Y-%m-%d'), proximo_pago) < -5 THEN 'Mora'
				WHEN prt.proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) = 0 and TIMESTAMPDIFF(day, DATE_FORMAT(NOW(), '%Y-%m-%d'), proximo_pago) >= -5 THEN 'Al dia'
				END)  as esta
				FROM prestamo as prt
				INNER JOIN amortizacion AS amrt ON prt.id_prestamo = amrt.id_prestamo
				INNER JOIN clientes as clt on prt.id_cliente = clt.id_cliente
				WHERE prt.id_prestamo = $id_prestamo AND amrt.estado != 'Pagada'
				ORDER BY amrt.fecha asc limit 1";
		$run = $this->db_connection->query($query);
		if ($run->num_rows >= 1) {
			return $run;
		}else{
			$query = "SELECT clt.cedula,clt.id_cliente,clt.path_img_cliente,CONCAT(clt.nombre, ' ', clt.apellido) as cliente, COUNT(amrt.no_cuota) AS no_cuota, prt.*,amrt.balance,amrt.abono_capital,amrt.fecha as fecha_pago,amrt.interes as interes_cantidad,prt.nota,prt.fecha_nota, amrt.fecha as proximo_pagos FROM prestamo as prt
				INNER JOIN amortizacion AS amrt ON prt.id_prestamo = amrt.id_prestamo
				INNER JOIN clientes as clt on prt.id_cliente = clt.id_cliente
				INNER JOIN notas n on prt.id_prestamo = n.id_prestamo
				WHERE prt.id_prestamo = $id_prestamo AND amrt.estado = 'Pagada'
				ORDER BY amrt.fecha asc limit 1";
			$run = $this->db_connection->query($query);
			return $run;
		}
	}

	public function read_cliente_prestamo_capital($id_prestamo,$tipo)
	{
		$query = "SELECT prt.fecha_creado,clt.cedula,clt.id_cliente,clt.path_img_cliente,CONCAT(clt.nombre, ' ', clt.apellido) as cliente,clt.celular, (cuota - COUNT(amrt.no_cuota)) as no_cuota, prt.*,amrt.fecha as fecha_pago,prt.capital_pendiente as balance,amrt.abono_capital,  (prt.capital_pendiente/prt.cuota)*(prt.interes/prt.cuota) AS interes_cantidad, amrt.fecha as proximo_pagos,
				cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) AS faltas,prt.nota,prt.fecha_nota,
				(CASE
				WHEN prt.proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) >= 1 THEN  'Atrasado'
				WHEN  prt.proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) = 0 and TIMESTAMPDIFF(day, DATE_FORMAT(NOW(), '%Y-%m-%d'), proximo_pago) < -5 THEN 'Mora'
				WHEN prt.proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) = 0 and TIMESTAMPDIFF(day, DATE_FORMAT(NOW(), '%Y-%m-%d'), proximo_pago) >= -5 THEN 'Al dia'
				ELSE 'Al dia' END)  as esta
				FROM prestamo as prt
				INNER JOIN amortizacion AS amrt ON prt.id_prestamo = amrt.id_prestamo
				INNER JOIN clientes as clt on prt.id_cliente = clt.id_cliente
				WHERE prt.id_prestamo = $id_prestamo AND amrt.estado != 'Pagada'
				ORDER BY amrt.fecha asc limit 1";
		$run = $this->db_connection->query($query);
		if ($run->num_rows >= 1) {
			return $run;
		}else{
			$query = "SELECT clt.cedula,clt.id_cliente,clt.path_img_cliente,CONCAT(clt.nombre, ' ', clt.apellido) as cliente, COUNT(amrt.no_cuota) AS no_cuota, prt.*,amrt.balance,amrt.abono_capital,amrt.fecha as fecha_pago,(prt.capital_pendiente/prt.cuota)*(prt.cuota/prt.interes) AS interes_cantidad, amrt.fecha as proximo_pagos,prt.nota,prt.fecha_nota FROM prestamo as prt
				INNER JOIN amortizacion AS amrt ON prt.id_prestamo = amrt.id_prestamo
				INNER JOIN clientes as clt on prt.id_cliente = clt.id_cliente
				WHERE prt.id_prestamo = $id_prestamo AND amrt.estado = 'Pagada'
				ORDER BY amrt.fecha asc limit 1";
			$run = $this->db_connection->query($query);
			return $run;
		}
	}	
	
	
	public function historial($id_prestamo)
	{
		$query = "SELECT * FROM historial_pagos WHERE id_prestamo = $id_prestamo AND concepto != 'ABONO CAPITAL' AND estado != 'Anulada' AND estado != 'Prestamo Anterior' AND (concepto = 'PAGO INTERES' OR no_cuota != 0)";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function update_last_pago($proximo_pago,$id_prestamo)
	{
		$query = "UPDATE prestamo SET proximo_pago='$proximo_pago' WHERE id_prestamo='$id_prestamo'";
		$run = $this->db_connection->query($query);
	}

	public function update_prestamo($id_prestamo,$estado)
	{
		if ($estado == "Al Dia") {
			$query = "UPDATE prestamo SET estado='$estado' WHERE id_prestamo='$id_prestamo'";
		}else if ($estado == "Atrasado") {
			$query = "UPDATE prestamo SET estado='$estado' WHERE id_prestamo='$id_prestamo' AND capital_pendiente != 0";
		}
		$run = $this->db_connection->query($query);
	}

	public function cantidad_reajustes($id_prestamo)
	{
		$query = "SELECT * FROM historial_pagos WHERE id_prestamo = $id_prestamo AND concepto = 'Reajuste Capital' AND estado = 'Pagada' ORDER BY id_historial DESC";
		$run = $this->db_connection->query($query);
		return $run;
	}
	
	
	public function read_ranking($id_cliente)
	{
		$query = "SELECT id_cliente,SUM(cantidad_menos) AS menos,SUM(cantidad_mas) AS mas FROM ranking 
					GROUP BY id_cliente";
		$run = $this->db_connection->query($query);
		return $run;
	}
	
	public function completar_prestamo($id_prestamo)
	{
		$query = "UPDATE prestamo SET estado = 'Completado', capital_pendiente = 0 WHERE id_prestamo = $id_prestamo";
		$run = $this->db_connection->query($query);
		return $run;
	}
	
	public function read_new_negocio($negocio)
	{
		$config = "SELECT * FROM configuracion WHERE id_negocio = $negocio";
		$result_config = $this->db_connection->query($config);
		return $result_config;
	}
	
} 


?>