
<?php
require_once('config/db.php');
//ob_start();  
include_once("header/header.php"); 
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<?php 
$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$id_prestamo = base64_decode($_GET['tp']);
$query = "SELECT CONCAT(clt.nombre, ' ', clt.apellido) as cliente,hpt.* FROM historial_pagos as hpt 
			INNER JOIN prestamo as prt on hpt.id_prestamo = prt.id_prestamo 
			INNER JOIN clientes as clt on prt.id_cliente = clt.id_cliente
			WHERE prt.id_prestamo = $id_prestamo and hpt.estado = 'Pagada'";
$query_listado = $con->query($query); 

$query = "SELECT CONCAT(clt.nombre, ' ', clt.apellido) as cliente,clt.telefono, amrt.no_cuota, prt.*,amrt.fecha as fecha_pago,amrt.balance,amrt.abono_capital,amrt.interes as interes_cantidad, amrt.fecha as proximo_pagos FROM prestamo as prt
				INNER JOIN amortizacion AS amrt ON prt.id_prestamo = amrt.id_prestamo
				INNER JOIN clientes as clt on prt.id_cliente = clt.id_cliente
				WHERE prt.id_prestamo = $id_prestamo AND amrt.estado != 'Pagada'
				ORDER BY amrt.fecha asc limit 1";
$query_cliente_res = $con->query($query);
 if ($query_cliente_res->num_rows >= 1) {
    while($ron = $query_cliente_res->fetch_object()){
        $cliente = $ron->cliente;
		$photo = $ron->path_img_cliente;
        $fecha_inicio = $ron->fecha;
        $capital_inicial = $ron->capital_inicial;
        $capital_pendiente = $ron->capital_pendiente;
        $proximo_pago = $ron->proximo_pago;
        $estado = $ron->estado;
        $interes_porcentaje = $ron->interes;
        $tipo_interes = $ron->tipo_interes;
        $cuotas = $ron->cuota;
        $no_cuota = $ron->no_cuota - 1;
        $balance = $ron->balance;
        $abono_capital = $ron->abono_capital;
        $interes = $ron->interes_cantidad;
        $fecha_aux = $ron->fecha_aux;
        $fecha_pagar = $ron->fecha_pago;
		$telefono = $ron->telefono;
        $ciclo_pago = $ron->ciclo_pago;
}}
			
?>
<div style="margin-left: 60px;margin-right: 60px;">
<div class="form-row" style="border-bottom:1px solid #ccc">
	<div class="form-group col">
		<img src="<?php echo $logo; ?>" style="/*width: 188px;*/width: auto;height: 100px;margin-top: 10px;border-radius: 20px;">
	</div>
	<div class="form-group col" align="center">
		<h3 style="margin-top: 14%;">Informe de Pagos</h3>
	</div>
	<div class="form-group col" align="right">
		<h3><?php echo $empresa; ?></h3>
		<h4><?php echo $direccion; ?></h4>
		<span><strong>RNC:</strong> <?php echo $rnc; ?></span>
		<span><strong>Teléfono:</strong> <?php echo $telefono_empresa; ?></span>
	</div>
</div>
<div class="form-row" >
	<div class="form-group col-md-8">
		<h4><?php echo $cliente; ?></h4>
		<span><?php echo $telefono; ?></span>
	</div>
	<div class="form-group col" style="text-align:right">
		<h4><strong>Fecha:</strong> <?php echo date("Y-m-d"); ?></h4>
	</div>
	
</div>
<div class="form-row" style="border-top:1px solid #ccc;border-bottom:1px solid #ccc">
	<div class="form-group col">
		<h4><strong>Código Préstamo:</strong> <?php echo "000".$id_prestamo;  ?></h4>
		<h4><strong>Fecha Inicio:</strong> <?php echo $fecha_inicio; ?></h4>
		<h4><strong>Modalidad Pago:</strong> 
		<?php
           if ($ciclo_pago == 1){ echo 'Diario'; }
           else if ($ciclo_pago == 7){ echo 'Semanal'; }
           else if ($ciclo_pago == 15){ echo 'Quincenal'; }
           else if ($ciclo_pago == 30){ echo 'Mensual'; }
           else if ($ciclo_pago == 365){ echo 'Anual'; }
        ?>
		</h4>
	</div>
	<div class="form-group col">
		<h4><strong>Capital Actual:</strong> <?php echo "RD$ ".number_format($capital_pendiente,'2');  ?></h4>
		<h4><strong>Interés:</strong> <?php echo $interes."%"; ?></h4>
		<h4><strong>Cuotas:</strong> <?php echo $no_cuota." / ".$cuotas; ?></h4>
	</div>
	<div class="form-group col">
		<h4><strong>Capital Inicial:</strong> <?php echo "RD$ ".number_format($capital_inicial,'2'); ?></h4>
		<h4><strong>Amortización:</strong> <?php echo $tipo_interes; ?></h4>
		<h4><strong>Próximo Pago:</strong> <?php echo $proximo_pago; ?></h4>
	</div>
</div>
<hr>
<table class="table table-bordered table-hover" width="100%" cellspacing="0">
<thead>
  <th style="white-space: nowrap;">Concepto</th>
  <th style="white-space: nowrap;">Fecha</th>
  <th style="white-space: nowrap;">Capital</th>
  <th style="white-space: nowrap;">Interés</th>
  <th style="white-space: nowrap;">Mora</th>
  <th style="white-space: nowrap;">Descuento</th>
  <th style="white-space: nowrap;">Total Pagado</th>
  <th style="white-space: nowrap;">Capital Restante</th>
</thead>

<tbody>
<?php
    $aux = 0;
    if ($query_listado->num_rows >= 1) {
    while($row = $query_listado->fetch_object()){
?>
    <tr>
      <td style="white-space: nowrap;"><?php print($row->concepto); ?></td>
      <td style="white-space: nowrap;"><?php print(date("Y-m-d",strtotime($row->fecha))); ?></td>
      <td style="white-space: nowrap;"><?php print("RD$ ".number_format($row->capital)); ?></td>
      <td style="white-space: nowrap;"><?php print("RD$ ".number_format($row->interes)); ?></td>
      <td style="white-space: nowrap;"><?php print("RD$ ".number_format($row->mora,'2')); ?></td>
      <td style="white-space: nowrap;"><?php print("RD$ ".number_format($row->descuento,'2')); ?></td>
      <td style="white-space: nowrap;"><?php print("RD$ ".number_format($row->total_pagado,'2')); ?></td>
      <td style="white-space: nowrap;"><?php print("RD$ ".number_format($row->capital_restante)); ?></td>
    </tr>
<?php } 
     }else{
        echo "<tr>";
        echo "<td colspan='10' class='py-5' style='font-size:20px;' align='center'>No hay Pagos Realizados</td>";
        echo "</tr>";
}?>     
  </tbody>
</table>
</div>
<?php
/*
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->set_paper('landscape');
$dompdf->set_option('defaultFont', 'Courier');
$dompdf->render();
$pdf = $dompdf->output();
$dompdf->stream("example.pdf", array("Attachment"=>0)); 
*/
?>