<div class="modal fade" id="modal_notas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="margin-top: 8%;box-shadow: 0px 0px 78px 150px rgba(66, 66, 66, 0.4);">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Añadir notas</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div>
      <nav class="nav nav-tabs">
          <a data-toggle="tab" href="#container_referencia" class="nav-item nav-link active"  tabindex="19">Notas</a>
      </nav>
      <div class="tab-content">
            <div class="row tab-pane fade in active show" id="container_referencia"  style="padding: 23px;">
        <button type="button" style="float: right;margin-top: -10px;margin-bottom: 5px;" class="btn btn-primary btn-round"
            data-toggle="modal" data-target="#modal_nota" ><i class="fas fa-plus"></i></button>
        <table class="table table-responsive tabl-responsive">
          <thead>
            <tr>
              <th nowrap>Nota</th>
              <th nowrap>Fecha</th>
            </tr>
          </thead>
          <tbody id="nota_table">
          </tbody>
        </table>
      </div>
     </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
      </div>
    </div>
  </div>
</div>