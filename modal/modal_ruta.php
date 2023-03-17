<div class="modal fade" id="modal_ruta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-road"></i> Registrar Ruta</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="alertruta"></div>
         <form  name="data_ruta"  id="data_ruta" autocomplete="off">
            <div class="form-group">
              <!--input type="hidden" id="creador_caja" name="creador_caja"-->
              <input type="hidden" id="id_negocio" name="id_negocio">
            <div class="form-label-group">
              <input class="form-control" type="text" id="direccion" name="direccion" placeholder="Ruta">
              <label for="direccion">Ruta</label>
            </div>
			</div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
        <button id="btn_save_ruta" name="btn_save_ruta" type="button" class="btn btn-info font-weight-bold btn-mda"><i class="fas fa-save"></i> Registrar</button>
      </div>
    </div>
  </div>
</div>