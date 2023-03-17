<?php 
  $solicitud_prestamo = "active";
  include_once("header/header.php");
if ($permisos->{'sol_prestamo'} == "on" || isset($_POST['location'])) {
  include_once("header/menu.php");
  include "php/historial_solicitud.php";
  include_once("modal/modal_form_solicitud.php");
  include_once("modal/modal_solictud_prestamo.php");
  include_once("modal/modal_referencia.php");
  include_once("modal/modal_garante.php");
?>
<div id="content-wrapper">
<div class="container-fluid">
<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="">Solicitud de Préstamos</a>
</li>
<li class="breadcrumb-item active">Solicitudes</li>
</ol>
<div class="card mb-3" id="table_solicitud">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
<p><i class="fas fa-hand-holding-usd"></i> Solicitudes de Préstamos</p>
	
<?php if($negocio == 0 || ($cant_prestamo > $cant_prestamor_actual)){ ?>
<button type="button" style="float: right;" class="btn btn-light btn-mdax" data-toggle="modal" data-target="#modal_solicitud" onclick="new_solicitud('<?php echo $user_id; ?>','<?php echo $negocio; ?>')">Nuevo</button>
<?php } ?>
	
</div>
<div class="card-body" >
<div class="table-responsive">
<table class="table table-bordered datatable" id="dataTable" width="100%" cellspacing="0">
<thead>
  <th nowrap>Creado Por</th>
  <th nowrap>Cliente</th>
  <th nowrap>Monto a Prestar</th>
  <th nowrap>Estado</th>
</thead>

<tbody class="hoverclass">
<?php
    $du = new Historial_Solicitud();
    $rows = "";
    if ($nivel != 2) {
      $rows = $du->solicitudes($negocio,'negocio');
    }else{
      $rows = $du->solicitudes($user_id,'user');
    }
    if ($rows->num_rows >= 1) {
	$fecha_hoy = date("Y-m-d");
    while($row = $rows->fetch_object()){
    $modal = "modal_estado_solicitud";
    $proceso = "upload('$row->codigo_metodo','$row->id_metodo','$row->metodo','$row->id_solicitud','$row->id_cliente','$row->monto','$row->cuotas','$row->ciclo_pago','$row->interes','$row->t_interes','$row->fecha_inicio','$row->estado','$fecha_hoy')";

    if ($row->estado == "Aceptado") {

      $modal = "modal_estado_solicitud";
      $proceso = "upload('$row->codigo_metodo','$row->id_metodo','$row->metodo','$row->id_solicitud','$row->id_cliente','$row->monto','$row->cuotas','$row->ciclo_pago','$row->interes','$row->t_interes','$row->fecha_inicio','$row->estado','$row->fecha_creado')";
    }
?>
    <tr data-toggle="modal" data-target="#<?php echo $modal; ?>" data-id="1" onclick="<?php echo $proceso; ?>">
      
      <td nowrap><?php print($row->creador_name); ?></td>
      <td nowrap><?php print($row->nombre).' '.($row->apellido); ?></td>
      <td nowrap style="padding-right: 50px;"><?php print("RD$ ".number_format($row->monto,'2')); ?></td>
      <td nowrap>
		<?php 
		if ($row->estado != "Aceptado") {
			echo "<strong style='color:orange;'>".$row->estado."</strong>";
		}else{
			echo  "<strong style='color:green;'>".$row->estado."</strong>";
		} 
		?>
	  </td>
      <!--<td>
        <button data-toggle="modal" data-target="#modal_estado_solicitud" type="button" class="btn btn-success btn-circle" ><i class="material-icons">visibility</i></button>
        <?php if ($row->estado == "Aceptado"): ?>
          
        <button data-toggle="modal" data-target="#modal_crear_presamo" onclick="" class="btn btn-warning btn-circle" ><i class="material-icons">settings_input_component</i></button>
        <?php endif ?>


        <?php if ($nivel == 1): ?>
        <button type="button" style="padding:10px 10px;" class="btn btn-primary btn-round" data-toggle="modal" data-target="#modal_solicitud" onclick="open_solicitud('update_solicitud', '<?php print($row->id_solicitud); ?>', '<?php print($row->id_cliente); ?>', '<?php print($row->nombre); ?>','<?php print($row->apellido); ?>', '<?php print($row->sexo); ?>', '<?php print($row->telefono); ?>', '<?php print($row->estado_civil); ?>','<?php print($row->cedula); ?>', '<?php print($row->correo); ?>','<?php print($row->direccion); ?>', '<?php print($row->fecha_nacimiento); ?>', '<?php print($row->celular); ?>', '<?php print($row->tipo_vivienda); ?>', '<?php print($row->ocupacion); ?>', '<?php print($row->titulo); ?>', '<?php print($row->ingreso); ?>','<?php print($row->facebook); ?>', '<?php print($row->instagram); ?>', '<?php print($row->dependientes); ?>','<?php print($row->id_ref); ?>', '<?php print($row->nombre_ref); ?>', '<?php print($row->telefono_ref); ?>','<?php print($row->tipo_ref); ?>', '<?php print($row->parentesco); ?>','<?php print($row->monto); ?>','<?php print($row->cuotas); ?>', '<?php print($row->ciclo_pago); ?>','0')"><i class="material-icons">edit</i></button>
        <?php endif ?>
        <button id="delete-user" style="padding:10px 10px;" name="delete-user" type="button" class="btn btn-danger btn-round" onclick="Delete_solicitud('<?php print($row->id_solicitud); ?>')"><i class="material-icons">delete_forever</i></button>
      </td>-->

    </tr>
<?php } 
     }else{
        echo "<tr>";
        echo "<td colspan='7' style='font-size:25px;' align='center'>No hay Registros</td>";
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
<script type="text/javascript" src="js/subir_archivos.js"></script>
<script type="text/javascript" src="js/js_soli_to_prestamo.js"></script>
<script type="text/javascript" src="js/txt.js"></script>
<script type="text/javascript" src="js/js_garante.js"></script>
<script type="text/javascript" src="js/js_referencia.js"></script>
<script type="text/javascript" src="js/js_solicitud.js"></script>
<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>