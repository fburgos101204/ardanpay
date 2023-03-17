<div class="modal fade" id="modal_seguridad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Autorizacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="alertseguridad"></div>
         <form  name="frm_seguridad" action="" id="frm_seguridad" autocomplete="off" method="POST">
            <div class="form-group">
              <input class="form-control" type="hidden" id="location" name="location">
              <label for="seguridad_user">Usuario</label>
              <input class="form-control" type="text" id="seguridad_user" name="seguridad_user" autofocus>
            </div>
            <div class="form-group">
              <label for="seguridad_pass">Contraseña</label>
              <input type="password" class="form-control" id="seguridad_pass" name="seguridad_pass">
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" id="validar_modulo_box" onclick="validar()">Aceptar</button>
        <button type="button" class="btn btn-success" id="validar_txt_box">Aceptar</button>
        <button type="button" class="btn btn-success" id="validar_btn_box" onclick="validar_btn()">Aceptar</button>
      </div>
    </div>
  </div>
</div>