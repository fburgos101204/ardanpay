<?php 
  $active_admind = 'active';
  include_once("header/header.php");
if (($permisos->{'plan'} == "on" && $negocio == 0) || isset($_POST['location'])) {
  include_once("header/menu.php");
  include "php/plancontroller.php";
  include "modal/modal_plan.php";
?>
<style>
/*---- Debe quedarse en Usuarios ---- */
	.tab-content > .active { display: flex;}
</style>
<div id="content-wrapper">
<div class="container-fluid">
<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="">Servicios</a>
</li>
<li class="breadcrumb-item active">Planes</li>
</ol>
<div class="card mb-3">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
<p><i class="fa fa-flag"></i> Listado Planes</p>
<button type="button" style="float: right;" class="btn btn-light btn-mdax" data-toggle="modal" data-target="#modal_plan" onclick="new_plan()">Nuevo</button>
</div>
<div class="card-body">
<div class="table-responsive" id="plan_tabla">
<table class="table table-hover table-bordered table-condensed datatable">
  <thead>
    <th style="white-space: nowrap;">Plan</th>
    <th style="white-space: nowrap;">Cant. Usuarios</th>
    <th style="white-space: nowrap;">Cant. Préstamos</th>
    <th style="white-space: nowrap;">Precio</th>
    <th style="white-space: nowrap;"></th>
  </thead>
<tbody>
<?php
    $result = new PlanController();
    $rows = $result->read_plan();
    if ($rows->num_rows >= 1) {
    while($row = $rows->fetch_object()){
?>
    <tr>
      <td style="white-space: nowrap;"><?php echo $row->plan; ?></td>
      <td style="white-space: nowrap;"><?php echo $row->cant_user; ?></td>
      <td style="white-space: nowrap;"><?php echo $row->cant_prestamo; ?></td>
      <td style="white-space: nowrap;"><?php echo "RD$ ".number_format($row->precio,2); ?></td>
      <td style="white-space: nowrap;" align="center">
        <button type="button" style="padding:10px 10px;" class="btn btn-primary btn-round" data-toggle="modal" data-target="#modal_plan" onclick="open_plan('update_plan','<?php echo $row->id_plan; ?>','<?php echo $row->plan; ?>','<?php echo $row->cant_user; ?>','<?php echo $row->cant_prestamo; ?>','<?php echo $row->precio; ?>')"><i class="fas fa-edit"></i></button>
		<input type="hidden" value='<?php echo $row->permisos ?>' name='<?php echo $row->id_plan; ?>' id='<?php echo $row->id_plan; ?>'>
        <button style="padding:10px 10px;" type="button" class="btn btn-danger btn-round" onclick="drop_plan('<?php echo $row->id_plan; ?>')"><i class="fas fa-trash-alt"></i></button>
      </td>
    </tr>
<?php } 
     }else{
        echo "<tr>";
        echo "<td colspan='10' style='font-size:25px;' align='center'>No hay Registros</td>";
        echo "</tr>";
} ?>     
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
<script type="text/javascript" src="js/js_plan.js"></script>
<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>