<div class="modal fade" id="modal_pago_efectivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-money"></i> Registrar Pago en Efectivo</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
         <div id="alertcaja"></div>
         <form  name="data_pago_efectivo"  id="data_pago_efectivo" autocomplete="off">
            <input type="hidden" id="crd" name="crd">
            <div class="form-row">
            <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
              <label for="negocio">Negocio</label>
              <select class="js-example-basic-single" id="negocio" name="negocio">
				  <?php
                      require_once('config/db.php');
                      $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                      $query = "SELECT * FROM negocio";
                      $row3 = $con->query($query); 
                      if ($row3->num_rows >= 1) {
                        while ($row = $row3->fetch_object()) { ?>
                  <option value="<?php echo $row->id_negocio; ?>">
                    <?php echo $row->nombre; ?>
                  </option>
                  <?php }} ?>
              </select>
            </div>
				
			<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
              <label for="fecha_pago">Fecha Pago</label>
              <input type="date" class="form-control" id="fecha_pago" name="fecha_pago" value="<?php echo date("Y-m-d"); ?>">
            </div>
            </div>
			 
			<div id="info_negocio" class="form-group">
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
        <button id="btn_save_pago_efectivo" type="button" class="btn btn-success font-weight-bold btn-mda"><i class="fas fa-save"></i> Registrar Pago</button>
      </div>
    </div>
  </div>
</div>