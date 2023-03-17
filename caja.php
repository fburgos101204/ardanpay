<?php 
  $active_empresa = 'active';
  $tabla = "Cajas";
  include_once("header/header.php");
if ($permisos->{'caja'} == "on"  || isset($_POST['location'])) {
  include_once("header/menu.php");
  include "php/cajacontroller.php";
  include "modal/modal_caja.php";
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
<p><i class="fas fa-box-open"></i> Registro de Caja</p>
<button type="button" style="float: right;" class="btn btn-light btn-mdax" data-toggle="modal" data-target="#modal_caja" onclick="new_caja('<?php echo $user_id; ?>','<?php echo $negocio; ?>')" title="Añadir Caja">Nuevo</button>
</div>

<div class="card-body">
  <div class="table-responsive" id="caja_tabla">
    <table class="table table-bordered datatable" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <!--th>Registrada Por</th-->
          <th style="white-space:nowrap;">Nombre</th>
          <th style="white-space:nowrap;">Monto en Caja</th>
          <th style="white-space:nowrap;"></th>
        </thead>

        <tbody>
        <?php
          $du = new CajaController();
          $rows = $du->read_caja($negocio);
          if ($rows->num_rows >= 1) {
          while($row = $rows->fetch_object()){
        ?>
        <tr>
          <!--td><?php print($row->creado); ?></td-->
          <td nowrap><?php print($row->nombre); ?></td>
          <td nowrap><?php print("RD$ ".number_format($row->monto,'2')); ?></td>
          <td nowrap align="center">
            <button type="button" class="btn btn-primary btn-round" data-toggle="modal" data-target="#modal_caja" onclick="open_caja('update_caja','<?php echo $row->id_caja; ?>','<?php echo $row->nombre; ?>','<?php echo $row->monto; ?>',0,0)" title="Modificar Caja"><i class="fas fa-edit" style="padding-left: 1px;"></i></button>

            <button type="button" class="btn btn-danger btn-round" onclick="Delete('<?php print($row->id_caja); ?>')" title="Eliminar Caja"><i class="fas fa-trash-alt"></i></button>
          </td>
        </tr>
        <?php } }else{
        echo "<tr>";
        echo "<td nowrap colspan='8' style='font-size:25px;' align='center'>No hay Registros</td>";
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
<script type="text/javascript" src="js/js_caja.js"></script>
<script type="text/javascript" src="js/txt.js"></script>
<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>