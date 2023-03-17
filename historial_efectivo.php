<?php 
  $active_admind = 'active';
  	include_once("header/header.php");
if (($permisos->{'pago_efectivo'} == "on" && $negocio == 0) || isset($_POST['location'])) {

  	include_once("header/menu.php");
	include "php/historialefectivocontroller.php";
	include "modal/modal_pago_efectivo.php";
?>
<div id="content-wrapper">
<div class="container-fluid">
<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="">Servicios</a>
</li>
<li class="breadcrumb-item active">Pagos Efectivo</li>
</ol>
<div class="card mb-3">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
  <p><i class="fas fa-money"></i> Pagos en Efectivo</p>
  <button style="float: right;" class="btn btn-light btn-mdax"  onclick="new_pago_efectivo('<?php echo $user_id; ?>')" data-toggle="modal"  data-target="#modal_pago_efectivo" >Nuevo</button>
</div>
<div class="card-body" id="table_pago_efectivo">
<div class="table-responsive">
<table class="table table-bordered table-hover datatable" width="100%" cellspacing="0">
<thead>
    <th style="white-space: nowrap;">Crobrado Por</th>
    <th style="white-space: nowrap;">Plan</th>
    <th style="white-space: nowrap;">Precio</th>
    <th style="white-space: nowrap;">Negocio</th>
    <th style="white-space: nowrap;">Fecha Pago</th>
  </thead>

  <tbody>
<?php
    $du = new HistorialEfectivoController();
    $rows = $du->read_efectivo();
    if ($rows->num_rows >= 1) {
    while($row = $rows->fetch_object()){
?>
    <tr>
      <td style="white-space: nowrap;"><?php print($row->cobrado_por); ?></td>
      <td style="white-space: nowrap;"><?php print($row->plan); ?></td>
      <td style="white-space: nowrap;"><?php print("RD$ ".number_format($row->precio,2)); ?></td>
      <td style="white-space: nowrap;"><?php print($row->nombre); ?></td>
      <td style="white-space: nowrap;"><?php print($row->fecha_pago); ?></td>
    </tr>
<?php } 
     }else{
        echo "<tr>";
        echo "<td colspan='12' style='font-size:25px;' align='center'>No hay Registros</td>";
        echo "</tr>";
}?>     
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
<script type="text/javascript" src="js/js_pago_efectivo.js"></script>
<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>