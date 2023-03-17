<div class="modal fade" id="modal_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="alertcliente"></div>
         <form  name="data_cliente"  id="data_cliente" class="empety"  autocomplete="off">
           	<input type="hidden" id="creador" name="creador">
           	<input type="hidden" id="id_cliente" name="id_cliente">
           	<input type="hidden" id="id_negocio" name="id_negocio">
			 
            <div class="form-row">
              <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="image-upload">
                  <label id="img_cliente" class="text-center" for="file_img_cliente" style="display: block;">
                      <img src="files/logo_user.jpg" class="img_solicitud">
                  </label>
                  <input type="file" class="img_file_inpt" name="file_img_cliente" id="file_img_cliente" accept="image/*"/>
                </div>
              </div>
				      
              <div class="form-group col-sm-12 col-md-9 col-lg-9 col-xl-9">
          <div class="form-row">
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6" style="margin-top:2%;">
              	<div class="form-group">
            	<div class="form-label-group">
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" tabindex="1">
                <label for="nombre">Nombre</label>
				</div>
				</div>
				  
              	<div class="form-group">
            	<div class="form-label-group">
                <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cedula o Pasaporte" maxlength="13" onkeypress="cedulas(); if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"  tabindex="3">
                <label for="cedula">Cédula o Pasaporte</label>
				</div>
				</div>
              </div>
				
              <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6" style="margin-top:2%;">
              	<div class="form-group">
            	<div class="form-label-group">
                <input type="text" class="form-control" id="apellido" placeholder="Apellido" name="apellido"  tabindex="2">
                <label for="apellido">Apellido</label>
               	</div>
				</div>
              
              	<div class="form-group">
            	<div class="form-label-group">
                <input type="date" class="form-control" id="fecha_nacimiento" placeholder="Fecha Nacimiento" name="fecha_nacimiento" tabindex="4">
                <label for="fecha_nacimiento">Fecha Nacimiento</label>
				</div>
				</div>
				  
              </div>
            </div>
            </div>
