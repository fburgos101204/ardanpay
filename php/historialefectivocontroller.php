<?php 
if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new HistorialEfectivoController();
	$proceso = $_POST['proceso'];
	$id_negocio =  (isset($_POST["id_negocio"])) ?  $_POST['id_negocio'] : 0;
	$creador =  (isset($_POST["crd"])) ?  $_POST['crd'] : 0;
	$id_plan =  (isset($_POST["id_plan"])) ?  $_POST['id_plan'] : 0;
	$fecha_pago =  (isset($_POST["fecha_pago"])) ?  $_POST['fecha_pago'] : date("Y-m-d");
	$modalidad =  (isset($_POST["mdl"])) ?  $_POST['mdl'] : 0;
	$proximo_pago =  (isset($_POST["prx_p"])) ?  $_POST['prx_p'] : date("Y-m-d");
	
	if($proceso == "info_efectivo")
	{
		$result = $class->read_info_negocio($id_negocio);
    	if ($result->num_rows >= 1)
		{
   			while($row = $result->fetch_object())
			{ ?>
				
            	<input type="hidden" id="id_plan" name="id_plan" value = "<?php echo $row->id_plan; ?>">
            	<input type="hidden" id="cta" name="cta" value = "<?php echo $row->precio; ?>">
            	<input type="hidden" id="mdl" name="mdl" value = "<?php echo $row->modalidad; ?>">
            	<input type="hidden" id="prx_p" name="prx_p" value = "<?php echo $row->fecha_pago; ?>">
            	<div class="table-responsive mt-3">
				<table class="table table-bordered table-hover" width="100%" cellspacing="0" style = "text-align:center;">
				<tr style="background-color:#9CDAA6;">
      				<th style="white-space: nowrap;">Empresa</th>
      				<th style="white-space: nowrap;">Usuarios</th>
      				<th style="white-space: nowrap;">Préstamos</th>
      				<th style="white-space: nowrap;">Estado</th>
    				<th style="white-space: nowrap;">Plan</th>
      				<th style="white-space: nowrap;">Cuota</th>
      				<th style="white-space: nowrap;">Próximo Pago</th>
      				<th style="white-space: nowrap;">Modalidad</th>

  				</tr>
				<tr>
      				<td style="white-space: nowrap;"><?php print($row->nombre); ?></td>
      				<td style="white-space: nowrap;"><?php print($row->cant_users." / ".$row->cant_user); ?></td>
      				<td style="white-space: nowrap;"><?php print($row->cant_prestamos." / ".$row->cant_prestamo); ?></td>
      				<td style="white-space: nowrap;">
					<?php 
						if($row->estado == 1){ echo "Habilitado"; }
						else{ echo "Deshabilitado"; }
		  			?>
					</td>
    				<td style="white-space: nowrap;"><?php print($row->plan); ?></td>
      				<td style="white-space: nowrap;"><?php print("RD$ ".number_format($row->precio,2)); ?></td>
    				<td style="white-space: nowrap;"><?php print($row->fecha_pago); ?></td>
    				<td style="white-space: nowrap;">
					<?php 
			 			if($row->modalidad == "30"){ echo "Mensual"; }
			 			else if($row->modalidad == "182"){ echo "Semestral"; }
			 			else if($row->modalidad == "365"){ echo "Anual"; }
					?>
					</td>
  				</tr>
				</table>
			</div>
				
<?php 		}
		}
	}
	else if($proceso == "save_efectivo")
	{
		$id_negocio =  (isset($_POST["negocio"])) ?  $_POST['negocio'] : 0;
		$class->pagar_efectivo($creador,$id_negocio,$id_plan,$fecha_pago,$modalidad,$proximo_pago);
	}

}
else
{
	require_once('config/db.php');
}
class HistorialEfectivoController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function read_efectivo()
	{
		$query = "SELECT htef.*,pln.plan,pln.precio,ngc.nombre,
					CONCAT(urs.firstname, ' ',urs.lastname) AS cobrado_por
					FROM historial_efectivo AS htef
				INNER JOIN planes AS pln ON htef.id_plan = pln.id_plan
				INNER JOIN negocio AS ngc ON htef.id_negocio = ngc.id_negocio
				INNER JOIN users AS urs ON htef.creador = urs.user_id
				WHERE MONTH(htef.fecha_pago) = MONTH(NOW())";
		$run = $this->db_connection->query($query);
		return $run;
	}
	
	public function read_pagos_tarjeta()
  	{
    	$query = "SELECT ngc.nombre AS negocio, htp.* FROM historial_tarjeta AS htp
					INNER JOIN negocio AS ngc ON htp.id_negocio = ngc.id_negocio
					WHERE MONTH(htp.created) = MONTH(NOW())";
    	$run = $this->db_connection->query($query);
		return $run;
  	}
	
  	public function read_pagos_tarjeta_negocio($id_negocio)
  	{
    	$query = "SELECT * FROM historial_tarjeta WHERE id_negocio = $id_negocio";
    	$run = $this->db_connection->query($query);
		return $run;
  	}
	
	public function read_info_negocio($negocio)
	{
		$query = "SELECT ngpl.fecha_pago,ngpl.modalidad,ngc.*,pln.plan,pln.id_plan,pln.precio,COUNT(prt.id_prestamo) AS cant_prestamos,COUNT(urs.user_id) AS cant_users,
					pln.cant_user,pln.cant_prestamo FROM negocio AS ngc
					LEFT JOIN negocio_plan AS ngpl ON ngc.id_negocio = ngpl.id_negocio
					LEFT JOIN planes AS pln ON ngpl.id_plan = pln.id_plan
					LEFT JOIN users AS urs ON ngc.id_negocio = urs.negocio
					LEFT JOIN clientes AS clt ON ngc.id_negocio = clt.negocio
					LEFT JOIN prestamo AS prt ON clt.id_cliente = prt.id_cliente
					WHERE ngc.id_negocio = $negocio";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function pagar_efectivo($creador,$id_negocio,$id_plan,$fecha_pago,$modalidad,$proximo_pago)
	{
		$query = "INSERT INTO historial_efectivo(creador,id_negocio,id_plan,fecha_pago)
					VALUES($creador,$id_negocio,$id_plan,'$fecha_pago')";
		$this->db_connection->query($query);
		$nueva_fecha = date("Y-m-d",strtotime($proximo_pago."+ ".$modalidad." days"));
		$query = "UPDATE negocio_plan SET fecha_pago = '$nueva_fecha'
					WHERE id_negocio = $id_negocio";
		$this->db_connection->query($query);
	}
	
	public function delete($id_caja)
	{
		$query = "DELETE  FROM caja WHERE id_caja=$id_caja";
		$run = $this->db_connection->query($query);
		echo $query;
	}
}
?>