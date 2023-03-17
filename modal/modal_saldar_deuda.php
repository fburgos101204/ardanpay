<div class="modal fade" id="modal_saldar_deuda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document" style="max-width: 600px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-money"></i> Agregar Pago</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="alertpago"></div>
         <form  name="data_saldar_deuda" id="data_saldar_deuda" class="empety"  autocomplete="off">
            <input type="hidden" id="cap_pediente" name="cap_pediente">
            <input type="hidden" id="id_prestamo_saldar_cap" name="id_prestamo_saldar_cap">
            <input type="hidden" id="creador_cap" name="creador_cap">
            <div class="form-row">
              <div class="form-group col">
              <label for="tipo_pago">Tipo de pago</label>
                <select class="form-control" name="tipo_pago_capt" id="tipo_pago_capt">
                  <option>Efectivo</option>
                  <option>Cheque</option>
                  <option>Deposito / Transferencia</option>
                </select>
              </div>
              <div class="form-group col banco_pago_capt">
              <label for="banco_pago_capt">Banco</label>
                <select class="form-control" name="banco_pago_capt" id="banco_pago_capt">
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
               <div class="form-group col no_cheque_capt">
                <label for="banco_pago">Codigo</label>
                <input type="text" class="form-control" name="no_cheque_capt" id="no_cheque_capt" placeholder="Numero de Cheque o Deposito">
               </div>
              <div class="form-group col id_caja_capt">
              <label for="id_caja_capt">Caja</label>
                <select class="form-control" name="id_caja_capt" id="id_caja_capt">
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
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" name="btn_saldar_deuda" id="btn_saldar_deuda">Saldar</button>
      </div>
    </div>
  </div>
</div>