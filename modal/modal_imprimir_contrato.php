<div class="modal fade" id="modal_imprimir_contrato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user"></i> Seleccione un Notario</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="alertimprimir"></div>
          <form  name="data_imprimir_contrato"  id="data_imprimir_contrato" class="empety" target="_blank"
				method="GET" autocomplete="off">
              <input type="hidden" id="tp" name="tp">
			  <input type="hidden" id="tmp_negocio" name="tmp_negocio">
			  <input type="hidden" id="data_url" name="data_url" value="">
			  <input type="hidden" id="tmps" name="tmps">
			  <div class="form-group">
              <label for="id_notario" class="control-label">Notario</label>
              <select class="form-control" name="id_notario" id="id_notario">
                <?php
                      require_once('config/db.php');
                      $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                      $query = "SELECT * FROM notario WHERE negocio = $negocio";
                      $row3 = $con->query($query); 
                      if ($row3->num_rows >= 1) {
                        while ($row = $row3->fetch_object()) { ?>
                  <option value="<?php echo $row->id_notario; ?>">
                    <?php echo $row->nombre." ".$row->apellido; ?>
                  </option>
                  <?php }} ?>
              </select>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
        <button type="button" class="btn btn-success font-weight-bold btn-mda" onclick="imprimir_contrato()"><i class="fas fa-print"></i> Imprimir</button>
      </div>
    </div>
  </div>
</div>