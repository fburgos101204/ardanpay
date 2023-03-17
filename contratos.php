<?php 
  $active_admin = 'active';
  include_once("header/header.php");
  include_once("header/menu.php");
?>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
<input type="hidden" value="<?php echo $negocio; ?>" id="negocio_contrato">
<script src="//cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<div id="content-wrapper">
<div class="container-fluid">
<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="">Administración</a>
</li>
<li class="breadcrumb-item active">Contratos</li>
</ol>
<style>
	.cke_contents {
		min-height:485px !important;
		max-height:485px !important;
	}
	.max-height{
		min-height:590px !important;
		max-height:590px !important;
	}
	.lis li
	{
		padding-bottom: 4px;
		font-weight:bold;
	}
</style>
<div class="card mb-3">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">  
	<i class="fas fa-file-word"></i> Contratos
</div>

<div class="card-body">
	<nav class="nav nav-tabs">
  		<a data-toggle="tab" href="#container_personal" class="nav-item nav-link active">Préstamo Personal</a>
  		<a data-toggle="tab" href="#container_vehiculo" class="nav-item nav-link">Préstamo Vehículo</a>
  		<a data-toggle="tab" href="#container_inmobiliaria" class="nav-item nav-link">Prestamo Inmobiliario</a>
	</nav>
	<div class="tab-content tab-contents">
	<div id="container_personal" class="tab-pane fade in active show">
		<div class="form-row">
		<div class="form-group col-md-9">
			<textarea class="ckeditor" id="contrato_personal" name="contrato_personal"></textarea>
		</div>
		<div class="form-group col-md-3">
			<div class="card">
				<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
					<h5>Leyenda de Información</h5>
				</div>
				<div class="card-body">
					<ul  class="lis">
						<li>$nombre_prestador</li>
						<li>$nombre_cliente</li>
						<li>$cedula_cliente</li>
						<li>$direccion_cliente</li>
						<li>$ocupacion_cliente</li>
						<li>$nombre_garante</li>
						<li>$cedula_garante</li>
						<li>$monto_prestar</li>
						<li>$tasa_interes</li>
						<li>$modalidad_pago</li>
						<li>$cantidad_cuotas</li>
						<li>$nombre_notario</li>
						<li>$codigo_colegio_notario</li>
						<li>$cedula_notario</li>
						<li>$nacionalidad</li>
						<li>$fecha_creado</li>
					</ul>
				</div>
      			<div class="card-footer small text-muted">
					<button class="btn btn-success font-weight-bold btn-mda" style="width:100%;" onclick="guardar_contrato('contrato_personal')">
						Guardar Contrato</button>
				</div>
			</div>
		</div>
		</div>
	</div>
	<div id="container_vehiculo" class="tab-pane fade">
		<div class="form-row">
		<div class="form-group col-md-9">
			<textarea class="ckeditor" id="contrato_vehiculo" name="contrato_vehiculo"></textarea>
		</div>
		<div class="form-group col-md-3">
			<div class="card">
				<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
					<h5>Leyenda de Información</h5>
				</div>
				<div class="card-body">
					<ul  class="lis">
						<li>$nombre_prestador</li>
						<li>$nombre_cliente</li>
						<li>$cedula_cliente</li>
						<li>$direccion_cliente</li>
						<li>$nombre_garante</li>
						<li>$cedula_garante</li>
						<li>$monto_prestar</li>
						<li>$tasa_interes</li>
						<li>$modalidad_pago</li>
						<li>$cantidad_cuotas</li>
						<li>$nombre_notario</li>
						<li>$codigo_colegio_notario</li>
						<li>$cedula_notario</li>
						<li>$nacionalidad</li>
						<li>$fecha_creado</li>
					</ul>
				</div>
      			<div class="card-footer small text-muted">
					<button class="btn btn-success font-weight-bold btn-mda" style="width:100%;" onclick="guardar_contrato('contrato_vehiculo')">
						Guardar Contrato</button>
				</div>
			</div>
		</div>
		</div>
	</div>
	
	<div id="container_inmobiliaria" class="tab-pane fade">
		<div class="form-row">
		<div class="form-group col-md-9">
			<textarea class="ckeditor" id="contrato_inmobiliario" name="contrato_inmobiliario"></textarea>
		</div>
		<div class="form-group col-md-3">
			<div class="card">
				<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
					<h5>Leyenda de Información</h5>
				</div>
				<div class="card-body">
					<ul  class="lis">
						<li>$nombre_prestador</li>
						<li>$nombre_cliente</li>
						<li>$cedula_cliente</li>
						<li>$direccion_cliente</li>
						<li>$nombre_garante</li>
						<li>$cedula_garante</li>
						<li>$monto_prestar</li>
						<li>$tasa_interes</li>
						<li>$modalidad_pago</li>
						<li>$cantidad_cuotas</li>
						<li>$nombre_notario</li>
						<li>$codigo_colegio_notario</li>
						<li>$cedula_notario</li>
						<li>$nacionalidad</li>
						<li>$fecha_creado</li>
					</ul>
				</div>
      			<div class="card-footer small text-muted">
					<button class="btn btn-success font-weight-bold btn-mda" style="width:100%;" onclick="guardar_contrato('contrato_inmobiliario')">
						 Guardar Contrato</button>
				</div>
			</div>
		</div>
		</div>
	</div>
	</div>
</div>
</div>
</div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<script src="js/js_contrato.js"></script>
<?php
  include_once("header/footer.php"); 
?>