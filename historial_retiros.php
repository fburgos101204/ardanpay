<?php 
  $active_historia = "active";
  include_once("header/header.php");
if ($permisos->{'historial_retiro'} == "on"  || isset($_POST['location'])) {
  include_once("header/menu.php");
  include "php/monetizarcontroller.php";
?>
<div id="content-wrapper">
<div class="container-fluid">
<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="">Historiales</a>  
</li>
<li class="breadcrumb-item active">Retiros Realizados</li>
</ol>
<div class="card mb-3">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
  <p><i class="fas fa-history"></i> Histórico de Retiros</p>
  <div class="form-group col-md-3" style="float:right;">
  <select class="form-control" name="tipo_retiro" id="tipo_retiro">
    <option value="1">Retiros de Bancos</option>
    <option selected value="2">Retiros de Caja</option>
  </select>
  </div>
</div>
<div class="card-body" id="table_solicitud">
<div class="table-responsive">
<table class="table table-bordered table-hover hidden table_banco datatable" id="dataTable" width="100%" cellspacing="0">
<thead>
  <th nowrap>Retirado Por</th>
  <th nowrap>Fecha</th>
  <th nowrap>Concepto</th>
  <th nowrap>Método</th>
  <th nowrap>Entidad</th>
  <th nowrap>Código</th>
  <th nowrap>Monto</th>
</thead>
<tbody>
<?php
    $class = new MonetizarController();
    $rows = $class->read_retiros_banco($negocio);
    if ($rows->num_rows >= 1) {
    while($row = $rows->fetch_object()){
?>
    <tr>
      <td nowrap><?php print($row->creador); ?></td>
      <td nowrap><?php print(date("Y-m-d",strtotime($row->fecha))); ?></td>
      <td nowrap><?php  echo $row->concepto_retiro; ?></td>
      <td nowrap><?php print($row->metodo); ?></td>
      <td nowrap><?php echo $row->banco; ?></td>
      <td nowrap><?php print($row->codigo); ?></td>
      <td nowrap><?php $total += $row->monto; print("RD$ ".number_format($row->monto,'2')); ?></td>
    </tr>
<?php } ?>
	<tr style="background:#c0e0dc;">
		<td nowrap colspan="6" align="right">
			<strong>Total Prestado: </strong>
		</td>
		<td nowrap colspan="1">
			<strong><?php echo "RD$ ".number_format($total,'2'); ?></strong>
		</td>
	</tr>
<?php }else{
        echo "<tr>";
        echo "<td nowrap colspan='13 style='font-size:25px;' align='center'>No hay Retiros de Banco Realizados</td>";
        echo "</tr>";
}?>     
  </tbody>
</table>

<table class="table table-bordered table-hover table_caja datatable" id="dataTable" width="100%" cellspacing="0">
<thead>
  <th nowrap>Retirado Por</th>
  <th nowrap>Fecha</th>
  <th nowrap>Concepto</th>
  <th nowrap>Método</th>
  <th nowrap>Entidad</th>
  <th nowrap>Monto</th>
</thead>

<tbody>
<?php
    $class = new MonetizarController();
    $rows = $class->read_retiros_caja($negocio);
    if ($rows->num_rows >= 1) {
    while($row = $rows->fetch_object()){
?>
    <tr>
      <td nowrap><?php print($row->creador); ?></td>
      <td nowrap><?php print(date("Y-m-d",strtotime($row->fecha))); ?></td>
      <td nowrap><?php  echo $row->concepto_retiro; ?></td>
      <td nowrap><?php print($row->metodo); ?></td>
      <td nowrap><?php echo $row->caja; ?></td>
      <td nowrap><?php $total += $row->monto; print("RD$ ".number_format($row->monto,'2')); ?></td>
    </tr>
<?php } ?>
	<tfoot>
		<tr style="background:#c0e0dc;">
		<th nowrap colspan="5" style="text-align:right !important;">
			Total Retirado: 
		</th>
		<th nowrap colspan="1">
			<?php echo "RD$ ".number_format($total,'2'); ?>
		</th>
		</tr>
	</tfoot>
<?php }else{
        echo "<tr>";
        echo "<td nowrap colspan='13 style='font-size:25px;' align='center'>No hay Retiros de Caja Realizados</td>";
        echo "</tr>";
}?>     
  </tbody>
</table>


</div>
</div>
</div>
</div>
</div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<script src="js/js_retiro.js"></script>
<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>