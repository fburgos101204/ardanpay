<div class="modal fade" id="modal_agregar_pago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document" style="max-width: 600px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-money"></i> Agregar Pago</h5>

        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="alertpago"></div>
         <form  name="data_agregar_pago" id="data_agregar_pago" class="empety"  autocomplete="off">
            <input type="hidden" id="pago_selector" name="pago_selector">
            <input type="hidden" id="monto_picket" name="monto_picket">
            <input type="hidden" id="total_pagar" name="total_pagar">
            <div class="form-row mb-2">
              <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <label for="fecha_pago">Fecha de Pago</label>
				<?php 
				      $fecha_pago = "readonly";
					  $function_fecha_pago = "onload_validar_txt('fecha_pago')";
					  $modal ="data-toggle='modal' data-target='#modal_seguridad'";
					  if ($permisos->{'cambio_fecha_pagar'} == "on"){ 
						  $fecha_pago = "";  
						  $function_fecha_pago = "";
						  $modal =""; }
				?>
                <input type="date" class="form-control" id="fecha_pago" name="fecha_pago" <?php echo $modal.$fecha_pago; ?> onclick="<?php echo $function_fecha_pago; ?>" value="<?php echo date('Y-m-d'); ?>">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6" id="radio_button">
                  <div class="radio">
                        <label class="l_cuota_pagar" for="cuota_pagar"><input type="radio" value="0" name="radio_opt" id="cuota_pagar"><span></span></label>
                  </div>
                  <div class="radio">
                        <label class="l_cancelar_pagar" for="cancelar_pagar"><input type="radio" value="0" name="radio_opt" id="cancelar_pagar"><span></span></label>
                        <input type="hidden"  id="rd_cancelar" name="rd_cancelar" value="0">
                  </div>

                  <div class="radio monto_capit"  style="display: none;">
                        <label class="l_no_interes_monto" for="no_interes_monto">
                          <input type="radio" value="no_interes_monto" name="radio_opt" id="no_interes_monto"> Monto Capital
                        </label>
                        <div id="form_monto_capital" class="form-group">
                          <input type="number" min="0" disabled class="form-control" id="monto_capital_no_interes" value="0" name="monto_capital_no_interes" placeholder="Monto Pagar">
                      </div>
                  </div>
                  <div class="radio">
                        <label class="l_solo_interes" for="solo_interes"><input type="radio" value="0" name="radio_opt" id="solo_interes"><span></span>
                        </label>
                  </div>
                  <div class="radio">
                      <label class="l_otro_monto" for="otro_monto">
                        <input type="radio" value="otro_monto" name="radio_opt" id="otro_monto"> Otro Monto:</label>

                      <div style="display:none" id="form_monto" class="form-group col-md-10">
                        <input type="number" min="0" class="form-control" id="monto_capital" name="monto_capital">
                      </div>
                  </div>
                <div class="form-group" style="margin-top:10%; ">
                  <input type="checkbox" id="anular_interes" class="checkbox-template"> 
                  <label for="anular_interes">Anular Interés</label>
                </div>
              </div>
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-row">
                  <div class="form-group col">
                    <label class="form-check-label" for="moras_cargos">Moras/Cargos </label>
					  
      				<?php
					  $cambio_mora = "readonly";
					  $function_mora = "onload_validar_txt('moras_cargos')";
					  $modal ="data-toggle='modal' data-target='#modal_seguridad'";
					  if ($permisos->{'cambio_mora'} == "on"){ $cambio_mora = "";  $function_mora = ""; $modal =""; } ?>
                    <input type="number" min="0" class="form-control" id="moras_cargos" <?php echo $modal.$cambio_mora; ?> onclick="<?php echo $function_mora; ?>" name="moras_cargos">
					
                  </div>
                </div>
                <div class="form-row" id="descuento_hidden">
                  <div class="form-group col">
                    <label class="form-check-label" for="descuento_interes">Descuento a Interés</label>
                    <input type="number" min="0" class="form-control" id="descuento_interes" name="descuento_interes">
                  </div>
                </div>
                <div class="form-row">
                   <div class="form-group">
                      <label class="form-check-label" for="total_a_pg">Total a Pagar: <span  style="color:#17a2b8 !important; font-weight: bold;">RD$ </span><span id="total_a_pg" style="color:#17a2b8 !important; font-weight: bold;"></span></label>
                   </div>
                </div>
              </div>
            </div>
            <div class="form-row mt-3">
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
              <label for="tipo_pago">Tipo de pago</label>
                <select class="form-control" name="tipo_pago" id="tipo_pago">
                  <option>Efectivo</option>
                  <option>Cheque</option>
                  <option>Deposito / Transferencia</option>
                </select>
              </div>
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6 banco_pago">
              <label for="banco_pago">Banco</label>
                <select class="form-control" name="banco_pago" id="banco_pago">
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
               <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6 no_cheque">
                <label for="banco_pago">Código</label>
                <input type="text" class="form-control" name="no_cheque" id="no_cheque" placeholder="Numero de Cheque o Deposito">
               </div>
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6 id_caja">
              <label for="id_caja">Caja</label>
                <select class="form-control" name="id_caja" id="id_caja">
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
            
            <div class="form-group">
              <label class="form-check-label" for="moras_cargos">Notas</label>
              <textarea class="form-control" name="nota" id="nota" cols="30" rows="2"></textarea>
            </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
        <button type="button" class="btn btn-success font-weight-bold btn-mda" name="btn_pagar" id="btn_pagar"><i class="fas fa-money-bill"></i> Pagar</button>
      </div>
    </div>
  </div>
</div>