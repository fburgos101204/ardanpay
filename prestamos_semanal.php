<?php 
  $active_prestamo = "active";
  include_once("header/header.php");
if ($permisos->{'prestamo_personal'} == "on"  || isset($_POST['location'])) {
  include_once("header/menu.php");
  include "php/prestamosemanalcontroller.php";
  include "modal/modal_crear_prestamo.php";
?>

<div id="content-wrapper">
<div class="container-fluid">
<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="">Préstamos</a>
</li>
<li class="breadcrumb-item active">Historial de Préstamos</li>
</ol>
<div class="card mb-3" id="table_solicitud">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
 <p> <i class="fas fa-coins"></i> Histórico de Préstamos</p>
	
	<a href="backup_datos/backup_prestamo.php?negocio=<?php echo $negocio; ?>&tipo_negocio=Prestamo Personal" style="float: right;color:#fff;margin-left:10px;"class="btn btn-success btn-mdax">Exportar</a>
	
	
  <?php if($negocio == 0 || ($cant_prestamo > $cant_prestamor_actual)){ ?>
  <button style="float: right;" class="btn btn-light btn-mdax" onclick="new_prestamo('<?php echo $user_id; ?>')" data-toggle="modal" data-target="#modal_crear_prestamo">Nuevo</button>
  <?php } ?>
	
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered table-hover datatable">
<thead>
  <th nowrap>Tipo Préstamo</th>
  <th nowrap>Estado</th>
  <th nowrap>Cliente</th>
  <th nowrap>Fecha</th>
  <th nowrap>Amortización</th>
  <th nowrap>Capital Inicial</th>
  <th nowrap>Capital Pendiente</th>
  <th nowrap>Intéres</th>
  <th nowrap>Cuotas</th>
  <th nowrap>Pagos</th>
  <th nowrap>Próximo Pago</th>
</thead>

<tbody class="hoverclass">
<?php
    $du = new PrestamosController();
    $rows = $du->read_all_prestamo("Prestamo Personal",$negocio);
    if ($rows->num_rows >= 1) {
    while($row = $rows->fetch_object()){
?>  
    <tr data-href="detalle_prestamo.php?tmp=<?php echo base64_encode($row->id_prestamo); ?>&tp=<?php echo base64_encode($row->tipo_prestamo); ?>&tipo_amortizacion=<?php echo base64_encode($row->id_interes); ?>">
	    <td nowrap><?php echo $row->tipo_prestamo; ?></td>
      <td nowrap>
      <?php 
        if ($row->estado == 'Atrasado' || $row->estado == 'Cancelado') {  echo "<strong style='color:red'>"; }
		else if ($row->estado == 'Asunto Legal') { echo "<strong style='color:orange'>"; }
		else if ($row->estado == 'Al Dia'){ echo "<strong style='color:green'>"; }
        echo $row->estado."</strong>";
      ?>
      </td>
      <td nowrap><?php print($row->cliente); ?></td>
      <td nowrap><?php print($row->fecha_creado); ?></td>
      <td nowrap><?php print($row->tipo_interes); ?></td>
      <td nowrap><?php print("RD$ ".number_format($row->capital_inicial,'2')); ?></td>
      <td nowrap><?php $total += $row->capital_pendiente; print("RD$ ".number_format($row->capital_pendiente,'2')); ?></td>
      <td nowrap><?php print($row->interes." %"); ?></td>
      <td nowrap><?php print($row->cuota); ?></td>
      <td nowrap><?php 
		   $ciclo_pago = $row->ciclo_pago;
           if ($ciclo_pago == 1){ echo 'Diario'; }
           else if ($ciclo_pago == 7){ echo 'Semanal'; }
           else if ($ciclo_pago == 15){ echo 'Quincenal'; }
           else if ($ciclo_pago == 30){ echo 'Mensual'; }
           else if ($ciclo_pago == 365){ echo 'Anual'; } ?>
	  </td>
      <td nowrap><?php print($row->proximo_pago) ?></td>
    </tr>
<?php } ?> 
<?php }else{
        echo "<tr data-href='#'>";
        echo "<td colspan='12' style='font-size:25px;' align='center'>No hay Registros</td>";
        echo "</tr>";
}?>     
  </tbody>
	<tfoot>
	<tr data-href="#" style="background:#c0e0dc;">
		<td colspan="6" align="right">
			<strong>Total Pendiente: </strong>
		</td>
		<td colspan="6">
			<strong><?php echo "RD$ ".number_format($total,'2'); ?></strong>
		</td>
	</tr>
  </tfoot>
</table>
</div>
</div>
</div>
</div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<script type="text/javascript" src="js/js_reajuste.js"></script>
<script type="text/javascript" src="js/js_prestamos.js"></script>
<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>