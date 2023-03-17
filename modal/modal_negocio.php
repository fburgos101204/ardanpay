<div class="modal fade" id="modal_negocio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		
      <div class="modal-body">
         <div id="alertPass"></div>
         <form  name="data_negocio"  id="data_negocio" autocomplete="off">
			 
			<div class="form-row">
				
			<div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
              <label for="plan_negocio" class="control-label">Plan</label>
              <select class="js-example-basic-single" name="plan_negocio" id="plan_negocio">
                <?php
                      require_once('config/db.php');
                      $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                      $query = "SELECT * FROM planes";
                      $row3 = $con->query($query); 
                      if ($row3->num_rows >= 1) {
                        while ($row = $row3->fetch_object()) { ?>
                  <option value="<?php echo $row->id_plan; ?>"><?php echo $row->plan; ?></option>
                  <?php }} ?>
              </select>
            </div>
				
			<div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
              <label for="proximo_pago" class="control-label">Próximo Pago</label>
              <input type="date" class="form-control" name="proximo_pago" id="proximo_pago" value="<?php echo date("Y-m-d"); ?>">
            </div>
				
			<div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
              <label for="prx_pago" class="control-label">Modalidad</label>
			  <select class="form-control" name="modalidad" id="modalidad">
                  <option value="30">Mensual</option>
                  <option value="182">Semestral</option>
                  <option value="365">Anual</option>
			  </select>
            </div>
				
            </div>
			 
			 
            <div class="form-row mt-2">
            	<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
            	<input type="hidden" id="id_negocio" name="id_negocio">
            	<div class="form-label-group">
              		<input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre de Negocio">
              		<label for="nombre">Nombre de Negocio</label>
            	</div>
				</div>
				<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
            	<div class="form-label-group">
              		<input class="form-control" type="text" id="email" name="email"
						   placeholder="Correo Electronico"  maxlength="100">
              		<label for="email">Correo Electrónico</label>
            	</div>
				</div>
			</div>
			 	
			 	
            <div class="form-row">
				<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
            	<div class="form-label-group">
              		<input class="form-control" type="text" id="telefono"
							name="telefono" placeholder="Telefono" 
						   onkeypress="phone(); if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" 
						   maxlength="12">
              		<label for="telefono">Teléfono</label>
            	</div>
				</div>
            	<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
              		<select class="form-control" id="estado_negocio" name="estado_negocio" style="min-height: 50px !important;">
						<option selected disabled value="-1">Estado</option>
						<option value="0">Deshabilitado</option>
						<option value="1">Habilitado</option>
			  		</select>
            	</div>
			</div>
		  
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>

        <button id="update_negocio" name="update_negocio" type="button" class="btn btn-success font-weight-bold btn-mda"><i class="fas fa-save"></i> Actualizar</button>

        <button id="save_negocio" name="save_negocio" type="button" class="btn btn-success font-weight-bold btn-mda"><i class="fas fa-save"></i> Registrar</button>
      </div>
    </div>
  </div>
</div>