<div class="modal fade" id="modal_banco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="alertcaja"></div>
         <form  name="frm_banco"  id="frm_banco" autocomplete="off">
          	<input class="form-control" type="hidden" id="creador_banco" name="creador_banco">
              <input class="form-control" type="hidden" id="id_negocio" name="id_negocio">
            <input class="form-control" type="hidden" id="id_banco" name="id_banco">
            
            <div class="form-group">
			<div class="form-label-group">
              <input class="form-control" type="text" id="banco_name" name="banco_name" placeholder="Nombre Banco">
              <label for="banco_name">Nombre del Banco</label>
            </div>
			</div>
			
            <div class="form-group">
            <div class="form-label-group">
              <input type="text" class="form-control" id="banco_titular" name="banco_titular" placeholder="Titular de Cuenta">
              <label for="banco_titular">Titular de Cuenta</label>
            </div>
			</div>
			 
            <div class="form-group">
            <div class="form-label-group">
              <input class="form-control" type="date" id="fecha_venci" name="fecha_venci" placeholder="Fecha de Vencimiento" value="<?php echo date('Y-m-d'); ?>">
              <label for="fecha_venci">Fecha Vencimiento</label>
            </div>
            </div>
			 
            <div class="form-group">
            <div class="form-label-group">
              <input type="text" class="form-control" id="banco_monto" name="banco_monto" placeholder="Monto de la Cuenta" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
              <label for="banco_monto">Monto en Cuenta</label>
            </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>

        <button id="btn_update_banco" name="btn_update_caja" type="button" class="btn btn-success font-weight-bold btn-mda"><i class="fas fa-save"></i> Actualizar</button>

        <button id="btn_save_banco" name="btn_save_caja" type="button" class="btn btn-info font-weight-bold btn-mda"><i class="fas fa-save"></i> Registrar</button>
      </div>
    </form>
    </div>
  </div>
</div>