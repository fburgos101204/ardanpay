<?php 
if (isset($_POST['retirar_de'])) {
	require_once('../config/db.php');
	$class = new MonetizarController();
	
	$metodo =  (isset($_POST["retirar_de"])) ?  $_POST['retirar_de'] : "";
	if ($metodo == "Banco") {
		$id_metodo =  (isset($_POST["entidad_banco"])) ?  $_POST['entidad_banco'] : 0;
	}else if($metodo = "Caja"){
		$id_metodo =  (isset($_POST["entidad_caja"])) ?  $_POST['entidad_caja'] : 0;
	}
	$codigo = (isset($_POST["no_codigo"])) ?  $_POST['no_codigo'] : "";

	$monto =  (isset($_POST["monto_valida"])) ?  $_POST['monto_valida'] : 0;


	$creador =  (isset($_POST["id_creador_re"])) ?  $_POST['id_creador_re'] : 0;
	$id_prestamo =  (isset($_POST["id_prestamo_valida"])) ?  $_POST['id_prestamo_valida'] : 0;

	$class->retiro_prestamo($id_prestamo,$metodo,$id_metodo,$monto,$codigo,$creador);

}
else
{
	require_once('config/db.php');
}
class MonetizarController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function read_retiros_caja($id_negocio)
	{
		$query = "SELECT rtp.fecha,CONCAT(urs.firstname,' ',urs.lastname) as creador,rtp.concepto_retiro, rtp.metodo,rtp.monto,rtp.codigo,cja.nombre as caja FROM retiros_prestamo AS rtp
					LEFT JOIN prestamo AS prt ON rtp.id_prestamo = prt.id_prestamo
					LEFT JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente
					INNER JOIN caja AS cja ON rtp.id_metodo = cja.id_caja
					LEFT JOIN users AS urs ON rtp.creador = urs.user_id
					WHERE clt.negocio = $id_negocio AND  rtp.metodo = 'Caja'";
		$run = $this->db_connection->query($query);
		return $run;
	}
	public function read_retiros_banco($id_negocio)
	{
		$query = "SELECT  rtp.fecha,rtp.concepto_retiro, rtp.metodo,rtp.monto,rtp.codigo,cja.banco,CONCAT(urs.firstname,' ',urs.lastname) as creador FROM retiros_prestamo AS rtp
					LEFT JOIN prestamo AS prt ON rtp.id_prestamo = prt.id_prestamo
					LEFT JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente
					INNER JOIN banco AS cja ON rtp.id_metodo = cja.id_banco
					LEFT JOIN users AS urs ON rtp.creador = urs.user_id
					WHERE rtp.metodo = 'Banco' and clt.negocio = $id_negocio";
		$run = $this->db_connection->query($query);
		return $run;
	}
	public function retiro_prestamo($id_prestamo,$metodo,$id_metodo,$monto,$codigo,$creador)
	{
		$query = "INSERT INTO retiros_prestamo (metodo, id_metodo,monto,codigo,id_prestamo,creador)
					VALUES('$metodo',$id_metodo,$monto,'$codigo','$id_prestamo',$creador)";
		$run = $this->db_connection->query($query);
		echo $query;
		if ($metodo == "Banco") {
			$query = "UPDATE banco SET monto = monto - $monto WHERE id_banco = $id_metodo";
			$run = $this->db_connection->query($query);
		}else if($metodo = "Caja"){
			$query = "UPDATE caja SET monto = monto - $monto WHERE id_caja = $id_metodo";
			$run = $this->db_connection->query($query);
		}
		echo $query;
	}
}


?>