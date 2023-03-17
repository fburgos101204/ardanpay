<div class="modal fade" id="modal_calculadora" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-calculator"></i> Calculadora</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="alertPass"></div>
         <form  name="data_calculator"  id="data_calculator" class="empety"  autocomplete="off">
            <!-------Prestamo--------------->
            <div class="form-row">
              <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <label for="monto_calculador" class="control-label">Monto</label>
                <input type="number" id="monto_calculador" placeholder="0" name="monto_calculador" class="form-control">
              </div>

              <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <label for="interes_calculador" class="control-label">Intéres</label>
                <input type="number" id="interes_calculador" placeholder="0" name="interes_calculador" class="form-control">
              </div>

              <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <label for="cuotas_calculador" class="control-label">Cuotas</label>
                <input type="number" id="cuotas_calculador" placeholder="0" name="cuotas_calculador" class="form-control">
              </div>  
            </div>

            <div class="form-row">
              <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                  <label for="ciclo_calculador" class="control-label">Modalidad de Pago</label>
                  <select id="ciclo_calculador" name="ciclo_calculador" class="form-control">
                    <option value="1">Diario</option>
                    <option value="7">Semanal</option>
                    <option value="15">Quincenal</option>
                    <option selected value="30">Mensual</option>
                    <option value="365">Anual</option>
                  </select>
              </div>
               <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <label for="t_interes_calculador" class="control-label">Amortización</label>
                  <select id="t_interes_calculador" name="t_interes_calculador" class="form-control">
                    <option>Interes Fijo</option>
                    <option>Disminuir Cuotas</option>
                    <option>Cuota Fija</option>
                  </select>
              </div>
			  <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3" id="hidden_tipo_calculadora">
                <label for="monto_cuota_txt" class="control-label">Monto de Cuotas</label>
				  <!--onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"-->
                  <input type="text" placeholder="0" id="monto_cuota_txt" name="monto_cuota_txt"  class="form-control">
              </div>
              <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <label for="fecha_calculador" class="control-label">Fecha Primer Pago</label>
                <input type="date" name="fecha_calculador" id="fecha_calculador"  value="<?php echo date('Y-m-d'); ?>" class="form-control">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                 <button  style="width: 100%;" id="btn_calcular" name="btn_calcular" type="button" class="btn btn-info mt-4">Calcular</button>
              </div>
            </div>
              <div id="result">
                <table class="table table-responsive calculadoras" id="historial_historial">
                  <thead>
                    <th nowrap>Fecha</th>
                    <th nowrap>Total a Pagar</th>
                    <th nowrap>Capital Restante</th>
                    <th nowrap>Abono Capital</th>
                    <th nowrap>Intéres</th>
                  </thead>
                  <tbody id="tbody_make">
                    
                  </tbody>
                </table>
                <span id="resultado" style="margin: 6px;font-weight: bold;"></span>
              </div>


        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i>  Cerrar</button>
      </div>
    </div>
  </div>
</div>