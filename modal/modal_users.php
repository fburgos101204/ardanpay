<div class="modal fade" id="User" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="alertuser"></div>
        <form  name="formCbUser"  id="formCbUser" class="empety"  autocomplete="off">
            <div class="form-row">
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="firstname" name="firstname">
                <input type="hidden" class="form-control" id="user_id" name="user_id">
              </div>
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <label for="lastname">Apellido</label>
                <input type="text" class="form-control" id="lastname" name="lastname">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <label for="user_name">Usuario</label>
                <input type="text" class="form-control" id="user_name" name="user_name">
              </div>
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="user_email" name="user_email">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6" id="hide-ps">
                <label for="ps">Contraseña</label>
                <input type="password" class="form-control" id="ps" name="ps">
              </div>
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6" id="hide-ps2">
                <label for="ps">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="ps2" name="ps2">
              </div>
            </div>
			
			
            <div class="form-row">
			<?php if($negocio == 0){ ?>
            <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
              <label for="negocio">Negocio</label>
              <select class="form-control js-example-basic-single" data-style="btn btn-link" id="negocio" name="negocio">
				<option class="" value="-1">Seleccione un negocio</option>
                <option class="" value="0">Xilus Financiera</option>
				  <?php
                      require_once('config/db.php');
                      $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                      $query = "SELECT ngc.id_negocio,ngc.nombre,pln.permisos FROM negocio AS ngc
					  			LEFT JOIN negocio_plan AS ngcp ON ngc.id_negocio = ngcp.id_negocio
								LEFT JOIN planes AS pln ON ngcp.id_plan = pln.id_plan
								GROUP BY ngc.id_negocio";
                      $row3 = $con->query($query); 
                      if ($row3->num_rows >= 1) {
                        while ($row = $row3->fetch_object()) { ?>
                  <option class='<?php echo $row->permisos; ?>' value="<?php echo $row->id_negocio; ?>">
                    <?php echo $row->nombre; ?>
                  </option>
                  <?php }} ?>
              </select>
            </div>
			<?php }else{ ?>
			<input type="hidden" id="negocio" name="negocio" value="<?php echo $negocio; ?>">
			<?php } ?>
			<div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
              <label for="nivel">Privilegios</label>
              <select class="form-control" data-style="btn btn-link" id="nivel" name="nivel">
                <option value="3">Inspector</option>
                <option value="2">Secretaria</option>
                <option value="1">Administrador</option>
              </select>
            </div>
            </div>
			
			
          <nav class="nav nav-tabs mt-4">
  			<a data-toggle="tab" href="#tab_modulos" class="nav-item nav-link active">Módulos</a>
			<?php if($negocio == 0){ ?>
  			<a data-toggle="tab" href="#tab_servicio" class="nav-item nav-link">Servicios</a>
			<?php } ?>
  			<a data-toggle="tab" href="#tab_accesos" class="nav-item nav-link">Accesos</a>
		  </nav>
		<div  class="tab-content">
          <div class="tab-pane fade in active show form-row" id="tab_modulos" style="padding: 16px;" >
            <div class="form-group col-md-4 mb-0">
				
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'inicio'} == "on"){ ?>
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_inicio" id="ck_inicio">Inicio 
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
			  <?php } ?>
				
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'sol_prestamo'} == "on"){ ?>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_sol_prestamo" id="ck_sol_prestamo">Solicitud Préstamos<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
			  <?php } ?>
				
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'prestamo_personal'} == "on"){ ?>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_prestamo_personal" id="ck_prestamo_personal">Préstamos Personales<span class="form-check-sign"><span class="check"></span></span>
                </label>
              </div>
			  <?php } ?>
      		 
			  <?php  if ($negocio == 0 || $permisos_muestra->{'prestamo_semanal'} == "on"){ ?>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_prestamo_semanal" id="ck_prestamo_semanal">Préstamos Semanal<span class="form-check-sign"><span class="check"></span></span>
                </label>
              </div>
			  <?php } ?>				

			
			<?php  if ($negocio == 0 || $permisos_muestra->{'prestamo_inmobilirario'} == "on"){ ?>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_prestamo_inmobilirario" id="ck_prestamo_inmobilirario">Préstamos Innmobilirarios<span class="form-check-sign"><span class="check"></span></span>
                </label>
              </div>
			  <?php } ?>
				
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'prestamo_vehiculo'} == "on"){ ?>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_prestamo_vehiculo" id="ck_prestamo_vehiculo">Préstamos Vehículos<span class="form-check-sign"><span class="check"></span></span>
                </label>
              </div>
			  <?php } ?>
				
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'ranking'} == "on"){ ?>
			  <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_ranking" id="ck_ranking">Ranking
					<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
			  <?php } ?>
            </div>


            <div class="form-group col-md-4 mb-0">
				
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'historial_pago'} == "on"){ ?>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_historial_pago" id="ck_historial_pago">Historial Pagos<span class="form-check-sign"><span class="check"></span></span>
                </label>
              </div>
			  <?php } ?>
				
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'historial_retiro'} == "on"){ ?>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_historial_retiro" id="ck_historial_retiro">Historial Retiros<span class="form-check-sign"><span class="check"></span></span>
                </label>
              </div>
			  <?php } ?>
				
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'cliente'} == "on"){ ?>
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_cliente" id="ck_cliente" >Clientes 
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
			  <?php } ?>
				
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'vehiculo'} == "on"){ ?>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_vehiculo" id="ck_vehiculo">Vehículo
                  <span class="form-check-sign"><span class="check"></span></span></label>
              </div>
			  <?php } ?>
				
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'inmobilirario'} == "on"){ ?>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_inmobilirario" id="ck_inmobilirario">Inmobilirarios<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
			  <?php } ?>
				
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'mensajero'} == "on"){ ?>
			  <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_mensajero" id="ck_mensajero">Mensajeros
					<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
			  <?php } ?>
            </div>

            <div class="form-group col-md-4 mb-0">
				
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'caja'} == "on"){ ?>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_caja" id="ck_caja">Cajas<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
			  <?php } ?>
				
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'banco'} == "on"){ ?>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_banco" id="ck_banco">Bancos<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
			  <?php } ?>
				
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'notario'} == "on"){ ?>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_notario" id="ck_notario">Notarios<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
			  <?php } ?>
				
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'ruta'} == "on"){ ?>
			  <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_ruta" id="ck_ruta">Rutas
					<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
			  <?php } ?>
				
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'usuario'} == "on"){ ?>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_user" id="ck_user">Usuarios<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
			  <?php } ?>

      		  <?php  if ($negocio == 0 || $permisos_muestra->{'configuracion'} == "on"){ ?>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_config" id="ck_config">Configuración<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
			  <?php } ?>
            </div>
            </div>
			
		  
		  <?php if($negocio == 0){ ?>
		  <div class="tab-pane fade form-row" id="tab_servicio"  style="padding: 16px;">
			  <div class="form-group col-md-4 mb-0">
				  
			  <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_plan" id="ck_plan">
					Planes<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
				  
			  <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_negocio" id="ck_negocio">
					Negocios<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
				  
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_p_efectivo" id="ck_p_efectivo">
					Pagos Efectivo<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
				  
              
			  </div>
			  
			  <div class="form-group col-md-4 mb-0">
				  
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_p_tarjeta" id="ck_p_tarjeta">
					Pagos Tarjeta<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
				  
             <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_r_estado_negocio" id="ck_r_estado_negocio">
					Reporte Estado Negocio<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_r_pago_servicio" id="ck_r_pago_servicio">
					Reporte Pagos Servicio
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
			  </div>
		  </div>
		  <?php } ?>
			
          <div class="tab-pane fade form-row" id="tab_accesos"  style="padding: 16px;">
			  <div class="form-group col-md-4 mb-0">
				  
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'cambio_mora'} == "on"){ ?>
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_cambio_mora" id="ck_cambio_mora">
					Cambiar Mora 
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
		 	  <?php } ?>
				  
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'cambio_fecha_pagar'} == "on"){ ?>
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_cambio_fecha_pagar" id="ck_cambio_fecha_pagar">
					Cambiar Fecha Pago
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
		 	  <?php } ?>
				  
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'modificar_prestamo'} == "on"){ ?>
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_modificar_prestamo" id="ck_modificar_prestamo">
					Modificar Préstamo
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
		 	  <?php } ?>
			  </div>
			  
			  <div class="form-group col-md-4 mb-0">
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'modificar_cliente'} == "on"){ ?>
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_modificar_cliente" id="ck_modificar_cliente">
					Modificar Cliente 
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
		 	  <?php } ?>
				  
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'eliminar_cliente'} == "on"){ ?>
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_eliminar_cliente" id="ck_eliminar_cliente">
					Eliminar Cliente
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
		 	  <?php } ?>
				  
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'grafica_estadistica'} == "on"){ ?>
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_grafica_estadistica" id="ck_grafica_estadistica">
					Estadísticas Gráficas
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
		 	  <?php } ?>
			  </div>
			  
			  <div class="form-group col-md-4 mb-0">
      		  <?php  if ($negocio == 0 || $permisos_muestra->{'grafica_estadistica'} == "on"){ ?>
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_fecha_inicio_prestamo" id="ck_fecha_inicio_prestamo">
					Fecha de Inicio de Préstamo
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
		 	  <?php } ?>
			  <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_eliminar_pago" id="ck_eliminar_pago">
					Eliminar Pago
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
			  </div>
		  </div>
	</div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal">
          <i class="fas fa-times"></i> Cerrar</button>

        <button id="save-user" name="save-user" type="button" class="btn btn-success font-weight-bold btn-mda">
        <i class="fas fa-save"></i> Guardar</button>

        <button id="update-user" name="update-user" type="button" class="btn btn-success font-weight-bold btn-mda">
        <i class="fas fa-save"></i> Actualizar</button>
      </div>
    </div>
  </div>
</div>