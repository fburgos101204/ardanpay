<div class="modal fade" id="Pass-User" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="material-icons">lock</i> Resetear Contraseña</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="alertPass"></div>
         <form  name="formCbUserPass"  id="formCbUserPass" class="formCbUserPass"  autocomplete="off">
            <div class="form-group">
              <input type="hidden" class="form-control" id="users_id" name="users_id">
            </div>
            <div class="form-group" id="hide-ps">
              <label for="psw">Contraseña</label>
              <input type="password" class="form-control" id="psw" name="psw">
            </div>
            <div class="form-group" id="hide-ps2">
              <label for="psw2">Confirmar Contraseña</label>
              <input type="password" class="form-control" id="psw2" name="psw2">
            </div>
            <div id="errors" class="well"></div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal">
          <i class="fas fa-times"></i> Cerrar</button>

        <button id="update-pass" name="update-pass" type="button" class="btn btn-success font-weight-bold btn-mda">
        <i class="fas fa-save"></i> Actualizar</button>
      </div>
    </form>
    </div>
  </div>
</div>