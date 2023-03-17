<div class="modal fade" id="modal_referencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="margin-top: 38%;box-shadow: 0px 0px 78px 150px rgba(66, 66, 66, 0.4);">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Añadir Referencia</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="alertreferencia"></div>
         <form  name="frm_referencia"  id="frm_referencia" autocomplete="off">
            <div class="form-row margin-input" id="home">
              <div class="form-group col-sm-6">
                <input type="hidden" class="form-control" id="id_referencia" name="id_referencia">
                <label for="nombre_referencia">Nombre</label>
                <input type="text" class="form-control" id="nombre_referencia" name="nombre_referencia">
              </div>
              <div class="form-group col-sm-6">
                  <label for="telefono_referencia">Teléfono</label>
                  <input type="text"class="form-control" id="telefono_referencia" name="telefono_referencia" maxlength="12" onkeypress="telefono_referido(); if (isNaN( String.fromCharCode(event.keyCode) )) return false;">
              </div>
			 </div>
			 <div class="form-row">
                <div class="form-group col-sm-6">
                  <label for="tipo_referencia">Tipo de Referencia</label>
                  <select class="form-control" cols="2" rows="4" id="tipo_referencia" name="tipo_referencia">
                    <option value="0" selected disabled>-Seleccione un tipo-</option>
                    <option>Personal</option>
                    <option>Laboral</option>
                  </select>
                </div>
                <div class="form-group col-sm-6">
                        <label for="parentesco_referencia">Parentesco</label>
                  <select class="form-control" cols="2" rows="4" id="parentesco_referencia" name="parentesco_referencia">
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
        <button type="button" class="btn btn-success font-weight-bold btn-mda" onclick="add_ref()"><i class="fas fa-save"></i> Añadir</button>
      </div>
    </div>
  </div>
</div>