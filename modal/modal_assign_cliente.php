<div class="modal fade" id="modal_assign_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content"  style="margin-top: 10%;box-shadow: 0px 0px 78px 150px rgba(0,0,0,0.4);">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user"></i> Asignar Cliente a Ruta</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="alert_clt"></div>
          <form  name="data_clt"  id="data_clt" class="empety"  autocomplete="off">
            <div class="form-group">
              <label for="id_cliente" class="control-label">Cliente</label>
              <select class="js-example-basic-single" name="id_cliente" id="id_cliente">
                <?php
                      require_once('config/db.php');
                      $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                      $query = "SELECT * FROM clientes WHERE negocio = $negocio";
                      $row3 = $con->query($query); 
                      if ($row3->num_rows >= 1) {
                        while ($row = $row3->fetch_object()) { ?>
                  <option value="<?php echo $row->id_cliente; ?>">
                    <?php echo $row->nombre." ".$row->apellido; ?>
                  </option>
                  <?php }} ?>
              </select>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
        <button type="button" class="btn btn-success font-weight-bold btn-mda" onclick="assign_cliente_table()" id="agregar_clt"><i class="fas fa-save"></i> Añadir</button>
      </div>
    </div>
  </div>
</div>