<?php 
  $active_personal = 'active';
  $tabla = "Clientes";
  include_once("header/header.php");
if ($permisos->{'cliente'} == "on"  || isset($_POST['location'])) {
  include_once("header/menu.php");
  include "php/clientecontroller.php";
  include "modal/modal_cliente.php";
  include "modal/modal_referencia.php";
  include "modal/modal_garante.php";
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
<p><i class="fas fa-users"></i> Mantenimiento de Clientes</p>
<!--a href="backup_datos/backup_cliente.php?negocio=<?php echo $negocio; ?>" style="float: right;color:green;margin-left:10px;"class="btn btn-sucess">Exportar</a-->
	
<button type="button" style="float: right;" class="btn btn-light btn-mdax" data-toggle="modal" data-target="#modal_cliente" onclick="new_cliente('<?php echo $user_id; ?>','<?php echo $negocio; ?>')" title="Añadir Cliente">Nuevo</button>

</div>
<div class="card-body">
  <div class="table-responsive" id="cliente_tabla">
    <table class="table table-bordered datatable" width="100%" cellspacing="0">
        <thead>
          <th nowrap>Creado Por</th>
          <th nowrap>Foto</th>
          <th nowrap>Nombre</th>
          <th nowrap>Teléfono</th>
          <th nowrap>Cédula</th>
          <th nowrap>Correo</th>
          <th nowrap>Dirección</th>
          <th nowrap></th>
        </thead>

        <tbody id="table_prueba_cliente">
        <?php
          $du = new ClienteController();
          $rows = $du->read_all($negocio);
          if ($rows->num_rows >= 1) {
          while($row = $rows->fetch_object()){
        ?>
        <tr>
          <td nowrap><?php print($row->creador_name); ?></td>
          <td nowrap><img src="<?php print(substr($row->path_img_cliente,3)); ?>" width="50"></td>
          <td nowrap><?php print($row->nombre).' '.($row->apellido); ?></td>
          <td nowrap><?php print($row->telefono); ?></td>
          <td nowrap><?php print($row->cedula); ?></td>
          <td nowrap><?php print($row->correo); ?></td>
          <td nowrap><?php print($row->direccion); ?></td>
          <td nowrap align="center">
			<?php 
			if ($permisos->{'modificar_cliente'} == "on"){ 
				$habilitado = "style='display:none;'"; 
				$deshabilitado = "";
			}else{ 
				$deshabilitado = "style='display:none;'"; 
				$habilitado = "";
			} 
		  ?>
            <button type="button" <?php echo $deshabilitado; ?> id="btn_mdf_cliente" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#modal_cliente" onclick="open_cliente('update_cliente', '<?php print($row->id_cliente); ?>', '<?php print($row->nombre); ?>','<?php print($row->apellido); ?>', '<?php print($row->sexo); ?>', '<?php print($row->telefono); ?>', '<?php print($row->estado_civil); ?>','<?php print($row->cedula); ?>', '<?php print($row->correo); ?>','<?php print($row->direccion); ?>', '<?php print($row->fecha_nacimiento); ?>', '<?php print($row->celular); ?>', '<?php print($row->tipo_vivienda); ?>', '<?php print($row->ocupacion); ?>', '<?php print($row->titulo); ?>', '<?php print($row->ingreso); ?>','<?php print($row->facebook); ?>', '<?php print($row->instagram); ?>', '<?php print($row->dependientes); ?>','<?php print($row->path_img_cliente); ?>', '<?php print($row->path_cedula); ?>','0','0', '<?php print($row->nacionalidad); ?>')"><i class="fas fa-edit" style="padding-left: 1px;"></i></button>
			<button class="btn btn-primary btn-circle" <?php echo $habilitado; ?> onclick="onload_validar_btn('btn_mdf_cliente')" data-toggle='modal' data-target='#modal_seguridad' title="Modificar Cliente"><i class="fas fa-edit" style="padding-left: 1px;"></i></button>
			  
			<?php 
			if ($permisos->{'eliminar_cliente'} == "on"){ 
				$habilitado = "style='display:none;'"; 
				$deshabilitado = "";
			}else{ 
				$deshabilitado = "style='display:none;'"; 
				$habilitado = "";
			} 
		  	?>
            <button id="delete-user" name="delete-user" <?php echo $deshabilitado; ?>  type="button" class="btn btn-danger btn-circle" onclick="Delete('<?php print($row->id_cliente); ?>')"  title="Eliminar Cliente"><i class="fas fa-trash-alt"></i></button>
			<button class="btn btn-danger btn-circle"  <?php echo $habilitado; ?> onclick="onload_validar_btn('delete-user')" data-toggle='modal' data-target='#modal_seguridad' title="Eliminar Cliente"><i class="fas fa-trash-alt"></i></button>
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
<script type="text/javascript" src="js/txt.js"></script>
<script type="text/javascript" src="js/subir_archivos.js"></script>
<script type="text/javascript" src="js/js_garante.js"></script>
<script type="text/javascript" src="js/js_referencia.js"></script>
<script type="text/javascript" src="js/js_cliente.js"></script>

<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>