</div>

            <div class="form-row">
			  <div class="form-group col-md-24">
            	<div class="form-label-group">
                <input type="text" class="form-control" id="nacionalidad" placeholder="Nacionalidad" name="nacionalidad" tabindex="5">
                <label for="nacionalidad">Nacionalidad</label>
				</div>
              </div>
              <div class="form-group col-md-24">
            	<div class="form-label-group">
                <input type="text" class="form-control" id="telefono" placeholder="Telefono" name="telefono" maxlength="12" onkeypress="phone(); if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"  tabindex="5">
                <label for="telefono">Teléfono</label>
				</div>
              </div>
              <div class="form-group col-md-24">
            	<div class="form-label-group">
                <input type="text" class="form-control" id="celular" placeholder="Celular" name="celular" maxlength="12" onkeypress="cell(); if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"  tabindex="6">
                <label for="celular">Celular</label>
              	</div>
              </div>
              <div class="form-group col-md-24">
            	<div class="form-label-group">
                <input type="email" class="form-control" id="correo" placeholder="E-Mail" name="correo"  tabindex="7">
                <label for="correo">E-Mail</label>
				</div>
              </div>
              <div class="form-group col-md-24">
            	<div class="form-label-group">
                <input id="direccion" type="text" class="form-control"  placeholder="Direccion" name="direccion" required tabindex="8">
                <label for="direccion">Dirección</label>
              	</div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
            	<div class="label form-label-group">
                <select type="text" name="sexo" id="sexo" class="form-control"  placeholder="Sexo" tabindex="9">
				  <option value="null" disabled selected>Sexo</option>
                  <option>Femenino</option>
                  <option>Masculino</option>
                </select>
              	</div>
              </div>
              <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
            	<div class="form-label-group">
                <select type="text" name="estado_civil" id="estado_civil"  placeholder="Estado Civil" class="form-control"  tabindex="10">
				  <option value="null" disabled selected>Estado Civil</option>
                  <option>Soltero</option>
                  <option>Casado</option>
                  <option>Unión Libre</option>
                  <option>Divorciado</option>
                  <option>Viudo</option>
                </select>
             	</div>
              </div>
              <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <select name="tipo_vivienda" id="tipo_vivienda" class="form-control"  tabindex="11">
				  <option value="null" disabled selected>Tipo Vivienda</option>
                  <option>Propia</option>
                  <option>Alquiler</option>
                  <option>Otra</option>
                </select>
              </div>
              <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
              <select id="ocupacion" data-val="true" name="ocupacion" class="form-control"  tabindex="12">
				<option value="null" disabled selected>Ocupación</option>
                <option>Empleado</option>
                <option>Desempleado</option>
                <option>Estudiante</option>
                <option>Banquero</option>
                <option>Comerciante</option>
                <option>Profesional</option>
                <option>Rifero</option>
                <option>Otros</option>
              </select>
              </div>
            </div>

          <div class="form-row">
            <div class="form-group col-md-24">
              <div class="form-label-group">
              <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Mayor Titulo" tabindex="13">
              <label for="titulo">Mayor Titulo</label>
              </div>
            </div>
            <div class="form-group col-md-24">
              <div class="form-label-group">
              <input id="ingreso" type="text" placeholder="Ingresos" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" name="ingreso"  tabindex="14">
              <label for="ingreso">Ingresos</label>
              </div>
            </div>
            <div class="form-group col-md-24">
              <div class="form-label-group">
              <input type="text" class="form-control" placeholder="Facebook" id="facebook" name="facebook"  tabindex="15">
              <label for="facebook">Facebook</label>
              </div>
            </div>
              <div class="form-group col-md-24">
              	<div class="form-label-group">
                <input type="text" name="instagram" id="instagram" placeholder="Instagram" class="form-control"  tabindex="16">
                <label for="instagram">Instagram</label>
              	</div>
              	</div>
               <div class="form-group col-md-24">
              	<div class="form-label-group">
                <input type="text" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" name="dependientes" id="dependientes" class="form-control"  tabindex="17"  placeholder="Dependientes">
                <label for="dependientes">Dependientes</label>
              	</div>
              </div>
              </div>
			 
		  	<div>
			<nav class="nav nav-tabs">
  				<a data-toggle="tab" href="#container_referencia" class="nav-item nav-link active"  tabindex="18">Referencias</a>
  				<a data-toggle="tab" href="#container_garante" class="nav-item nav-link"  tabindex="19">Garantes</a>
				<a data-toggle="tab" href="#container_foto_cedula" class="nav-item nav-link"  tabindex="20">Foto Cédula</a>
			</nav>
			<div class="tab-content">
            <div class="row tab-pane fade in active show" id="container_referencia"  style="padding: 16px;">
				<button type="button" style="float: right;margin-top: -10px;margin-bottom: 5px;" class="btn btn-primary btn-round"
						data-toggle="modal" data-target="#modal_referencia" ><i class="fas fa-plus"></i></button>
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
					<tbody id="referencia_table">
					</tbody>
				</table>
			</div>
			<div class="row tab-pane fade" id="container_garante" style="padding: 16px;">
				<button type="button" style="float: right;margin-top: -10px;margin-bottom: 5px;" class="btn btn-primary  btn-round" data-toggle="modal"
							data-target="#modal_garante"><i class="fas fa-plus"></i></button>
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
					<tbody id="garante_table">
					</tbody>
				</table>
			</div>
            <div class="row tab-pane fade" style="margin-top:10px;padding:16px;" id="container_foto_cedula">
               <div class="input-group">
                 <div>
                  <input type="file" class="custom-file-input" name="cedula_cliente_img" id="cedula_cliente_img">
                  <label class="custom-file-label" id="choosen_file" for="cedula_cliente_img">Choose file</label>
                 </div>
               </div>
			</div>
		 </div>
	    </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>

        <button id="save_cliente" name="save_cliente" type="button" class="btn btn-info font-weight-bold btn-mda"><i class="fas fa-save"></i> Guardar</button>

        <button id="update_cliente" name="update_cliente" type="button" class="btn btn-success font-weight-bold btn-mda">
          <i class="fas fa-save"></i> Actualizar</button>
      </div>
    </div>
  </div>
</div>