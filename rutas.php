<?php 
  $active_empresa = 'active';
  $tabla = "Rutas";
  include_once("header/header.php");
if ($permisos->{'caja'} == "on"  || isset($_POST['location'])) {
  include_once("header/menu.php");
  include "php/rutacontroller.php";
  include "modal/modal_ruta.php";
  include "modal/modal_ruta_assign.php";
  include "modal/modal_assign_mensajero.php";
  include "modal/modal_assign_cliente.php";
?>
<div id="content-wrapper">
<div class="container-fluid">

<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="">Registros Empresa</a>
</li>
<li class="breadcrumb-item active"><?php echo $tabla; ?></li>
</ol>
<div class="card mb-3">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">  
<p><i class="fas fa-road"></i> Registro de Rutas</p>
<button type="button" style="float: right;" class="btn btn-light btn-mdax" data-toggle="modal" data-target="#modal_ruta" onclick="new_ruta('<?php echo $negocio; ?>')" title="Añadir Rutas">Nuevo</button>
</div>

<div class="card-body">
  <div class="table-responsive" id="ruta_tabla">
    <table class="table table-bordered datatable" width="100%" cellspacing="0">
        <thead>
          <th style="white-space:nowrap;">#</th>
          <th style="white-space:nowrap;">Ruta</th>
          <th style="white-space:nowrap;">Cant. Clientes</th>
          <th style="white-space:nowrap;">Cant. Mensajeros</th>
          <th style="white-space:nowrap;"></th>
        </thead>

        <tbody>
        <?php
          $du = new RutaController();
          $rows = $du->read_rutas($negocio);
          if ($rows->num_rows >= 1) {
          while($row = $rows->fetch_object()){
        ?>
        <tr>
          <td nowrap><?php print($row->id_ruta); ?></td>
          <td nowrap><?php print($row->direccion); ?></td>
          <td nowrap><?php print($row->total_cliente); ?></td>
          <td nowrap><?php print($row->total_mensajero); ?></td>
          <td nowrap align="center">
			<button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#modal_ruta_assign" onclick="open_ruta('update_ruta','<?php print($row->id_ruta); ?>','<?php print($row->direccion); ?>')" title="Modificar Rutas"><i class="fas fa-id-badge"></i></button>
            <button type="button" class="btn btn-danger btn-circle" onclick="Delete('<?php print($row->id_ruta); ?>')" title="Eliminar Rutas"><i class="fas fa-trash-alt"></i></button>
          </td>
        </tr>
        <?php } }else{
        echo "<tr>";
        echo "<td colspan='8' style='font-size:25px;' align='center'>No hay Registros</td>";
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
<script type="text/javascript" src="js/js_ruta.js"></script>
<script type="text/javascript" src="js/js_ruta_assign_drop.js"></script>
<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>