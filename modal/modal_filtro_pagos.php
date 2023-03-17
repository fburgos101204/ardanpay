<div class="modal fade" id="modal_filtro_pagos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-filter"></i> Filtrar Pagos</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="alertcaja"></div>
         <form  name="data_filtro_pagos"  id="data_filtro_pagos" autocomplete="off">
            <input class="form-control" type="hidden" id="negocio" name="negocio">
            <div class="form-row">
            <div class="form-group col">
              <label for="desde">Desde</label>
              <input class="form-control" type="date" id="desde" name="desde" value="<?php echo date("Y-m-d"); ?>">
            </div>
            <div class="form-group col">
              <label for="hasta">Hasta</label>
              <input class="form-control" type="date" id="hasta" name="hasta" value="<?php echo date("Y-m-d"); ?>">
            </div>
			</div>
			<div class="form-row">
            <div class="form-group col">
              <label for="desde">Estado</label>
              <select class="form-control" id="estado" name="estado">
				<option>Todos</option>
				<option>Pagada</option>
				<option>Anulada</option>
			  </select>
            </div>
            <div class="form-group col">
              <label for="forma_pago">Forma de Pago</label>
			  <select class="form-control" id="forma_pago" name="forma_pago">
				<option>Caja</option>
				<option>Banco</option>
			  </select>
            </div>
			</div>
			<div class="form-row">
            <div class="form-group col">
              <label for="creado_por">Creador Por</label>
              <select class="form-control"  id="creado_por" name="creado_por">
				<option>Todos</option>
				<?php
                      require_once('config/db.php');
                      $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                      $query = "SELECT * FROM users WHERE negocio = $negocio";
                      $row3 = $con->query($query); 
                      if ($row3->num_rows >= 1) {
                        while ($row = $row3->fetch_object()) { ?>
                  <option value="<?php echo $row->user_id; ?>">
                    <?php echo $row->firstname." ".$row->lastname; ?>
                  </option>
                  <?php }} ?>
			  </select>
            </div>
            <div class="form-group col" id="hidden-caja">
              <label for="caja_pago">Caja</label>
			  <select class="form-control" id="caja_pago" name="caja_pago">
				<?php
                      require_once('config/db.php');
                      $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                      $query = "SELECT * FROM caja WHERE negocio = $negocio";
                      $row3 = $con->query($query); 
                      if ($row3->num_rows >= 1) {
                        while ($row = $row3->fetch_object()) { ?>
                  <option value="<?php echo $row->id_caja; ?>">
                    <?php echo $row->nombre; ?>
                  </option>
                  <?php }} ?>
			  </select>
            </div>
            <div class="form-group col" id="hidden-banco" style="display:none;">
              <label for="banco_pago">Banco</label>
			  <select class="form-control" id="banco_pago" name="banco_pago">
				<?php
                      require_once('config/db.php');
                      $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                      $query = "SELECT * FROM banco WHERE negocio = $negocio";
                      $row3 = $con->query($query); 
                      if ($row3->num_rows >= 1) {
                        while ($row = $row3->fetch_object()) { ?>
                  <option value="<?php echo $row->id_banco; ?>">
                    <?php echo $row->banco; ?>
                  </option>
                  <?php }} ?>
			  </select>
            </div>
			</div>
          </form>
      </div>
      <div class="modal-footer">
        <button id="btn_filtrar_pago" name="btn_filtrar_pago" type="button" class="btn btn-info font-weight-bold btn-mda" style="width:100%"><i class="fas fa-filter"></i> Filtrar</button>
      </div>
    </div>
  </div>
</div>