<?php 
  $active_admind = 'active';
  include_once("header/header.php");
if (($permisos->{'negocio'} == "on" && $negocio == 0) || isset($_POST['location'])) {
  	include_once("header/menu.php");
	include "php/negociocontroller.php";
	include "modal/modal_negocio.php";
?>
<div id="content-wrapper">
<div class="container-fluid">
<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="">Servicios</a>
</li>
<li class="breadcrumb-item active">Negocios</li>
</ol>
<div class="card mb-3">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
<p><i class="fas fa-business-time"></i> Listado Negocios</p>
<button type="button" style="float: right;" class="btn btn-light btn-mdax" data-toggle="modal" data-target="#modal_negocio" onclick="new_negocio()" title="Agregar Negocio">Nuevo</button>
</div>
<div class="card-body">
<div class="table-responsive" id="negocio_tabla">
<table class="table table-hover table-bordered table-condensed datatable">
  <thead>
    <th style="white-space: nowrap;">Plan</th>
	  <th style="white-space: nowrap;">Cuota</th>
    <th style="white-space: nowrap;">Nombre</th>
    <th style="white-space: nowrap;">Estado</th>
    <th></th>
  </thead>
<tbody>
<?php
    $du = new NegocioController();
    $rows = $du->read_all();
    if ($rows->num_rows >= 1) {
    	while($row = $rows->fetch_object()){
?>
    <tr>
      <td style="white-space: nowrap;"><?php print($row->plan); ?></td>
      <td style="white-space: nowrap;"><?php print("RD$ ".number_format($row->precio,2)); ?></td>
      <td style="white-space: nowrap;"><?php print($row->nombre); ?></td>
      <td style="white-space: nowrap;">
		  <?php 
				if($row->estado == 1){ echo "<strong style='color:green;'>Habilitado</strong>"; }
				else{ echo "<strong style='color:red;'>Deshabilitado</strong>"; }
		  ?>
	  </td>
      <td style="white-space: nowrap;" align="center">
        <button type="button" style="padding:10px 10px;" class="btn btn-primary btn-round" data-toggle="modal" data-target="#modal_negocio" onclick="open_negocio('update', '<?php print($row->id_negocio); ?>', '<?php print($row->nombre); ?>', '<?php print($row->estado); ?>','<?php print($row->id_plan); ?>','<?php print($row->fecha_pago); ?>','<?php print($row->modalidad); ?>','<?php print($row->email); ?>','<?php print($row->telefono); ?>')" title="Modificar Negocio"><i class="fas fa-edit"></i></button>
		  
        <button id="delete-user" style="padding:10px 10px;" name="delete-user" type="button" class="btn btn-danger btn-round" onclick="Delete('<?php print($row->id_negocio); ?>')" title="Eliminar Negocio"><i class="fas fa-trash-alt"></i></button>
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
<script type="text/javascript" src="js/js_negocio.js"></script>
<script type="text/javascript" src="js/txt.js"></script>
<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>