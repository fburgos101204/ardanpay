<?php 
  $active_report = "active";
  include_once("header/header.php");
if ($permisos->{'prestamo_personal'} == "on"  || isset($_POST['location'])) {
  include_once("header/menu.php");
  include "php/prestamocontroller.php";
  include "modal/modal_crear_prestamo.php";
?>
<div id="content-wrapper">
<div class="container-fluid">
<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="">Reportes</a>
</li>
<li class="breadcrumb-item active"> Préstamos</li>
</ol>
<div class="card mb-3">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
  	<i class="fas fa-coins"></i> Histórico de Préstamos
  
</div>
<div class="card-header">
	<div class="form-row">
		<div class="form-group col-sm-3">
			<span>Desde:</span>
			 <input type="date" class="form-control" id="desde_reporte" name="hasta_reporte" value="<?php echo date('Y-m-d'); ?>">
		</div>
		<div class="form-group col-sm-3">
			<span>Hasta:</span>
			<input type="date" class="form-control" id="hasta_reporte" name="hasta_reporte" value="<?php echo date('Y-m-d'); ?>">
		</div>
		<div class="form-group col-sm-3">
			<span>Estado:</span>
			<select class="form-control" id="estado_reporte" name="estado_reporte">
				<option selected>Todos</option>	
				<option>Asunto Legal</option>	
				<option>Cancelado</option>	
				<option>Completado</option>	
			</select>	
		</div>
		<div class="form-group col-sm-3">
			<br>
			<button class="btn btn-success font-weight-bold" onclick="buscar_reporte('<?php echo $negocio; ?>')">Buscar Reporte</button>
		</div>
	</div>
</div>
<div class="card-body">

<div class="table-responsive" id="table_report">
	
<table class="table table-bordered table-hover datatable" id="dataTable" width="100%" cellspacing="0">
<thead>
  <th nowrap>Estado</th>
  <th nowrap>Tipo Préstamo</th>
  <th nowrap>Cliente</th>
  <th nowrap>Fecha Creación</th>
  <th nowrap>Amortización</th>
  <th nowrap>Capital Inicial</th>
  <th nowrap>Capital Pendiente</th>
  <th nowrap>Interés</th>
  <th nowrap>Cuotas</th>
  <th nowrap>Pagos</th>
</thead>

<tbody class="hoverclass">
<?php
    $du = new PrestamosController();
    $rows = $du->read_all_prestamo_reports($negocio);
    if ($rows->num_rows >= 1) {
    while($row = $rows->fetch_object()){
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
      <td nowrap><?php print(date("Y-m-d",strtotime($row->fecha_creado))); ?></td>
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
    </tr>
<?php } ?> 
<?php }else{
        echo "<tr data-href='#'>";
        echo "<td colspan='12' style='font-size:25px;' align='center'>No hay Registros</td>";
        echo "</tr>";
}?>     
  </tbody>
</table>
<script type="text/javascript" src="js/js_prestamos.js"></script>
</div>
</div>
</div>
</div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<script type="text/javascript" src="js/js_report_prestamo.js"></script>
<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>