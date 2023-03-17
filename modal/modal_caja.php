<div class="modal fade" id="modal_caja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
         <form  name="frm_caja"  id="frm_caja" autocomplete="off">
            <div class="form-group">
              <input class="form-control" type="hidden" id="creador_caja" name="creador_caja">
              <input class="form-control" type="hidden" id="id_negocio" name="id_negocio">
              <input class="form-control" type="hidden" id="id_caja" name="id_caja">
            <div class="form-label-group">
              <input class="form-control" type="text" id="caja_name" name="caja_name" placeholder="Identificador">
              <label for="caja_name">Identificador</label>
            </div>
			</div>
            <div class="form-group">
            <div class="form-label-group">
              <input type="text" class="form-control" id="monto_caja" name="monto_caja" placeholder="Monto Inicial">
              <label for="monto_caja">Monto</label>
            </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>

        <button id="btn_update_caja" name="btn_update_caja" type="button" class="btn btn-success font-weight-bold btn-mda"><i class="fas fa-save"></i> Actualizar</button>

        <button id="btn_save_caja" name="btn_save_caja" type="button" class="btn btn-info font-weight-bold btn-mda"><i class="fas fa-save"></i> Registrar</button>
      </div>
    </div>
  </div>
</div>