<?php 
  $active_report = "active";
  include_once("header/header.php");
if ($permisos->{'prestamo_personal'} == "on"  || isset($_POST['location'])) {
  include_once("header/menu.php");
  include "php/prestamocontroller.php";
  //include "modal/modal_crear_prestamo.php";
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

		<div class="form-group col-sm-3">
			<br>
			<button class="btn btn-primary font-weight-bold" onclick="buscar_cliente('<?php echo $negocio; ?>')">Consultar <i class="fas fa-search"></i> </button>
			<button  class="btn btn-success font-weight-bold" onclick="printData()">Imprimir <i class="fas fa-print"></i></button>
		</div>
	</div>
</div>
<div class="card-body">

<div class="table-responsive" id="table_report">
	
<table class="table table-bordered table-hover display" id="table_report_cliente" width="100%" cellspacing="0">
<thead>
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
        echo "<tr data-href='#'>";
        echo "<td colspan='12' style='font-size:25px;' align='center'>No hay Registros</td>";
        echo "</tr>";
?>     
  </tbody>
</table>
<!--<script type="text/javascript" src="js/js_prestamos.js"></script>-->
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


  <script type="text/javascript">
		$(document).ready(function() {

} );
	</script>
