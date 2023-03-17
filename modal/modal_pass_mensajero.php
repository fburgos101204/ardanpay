<div class="modal fade" id="modal_pass_mensajero" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-lock"></i> Resetear Contraseña</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="alertPassw"></div>
         <form  name="data_mensajero_pass"  id="data_mensajero_pass" autocomplete="off">
            <div class="form-group">
            <input type="hidden" id="id_mensajero_pass" name="id_mensajero_pass">
            </div>
            <div class="form-group" id="hide-ps">
              <label for="mensajero_pass">Contraseña</label>
              <input type="password" class="form-control" id="mensajero_pass" name="mensajero_pass">
            </div>
            <div class="form-group" id="hide-ps2">
              <label for="mensajero_passw">Confirmar Contraseña</label>
              <input type="password" class="form-control" id="mensajero_passw" name="mensajero_passw">
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal">
          <i class="fas fa-times"></i> Cerrar</button>

        <button id="update_pass" name="update_pass" type="button" class="btn btn-success font-weight-bold btn-mda">
        <i class="fas fa-save"></i> Actualizar</button>
      </div>
    </div>
  </div>
</div>