<?php 
  	$active_admin = 'active';
  	$tabla = "Método de Pagos";
  	include_once("header/header.php");
if ($permisos->{'banco'} == "on"  || isset($_POST['location'])) {
  	include_once("header/menu.php");
  	include "php/metodopagocontroller.php";
	include"modal/modal_metodo_pago.php";
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
<p><i class="fas fa-university"></i> Registro de Tarjetas</p>

<button type="button" style="float: right;" class="btn btn-light btn-mdax" data-toggle="modal" data-target="#modal_metodo_pago" onclick="new_pago('<?php echo $negocio; ?>')" title="Añadir Metodo de Pago">Nuevo</button>
</div>

<div class="card-body">
  <div class="table-responsive" id="pago_tabla">
    <table class="table table-bordered datatable" width="100%" cellspacing="0">
        <thead>
          	<?php if($negocio == 0){ ?>
        	<th nowrap>Negocio</th>
			<?php } ?>
        	<th style="white-space: nowrap;">Nombre Tarjeta</th>
        	<th style="white-space: nowrap;">Número de Tarjeta</th>
        	<th style="white-space: nowrap;">Tipo de Tarjeta</th>
        	<th style="white-space: nowrap;">CVV</th>
        	<th style="white-space: nowrap;">Fecha Expiración</th>
        	<th nowrap></th>
        </thead>
        <tbody class="hoverclass">
        <?php
          	$du = new MetodoPagoController();
          	if($negocio != 0)
			{
				$rows = $du->Mostrar($negocio);

		  	}
			else
			{
				$rows = $du->Mostrar_admin();
			}
								 
			if ($rows->num_rows >= 1) {
				while($row = $rows->fetch_object()){
				if($row->predeterminada == 1){ $color = "style='background-color:#C7DEC0'"; }else{ $color = ""; }
				$select = "data-toggle='modal' data-target='#modal_metodo_pago' ";
				$update_pago = '"update_pago"';
				$id_tarjeta_credito = '"'.$row->id_tarjeta_credito.'"';
				$nombre_tarjeta = '"'.$row->nombre_tarjeta.'"';
				$card_number = '"'.$row->card_number.'"';
				$card_name = '"'.$row->card_name.'"';
				$month_expire = '"'.$row->month_expire.'"';
				$year_expire = '"'.$row->year_expire.'"';
				$negocio_n = '"'.$row->negocio.'"';
				$negocio_a = '"'.$negocio.'"';
				$cvv = '""';
				$onclick = " onclick='open_pago($update_pago,$id_tarjeta_credito,
					 $nombre_tarjeta,$card_number,$card_name,$cvv,$month_expire,$year_expire,$negocio_n,$negocio_a)'";
        ?>
        <tr <?php echo $color; ?>>
          	<?php if($negocio == 0){ ?>
    	  	<td style="white-space: nowrap;" <?php echo $select.$onclick; ?>><?php print($row->n_negocio); ?></td>
			<?php } ?>
    		<td nowrap <?php echo $select.$onclick; ?>><?php print($row->nombre_tarjeta); ?></td>
    		<td style="white-space: nowrap;" <?php echo $select.$onclick; ?>><?php echo "**** **** **** ".substr($row->card_number,-4); ?></td>
    		<td style="white-space: nowrap;" <?php echo $select.$onclick; ?>><?php print($row->card_name); ?></td>
    		<td style="white-space: nowrap;" <?php echo $select.$onclick; ?>><?php print("***"); ?></td>
    		<td style="white-space: nowrap;" <?php echo $select.$onclick; ?>> <?php echo $row->month_expire." / ".$row->year_expire; ?></td>
			<td style="white-space: nowrap;" align="center">
			<?php if($row->predeterminada == 1){ ?>
			<button type="button" class="btn btn-dark btn-round" onclick="default_drop('<?php echo $row->id_tarjeta_credito; ?>')" title="Desasignar como predeterminado">
				<i class="fas fa-times-circle"></i></button>
			<?php }else{ ?>
			<button type="button"  class="btn btn-success  btn-round" 
				onclick="default_payment('<?php echo $row->id_tarjeta_credito; ?>','<?php echo $row->negocio; ?>')"  title="Asignar como predeterminado">
				<i class="fas fa-check-circle"></i></button>
			<?php } ?>
			<button type="button" 
					class="btn btn-danger  btn-round" onclick="delete_pago('<?php echo $row->id_tarjeta_credito; ?>')" title="Eliminar metodo de pago">
					<i class="fas fa-trash-alt"></i>
      		</button>
			</td>
        </tr>
        <?php 
			} }else{
        		echo "<tr>";
        		echo "<td colspan='8' style='font-size:25px;' align='center'>No hay Registros</td>";
        		echo "</tr>";
        	}	
		?>     
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
<script type="text/javascript" src="js/js_metodo_pago.js"></script>
<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>