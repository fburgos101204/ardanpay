<?php 
  $active_personal = 'active';
  $tabla = "Vehículos";
  include_once("header/header.php");
if ($permisos->{'vehiculo'} == "on"  || isset($_POST['location'])) {
  include_once("header/menu.php");
  include "php/vehiculocontroller.php";
  include "modal/modal_vehiculo.php";
?>
<div id="content-wrapper">
<div class="container-fluid">

<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="">Registros Personales</a>
</li>
<li class="breadcrumb-item active"><?php echo $tabla; ?></li>
</ol>
<div class="card mb-3">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">  
<i class="fas fa-car"></i> Mantenimiento de Vehículos
</div>
<div class="card-body">
  <div class="table-responsive" id="cliente_tabla">
    <table class="table table-bordered datatable" width="100%" cellspacing="0">
        <thead>
          <th nowrap>Propietario</th>
          <th nowrap>Marca</th>
          <th nowrap>Modelo</th>
          <th nowrap>Año</th>
          <th nowrap>Color</th>
          <th nowrap>Tipo</th>
          <th nowrap>Matrícula</th>
          <th nowrap>Acción</th>
        </thead>
        <tbody id="table_prueba_cliente">
        <?php
          $du = new VehiculoController();
          $rows = $du->read_all($negocio);
          if ($rows->num_rows >= 1) {
          while($row = $rows->fetch_object()){
        ?>
        <tr>
          <td nowrap><?php print($row->cliente); ?></td>
          <td nowrap><?php print($row->marca); ?></td>
          <td nowrap><?php print($row->modelo); ?></td>
          <td nowrap><?php print($row->tiempo); ?></td>
          <td nowrap><?php print($row->color); ?></td>
          <td nowrap><?php print($row->tipo); ?></td>
          <td nowrap><?php print($row->matricula); ?></td>
          <td nowrap align="center">
            <button type="button" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#modal_vehiculo" onclick="open_vehiculo('<?php echo $row->id_vehiculo; ?>','<?php echo $row->marca; ?>','<?php echo $row->modelo; ?>','<?php echo $row->tiempo; ?>','<?php echo $row->color; ?>','<?php echo $row->tipo; ?>','<?php echo $row->matricula; ?>','<?php echo $row->foto_1; ?>','<?php echo $row->foto_3; ?>','<?php echo $row->foto_4; ?>','<?php echo $row->foto_2; ?>')" title="Modificar Vehiculo"><i class="fas fa-edit" style="padding-left: 1px;"></i></button>

            <!--<button id="delete-user" name="delete-user" type="button" class="btn btn-danger btn-circle" onclick="drop_vehiculo('<?php print($row->id_vehiculo); ?>')"><i class="material-icons">delete_forever</i></button>-->
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
</div>
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<script type="text/javascript" src="js/js_vehiculo.js"></script>
<script type="text/javascript" src="js/subir_archivos.js"></script>
<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>