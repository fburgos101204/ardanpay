<?php 
  $active_admind = "active";
  include_once("header/header.php");
if (($permisos->{'reporte_estado_negocio'} == "on" && $negocio == 0) || isset($_POST['location'])) {
  include_once("header/menu.php");
  include "php/reportcontroller.php";
?>
<div id="content-wrapper">
<div class="container-fluid">
<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="">Servicios</a>
</li>
<li class="breadcrumb-item active"> Reporte de Negocios</li>
</ol>
<div class="card mb-3">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
  	<i class="fas fa-business-time"></i> Estado de Negocios
  
</div>
<div class="card-header" style="margin-top: 0px !important;">
	<div class="form-row">
		<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<span>Estado:</span>
			<select class="form-control" id="estado_reporte" name="estado_reporte">
				<option selected>Todos</option>	
				<option value="0">Al Dia</option>	
				<option value="1">Atrasado</option>
			</select>	
		</div>
		<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<br>
			<button class="btn btn-success font-weight-bold" onclick="buscar_reporte_estado_negocio()">Buscar</button>
		</div>
	</div>
</div>
<div class="card-body">

<div class="table-responsive" id="table_report_estado_negocio">
<table class="table table-bordered table-hover" width="100%" cellspacing="0">
<thead>
  <th style="white-space: nowrap;">Estado</th>
  <th style="white-space: nowrap;">Próximo Pago</th>
  <th style="white-space: nowrap;">Negocio</th>
  <th style="white-space: nowrap;">Modalidad</th>
  <th style="white-space: nowrap;">Plan</th>
  <th style="white-space: nowrap;">Monto</th>
</thead>
<tbody class="hoverclass">
<?php
    $du = new ReportController();
    $rows = $du->read_all_estado_negocio($estado);
    if ($rows->num_rows >= 1) {
    	while($row = $rows->fetch_object()){
?>  
    <tr>
      <td style="white-space: nowrap;">
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
      <td style="white-space: nowrap;"><?php print($row->fecha_pago); ?></td>
      <td style="white-space: nowrap;"><?php print($row->nombre); ?></td>
      <td style="white-space: nowrap;">
	  <?php 
			if($row->modalidad == "30"){ echo "Mensual"; }
			else if($row->modalidad == "182"){ echo "Semestral"; }
			else if($row->modalidad == "365"){ echo "Anual"; }
	  ?>
	  </td>
	  <td style="white-space: nowrap;"><?php echo $row->plan; ?></td>
      <td style="white-space: nowrap;"><?php print("RD$ ".number_format($row->precio,'2')); ?></td>
    </tr>
	<?php }} ?>
  </tbody>
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