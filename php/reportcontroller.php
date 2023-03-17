<?php 

if (isset($_POST['tipo'])) {
	require_once('../config/db.php');
	$class = new ReportController();
	$tipo =  (isset($_POST["tipo"])) ?  $_POST['tipo'] : "";
	$forma_pago =  (isset($_POST["forma_pago"])) ?  $_POST['forma_pago'] : "";
	$caja_pago =  (isset($_POST["caja_pago"])) ?  $_POST['caja_pago'] : "";
	$banco_pago =  (isset($_POST["banco_pago"])) ?  $_POST['banco_pago'] : "";
	$creado_por =  (isset($_POST["creado_por"])) ?  $_POST['creado_por'] : "";
	$hasta =  (isset($_POST["hasta"])) ?  $_POST['hasta'] : "";
	$desde =  (isset($_POST["desde"])) ?  $_POST['desde'] : "";
	$estado =  (isset($_POST["estado"])) ?  $_POST['estado'] : "";
	$negocio =  (isset($_POST["negocio"])) ?  $_POST['negocio'] : "";
	$tipo_p =  (isset($_POST["tipo_p"])) ?  $_POST['tipo_p'] : "";
	
	if($tipo == "prestamo"){
		if($estado == "Todos"){ $estado = ""; }
			else{ $estado = "AND prt.estado = '$estado'"; } 
?>
	<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
		<thead>
  			<th nowrap>Estado</th>
  			<th nowrap>Tipo Prést.</th>
  			<th nowrap>Cliente</th>
  			<th nowrap>Fecha Creación</th>
  			<th nowrap>Amortización</th>
  			<th nowrap>Capital Inicial</th>
  			<th nowrap>Capital Pendiente</th>
  			<th nowrap>Intéres</th>
  			<th nowrap>Cuotas</th>
  			<th nowrap>Pagos</th>
		</thead>
		<tbody class="hoverclass">
		<?php
			$result = $class->read_all($negocio,$desde,$hasta,$estado);
    		if ($result->num_rows >= 1) {
    			while($row = $result->fetch_object()){
		?>  
    		<tr data-href="detalle_prestamo.php?tmp=<?php echo base64_encode($row->id_prestamo); ?>&tp=<?php echo base64_encode($row->tipo_prestamo); ?>">
      			<td nowrap>
      			<?php 
        			if ($row->estado == 'Atrasado' || $row->estado == 'Cancelado') {  echo "<strong style='color:red'>"; }
					else if ($row->estado == 'Asunto Legal') { echo "<strong style='color:orange'>"; }
					else if ($row->estado == 'Al Dia' || $row->estado == 'Completado'){ echo "<strong style='color:green'>"; }
        			echo $row->estado."</strong>";
      			?>
      			</td>
	  			<td nowrap><?php echo $row->tipo_prestamo; ?></td>
      			<td nowrap><?php print($row->cliente); ?></td>
      			<td nowrap><?php print($row->fecha_creado); ?></td>
      			<td nowrap><?php print($row->tipo_interes); ?></td>
      			<td nowrap><?php print("RD$ ".number_format($row->capital_inicial,'2')); ?></td>
      			<td nowrap><?php $total += $row->capital_pendiente; print("RD$ ".number_format($row->capital_pendiente,'2')); ?></td>
      			<td nowrap><?php print($row->interes." %"); ?></td>
      			<td nowrap><?php print($row->cuota); ?></td>
      			<td nowrap>
				<?php 
				   $ciclo_pago = $row->ciclo_pago;
				   if ($ciclo_pago == 1){ echo 'Diario'; }
				   else if ($ciclo_pago == 7){ echo 'Semanal'; }
				   else if ($ciclo_pago == 15){ echo 'Quincenal'; }
				   else if ($ciclo_pago == 30){ echo 'Mensual'; }
				   else if ($ciclo_pago == 365){ echo 'Anual'; } 
				?>
	  			</td>
    		</tr>
			<?php }  
				}else{
        			echo "<tr data-href='#'>";
        			echo "<td nowrap colspan='12' style='font-size:25px;' align='center'>No hay Registros</td>";
        			echo "</tr>";
				}
			?>     
  		</tbody>
	</table>
	<script type="text/javascript" src="js/js_prestamos.js"></script>
<?php 
	}
	else if ($tipo == "estado_negocio")
	{
?>
	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
		<thead>
  			<th nowrap>Estado</th>
  			<th nowrap>Próximo Pago</th>
  			<th nowrap>Negocio</th>
  			<th nowrap>Modalidad</th>
  			<th nowrap>Plan</th>
  			<th nowrap>Precio</th>
		</thead>
	<tbody class="hoverclass">
<?php
    $rows = $class->read_all_estado_negocio($estado);
    if ($rows->num_rows >= 1) {
    	while($row = $rows->fetch_object()){
?>  
    	<tr>
      		<td nowrap>
	  		<?php if($row->fecha_pago < date('Y-m-d'))
				{ 
					echo "<strong style='color:red;'>Atrasado</strong>"; 
				}
				else
				{ 
					echo "<strong style='color:green;'>Al Dia</strong>";
				} 
	  		?>
	  		</td>
      		<td nowrap><?php print($row->fecha_pago); ?></td>
      		<td nowrap><?php print($row->nombre); ?></td>
      		<td nowrap>
	 		<?php 
			if($row->modalidad == "30"){ echo "Mensual"; }
			else if($row->modalidad == "182"){ echo "Semestral"; }
			else if($row->modalidad == "365"){ echo "Anual"; }
	  		?>
	  		</td>
	  		<td nowrap><?php echo $row->plan; ?></td>
      		<td nowrap><?php print("RD$ ".number_format($row->precio,'2')); ?></td>
    	</tr>
	<?php }} ?>
  		</tbody>
	</table>
<?php
	}
	else if($tipo == "pago_servicio")
	{ 
?>
	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
	<thead>
  		<th nowrap>Negocio</th>
  		<th nowrap>Tipo</th>
  		<th nowrap>Fecha Pago</th>
  		<th nowrap>Plan</th>
  		<th nowrap>Precio</th>
	</thead>
	<tbody class="hoverclass">
	<?php
	$total = 0;
    $du = new ReportController();
	if($tipo_p == "Efectivo" || $tipo_p == "Todos"){
    $rows = $du->read_all_pago_servicio_efectivo($desde,$hasta,$negocio);
    		if ($rows->num_rows >= 1) {
    		while($row = $rows->fetch_object()){
		?>  
   		<tr>
      		<td nowrap><?php print($row->nombre); ?></td>
      		<td nowrap><?php echo "Efectivo"; ?></td>
      		<td nowrap><?php print($row->fecha_pago); ?></td>
	  		<td nowrap><?php echo $row->plan; ?></td>
      		<td nowrap><?php print("RD$ ".number_format($row->precio,'2'));$total += $row->precio; ?></td>
    	</tr>
		<?php }}}
		
		if($tipo_p == "Tarjeta de Credito" || $tipo_p == "Todos"){
		$rows = $du->read_all_pago_servicio_tarjeta($desde,$hasta,$negocio);
    	if ($rows->num_rows >= 1) {
    		while($row = $rows->fetch_object()){
		?>
		<tr>
		  <td nowrap><?php print($row->nombre); ?></td>
		  <td nowrap><?php echo "Tarjeta"; ?></td>
      	  <td nowrap><?php print($row->created); ?></td>
		  <td nowrap><?php echo $row->plan; ?></td>
		  <td nowrap><?php print("RD$ ".number_format($row->precio,'2'));$total += $row->precio; ?></td>
    	</tr>
		<?php }}} ?>
  		</tbody>
		<tfoot>
			<tr>
		  		<th nowrap colspan="4"  style="text-align: right !important;">Total: </th>
		  		<td nowrap><?php echo "RD$ ".number_format($total,'2'); ?></td>
			</tr>
		</tfoot>
	</table>
<?php
	}
	else if($tipo == "cliente")
	{ 
?>
	<table class="table table-bordered table-hover" width="100%" cellspacing="0">
	<thead>

  			<th nowrap>Cliente</th>
  			<th nowrap>Fecha Creación</th>
  			<th nowrap>Tipo Amortización</th>
  			<th nowrap>Capital Inicial</th>
  			<th nowrap>Capital Pendiente</th>
  			<th nowrap>% Intéres</th>
  			<th nowrap>Cuotas</th>
  			<th nowrap>Frequencia</th>
	</thead>
	<tbody class="hoverclass">
	<?php
	$total = 0;
	$result = $class->read_cliente($negocio);
    if ($result->num_rows >= 1) {
    while($row = $result->fetch_object()){
 	?>  
   		<tr>
      	     </td>
      			<td nowrap><?php print($row->cliente); ?></td>
      			<td nowrap><?php print($row->fecha_creado); ?></td>
      			<td nowrap><?php print($row->tipo_interes); ?></td>
      			<td nowrap><?php print("RD$ ".number_format($row->capital_inicial,'2')); ?></td>
      			<td nowrap><?php $total += $row->capital_pendiente; print("RD$ ".number_format($row->capital_pendiente,'2')); ?></td>
      			<td nowrap><?php print($row->interes." %"); ?></td>
      			<td nowrap><?php print($row->cuota); ?></td>
      			<td nowrap>
				<?php 
				 $ciclo_pago = $row->ciclo_pago;
				   if ($ciclo_pago == 1){ echo 'Diario'; }
				   else if ($ciclo_pago == 7){ echo 'Semanal'; }
				   else if ($ciclo_pago == 15){ echo 'Quincenal'; }
				   else if ($ciclo_pago == 30){ echo 'Mensual'; }
				   else if ($ciclo_pago == 365){ echo 'Anual'; } 
				?>
	  			</td>
    		</tr>
			<?php }  
				}else{
        			echo "<tr data-href='#'>";
        			echo "<td nowrap colspan='12' style='font-size:25px;' align='center'>No hay Registros</td>";
        			echo "</tr>";
				}
			?>     
   		</tbody>

	</table>	
<?php
	}
	else if($tipo == "t_pago")
	{ ?>
		<table class="table table-bordered table-hover" width="100%" cellspacing="0">
		<thead>
  			<th nowrap>Cobrado Por</th>
  			<th nowrap>Estado</th>
  			<th nowrap>Entidad</th>
  			<th nowrap>Tipo de Pago</th>
  			<th nowrap>No Depósito</th>
  			<th nowrap>Cliente</th>
  			<th nowrap>Concepto</th>
  			<th nowrap>Fecha</th>
  			<th nowrap>Capital</th>
  			<th nowrap>Intéres</th>
  			<th nowrap>Mora</th>
  			<th nowrap>Descuento</th>
  			<th nowrap>Total Pagado</th>
  			<th nowrap>Capital Restante</th>
		</thead>
		<tbody>
<?php
		$rows = $class->read_historial_complete($negocio,$desde,$hasta,$estado,$forma_pago,$creado_por,$caja_pago,$banco_pago);
    	if ($rows->num_rows >= 1) {
    		while($row = $rows->fetch_object()){
?>
	<tr>
      <td nowrap>
		<?php if ($row->creado == '') {
              print($row->mensajero);
        } else {
              print($row->creado); 
        }?></td>
      <td nowrap>
        <?php 
          if ($row->estado == "Anulada") {
            echo "<strong style='color:red'>$row->estado</strong>";
          }else if ($row->estado == "Prestamo Anterior"){
			  echo "<strong style='color:orange'>$row->estado</strong>";
		  }else{
            echo "<strong style='color:green'>$row->estado</strong>";
          }
        ?>
      </td>
      <td nowrap>
      <?php 
        if (strlen($row->caja_pagada) <= 0) {
          echo $row->banco_pagado;
        }else
        {
          echo $row->caja_pagada;
        } 
      ?> 
      </td>
      <td nowrap><?php print($row->tipo_pago); ?></td>
      <td nowrap>
      <?php 
        if (strlen($row->caja_pagada) <= 0) {
          echo $row->no_deposito;
        }else
        {
          echo "Sin Codigo";
        } 
      ?> 
      </td>
      <td nowrap><?php print($row->cliente); ?></td>
      <td nowrap><?php print($row->concepto); ?></td>
      <td nowrap><?php print(date("Y-m-d",strtotime($row->fecha))); ?></td>
	  <td nowrap><?php $capital_total += $row->capital; print("RD$ ".number_format($row->capital)); ?></td>
      <td nowrap><?php $interes_total += $row->interes; print("RD$ ".number_format($row->interes)); ?></td>
      <td nowrap><?php $mora_total += $row->mora; print("RD$ ".number_format($row->mora,'2')); ?></td>
      <td nowrap><?php $descuento_total += $row->descuento; print("RD$ ".number_format($row->descuento,'2')); ?></td>
      <td nowrap><?php $pagado_total += $row->total_pagado; print("RD$ ".number_format($row->total_pagado,'2')); ?></td>
      <td nowrap><?php $capital_restante_total += $row->capital_restante; print("RD$ ".number_format($row->capital_restante)); ?></td>
    </tr>
	
<?php }} ?>
  	</tbody>
	<tfoot>
		<tr style="background:#c0e0dc;">
		<th nowrap colspan="8" style="text-align:right !important;">Total: </th>
		<th nowrap colspan="1">
			<?php echo "RD$ ".number_format($capital_total,'2'); ?>
		</th>
		<th nowrap colspan="1">
			<?php echo "RD$ ".number_format($interes_total,'2'); ?>
		</th>
		<th nowrap colspan="1">
			<?php echo "RD$ ".number_format($mora_total,'2'); ?>
		</th>
		<th nowrap colspan="1">
			<?php echo "RD$ ".number_format($descuento_total,'2'); ?>
		</th>
		<th nowrap colspan="1">
			<?php echo "RD$ ".number_format($pagado_total,'2'); ?>
		</th>
		<th nowrap colspan="1">
			<?php echo "RD$ ".number_format($capital_restante_total,'2'); ?>
		</th>
		</tr>
	</tfoot>
	</table>
<?php }
}
else
{
	require_once('config/db.php');
}
class ReportController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function read_all($negocio,$desde,$hasta,$estado)
	{
		$query = "SELECT CONCAT(clt.nombre, ' ', clt.apellido) as cliente,  prt.* FROM prestamo as prt
				INNER JOIN clientes as clt on prt.id_cliente = clt.id_cliente
				WHERE (prt.fecha_creado BETWEEN '$desde' AND '$hasta') $estado AND
				clt.negocio = $negocio AND prt.estado != 'Al Dia' AND prt.estado != 'Atrasado'
				GROUP BY prt.id_prestamo
				ORDER BY cliente";
		$run = $this->db_connection->query($query);
		return $run;
	}
	
	public function read_cliente($negocio)
	{
		$query = "SELECT CONCAT(clt.nombre, ' ', clt.apellido) as cliente,  prt.* FROM prestamo as prt
				INNER JOIN clientes as clt on prt.id_cliente = clt.id_cliente
				WHERE  clt.negocio = $negocio 
				GROUP BY prt.id_prestamo
				ORDER BY cliente";
		$run = $this->db_connection->query($query);
		return $run;
	}



	public function read_all_estado_negocio($estado)
	{
		/*Atrasados*/
		$new_estado = "";
		if($estado == 1){ $new_estado = "WHERE ngpl.fecha_pago < ".date('Y-m-d'); }
		/*Actual*/
		else if($estado == 0){ $new_estado = "WHERE ngpl.fecha_pago >= ".date('Y-m-d'); }
		
		$query = "SELECT pln.precio,ngpl.fecha_pago,ngpl.modalidad,ngc.nombre,pln.plan FROM negocio_plan AS ngpl 
					INNER JOIN negocio AS ngc ON ngpl.id_negocio = ngc.id_negocio 
					INNER JOIN planes AS pln ON ngpl.id_plan = pln.id_plan
					$new_estado";
		$run = $this->db_connection->query($query);
		return $run;
	}
	
	public function read_all_pago_servicio_efectivo($desde,$hasta,$negocio)
	{
		if($negocio > 0 && $desde != "")
		{
			$desde_hasta = "WHERE (htef.fecha_pago BETWEEN '$desde' AND '$hasta') AND ntef.id_negocio = $negocio";
		}
		else if($negocio == -1)
		{
			$desde_hasta = "WHERE (htef.fecha_pago BETWEEN '$desde' AND '$hasta')";
		}
		else
		{ 
			$desde_hasta = "";
		}
		$query = "SELECT htef.*,pln.plan,pln.precio,ngc.nombre FROM historial_efectivo AS htef
					INNER JOIN planes AS pln ON htef.id_plan = pln.id_plan
					INNER JOIN negocio AS ngc ON htef.id_negocio = ngc.id_negocio
					$desde_hasta";
		$run = $this->db_connection->query($query);
		return $run;
	}
	
	public function read_all_pago_servicio_tarjeta($desde,$hasta,$negocio)
	{
		if($negocio > 0 && $desde != "")
		{
			$desde_hasta = "WHERE (httj.created BETWEEN '$desde' AND '$hasta') AND ngpl.id_negocio = $negocio";
		}
		else if($negocio == -1)
		{
			$desde_hasta = "WHERE (httj.created BETWEEN '$desde' AND '$hasta')";
		}
		else
		{ 
			$desde_hasta = "";
		}
		$query = "SELECT httj.id_historial_tarjeta,httj.created,pln.plan,pln.precio,ngc.nombre FROM negocio_plan AS ngpl
					INNER JOIN planes AS pln ON ngpl.id_plan = pln.id_plan 
					INNER JOIN negocio AS ngc ON ngpl.id_negocio = ngc.id_negocio
					INNER JOIN historial_tarjeta AS httj ON ngpl.id_negocio = httj.id_negocio
					$desde_hasta";
		$run = $this->db_connection->query($query);
		return $run;
	}
	
	public function read_historial_complete($negocio,$desde,$hasta,$estado,$forma_pago,$creado_por,$caja_pago,$banco_pago)
	{
		if($estado == "Todos"){ 
			$estado = ""; 
		}else{ 
			$estado = "AND htpg.estado = '$estado'"; 
		}
		
		if($forma_pago != "Caja"){ 
			$forma_pagos = "AND htpg.tipo_pago != 'Efectivo' and htpg.banco = $banco_pago"; 
		}else{ 
			//$forma_pago = "AND htpg.tipo_pago = 'Efectivo' AND htpg.caja = $caja_pago"; 
			$forma_pago = "";
		}
		
		if($creado_por != "Todos"){ 
			$creado_por = "AND urs.user_id = $creado_por"; 
		}else{ 
			$creado_por = ""; 
		}
		
		$query = "SELECT htpg.*,banc.banco as banco_pagado, cja.nombre as caja_pagada,CONCAT(clt.nombre, ' ',clt.apellido) as cliente,CONCAT(urs.firstname, ' ',urs.lastname) as creado , me.id_mensajero, CONCAT(me.nombre,' ',me.apellido) as mensajero
            FROM historial_pagos AS htpg
			INNER JOIN prestamo AS prt ON htpg.id_prestamo = prt.id_prestamo
			INNER JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente
			LEFT JOIN caja AS cja ON htpg.caja = cja.id_caja
			LEFT JOIN banco AS banc ON htpg.banco = banc.id_banco
			LEFT JOIN users AS urs ON htpg.creador = urs.user_id
			LEFT JOIN mensajeros AS me ON htpg.id_mensajero = me.id_mensajero
			WHERE clt.negocio = $negocio and (htpg.fecha BETWEEN '$desde' AND '$hasta') $estado $forma_pago  $creado_por
			GROUP BY htpg.id_historial ORDER BY htpg.id_historial DESC";
		$run = $this->db_connection->query($query);
		//echo $query;
		return $run;
	}
}
?>