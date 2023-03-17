<?php 
if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new PrestamosController();
	$proceso = $_POST['proceso'];
	$id_prestamo = (isset($_POST['id_prestamo'])) ? $_POST['id_prestamo'] : 0;
	$no_cuota = (isset($_POST['no_cuota'])) ? $_POST['no_cuota'] : 0;
	$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '2019-01-01';
	$balance = (isset($_POST['balance'])) ? $_POST['balance'] : 0;
	$abono_capital = (isset($_POST['abono_capital'])) ? $_POST['abono_capital'] : 0;
	$interes = (isset($_POST['interes'])) ? $_POST['interes'] : 0;
	$monto_pagar = (isset($_POST['monto_pagar'])) ? $_POST['monto_pagar'] : 0;
	$class->guardar_amortizacion($no_cuota,$id_prestamo,$fecha,$balance,$abono_capital,$interes,$monto_pagar);
}
else
{
	require_once('config/db.php');
}
class PrestamosController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}
    
	public function read_all_prestamo_reports($id_negocio)
	{
		$query = "SELECT CONCAT(clt.nombre, ' ', clt.apellido) as cliente,  prt.*,amrt.fecha as proximo_pago FROM prestamo as prt
				INNER JOIN amortizacion AS amrt ON prt.id_prestamo = amrt.id_prestamo
				INNER JOIN clientes as clt on prt.id_cliente = clt.id_cliente
				WHERE clt.negocio = $id_negocio AND prt.estado != 'Al Dia' AND prt.estado != 'Atrasado'
				GROUP BY prt.id_prestamo ORDER BY amrt.fecha asc";
		
		$run = $this->db_connection->query($query);
		return $run;
	}
	
	
	public function read_all_prestamo($tipo,$id_negocio)
	{
		if($tipo == "Prestamo Personal")
		{
			$sql_tipo = "(prt.tipo_prestamo = '$tipo' or prt.tipo_prestamo = 'Acuerdo de Pago')";
		}
		else
		{
			$sql_tipo = "(prt.tipo_prestamo = '$tipo')";
		}
		$query = "SELECT CONCAT(clt.nombre, ' ', clt.apellido) as cliente,  prt.* , i.id as id_interes FROM prestamo as prt
				INNER JOIN amortizacion AS amrt ON prt.id_prestamo = amrt.id_prestamo
				INNER JOIN clientes as clt on prt.id_cliente = clt.id_cliente
				INNER JOIN tipo_interes i on prt.tipo_interes = i.descripcion
				WHERE amrt.estado = 'Pendiente' and  prt.estado != 'Asunto Legal' and prt.estado != 'Cancelado' 
				and prt.estado != 'Completado'
				and prt.estado != 'Completo' and $sql_tipo
				and prt.ciclo_pago = 7
				and clt.negocio = $id_negocio and clt.estado = 1
				GROUP BY prt.id_prestamo ORDER BY amrt.fecha asc";
		
		$run = $this->db_connection->query($query);
		return $run;
	}
	

	public function guardar_amortizacion($no_cuota,$id_prestamo,$fecha,$balance,$abono_capital,$interes,$monto_pagar)
	{
		$query = "INSERT INTO amortizacion (id_prestamo,fecha,balance,abono_capital,interes,monto_pagar,no_cuota)
				VALUES ($id_prestamo,'$fecha',$balance,$abono_capital,$interes,$monto_pagar,$no_cuota)";
		$run = $this->db_connection->query($query);
		echo $query;
	}
}


?>