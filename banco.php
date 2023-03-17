<?php 
  $active_empresa = 'active';
  $tabla = "Bancos";
  include_once("header/header.php");
if ($permisos->{'banco'} == "on"  || isset($_POST['location'])) {
  include_once("header/menu.php");
  include "php/bancocontroller.php";
  include "modal/modal_banco.php";
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
<p><i class="fas fa-university"></i> Registro de Bancos</p>

<button type="button" style="float: right;" class="btn btn-light btn-mdax" data-toggle="modal" data-target="#modal_banco" onclick="new_banco('<?php echo $user_id; ?>','<?php echo $negocio; ?>')" title="Añadir Banco">Nuevo</button>
</div>

<div class="card-body">
  <div class="table-responsive" id="banco_tabla">
    <table class="table table-bordered datatable" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <!--th>Registrada Por</th-->
          <th style="white-space:nowrap;">Banco</th>
          <th style="white-space:nowrap;">Titular</th>
          <th style="white-space:nowrap;">Fecha Venc.</th>
          <th style="white-space:nowrap;">Monto</th>
          <th style="white-space:nowrap;"></th>
        </thead>

        <tbody>
        <?php
          $du = new BancoController();
          $rows = $du->read_banco($negocio);
          if ($rows->num_rows >= 1) {
          while($row = $rows->fetch_object()){
        ?>
        <tr>
          <!--td><?php print($row->creado); ?></td-->
          <td nowrap><?php print($row->banco); ?></td>
          <td nowrap><?php print($row->titular); ?></td>
          <td nowrap><?php print($row->fecha_vencimiento); ?></td>
          <td nowrap><?php print("RD$ ".number_format($row->monto,'2')); ?></td>
          <td nowrap align="center">
            <button type="button" class="btn btn-primary btn-round" data-toggle="modal" data-target="#modal_banco" onclick="open_banco('update_banco','<?php echo $row->id_banco; ?>','<?php echo $row->banco; ?>','<?php echo $row->titular; ?>','<?php echo $row->fecha_vencimiento; ?>','<?php echo $row->monto; ?>',0,0)" title="Modificar Banco"><i class="material-icons">edit</i></button>

            <button type="button" class="btn btn-danger btn-round" onclick="Delete('<?php print($row->id_banco); ?>')" title="Eliminar Banco"><i class="fas fa-trash-alt"></i></button>
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
<script type="text/javascript" src="js/js_banco.js"></script>
<script type="text/javascript" src="js/txt.js"></script>
<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>