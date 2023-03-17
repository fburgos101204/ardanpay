<div class="modal fade" id="modal_ruta_assign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-road"></i> Asignación de Ruta</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="alertruta_dir"></div>
         <form  name="data_ruta_assign"  id="data_ruta_assign" autocomplete="off">
            <div class="form-group">
              <input class="form-control" type="hidden" id="id_ruta" name="id_ruta">
            <div class="form-label-group">
              <input class="form-control" type="text" id="dir_ruta" name="dir_ruta" placeholder="Dirección Ruta">
              <label for="dir_ruta">Dirección Ruta</label>
            </div>
      </div>
      <div class="form-group">
        <nav class="nav nav-tabs">
            <a data-toggle="tab" href="#cliente_table" class="nav-item nav-link active">Clientes</a>
            <a data-toggle="tab" href="#mensajero_table" class="nav-item nav-link">Mensajeros</a>
        </nav>
        <div class="tab-content">
        
        <div class="tab-contents tab-pane fade in active show" id="cliente_table">
          <br>  
          <button style="float:right" type="button" class="btn btn-primary" 
              data-toggle="modal" data-target="#modal_assign_cliente">
              Agregar Cliente</button>
          <br><br>
          <div class="table-responsive">
          <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <th>Nombre</th>
                  <th>Teléfono</th>
                  <th>Cédula</th>
                  <th>Correo</th>
                  <th>Dirección</th>
                  <th>Acción</th>
                </thead>
                <tbody id="info_cliente">
              
                </tbody>
          </table>
          </div>    
        </div>
        <br>
        <div class="tab-contents tab-pane" id="mensajero_table">
          <button style="float:right" type="button" class="btn btn-primary" 
              data-toggle="modal" data-target="#modal_assign_mensajero" id="btn_asg_mjr">
              Agregar Mensajero</button>
          <br><br>
          <div class="table-responsive">
          <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <th>Mensajero</th>
                    <th>Usuario</th>
                    <th>Cédula</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>IMEI</th>
                    <th>Acción</th>
                  </thead>
              <tbody  id="info_mensajero"> 
              
              </tbody>
          </table>
          </div>   
        </div>
        </div> 
      </div> 
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>

        <button id="btn_update_ruta" name="btn_update_ruta" type="button" class="btn btn-success font-weight-bold btn-mda"><i class="fas fa-save"></i> Actualizar Ruta</button>
      </div>
    </div>
  </div>
</div>