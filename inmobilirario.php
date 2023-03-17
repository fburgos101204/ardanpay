<?php 
  $active_personal = 'active';
  include_once("header/header.php");
if ($permisos->{'inmobilirario'} == "on"  || isset($_POST['location'])) {
  include_once("header/menu.php");
include "php/inmobiliariacontroller.php";
include "modal/modal_inmobiliriario.php";
?>
<div id="content-wrapper">
<div class="container-fluid">
<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="">Registros Personales</a>
</li>
<li class="breadcrumb-item active">Inmobiliriarias</li>
</ol>
<div class="card mb-3">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
  <i class="fas fa-fw fa-building"></i> Mantenimiento de Inmobiliriarios
  <!--<button style="float: right;" class="btn btn-primary"  onclick="new_casa(<?php echo $user_id; ?>)" data-toggle="modal"  data-target="#modal_inmobiliriario" >Nuevo</button>-->
</div>

<div class="card-body" id="table_inmobiliario">
<div class="table-responsive">
<table class="table table-bordered table-hover datatable" width="100%" cellspacing="0">
<thead>
    <th style="white-space:nowrap;">Creado Por</th>
    <th style="white-space:nowrap;">Cliente</th>
    <th style="white-space:nowrap;">Tipo</th>
    <th style="white-space:nowrap;">Color</th>
    <th style="white-space:nowrap;">Dirección</th>
    <th style="white-space:nowrap;">Cant. Habitaciones</th>
    <th style="white-space:nowrap;">Cant. Baños</th>
    <th style="white-space:nowrap;">Cant. Cocina</th>
    <th style="white-space:nowrap;">Cant. Sala</th>
    <th style="white-space:nowrap;">Cant. Comedor</th>
    <th style="white-space:nowrap;">Descripción</th>
    <th style="white-space:nowrap;"></th>
  </thead>

  <tbody>
<?php
    $du = new InmobiliariaController();
    $rows = $du->read_all($negocio);
    if ($rows->num_rows >= 1) {
    while($row = $rows->fetch_object()){
?>
    <tr>
      <td style="white-space:nowrap;"><?php print($row->creador_name); ?></td>
      <td style="white-space:nowrap;"><?php print($row->cliente); ?></td>
      <td style="white-space:nowrap;"><?php print($row->tipo); ?></td>
      <td style="white-space:nowrap;"><?php print($row->color); ?></td>
      <td style="white-space:nowrap;"><?php print($row->direccion); ?></td>
      <td><?php print($row->habitacion); ?></td>
      <td><?php print($row->bano); ?></td>
      <td><?php print($row->cocina); ?></td>
      <td><?php print($row->sala); ?></td>
      <td><?php print($row->comedor); ?></td>
      <td style="white-space:nowrap;"><?php print($row->descripcion); ?></td>
      <td style="white-space:nowrap;" align="center">
        <button type="button" style="padding:10px 10px;" class="btn btn-primary  btn-round" data-toggle="modal"  data-target="#modal_inmobiliriario" onclick="open_casa('update_casa', '<?php print($row->id_inmobiliaria); ?>', '<?php print($row->tipo); ?>','<?php print($row->color); ?>','<?php print($row->direccion); ?>', '<?php print($row->habitacion); ?>','<?php print($row->bano); ?>', '<?php print($row->cocina); ?>', '<?php print($row->sala); ?>', '<?php print($row->comedor); ?>', '<?php print($row->descripcion); ?>','0','<?php echo $row->foto_1; ?>','<?php echo $row->foto_3; ?>','<?php echo $row->foto_2; ?>')" title="Modificar Inmobiliario"><i class="fas fa-edit" style="padding-left: 1px;"></i></button>

        <!--<button id="delete-user" style="padding:10px 10px;" name="delete-user" type="button" class="btn btn-danger btn-round" onclick="Delete('<?php print($row->id_inmobiliaria); ?>')"><i class="material-icons">delete_forever</i></button>-->

      </td>
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
</div>
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<script type="text/javascript" src="js/js_inmobiliario.js"></script>
<script type="text/javascript" src="js/subir_archivos.js"></script>
<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>