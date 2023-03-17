<div class="modal fade" id="modal_notario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="alertPass"></div>
         <form  name="data_notario"  id="data_notario" class="empety" autocomplete="off">
            <div class="form-row">
              <div class="form-group col-sm-6">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
                <input type="hidden" id="creador" name="creador">
                <input type="hidden" id="id_negocio" name="id_negocio">
                <input type="hidden" id="id_notario" name="id_notario">
              </div>
              <div class="form-group col-sm-6">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-sm-6">
                <label for="cedula">Cédula</label>
                <input type="text" class="form-control" id="cedula" name="cedula" maxlength="13" onkeypress="cedulas(); if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
              </div>
              <div class="form-group col-sm-6">
              <label for="codigo">Código Colegio</label>
              <input type="text" class="form-control" id="codigo" name="codigo">
            </div>
            </div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal">
          <i class="fas fa-times"></i> Cerrar</button>

        <button id="save_notario" name="save_notario" type="button" class="btn btn-info font-weight-bold btn-mda">
        <i class="fas fa-save"></i> Guardar</button>

        <button id="update_notario" name="update_notario" type="button" class="btn btn-success font-weight-bold btn-mda">
        <i class="fas fa-save"></i> Actualizar</button>
      </div>
    </div>
  </div>
</div>