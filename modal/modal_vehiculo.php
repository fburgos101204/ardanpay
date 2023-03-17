<div class="modal fade" id="modal_vehiculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-car"></i> Modificar Vehículo</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="alertvehiclo"></div>
          <form  name="data_vehiculo"  id="data_vehiculo" class="empety"  autocomplete="off">
            <!-------Prestamo--------------->
            <input type="hidden" id="id_vehiculo" name="id_vehiculo">
			<div class="form-row">
				<div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
            	  <div class="form-label-group">
				  <input type="text" class="form-control" placeholder="Marca" name="marca_vehiculo" id="marca_vehiculo">
				  <label for="marca_vehiculo">Marca</label>
				  </div>
				</div>
				<div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
            	  	<div class="form-label-group">
              		<input type="text" class="form-control" placeholder="Modelo" name="modelo_vehiculo" id="modelo_vehiculo">
					<label for="modelo_vehiculo" class="control-label">Modelo</label>
				  	</div>
            	</div>
				<div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
            	  	<div class="form-label-group">
              		<input type="text" class="form-control" placeholder="Matricula" name="matricula_vehiculo" id="matricula_vehiculo">
              		<label for="matricula_vehiculo" class="control-label">Matrícula</label>
				  	</div>
            	</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
            	  	<div class="form-label-group">
					<input type="text" class="form-control" placeholder="Año" name="año_vehiculo" id="año_vehiculo">
					<label for="año_vehiculo" class="control-label">Año</label>
				  	</div>
            	</div>
				<div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
            	  	<div class="form-label-group">
              		<input type="text" class="form-control" placeholder="Color" name="color_vehiculo" id="color_vehiculo">
              		<label for="color_vehiculo" class="control-label">Color</label>
				  	</div>
            	</div>
				<div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
              		<select  type="text" class="form-control"  name="tipo_vehiculo" id="tipo_vehiculo" style="height: 50px;">
						<option value="null" disabled selected>Tipo de Vehículo</option>
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
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
        <button type="button" class="btn btn-info font-weight-bold btn-mda" id="update_vehiculo"><i class="fas fa-save"></i> Modificar</button>
      </div>
    </div>
  </div>
</div>