<div class="modal fade" id="modal_ajt_capital" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Ajustar Capital</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
         <div id="alertajustar"></div>
         <form  name="frm_ajt_capital" id="frm_ajt_capital" autocomplete="off">
          <div class="form-row">
            <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
              <label for="nuevo_monto">Monto</label>
              <input class="form-control" type="hidden" name="reajuste_id" id="reajuste_id">
              <input class="form-control" type="number" name="nuevo_monto" id="nuevo_monto"  placeholder="Añadir Monto">
            </div>
             <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
              <label for="fecha_reajuste">Fecha Primer Pago</label>
              <input class="form-control" type="date" id="fecha_reajuste" name="fecha_reajuste" value="<?php echo date('Y-m-d'); ?>">
            </div>
            
          </div>
          <div class="form-row">
            <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
              <label for="capital_actual">Capital Actual</label>
              <input class="form-control" readonly type="number" id="capital_actual" name="capital_actual">
            </div>
            <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
              <label for="new_capital">Nuevo Capital</label>
              <input class="form-control" readonly type="number" id="new_capital" name="new_capital">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <label for="tipo_pago_reajuste">Tipo de pago</label>
              <select class="form-control" name="tipo_pago_reajuste" id="tipo_pago_reajuste">
                <option>Efectivo</option>
                <option>Cheque</option>
                <option>Deposito / Transferencia</option>
              </select>
            </div>
            <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6 banco_pago_reajuste">
            <label for="banco_pago_reajuste">Banco</label>
              <select class="form-control" name="banco_pago_reajuste" id="banco_pago_reajuste">
                <?php
                    require_once('config/db.php');
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    $query = "SELECT * FROM banco WHERE negocio = $negocio";
                    $row3 = $con->query($query); 
                    if ($row3->num_rows >= 1) {
                      while ($row = $row3->fetch_object()) { ?>
                <option class="<?php echo $row->monto; ?>" value="<?php echo $row->id_banco; ?>">
                  <?php echo $row->banco; ?>
                </option>
                <?php }} ?>
              </select>
            </div>
            <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6 id_caja_reajuste">
            <label for="id_caja_reajuste">Caja</label>
              <select class="form-control" name="id_caja_reajuste" id="id_caja_reajuste">
                <?php
                    require_once('config/db.php');
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    $query = "SELECT * FROM caja WHERE negocio = $negocio";
                    $row3 = $con->query($query); 
                    if ($row3->num_rows >= 1) {
                      while ($row = $row3->fetch_object()) { ?>
                <option class="<?php echo $row->monto; ?>" value="<?php echo $row->id_caja; ?>">
                  <?php echo $row->nombre; ?>
                </option>
                <?php }} ?>
              </select>
            </div>

            <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6" id="disponible_hidden">
              <label for="disponible_id_reajuste">Monto Disponible</label>
              <input class="form-control" type="text" id="disponible_id_reajuste" name="disponible_id_reajuste" readonly>
            </div>
              
             <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6 no_cheque_reajuste">
              <label for="no_cheque_reajuste">Código</label>
              <input type="text" class="form-control" name="no_cheque_reajuste" id="no_cheque_reajuste" placeholder="Número de Cheque o Depósito">
             </div>
            </div>
         </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
        <button type="button" class="btn btn-info font-weight-bold btn-mda"  onclick="onload_calculator()" data-toggle="modal" data-target="#modal_calculadora"><i class="fas fa-calculator"></i> Calculadora</button>
        <button id="update_capital" name="update_capital" type="button" class="btn btn-success font-weight-bold btn-mda"><i class="fas fa-save"></i>  Actualizar</button>
      </div>
    </div>
  </div>
</div>