<?php 
if (isset($_POST['consultar'])) {
	require_once('../config/db.php');
	$class = new ConsultaController();
    $query = $class->mostrar_tarjetas_validas();
    $jsondata["data"]["users"] = array();
    if($query->num_rows > 0){
		while( $row = $query->fetch_object() ) {
   			$jsondata["data"]["users"][] = $row;
    	}
    }
    //returns data as JSON format
    echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
else
{
	require_once('config/db.php');
}
class ConsultaController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}
	public function mostrar_tarjetas_validas()
	{
		$query = "SELECT pgs.*,pgs.nombre_tarjeta as name, cbr.monto, cbr.fecha_pago FROM pagos AS pgs
					INNER JOIN cobro AS cbr ON pgs.id_cliente = cbr.id_cliente
					WHERE pgs.predeterminada = 1 AND cbr.metodo_pago = 'Tarjeta' AND cbr.fecha_pago <= NOW()";
		$run = $this->db_connection->query($query);
		return $run;
	}
}
?>