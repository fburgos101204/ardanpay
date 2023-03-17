<div class="modal fade" id="modal_edicion_prestamo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Modificar Préstamo</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="alertedit"></div>
         <form  name="frm_edit_prestamo"  id="frm_edit_prestamo" autocomplete="off">
            <div class="form-row">
				<div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
                  <label for="edit_t_interes" class="control-label">Amortización</label>
                  <select id="edit_t_interes" name="edit_t_interes" class="form-control">
                    <option>Interes Fijo</option>
                    <option>Disminuir Cuotas</option>
                    <option>Cuota Fija</option>
                  </select>
              </div>
			  <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <label for="edit_cuotas" class="control-label">Cuotas</label>
                <input type="number" id="edit_cuotas" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" value="0" name="edit_cuotas" class="form-control">
              </div>
			  <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <label for="edit_interes_porcentaje" class="control-label">Interés</label>
                <input type="number" step="any" id="edit_interes_porcentaje"  value="0" name="edit_interes_porcentaje" class="form-control">
              </div>
			 </div>
            <div class="form-row">
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <label for="edit_ciclo_pago" class="control-label">Modalidad de Pago</label>
                  <select id="edit_ciclo_pago" name="edit_ciclo_pago" class="form-control">
                    <option value="1">Diario</option>
                    <option value="7">Semanal</option>
                    <option value="15">Quincenal</option>
                    <option selected value="30">Mensual</option>
                    <option value="365">Anual</option>
                  </select>
              </div>
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <label for="edit_fecha" class="control-label">Fecha Primer Pago</label>
                <input type="date" name="edit_fecha" id="edit_fecha" value="<?php echo date('Y-m-d'); ?>" class="form-control">
              </div>
			</div> 
			
            <div class="form-row">
			  <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <label for="edit_monto_inicial" class="control-label">Monto Inicial</label>
                <input type="hidden" id="cant_reajust" name="cant_reajust">
                <input type="number" id="edit_monto_inicial" name="edit_monto_inicial" class="form-control">
              </div>
			  <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <label for="edit_capital_pendiente" class="control-label">Capital Pendiente</label>
                <input type="number" id="edit_capital_pendiente"  name="edit_capital_pendiente" class="form-control">
				<input type="hidden" id="edit_capital_p_inicial" name="edit_capital_p_inicial">
              </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
        <button type="button" class="btn btn-info font-weight-bold btn-mda"  onclick="onload_calculator()" data-toggle="modal" data-target="#modal_calculadora"><i class="fas fa-calculator"></i> Calculadora</button>
        <button id="btn_update_prestamo" name="btn_update_prestamo" type="button" class="btn btn-success font-weight-bold btn-mda"><i class="fas fa-save"></i> Modificar</button>
      </div>
    </div>
  </div>
</div>