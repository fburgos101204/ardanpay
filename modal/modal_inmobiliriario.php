<div class="modal fade" id="modal_inmobiliriario" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="mediumModalLabel"><i class="fas fa-hotel"></i> Modificar Inmobiliaria
</h5>
			<button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<div class="modal-body">
      <div id="alertPass"></div>
		<form id="data_casa" name="data_casa"  autocomplete="off">
		<div class="form-row">	
    		<input type="hidden" class="form-control" id="creador" name="creador">
    		<input type="hidden" class="form-control" id="id_casa" name="id_casa">
			<div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
              <div class="form-label-group">
              <input type="text"  id="tipo" placeholder="Tipo" name="tipo" class="form-control">
              <label for="tipo">Tipo</label>
              </div>
            </div>
            <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
				<div class="form-label-group">
              	<input type="text" class="form-control" placeholder="Color" id="color" name="color">
              	<label for="color">Color</label>
            	</div>
            </div>
            <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
				<div class="form-label-group">
              	<input type="text" class="form-control" placeholder="Cantidad de Habitaciones" id="habitacion" name="habitacion" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
              	<label for="habitacion">Cantidad de Habitaciones</label>
            	</div>
            </div>
            <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
				<div class="form-label-group">
              	<input type="text" class="form-control" placeholder="Direccion" id="direccion" name="direccion">
              	<label for="direccion">Dirección</label>
            	</div>
            </div>
            
        </div>

        <div class="form-row">	
            <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
				<div class="form-label-group">
              	<input type="text" class="form-control" placeholder="Cantidad de Baños" id="baño" name="baño" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
              	<label for="baño">Cantidad de Baños</label>
            	</div>
            </div>
            <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
				<div class="form-label-group">
              	<input type="text" class="form-control" placeholder="Cantidad de Cocina" id="cocina" name="cocina" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
              	<label for="cocina">Cantidad de Cocina</label>
            	</div>
            </div>
            <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
				<div class="form-label-group">
              	<input type="text" class="form-control" placeholder="Cantidad de Sala" id="sala" name="sala" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
              	<label for="sala">Cantidad de Sala</label>
            	</div>
            </div>
            <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
				<div class="form-label-group">
              	<input type="text" class="form-control"  placeholder="Cantidad de Comedor" id="comedor" name="comedor" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
              	<label for="comedor">Cantidad Comedor</label>
            	</div>
            </div>
        </div>
            <div class="form-group col-sm-12 px-0">
              	<label for="descripcion">Descripción</label>
              	<textarea type="text" cols="40" rows="2"  placeholder="Descripcion" class="form-control" id="descripcion" name="descripcion">
			  	</textarea>
            </div>
			
			<div class="form-row">
				<div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4" style="flex-grow: 0 !important;">
					<label for="logo" style="font-weight: bold;">
					<i class="fas fa-images"></i> Fotografía #1</label>
					<div class="custom-file">
					<div class="media_foto_1" style="height:200px;">
					<div id="part_frontal" style="position:relative;height:180px;">
            			<img src="" class="custom_img-2">
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
				<div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4" style="flex-grow: 0 !important;">
					<label for="logo" style="font-weight: bold;">
					<i class="fas fa-images"></i> Fotografía #2</label>
					<div class="custom-file">
					<div class="media_foto_1" style="height:200px;">
					<div id="part_trasera" style="position:relative;height:180px;">
            			<img src="" class="custom_img-2">
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
        	<div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4" style="flex-grow: 0 !important;">
			<label for="logo" style="font-weight: bold;">
       		<i class="fas fa-images"></i> Fotografía #3</label>
          	<div class="custom-file">
			<div class="media_foto_1" style="height:200px;">
			<div id="lat_derecho" style="position:relative;height:180px;">
            	<img src="" class="custom_img-2">
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
      </div>
        </form>
	</div>
	<div class="modal-footer">
			<button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
			<button type="button" class="btn btn-success font-weight-bold btn-mda" id="update_casa"><i class="fas fa-save"></i> Actualizar</button>
			<button type="button" class="btn btn-success font-weight-bold btn-mda" id="save_casa"><i class="fas fa-save"></i> Guardar</button>
	</div>

</div>
</div>
</div>