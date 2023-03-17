<div class="modal fade" id="modal_estado_solicitud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-hand-holding-usd"></i>  Información Solicitud Prestamo</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
 
      <div class="modal-body">
         <form  name="data_solicitud_prestamo"  id="data_solicitud_prestamo" class="empety"  autocomplete="off">
             <div id="info" style="width: 100%; height: auto;">
               
             </div>
			 <div  style="margin-top:10px;">
			 <nav class="nav nav-tabs">
  				<a data-toggle="tab" href="#container_valida_prestamo" class="nav-item nav-link active">Información Préstamo</a>
  				<a data-toggle="tab" href="#container_referencia_valida" class="nav-item nav-link">Referencias</a>
  				<a data-toggle="tab" href="#container_garante_valida" class="nav-item nav-link">Garantes</a>
			 </nav>
			 
			<div class="tab-content">
            <div class="row tab-pane fade" id="container_referencia_valida"  style="padding: 16px;">
				<table class="table table-responsive tabl-responsive">
					<thead>
						<tr>
							<th nowrap>Nombre</th>
							<th nowrap>Teléfono</th>
							<th nowrap>Tipo de Referencia</th>
							<th nowrap>Parentesco</th>
							<th nowrap>Acción</th>
						</tr>
					</thead>
					<tbody id="referencia_table_valida">
					</tbody>
				</table>
			</div>
			<div class="row tab-pane fade" id="container_garante_valida" style="padding: 16px;">
				<table class="table table-responsive tabl-responsive">
					<thead>
						<tr>
							<th nowrap>Nombre</th>
							<th nowrap>Cédula</th>
							<th nowrap>Dirección</th>
							<th nowrap>Parentesco</th>
							<th nowrap>Acción</th>
						</tr>
					</thead>
					<tbody id="garante_table_valida">
					</tbody>
				</table>
			</div>
			 <div class="form-group tab-pane fade in active show" style="padding:16px;"  id="container_valida_prestamo">
             <div class="form-row">
              <input type="hidden" id="id_creador_re" name="id_creador_re" value="<?php echo $user_id; ?>">
              <input type="hidden" id="id_prestamo_valida" name="id_prestamo_valida">
              <input type="hidden" id="id_solicitud_" name="id_solicitud_">
              <input type="hidden" id="id_cliente_solicitud" name="id_cliente_solicitud">
                <div class="form-group col-md-4">
                  <label for="titulo">Monto a Prestar</label>
                  <input type="text" class="form-control" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" id="monto_valida" name="monto_valida">
                </div>
                <div class="form-group col-md-4">
                  <label for="cuotas">Cuotas</label>
                  <input id="cuotas_valida" type="text" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" name="cuotas_valida">
                </div>
                <div class="form-group col-md-4">
                  <label for="ciclo_pago">Ciclos de Pago</label>
                  <select  class="form-control" id="ciclo_pago_valida" name="ciclo_pago_valida">
                    <option>- Seleccione -</option>
                    <option value="1">Diario</option>
                    <option value="7">Semanal</option>
                    <option value="15">Quincenal</option>
                    <option value="30">Mensual</option>
                    <option value="365">Anual</option>
                  </select>
                </div>
               </div>
               <div class="form-row">
              <div class="form-group col-md-4">
                <label for="interes_valida" class="control-label">Interés</label>
                <input type="text" id="interes_valida" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" value="0" name="interes_valida" class="form-control">
              </div>
               <div class="form-group col-md-4">
                <label for="t_interes_valida" class="control-label">Amortización</label>
                  <select id="t_interes_valida" name="t_interes_valida" class="form-control">
                    <option>Interés Fijo</option>
                    <option>Disminuir Cuotas</option>
                    <option>Cuota Fija</option>
                  </select>
              </div>
              <div class="form-group col-md-4">
                <label for="fecha_valida" class="control-label">Fecha de Inicio</label>
				  <?php
					  $fecha_reajuste= "readonly";
					  $function_fecha_reajuste = "onload_validar_txt('fecha_valida')";
					  $modal ="data-toggle='modal' data-target='#modal_seguridad'";
					  if ($permisos->{'fecha_inicio_prestamo'} == "on"){ 
						  $fecha_reajuste = "";
						  $function_fecha_reajuste = "";
						  $modal =""; 
					  } 
				  ?>
                <input type="date" name="fecha_valida" id="fecha_valida"   <?php echo $modal.$fecha_reajuste; ?> onclick="<?php echo $function_fecha_reajuste; ?>"   value="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" class="form-control">
              </div>
            </div>
            <hr>
            <div id="alertfrmsolictud"></div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="ciclo_pago">Estado</label>
                <select  class="form-control" id="estado_valida" name="estado_valida">
                  <?php if ($nivel != 3): ?>
                  <option>Revisar</option>
                  <?php endif ?>
                  <?php if ($nivel != 2): ?>
                  <option>Modificado</option>
                  <option>Validado</option>
                  <?php endif ?>
                  <?php if ($nivel != 3): ?>
                  <option>Aceptado</option>
                  <?php endif ?>
                </select>
              </div>
			  <div class="form-group col-md-4" class="retirar_de_hidden">
				  <label for="fecha_creacion" class="control-label">Fecha Creación</label>
				  <input type="date" class="form-control" name="fecha_creacion" id="fecha_creacion" value="<?php echo date("Y-m-d"); ?>">
			  </div>
              <div class="form-group col" class="retirar_de_hidden">
                <label for="retirar_de">Retirar de</label>
                <select  class="form-control" id="retirar_de" name="retirar_de">
                  <option selected>Caja</option>
                  <option>Banco</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6"  id="entidad_hidden">
                <label for="entidad">Entidad</label>
                <select  class="form-control" id="entidad_caja" name="entidad_caja">
					<option class="0" disabled selected>Seleccione una Entidad</option>
                  <?php
                        require_once('config/db.php');
                        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                        $query = "SELECT * FROM caja
									WHERE negocio = $negocio";
                        $row3 = $con->query($query); 
                        if ($row3->num_rows >= 1) {
                          while ($row = $row3->fetch_object()) { ?>
                    <option class="<?php echo $row->monto; ?>" value="<?php echo $row->id_caja; ?>">
                      <?php echo $row->nombre; ?>
                    </option>
                    <?php }} ?>
                </select>
                <select class="form-control"  name="entidad_banco" id="entidad_banco">
					<option class="0" disabled selected>Seleccione una Entidad</option>
                  <?php
                        require_once('config/db.php');
                        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                        $query = "SELECT * FROM banco
									WHERE negocio = $negocio";
                        $row3 = $con->query($query); 
                        if ($row3->num_rows >= 1) {
                          while ($row = $row3->fetch_object()) { ?>
                    <option class="<?php echo $row->monto; ?>" value="<?php echo $row->id_banco; ?>">
                      <?php echo $row->banco; ?>
                    </option>
                    <?php }} ?>
                </select>
              </div>
              <div class="form-group col-md-6" id="disponible_hidden">
                <label for="disponible_id">Monto Disponible</label>
                <input class="form-control" type="text" id="disponible_id" name="disponible_id" readonly>
              </div>
              <div class="form-group col-md-12" id="no_cheque_hidden">
                <label for="no_codigo">N. Cheque / Deposito</label>
                <input type="text" class="form-control" name="no_codigo" id="no_codigo" placeholder="Numero de Cheque o Deposito">
               </div>
            </div>
			</div>
			</div>
			</div>
         </form>
      </div>
      <div class="modal-footer">
        <button id="update_sol_pres" type="button" class="btn btn-success font-weight-bold btn-mda">
        <i class="fas fa-save"></i> Validar</button>
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
        <!--<button  data-toggle="modal" onclick="onload_calculator()" data-target="#modal_calculadora" type="button" class="btn btn-info">
        <i class="material-icons">repeat_one</i> Amortizador</button>-->

      </div>
    </div>
  </div>
</div>