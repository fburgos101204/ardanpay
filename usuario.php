<?php 
  $active_admin = 'active';
  include_once("header/header.php");
if ($permisos->{'usuario'} == "on"  || isset($_POST['location'])) {
  include_once("header/menu.php");
  include "php/UserController.php";
  include "modal/modal_users.php";
  include "modal/reset-pass.php";
?>

<style>
/*---- Debe quedarse en Usuarios ---- */
	.tab-content > .active { display: flex;}
</style>
<div id="content-wrapper">
<div class="container-fluid">

<ol class="breadcrumb"> 
<li class="breadcrumb-item">
  <a href="">Administración</a>
</li>
<li class="breadcrumb-item active">Usuarios</li>
</ol>
<div class="card mb-3"  id="rUsers">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
<p><i class="fas fa-user-cog"></i> Listado Usuario</p>

<?php if($negocio == 0 || ($cant_user > $cant_user_actual)){ ?>
<button type="button" style="float: right;" class="btn btn-light btn-mdax" data-toggle="modal" data-target="#User" onclick="newCbUser('<?php echo $negocio; ?>')"  title="Añadir Usuario">Nuevo</button>
<?php } ?>
</div>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered datatable" width="100%" cellspacing="0">
        <thead>
	      <?php if ($negocio == 0) { ?>
          <th style="white-space: nowrap;">Negocio</th>
	 	  <?php } ?>
          <th style="white-space: nowrap;">Tipo Usuario</th>
          <th style="white-space: nowrap;">Usuario</th>
          <th style="white-space: nowrap;">Nombre</th>
          <th style="white-space: nowrap;">Correo</th>
          <th style="white-space: nowrap;">Fecha Creación</th>
          <th style="white-space: nowrap;"></th>
        </thead>
    <tbody>
<?php
    $du = new CbUserController();
    $rows = $du->readAll($negocio);
    if ($rows->num_rows >= 1) {
    while($row = $rows->fetch_object()){
?>
    <tr>
	<?php if ($negocio == 0) { ?>
	 <td style="white-space: nowrap;">
        <?php 
          if ($row->negocios == Null) {
            $tipo = "Xilus Financiera";
          }else{
            $tipo = $row->negocios;
          }
          print($tipo); 
        ?>
      </td>
	  <?php } ?>
      <td style="white-space: nowrap;">
        <?php 
          if ($row->nivel == 1) {
            $tipo = "Administrador";
          }else if ($row->nivel == 2) {
            $tipo = "Secretaria";
          }else if ($row->nivel == 3) {
            $tipo = "Inspector";
          }
          print($tipo); 
        ?>
      </td>
      <td style="white-space: nowrap;"><?php print($row->user_name); ?></td>
      <td style="white-space: nowrap;"><?php print($row->firstname).' '.($row->lastname); ?></td>
      <td style="white-space: nowrap;"><?php print($row->user_email); ?></td>
      <td style="white-space: nowrap;"><?php print(date("Y-m-d",strtotime($row->date_added))); ?></td>
      <td style="white-space: nowrap;" align="center">
        <button type="button" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#User" onclick="openCbUser('edit', '<?php print($row->user_id); ?>', '<?php print($row->firstname); ?>','<?php print($row->lastname); ?>', '<?php print($row->user_name); ?>','<?php print($row->user_email); ?>','<?php print($row->nivel); ?>','<?php print($row->negocio); ?>')" title="Editar Usuario"><i class="fas fa-edit"></i></button>

        <input type="hidden" value='<?php echo $row->permisos ?>' name='<?php echo $row->user_id; ?>' id='<?php echo $row->user_id; ?>'>
        
        <button id="pass-user" name="pass-user" type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#Pass-User" onclick="pass('<?php print($row->user_id); ?>')" title="Cambiar Contraseña"><i class="fas fa-lock"></i></button>

        <button id="delete-user" name="delete-user" type="button" class="btn btn-danger btn-circle" onclick="delete_user('top','center','<?php print($row->firstname).' '.($row->lastname); ?>','<?php print($row->user_id); ?>')" title="Eliminar Usuario"><i class="fas fa-trash-alt"></i></button>

      </td>
    </tr>
<?php } 
     }else{
            echo "<tr>";
            echo "<td colspan='5' style='font-size:25px;' align='center'>No results available</td>";
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
<script type="text/javascript" src="js/js_usuario_plan.js"></script>
<script type="text/javascript" src="js/js_users.js"></script>
<?php include_once("header/footer.php"); } ?>