<div class="modal fade" id="modal_mensajero" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="alertmensajero"></div>
        <form  name="data_mensajero"  id="data_mensajero" class="empety"  autocomplete="off">
            <input type="hidden" id="creador" name="creador">
            <input type="hidden" id="id_negocio" name="id_negocio">
            <input type="hidden" id="id_mensajero" name="id_mensajero">
			<div class="form-row">
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <label for="dispositivo">Dispositivo</label>
                <input type="text" class="form-control" id="dispositivo" name="dispositivo">
              </div>
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <label for="imei">IMEI</label>
                <input type="text" class="form-control" id="imei" name="imei">
              </div>
            </div>
			<div class="form-row">
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
              </div>
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido">
              </div>
            </div>
			<div class="form-row">
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <label for="cedula">Cédula</label>
                <input type="text" class="form-control" onkeypress="cedula_mensajero(); if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" id="cedula" name="cedula" maxlength="13">
              </div>
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" onkeypress="telefono_mensajero(); if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" id="telefono" name="telefono" maxlength="12">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <label for="username">Usuario</label>
                <input type="text" class="form-control" id="username" name="username">
              </div>
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <label for="correo">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6" id="hide-ps">
                <label for="pass">Contraseña</label>
                <input type="password" class="form-control" id="pass" name="pass">
              </div>
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6" id="hide-ps2">
                <label for="passw">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="passw" name="passw">
              </div>
            </div>
			<div class="form-row">
              <div class="form-group col-sm-12">
                <label for="direccion">Dirección</label>
                <textarea class="form-control" id="direccion" name="direccion" cols="5">
				</textarea>
              </div>
			</div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>

        <button id="save_mensajero" name="save_mensajero" type="button" class="btn btn-info font-weight-bold btn-mda"><i class="fas fa-save"></i> Guardar</button>

        <button id="update_mensajero" name="update_mensajero" type="button" class="btn btn-success font-weight-bold btn-mda"><i class="fas fa-save"></i> Actualizar</button>
      </div>
    </div>
  </div>
</div>