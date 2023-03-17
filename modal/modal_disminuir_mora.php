<div class="modal fade" id="modal_disminuir_mora" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document" style="max-width: 600px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          <i class="fas fa-comments-dollar"></i> Disminuir mora
        </h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="AlertActive"></div>
        <div class="form-row">
          <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <label for="name">Codigo</label>
            <input type="text" class="form-control" id="randomXR" name="randomXR" placeholder="Generar codigo de descuento" required>
          </div>
          <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <button class="btn btn-success" onclick="rand_code('0123456789', 7)" style="display: inline-block;vertical-align: middle;margin-top: 30px;">
              <i class="fas fa-sync-alt" style="color: white"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal">
          <i class="fas fa-times"></i> Cerrar
        </button>
        <button type="button" class="btn btn-success font-weight-bold btn-mda" onclick="enviarCodigo()">
          <i class="fas fa-money-bill"></i> Disminuir
        </button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function rand_code(chars, lon){
    code = "";
    for (x=0; x < lon; x++){
      rand = Math.floor(Math.random()*chars.length);
      code += chars.substr(rand, 1);
    }
    $('#randomXR').val(code);
  }

function enviarCodigo(){
  var random = $('#randomXR').val();
  if (random =='') {
    $('#AlertActive').html('<div class="alert alert-warning">'+
  '<strong>Warning!</strong> Por favor generar un codigo antes de enviar.'+
  '</div>');
  } else {
  $.ajax({
    type: "POST",
    url: "php/radomController.php",
    data: {
     "random": random
    },beforeSend: function (xhr) {
      console.log('Guardando codigo...');
    },success: function(data){
      console.log('Codigo guardado con exitos');
      console.log(data);
      $.notify({
        icon: "add_alert",
        message: "Codigo guardado con exitos."
      },{
        type: 'success',
        timer: 2000,
        placement: {
          from: 'top',
          align: 'center'
        }
      });
      $('#AlertActive').html('');
      $('#randomXR').val('');
      $('#modal_disminuir_mora').modal('hide');
    },error: function(xhr){
      console.log(xhr);
    }
  });
}
}
</script>