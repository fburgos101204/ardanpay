<div class="modal fade" id="modal_nota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="margin-top: 38%;box-shadow: 0px 0px 78px 150px rgba(66, 66, 66, 0.4);">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Añadir nota</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="alertreferencia"></div>
         <form  name="frm_nota"  id="frm_nota" autocomplete="off">
            <div class="form-row margin-input" id="home">
              <div class="form-group col-sm-6">
                <input type="hidden" class="form-control" id="id_prestamo" name="id_prestamo">
                <label for="nombre_referencia">Nota</label>
                <input type="text"  class="form-control" id="anota" name="anota">
					
              </div>
              </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
        <button type="button" class="btn btn-success font-weight-bold btn-mda" onclick="add_nota('<?php echo $id_prestamo; ?>')"><i class="fas fa-save"></i> Añadir</button>
      </div>
    </div>
  </div>
</div>