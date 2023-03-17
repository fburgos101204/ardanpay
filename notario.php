<?php 
  $active_empresa = 'active';
  include_once("header/header.php");
if ($permisos->{'notario'} == "on"  || isset($_POST['location'])) {
  	include_once("header/menu.php");
	include "php/notariocontroller.php";
	include "modal/modal_notario.php";
?>
<div id="content-wrapper">
<div class="container-fluid">

<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="">Registros Empresa</a>
</li>
<li class="breadcrumb-item active">Notarios</li>
</ol>
<div class="card mb-3">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
<p><i class="fas fa-gavel"></i> Listado Notarios</p>
<button type="button" style="float: right;" class="btn btn-light btn-mdax" data-toggle="modal" data-target="#modal_notario" onclick="new_notario('<?php echo $user_id; ?>','<?php echo $negocio; ?>')" title="Agregar Notario">Nuevo</button>
</div>
<div class="card-body">
<div class="table-responsive" id="notario_tabla">
<table class="table table-hover table-bordered table-condensed datatable">
  <thead>
    <th style="white-space:nowrap;">Creado Por</th>
    <th style="white-space:nowrap;">Nombre</th>
    <th style="white-space:nowrap;">Cédula</th>
    <th style="white-space:nowrap;">Código</th>
    <th style="white-space:nowrap;"></th>
  </thead>
<tbody>
<?php
    $du = new NotarioController();
    $rows = $du->read_all($negocio);
    if ($rows->num_rows >= 1) {
    while($row = $rows->fetch_object()){
?>
    <tr>
      <td style="white-space:nowrap;"><?php print($row->creadorn); ?></td>
      <td style="white-space:nowrap;"><?php print($row->nombre).' '.($row->apellido); ?></td>
      <td style="white-space:nowrap;"><?php print($row->cedula); ?></td>
      <td style="white-space:nowrap;"><?php print($row->codigo_colegio); ?></td>
      <td style="white-space:nowrap;" align="center">
        <button type="button" style="padding:10px 10px;" class="btn btn-primary btn-round" data-toggle="modal" data-target="#modal_notario" onclick="open_notario('update', '<?php print($row->id_notario); ?>', '<?php print($row->nombre); ?>','<?php print($row->apellido); ?>','<?php print($row->cedula); ?>', '<?php print($row->codigo_colegio); ?>','0')" title="Modificar Notario"><i class="fas fa-edit" style="padding-left: 1px;"></i></button>
        
        <button id="delete-user" style="padding:10px 10px;" name="delete-user" type="button" class="btn btn-danger btn-round" onclick="Delete('<?php print($row->id_notario); ?>')" title="Eliminar Notario"><i class="fas fa-trash-alt"></i></button>
      </td>
    </tr>
<?php } 
     }else{
        echo "<tr>";
        echo "<td nowrap colspan='10' style='font-size:25px;' align='center'>No hay Registros</td>";
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
<script type="text/javascript" src="js/js_notario.js"></script>
<script type="text/javascript" src="js/txt.js"></script>
<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>