<?php 
$active_admin = 'active';
include_once("header/header.php"); 
if ($permisos->{'configuracion'} == "on"  || isset($_POST['location'])) {
include_once("header/menu.php");
?>
<div id="content-wrapper">

<div class="container-fluid">
<input type="hidden" id="color_conf" value="<?php echo $barcolor; ?>">
<input type="hidden" id="color_conf_font" value="<?php echo $font; ?>">
  <!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="">Administración</a>
  </li>
  <li class="breadcrumb-item active">Configuración</li>
  
</ol>

  <div class="form-row">
    <div class="form-group col-md-8">
  <div class="card mb-3">
    <div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
      <i class="fas fa-cog"></i> Configuración de la Empresa
      
    </div>
    <div class="card-body">
      <form id="form_config" name="form_config">
        <div class="form-row" >
          <div class="form-group col-sm-12 col-md-3 col-lg-3 col-xl-3">
                <div class="image-upload">
                  <label id="img_empresa" for="file_img_empresa">
                      <img src="<?php echo $logo; ?>" class="img_solicitud">
                  </label>
                  <input type="file" class="img_file_inpt" name="file_img_empresa" id="file_img_empresa" accept="image/*"/>
                </div>
          </div>
          <div class="form-group col-sm-12 col-md-9 col-lg-9 col-xl-9">
            <div class="form-row">
              <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <label for="empresa" style="font-weight: bold;">Empresa</label>
                <input type="hidden" name="negocio" id="negocio" value="<?php echo $negocio; ?>">
                <input type="text" class="form-control" name="empresa" id="empresa" value="<?php echo $empresa; ?>">
              </div>
              <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <label for="rnc" style="font-weight: bold;">RNC de la empresa</label>
                <input type="text" name="rnc" id="rnc" value="<?php echo $rnc; ?>"class="form-control">
              </div>
              <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <label for="correo" style="font-weight: bold;">Correo Electrónico</label>
            <input type="text" name="correo" id="correo" value="<?php echo $correo; ?>"class="form-control">
              </div>
          </div>
          <div class="form-row">
            <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
              <label for="telefono_empresa" style="font-weight: bold;">Teléfono</label>
              <input type="text" name="telefono_empresa" maxlength="12" onkeypress="telefono_empresa(); if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" id="telefono_empresa" value="<?php echo $telefono_empresa; ?>"class="form-control">
            </div>
            <div class="form-group col-sm-12 col-md-8 col-lg-8 col-xl-8">
              <label for="direccion" style="font-weight: bold;">Dirección</label>
              <input type="text" name="direccion" id="direccion" value="<?php echo $direccion; ?>"class="form-control">
            </div>
          </div>
          </div>
        </div>
      </form>
    </div>
    <div class="card-footer small text-muted"></div>
  </div>
</div>

<div class="form-group col">
  <div class="card mb-3" style="height: 95%;">
    <div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
      <i class="fas fa-chart-area"></i> Configuración de préstamos</div>
      <div class="card-body">
        <div class="form-group">
          <label for="telefono_empresa" style="font-weight: bold;">Porcentaje de Mora</label>
          <input type="text" name="mora_config" maxlength="3" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" id="mora_config" value="<?php echo $mora_empresa*100; ?>" class="form-control">
        </div>
        <div class="form-group">
          <label for="telefono_empresa" style="font-weight: bold;">Porcentaje de Mora</label>
          <select class="form-control" name="tipo_mora" id="tipo_mora">
            <option value="2">Mora a Capital</option>
            <option value="1">Mora a Cuota</option>
          </select>
        </div>
      </div>
      <div class="card-footer small text-muted"></div>
  </div>
  </div>
</div>

  <div class="form-row">
  
  <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
  <div class="card">
    <div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
      <i class="fas fa-bars"></i> Configuración de Estilo</div>
      <div class="card-body">
      <div class="form-row">

        <div class="form-group col">
          <label class="container">
            <input type="radio" value="dark" id="dark" name="barcolor">
            <span class="checkmark dark"></span>
          </label>
        </div>  
        

        <div class="form-group col">
          <label class="container">
            <input type="radio" value="warning" id="warning" name="barcolor">
            <span class="checkmark warning"></span>
          </label>
        </div>  
        
        <div class="form-group col">
          <label class="container">
            <input type="radio" value="info" id="info" name="barcolor">
            <span class="checkmark info"></span>
          </label>
        </div>  
        
        <div class="form-group col">  
          <label class="container">
            <input type="radio" value="success" id="success" name="barcolor">
            <span class="checkmark success"></span>
          </label>
        </div>  
        <div class="form-group col">
          <label class="container">
            <input type="radio" value="danger" id="danger" name="barcolor">
            <span class="checkmark danger"></span>
          </label>
        </div>

        <!---<div class="form-group col">
          <label class="container">
            <input type="radio" value="white" id="white" name="barcolor">
            <span class="checkmark white"></span>
          </label>
        </div>-->
        </div>
      </div>
    </div>
    <div class="card-footer small text-muted"></div>
  </div>
  <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
  <div class="card">
    <div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
      <i class="fas fa-font"></i> Configuración de Letras</div>
      <div class="card-body">
      <div class="form-row">

        <div class="form-group col">
          <label class="container2">
            <input type="radio" value="dark" id="dark" name="fontcolor">
            <span class="checkmark2 dark"></span>
          </label>
        </div>  
        

        <div class="form-group col">
          <label class="container2">
            <input type="radio" value="warning" id="warning" name="fontcolor">
            <span class="checkmark2 warning"></span>
          </label>
        </div>  
        
        <div class="form-group col">
          <label class="container2">
            <input type="radio" value="info" id="info" name="fontcolor">
            <span class="checkmark2 info"></span>
          </label>
        </div>  
        
        <div class="form-group col">  
          <label class="container2">
            <input type="radio" value="success" id="success" name="fontcolor">
            <span class="checkmark2 success"></span>
          </label>
        </div>  
        <div class="form-group col">
          <label class="container2">
            <input type="radio" value="danger" id="danger" name="fontcolor">
            <span class="checkmark2 danger"></span>
          </label>
        </div>
		
        <div class="form-group col">
          <label class="container2">
            <input type="radio" value="white" id="white" name="fontcolor">
            <span class="checkmark2 white"></span>
          </label>
        </div>
        </div>
      </div>
    </div>
    <div class="card-footer small text-muted"></div>
  </div>
  </div>
	<button style="float: right; margin-bottom: 30px !important; margin-top: 30px !important;" type="button" class="btn btn-success font-weight-bold btn-mda" onclick="subir()" title="Guardar Cambios"><i class="fas fa-save"></i> Guardar Cambios</button>
  </div>


</div>
</div>
<script type="text/javascript" >
  $(document).ready(function(){
    $("#tipo_mora").val('<?php echo $tipo_mora; ?>');
    $("#tipo_mora").trigger("change");
  });
</script>
<script type="text/javascript" src="js/txt.js"></script>
<script type="text/javascript" src="js/js_config.js"></script>
<script type="text/javascript" src="js/subir_archivos.js"></script>
<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>