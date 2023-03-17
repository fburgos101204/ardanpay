<div class="modal fade" id="modal_metodo_pago" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="mediumModalLabel"></h5>
			<button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<div class="modal-body">
    <div id="alertPass"></div>
    <form id="data_metodo_pago" name="data_metodo_pago" autocomplete="off">
			<div class="form-group">
              <input type="hidden" id="id_pago" name="id_pago">
			  <?php if($negocio == 0){ ?>
			  <label>Negocio</label>
			  <select class="form-control" id="negocio" name="negocio">
				  <option selected value="0" disabled>Seleccione un negocio</option>
			  	<?php 
				require_once('config/db.php');
              	$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
				$query = "SELECT * FROM negocio";
				$rows = $con->query($query); 
                if ($rows->num_rows >= 1) {
                while ($row = $rows->fetch_object()) {  
				?>
				  <option value="<?php echo $row->id_negocio; ?>"><?php echo $row->nombre; ?></option>
				<?php }} ?>
				</select>
				<script> $('#negocio').select2(); </script>
				<?php }else{ ?>
				<input type="hidden" id="negocio" name="negocio">
				<?php } ?>
            </div>
          <div class="form-group">
              <label>Nombre Tarjeta</label>
          <input type="text" class="form-control text-uppercase" placeholder="Nombre Tarjeta" id="nombre_tarjeta" name="nombre_tarjeta">
          </div>
          <div class="form-row">
          <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 mb-2">
          <label>Número de Tarjeta</label>
    			<input type="text" class="form-control text-uppercase" maxlength="19" placeholder="Número de Tarjeta" id="card_number" name="card_number" onkeypress="card(event); if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
          </div>
          <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-2">
          <label>Tipo de Tarjeta</label>
          <input type="text" class="form-control text-uppercase" readonly id="tipo_tarjeta" placeholder="Tipo de Tarjeta"  name="tipo_tarjeta">
            </div>
            </div>
            <div class="form-group">
              <label for="cvv">CVV</label>
              <input type="text" class="form-control text-uppercase" maxlength="3" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" id="cvv" name="cvv" placeholder="CVV">
            </div>
            <label>Fecha de Expiración</label>
        	<div class="form-row">   
				<div class="form-group col">
					<label>Mes</label>
					<input type="text" class="form-control text-uppercase" name="month_expire" maxlength="2" id="month_expire" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" placeholder="MM">	
				</div>
				<div class="form-group col">
					<label>Año</label>
					<input type="text" class="form-control text-uppercase" name="year_expire" maxlength="4" id="year_expire" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" placeholder="YYYY">	
				</div>
			</div> 
      </form>
	</div>
	<div class="modal-footer">
			<button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>		
			<button type="button" class="btn btn-success font-weight-bold btn-mda" id="btn_update"><i class="fas fa-save"></i> Actualizar</button>
			<button type="button" class="btn btn-success font-weight-bold btn-mda" id="btn_save"><i class="fas fa-save"></i> Guardar</button>
			
			
	</div>

</div>
</div>
</div>