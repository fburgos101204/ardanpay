<div class="modal fade" id="modal_plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="alertplan"></div>
         <form  name="data_plan"  id="data_plan" autocomplete="off">
			 
            <input class="form-control" type="hidden" id="creador_caja" name="creador_caja">
            <input class="form-control" type="hidden" id="id_plan" name="id_plan">
			 
            <div class="form-row">
            <div class="form-group col-sm-12 col-md-6">
            <div class="form-label-group">
              <input class="form-control" type="text" id="plan_name" name="plan_name" placeholder="Plan">
              <label for="plan_name">Plan</label>
            </div>
			</div>
			 
			<div class="form-group col-sm-12 col-md-6">
            <div class="form-label-group">
              <input type="text" class="form-control" id="cant_usuario" name="cant_usuario" placeholder="Cant. Usuarios" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
              <label for="cant_usuario">Cant. Usuarios</label>
            </div>
            </div>
            </div>
			 
            <div class="form-row">
			<div class="form-group col-sm-12 col-md-6">
            <div class="form-label-group">
              <input type="text" class="form-control" id="cant_prestamo" name="cant_prestamo" placeholder="Cant. Prestamo" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
              <label for="cant_prestamo">Cant. Préstamos</label>
            </div>
            </div>
            <div class="form-group col-sm-12 col-md-6">
            <div class="form-label-group">
              <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
              <label for="precio">Precio</label>
            </div>
            </div>
            </div>
			 
			<nav class="nav nav-tabs">
  			<a data-toggle="tab" href="#tab_modulos" class="nav-item nav-link active">Módulos</a>
  			<a data-toggle="tab" href="#tab_accesos" class="nav-item nav-link">Accesos</a>
		  </nav>
		 <div class="tab-content">
          <div class="tab-pane fade in active show form-row" id="tab_modulos" style="padding: 16px;">
            <div class="form-group col-md-4 mb-0">
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_inicio" id="ck_inicio">Inicio 
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_sol_prestamo" id="ck_sol_prestamo">Solicitud Préstamos<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_prestamo_personal" id="ck_prestamo_personal">Préstamos Personales<span class="form-check-sign"><span class="check"></span></span>
                </label>
              </div>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_prestamo_inmobilirario" id="ck_prestamo_inmobilirario">Préstamos Innmobilirarios<span class="form-check-sign"><span class="check"></span></span>
                </label>
              </div>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_prestamo_vehiculo" id="ck_prestamo_vehiculo">Préstamos Vehículos<span class="form-check-sign"><span class="check"></span></span>
                </label>
              </div>
			  <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_ranking" id="ck_ranking">Ranking
					<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
            </div>
            <div class="form-group col-md-4 mb-0">
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_historial_pago" id="ck_historial_pago">Historial Pagos<span class="form-check-sign"><span class="check"></span></span>
                </label>
              </div>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_historial_retiro" id="ck_historial_retiro">Historial Retiros<span class="form-check-sign"><span class="check"></span></span>
                </label>
              </div>
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_cliente" id="ck_cliente">Clientes 
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_vehiculo" id="ck_vehiculo">Vehículo
                  <span class="form-check-sign"><span class="check"></span></span></label>
              </div>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_inmobilirario" id="ck_inmobilirario">Inmobilirarios<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
			  <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_mensajero" id="ck_mensajero">Mensajeros
					<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
            </div>
            <div class="form-group col-md-4  mb-0">
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_caja" id="ck_caja">Cajas<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_banco" id="ck_banco">Bancos<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_notario" id="ck_notario">Notarios<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
			  <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_ruta" id="ck_ruta">Rutas
					<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_user" id="ck_user">Usuarios<span class="form-check-sign"><span class="check"></span></span></label>
              </div>

              <div class="form-check form-check-block">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="ck_config" id="ck_config">Configuración<span class="form-check-sign"><span class="check"></span></span></label>
              </div>
            </div>
            </div>
          	<div class="tab-pane fade form-row" id="tab_accesos" style="padding: 16px;">
			  <div class="form-group col-md-4 mb-0">
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_cambio_mora" id="ck_cambio_mora">
					Cambiar Mora 
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_cambio_fecha_pagar" id="ck_cambio_fecha_pagar">
					Cambiar Fecha Pago
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_modificar_prestamo" id="ck_modificar_prestamo">
					Modificar Préstamo
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
			  </div>
			  <div class="form-group col-md-4 mb-0">
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_modificar_cliente" id="ck_modificar_cliente">
					Modificar Cliente 
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_eliminar_cliente" id="ck_eliminar_cliente">
					Eliminar Cliente
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_grafica_estadistica" id="ck_grafica_estadistica">
					Estadísticas Gráficas
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
			  </div>
			  <div class="form-group col-md-4 mb-0">
              <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_fecha_inicio_prestamo" id="ck_fecha_inicio_prestamo">
					Fecha de Inicio de Préstamo
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                  </label>
              </div>
			  <div class="form-check form-check-block">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="ck_whatsapp" id="ck_whatsapp">
					Whatsapp
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
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>

        <button id="btn_update_plan" name="btn_update_plan" type="button" class="btn btn-success font-weight-bold btn-mda"><i class="fas fa-save"></i> Actualizar</button>

        <button id="btn_save_plan" name="btn_save_plan" type="button" class="btn btn-info font-weight-bold btn-mda"><i class="fas fa-save"></i> Registrar</button>
      </div>
    </div>
  </div>
</div>