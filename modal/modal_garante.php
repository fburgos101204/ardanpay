<div class="modal fade" id="modal_garante" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="margin-top: 38%;box-shadow: 0px 0px 78px 150px rgba(66, 66, 66, 0.4);">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Añadir Garante</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="alertgarante"></div>
         <form  name="frm_garante"  id="frm_garante" autocomplete="off">
            <div class="form-row margin-input" id="home">
              <div class="form-group col-sm-6">
                <input type="hidden" class="form-control" id="id_garante" name="id_garante">
                <label for="nombre_garante">Nombre</label>
                <input type="text" class="form-control" id="nombre_garante" name="nombre_garante">
              </div>
              <div class="form-group col-sm-6">
                  <label for="cedula_garante">Cédula</label>
                  <input type="text"class="form-control" id="cedula_garante" name="cedula_garante" maxlength="13" onkeypress="cedula_garante_txt(); if (isNaN( String.fromCharCode(event.keyCode) )) return false;">
              </div>
			 </div>
			 <div class="form-row">
                <div class="form-group col-sm-6">
                  <label for="direccion_garante">Dirección</label>
                  <input type="text" class="form-control" id="direccion_garante" name="direccion_garante">
                </div>
                <div class="form-group col-sm-6">
                        <label for="garante_parentesco">Parentesco</label>
                  <select class="form-control" cols="2" rows="4" id="garante_parentesco" name="garante_parentesco">
                    <option value="0" selected disabled>-Seleccione un Parentesco-</option>
                    <option>Hermano</option>
                    <option>Padre</option>
                    <option>Cuñado</option>
                    <option>Primo</option>
                    <option>Amigo</option>
                    <option>Otros</option>
                  </select>
                </div>
              </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
        <button type="button" class="btn btn-success font-weight-bold btn-mda" onclick="add_garante()"><i class="fas fa-save"></i> Añadir</button>
      </div>
    </div>
  </div>
</div>