<?php 
  $active_admind = "active";
  include_once("header/header.php");
if(($permisos->{'reporte_pago_servicio'} == "on" && $negocio == 0) || isset($_POST['location'])) {
  include_once("header/menu.php");
  include "php/reportcontroller.php";
?>
<div id="content-wrapper">
<div class="container-fluid">
<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="">Servicios</a>
</li>
<li class="breadcrumb-item active"> Reporte de Pagos Servicio</li>
</ol>
<div class="card mb-3">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
  	<i class="fas fa-business-time"></i> Pagos de Servicio
</div>
<div class="card-header" style="margin-top: 0px !important;">
	<div class="form-row">
		<div class="form-group col-md-24">
			<span>Negocio:</span>
			<select class="form-control js-example-basic-single" id="negocio" name="negocio">
				  <option value="-1">Todos los negocios</option>
				  <?php
                      require_once('config/db.php');
                      $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                      $query = "SELECT * FROM negocio";
                      $row3 = $con->query($query); 
                      if ($row3->num_rows >= 1) {
                        while ($row = $row3->fetch_object()) { ?>
                  <option value="<?php echo $row->id_negocio; ?>">
                    <?php echo $row->nombre; ?>
                  </option>
                  <?php }} ?>
              </select>
		</div>
		<div class="form-group col-md-24">
			<span>Desde:</span>
			 <input type="date" class="form-control" id="desde_reporte" name="hasta_reporte" value="<?php echo date('Y-m-d'); ?>">
		</div>
		<div class="form-group col-md-24">
			<span>Hasta:</span>
			<input type="date" class="form-control" id="hasta_reporte" name="hasta_reporte" value="<?php echo date('Y-m-d'); ?>">
		</div>
		<div class="form-group col-md-24">
			<span>Tipo de Pago:</span>
			<select class="form-control" id="tipo_p" name="tipo_p">
                <option>Todos</option>
                <option>Tarjeta de Credito</option>
                <option>Efectivo</option>
              </select>
		</div>
		
		<div class="form-group col-md-24">
			<br>
			<button class="btn btn-success font-weight-bold" onclick="buscar_reporte_pagos_servicio()">Buscar</button>
		</div>
	</div>
</div>
<div class="card-body">
<div class="table-responsive" id="table_report_pago_servicio">
<table class="table table-bordered table-hover" width="100%" cellspacing="0">
	<thead>
  		<th style="white-space: nowrap;">Negocio</th>
  		<th style="white-space: nowrap;">Tipo</th>
  		<th style="white-space: nowrap;">Fecha Pago</th>
  		<th style="white-space: nowrap;">Plan</th>
  		<th style="white-space: nowrap;">Monto</th>
	</thead>
	<tbody class="hoverclass">
<?php
	$total = 0;
    $du = new ReportController();
    $rows = $du->read_all_pago_servicio_efectivo("","",0);
    if ($rows->num_rows >= 1) {
    	while($row = $rows->fetch_object()){
?>  
    <tr>
      <td style="white-space: nowrap;"><?php print($row->nombre); ?></td>
      <td style="white-space: nowrap;"><?php echo "Efectivo"; ?></td>
      <td style="white-space: nowrap;"><?php print($row->fecha_pago); ?></td>
	    <td style="white-space: nowrap;"><?php echo $row->plan; ?></td>
      <td style="white-space: nowrap;"><?php print("RD$ ".number_format($row->precio,'2'));$total += $row->precio; ?></td>
    </tr>
	<?php }}
		
	$rows = $du->read_all_pago_servicio_tarjeta("","",0);
    if ($rows->num_rows >= 1) {
    	while($row = $rows->fetch_object()){
	?>
	<tr>
      <td style="white-space: nowrap;"><?php print($row->nombre); ?></td>
      <td style="white-space: nowrap;"><?php echo "Tarjeta"; ?></td>
      <td style="white-space: nowrap;"><?php print($row->created); ?></td>
	    <td style="white-space: nowrap;"><?php echo $row->plan; ?></td>
      <td style="white-space: nowrap;"><?php print("RD$ ".number_format($row->precio,'2'));$total += $row->precio; ?></td>
    </tr>
	<?php }} ?>
  </tbody>
  <tfoot>
	<tr>
		<th style="white-space: nowrap;" colspan="4" style="text-align: right !important;">Total: </th>
		<td style="white-space: nowrap;"><?php echo "RD$ ".number_format($total,'2'); ?></td>
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
<script type="text/javascript" src="js/js_report_prestamo.js"></script>
<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>