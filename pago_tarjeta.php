<?php 
  $active_admind = "active";
  include_once("header/header.php");
if (($permisos->{'pago_tarjeta'} == "on" && $negocio == 0) || isset($_POST['location'])) {
  include_once("header/menu.php");
  include "php/historialefectivocontroller.php";
?>
<div id="content-wrapper">
<div class="container-fluid">
<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="">Servicios</a>  
</li>
<li class="breadcrumb-item active">Pagos Tarjeta</li>
</ol>
<div class="card mb-3">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
<i class="fa fa-id-card" aria-hidden="true"></i> Histórico de Pagos de Tarjetas
</div>
<div class="card-body" id="table_solicitud">
<div class="table-responsive">
<table class="table table-hover table-bordered table-condensed datatable">
<thead>
    <tr>
        <th style="white-space: nowrap;">Negocio</th>
        <th style="white-space: nowrap;">No. de Orden</th>
        <th style="white-space: nowrap;">Fecha</th>
        <th style="white-space: nowrap;">Número de Tarjeta</th>
        <th style="white-space: nowrap;">Monto</th>
        <th style="white-space: nowrap;">Estado</th>
    </tr>
</thead>
<tbody>
<?php
$du = new HistorialEfectivoController();
$rows = $du->read_pagos_tarjeta();
if ($rows->num_rows >= 1) {
while($row = $rows->fetch_object()){  ?>
<tr>
  <td style="white-space: nowrap;"><?php print($row->negocio); ?></td>
  <td style="white-space: nowrap;"><?php print($row->order_number); ?></td>
  <td style="white-space: nowrap;"><?php echo date("d/m/Y", strtotime($row->created)); ?></td>
  <td style="white-space: nowrap;"><?php print("**** **** **** ".substr($row->card_num,-4)); ?></td>
  <td style="white-space: nowrap;">RD$ <?php echo number_format($row->paid_amount); ?></td>  
  <td style="white-space: nowrap;"><?php echo $row->payment_status; ?></td>
</tr>
<?php }  }else{  echo "<tr>";  echo "<td colspan='10' style='font-size:20px; font-weight: 400; height: 100px;' align='center'><i class='fas fa-eye-slash'></i> No hay pagos realizados.</td>";  echo "</tr>"; }?> 
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
<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>