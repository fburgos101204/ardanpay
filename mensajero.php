<?php 
  $active_empresa = 'active';
  include_once("header/header.php");
if ($permisos->{'mensajero'} == "on"  || isset($_POST['location'])) {
  include_once("header/menu.php");
  include "php/mensajerocontroller.php";
  include "modal/modal_mensajero.php";
  include "modal/modal_pass_mensajero.php";
?>
<div id="content-wrapper">
<div class="container-fluid">

<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="">Registros Empresa</a>
</li>
<li class="breadcrumb-item active">Mensajeros</li>
</ol>
<div class="card mb-3">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
<p><i class="fas fa-biking"></i> Listado de Mensajeros</p>
<button type="button" style="float: right;" class="btn btn-light btn-mdax" data-toggle="modal" data-target="#modal_mensajero" onclick="new_mensajero('<?php echo $negocio; ?>','<?php echo $user_id; ?>')" title="Agregar Mensajero">Nuevo</button>
</div>
<div class="card-body">
  <div class="table-responsive" id="table_mensajero">
    <table class="table table-bordered datatable" width="100%" cellspacing="0">
        <thead>
          <th style="white-space:nowrap;">Mensajero</th>
          <th style="white-space:nowrap;">Usuario</th>
          <th style="white-space:nowrap;">Cédula</th>
          <th style="white-space:nowrap;">Teléfono</th>
          <th style="white-space:nowrap;">Correo</th>
          <th style="white-space:nowrap;">IMEI</th>
          <th></th>
        </thead>
    <tbody>
<?php
    $du = new MensajeroController();
    $rows = $du->read_mensajero($negocio);
    if ($rows->num_rows >= 1) {
    while($row = $rows->fetch_object()){
?>
    <tr>
      <td style="white-space:nowrap;"><?php print($row->nombre." ".$row->apellido); ?></td>
      <td style="white-space:nowrap;"><?php print($row->username); ?></td>
      <td style="white-space:nowrap;"><?php print($row->cedula); ?></td>
      <td style="white-space:nowrap;"><?php print($row->telefono); ?></td>
      <td style="white-space:nowrap;"><?php print($row->correo); ?></td>
      <td style="white-space:nowrap;"><?php print($row->imei); ?></td>
      <td style="white-space:nowrap;" align="center">
        <button type="button" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#modal_mensajero" onclick="open_mensajero('edit','<?php echo $row->id_mensajero; ?>','0','<?php echo $row->nombre; ?>','<?php echo $row->apellido; ?>','<?php echo $row->cedula?>','<?php echo $row->telefono?>','<?php echo $row->correo ?>','<?php echo $row->direccion ?>','<?php echo $row->imei ?>','<?php echo $row->dispositivo ?>','<?php echo $row->username ?>',null,0)"><i class="fas fa-edit" style="padding-left: 1px;"></i></button>

        <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#modal_pass_mensajero" onclick="pass('<?php print($row->id_mensajero); ?>')"><i class="fas fa-lock"></i></button>

        <button id="delete-user" name="delete-user" type="button" class="btn btn-danger btn-circle" onclick="delete_mensajero('<?php print($row->id_mensajero); ?>')"><i class="fas fa-trash-alt"></i></button>

      </td>
    </tr>
<?php } 
     }else{
            echo "<tr>";
            echo "<td colspan='10' style='font-size:25px;' align='center'>No results available</td>";
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
<script type="text/javascript" src="js/js_mensajero.js"></script>
<?php include_once("header/footer.php"); } ?>