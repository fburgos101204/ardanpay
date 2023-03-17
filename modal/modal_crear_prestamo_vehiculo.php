<div class="modal fade" id="modal_crear_prestamo_vehiculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-car"></i> Crear Préstamo de Vehículo</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="alertprestamovehiculo"></div>
          <form  name="data_crear_prestamo_vehiculo"  id="data_crear_prestamo_vehiculo" class="empety"  autocomplete="off">
            <!-------Prestamo--------------->
            <input type="hidden" id="creador" name="creador">
            <input type="hidden" id="id_id_prestamo" name="id_id_prestamo">
            <input type="hidden" id="id_vehiculo_prestamo" name="id_vehiculo_prestamo">
			<div class="form-row">
			<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
              <label for="fecha_creacion" class="control-label">Fecha Préstamo</label>
              <input type="date" class="form-control" name="fecha_creacion" id="fecha_creacion" value="<?php echo date("Y-m-d"); ?>">
            </div>
			<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
              <label for="id_cliente" class="control-label">Cliente</label>
              <select class="js-example-basic-single" name="id_cliente" id="id_cliente">
                <?php
                      require_once('config/db.php');
                      $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                      $query = "SELECT * FROM clientes WHERE negocio = $negocio AND estado = 1";
                      $row3 = $con->query($query); 
                      if ($row3->num_rows >= 1) {
                        while ($row = $row3->fetch_object()) { ?>
                  <option value="<?php echo $row->id_cliente; ?>">
                    <?php echo $row->nombre." ".$row->apellido; ?>
                  </option>
                  <?php }} ?>
              </select>
            </div>
			<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
              <label for="marca_vehiculo" class="control-label">Marca</label>
              <input type="text" class="form-control" name="marca_vehiculo" id="marca_vehiculo">
            </div>
			<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
              <label for="modelo_vehiculo" class="control-label">Modelo</label>
              <input type="text" class="form-control" name="modelo_vehiculo" id="modelo_vehiculo">
            </div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
              		<label for="matricula_vehiculo" class="control-label">Matrícula</label>
              		<input type="text" class="form-control" name="matricula_vehiculo" id="matricula_vehiculo">
            	</div>
				<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
					<label for="año_vehiculo" class="control-label">Año</label>
					<input type="text" class="form-control" name="año_vehiculo" id="año_vehiculo">
            	</div>
				<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
              		<label for="color_vehiculo" class="control-label">Color</label>
              		<input type="text" class="form-control" name="color_vehiculo" id="color_vehiculo">
            	</div>
				<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
              		<label for="tipo_vehiculo" class="control-label">Tipo de Vehículo</label>
              		<select type="text" class="form-control" name="tipo_vehiculo" id="tipo_vehiculo">
						<option>Carro</option>
						<option>Camioneta</option>
						<option>Jeep</option>
						<option>Camion</option>
						<option>Motor</option>
					</select>
            	</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<label for="logo" style="font-weight: bold;">
					<i class="fas fa-images"></i> Parte Frontal</label>
					<div class="custom-file">
					<div class="media_foto_1" style="height:200px;">
					<div id="part_frontal" style="position:relative;height:180px;">
            			<img src="" class="custom_img">
					</div>
					</div>
					</div>
					<div class="image-upload">
					<label  class="btn btn-primary btn-round" for="file_part_frontal" style="padding: 10px 10px;left: 18px;top: 40px;position: absolute;">
						<i class="material-icons" style="color:white !important;">attach_file</i>
					</label>
					<input class="img_file_inpt" id="file_part_frontal" type="file"/>
					</div>
				</div>
				<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<label for="logo" style="font-weight: bold;">
					<i class="fas fa-images"></i> Parte Trasera</label>
					<div class="custom-file">
					<div class="media_foto_1" style="height:200px;">
					<div id="part_trasera" style="position:relative;height:180px;">
            			<img src="" class="custom_img">
					</div>
					</div>
					</div>
					<div class="image-upload">
					<label  class="btn btn-primary btn-round" for="file_part_trasera" style="padding: 10px 10px;left: 18px;top: 40px;position: absolute;">
						<i class="material-icons" style="color:white !important;">attach_file</i>
					</label>
					<input class="img_file_inpt" id="file_part_trasera" type="file"/>
					</div>
				</div>
      		</div> 
      <div class="form-row">
        <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<label for="logo" style="font-weight: bold;">
       		<i class="fas fa-images"></i> Lateral Derecho</label>
          	<div class="custom-file">
			<div class="media_foto_1" style="height:200px;">
			<div id="lat_derecho" style="position:relative;height:180px;">
            	<img src="" class="custom_img">
			</div>
          	</div>
			</div>
			<div class="image-upload">
    		<label  class="btn btn-primary btn-round" for="file_lat_derecho" style="padding: 10px 10px;left: 18px;top: 40px;position: absolute;">
        		<i class="material-icons" style="color:white !important;">attach_file</i>
    		</label>
    		<input class="img_file_inpt" id="file_lat_derecho"  type="file"/>
			</div>
     	</div>
        <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<label for="logo" style="font-weight: bold;">
       		<i class="fas fa-images"></i> Lateral Izquierdo</label>
          	<div class="custom-file">
			<div class="media_foto_1" style="height:200px;">
			<div id="lat_izquierda"  style="position:relative;height:180px;">
            	<img src="" class="custom_img">
			</div>
          	</div>
			</div>
			<div class="image-upload">
    		<label  class="btn btn-primary btn-round" for="file_lat_izquierda" style="padding: 10px 10px;left: 18px;top: 40px;position: absolute;">
        		<i class="material-icons" style="color:white !important;">attach_file</i>
    		</label>
    		<input class="img_file_inpt" id="file_lat_izquierda" type="file"/>
			</div>
     	</div>
      </div>
            <div class="form-row">
              <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <label for="new_capital" class="control-label">Monto</label>
                <input type="number" id="new_capital" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" value="0" name="new_capital" class="form-control">
              </div>
              <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <label for="id_cuotas" class="control-label">Cuotas</label>
                <input type="number" id="id_cuotas" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" value="0" name="id_cuotas" class="form-control">
              </div>  
              <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
                  <label for="id_ciclo_pago" class="control-label">Modalidad de Pago</label>
                  <select id="id_ciclo_pago" name="id_ciclo_pago" class="form-control">
                    <option value="1">Diario</option>
                    <option value="7">Semanal</option>
                    <option value="15">Quincenal</option>
                    <option selected value="30">Mensual</option>
                    <option value="365">Anual</option>
                  </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <label for="interes_porcentaje" class="control-label">Intéres</label>
                <input type="number" id="interes_porcentaje" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" value="0" name="interes_porcentaje" class="form-control">
              </div>
               <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <label for="t_interes_valida" class="control-label">Amortización</label>
                  <select id="t_interes_valida" name="t_interes_valida" class="form-control">
                    <option>Interes Fijo</option>
                    <option>Disminuir Cuotas</option>
                    <option>Cuota Fija</option>
                  </select>
              </div>
			  <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3" id="hidden_monto_cuota_prestamo">
                <label for="monto_cuota_txt" class="control-label">Monto de Cuotas</label>
                  <input type="text" placeholder="0" id="prestamo_monto_cuota_txt" name="prestamo_monto_cuota_txt" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control">
              </div>
              <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <label for="fecha_reajuste" class="control-label">Fecha Primer Pago</label>
				  <?php
					  $fecha_reajuste= "readonly";
					  $function_fecha_reajuste = "onload_validar_txt('fecha_reajuste')";
					  $modal ="data-toggle='modal' data-target='#modal_seguridad'";
					  if ($permisos->{'fecha_inicio_prestamo'} == "on"){ 
						  $fecha_reajuste = "";
						  $function_fecha_reajuste = "";
						  $modal =""; 
					  } 
				  ?>
                <input type="date" name="fecha_reajuste" id="fecha_reajuste" <?php echo $modal.$fecha_reajuste; ?> onclick="<?php echo $function_fecha_reajuste; ?>"  value="<?php echo date('Y-m-d'); ?>" class="form-control">
              </div>
            </div>

            
            <div class="form-group" id="retirar_de_hidden">
                <label for="retirar_de">Retirar de</label>
                <select  class="form-control" id="retirar_de" name="retirar_de">
                  <option selected>Caja</option>
                  <option>Banco</option>
                </select>
              </div>
            <div class="form-row">
              <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4"  id="entidad_hidden">
                <label for="entidad">Entidad</label>
                <select  class="form-control" id="entidad_caja" name="entidad_caja">
                  <?php
                        require_once('config/db.php');
                        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                        $query = "SELECT * FROM caja WHERE negocio = $negocio";
                        $row3 = $con->query($query); 
                        if ($row3->num_rows >= 1) {
                          while ($row = $row3->fetch_object()) { ?>
                    <option class="<?php echo $row->monto; ?>" value="<?php echo $row->id_caja; ?>">
                      <?php echo $row->nombre; ?>
                    </option>
                    <?php }} ?>
                </select>
                <select class="form-control"  name="entidad_banco" id="entidad_banco">
                  <?php
                        require_once('config/db.php');
                        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                        $query = "SELECT * FROM banco WHERE negocio = $negocio";
                        $row3 = $con->query($query); 
                        if ($row3->num_rows >= 1) {
                          while ($row = $row3->fetch_object()) { ?>
                    <option class="<?php echo $row->monto; ?>" value="<?php echo $row->id_banco; ?>">
                      <?php echo $row->banco; ?>
                    </option>
                    <?php }} ?>
                </select>
              </div>
              <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4" id="disponible_hidden">
                <label for="disponible_id">Monto Disponible</label>
                <input class="form-control" type="text" id="disponible_id" name="disponible_id" readonly>
              </div>
              <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4" id="no_cheque_hidden">
                <label for="no_codigo">N. Cheque / Depósito</label>
                <input type="text" class="form-control" name="no_codigo" id="no_codigo" placeholder="Numero de Cheque o Deposito">
               </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
        <button type="button" class="btn btn-info font-weight-bold btn-mda"  onclick="onload_calculator_prestamo()" data-toggle="modal" data-target="#modal_calculadora"><i class="fas fa-calculator"></i> Calculadora</button>
        <button type="button" class="btn btn-success font-weight-bold btn-mda" id="registrar_prestamo_vehiculo"><i class="fas fa-save"></i> Registrar</button>
      </div>
    </div>
  </div>
</div>