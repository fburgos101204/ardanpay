<?php 

if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new MetodoPagoController();
	$proceso = $_POST['proceso'];
	$id_pago =  (isset($_POST["id_pago"])) ?  $_POST['id_pago'] : 0;
	$negocio =  (isset($_POST["negocio"])) ?  $_POST['negocio'] : 0;
	$nombre_tarjeta =  (isset($_POST["nombre_tarjeta"])) ?  $_POST['nombre_tarjeta'] : 0;
	$card_number =  (isset($_POST["card_number"])) ?  $_POST['card_number'] : 0;
	$card_name =  (isset($_POST["tipo_tarjeta"])) ?  $_POST['tipo_tarjeta'] : 0;
	$cvv =  (isset($_POST["cvv"])) ?  $_POST['cvv'] : 0;
	$month_expire =  (isset($_POST["month_expire"])) ?  $_POST['month_expire'] : 0;
	$year_expire =  (isset($_POST["year_expire"])) ?  $_POST['year_expire'] : 0;
		echo $id_pago;
		echo $proceso;

	if ($proceso == "default_drop") {
		$class->default_drop($id_pago);
		
	}else if ($proceso == "default_payment"){
		$class->default_payment($id_pago,$negocio);
	}else if ($proceso == "delete") {
		$class->delete_card($id_pago);
	}
	else
	{
		if ($proceso == "save_pago") {
			$id_pago = 0;
		}
		$class->Proceso($proceso,$id_pago,$nombre_tarjeta,$negocio,$card_number,$card_name,$cvv,$month_expire,$year_expire);	
	}
}
else
{
	require_once('config/db.php');
}
class MetodoPagoController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function Mostrar($negocio)
	{
		$query = "SELECT * FROM tarjeta_credito WHERE negocio = $negocio";
		$run = $this->db_connection->query($query);
		return $run;
	}
	
	public function Mostrar_admin()
	{
		$query = "SELECT trjt.*,ngc.nombre AS n_negocio FROM tarjeta_credito AS trjt
					INNER JOIN negocio AS ngc ON trjt.negocio = ngc.id_negocio";
		$run = $this->db_connection->query($query);
		return $run;
	}
	
	public function Proceso($proceso,$id_pago,$nombre_tarjeta,$negocio,$card_number,$card_name,$cvv,$month_expire,$year_expire)
	{
		if($proceso == "save_pago"){
			$query = "INSERT INTO tarjeta_credito(negocio,nombre_tarjeta,card_number,card_name,cvv,month_expire,year_expire) 								VALUES($negocio,'$nombre_tarjeta','$card_number','$card_name','$cvv', $month_expire,$year_expire)";
		}else if($proceso == "update_pago"){
			$query = "UPDATE tarjeta_credito 
						SET negocio = $negocio, nombre_tarjeta = '$nombre_tarjeta', card_number = '$card_number',
						card_name = '$card_name', cvv = '$cvv', month_expire = $month_expire, year_expire = $year_expire
						WHERE id_tarjeta_credito = $id_pago";
		}
		$run = $this->db_connection->query($query);
		echo $query;
	}
	
	public function default_payment($id_pago,$negocio)
	{
		$query = "UPDATE tarjeta_credito SET predeterminada = 0 WHERE negocio = $negocio";
		$run = $this->db_connection->query($query);
		echo $query;
		$query2 = "UPDATE tarjeta_credito SET predeterminada= 1 WHERE id_tarjeta_credito = $id_pago";
		$run = $this->db_connection->query($query2);
		echo $query2;
	}
	
	public function default_drop($id_pago)
	{
		$query = "UPDATE tarjeta_credito SET predeterminada = 0 WHERE id_tarjeta_credito = $id_pago";
		$run = $this->db_connection->query($query);
		echo $query;
	}
	public function delete_card($id)
	{
		$query = "DELETE FROM tarjeta_credito WHERE id_tarjeta_credito = $id";
		$run = $this->db_connection->query($query);
		echo $query;
	}

}



?>