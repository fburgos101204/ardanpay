function cedula_mensajero()
{
  var len = $("#cedula").val().length;
  var dato = $("#cedula").val();
  if (event.keyCode != 8 || event.keyCode != 46) {
    if (len == 3 || len == 11) {
      $("#cedula").val(dato+"-");
  }
  }
}
function telefono_mensajero(){
  var len = $("#telefono").val().length;
  var dato = $("#telefono").val();
  if (event.keyCode != 8 || event.keyCode != 46) {
    if (len == 3 || len == 7) {
      $("#telefono").val(dato+"-");
  }
  }
}

/*FUNCION DEL MODAL PARA CREAR EL USUARIO*/
function new_mensajero(id_negocio,creador){                 
    open_mensajero('new',null,id_negocio,null,null,null,null,null,null,null,null,null,null,creador);
}
/*FUNCION DE RESETEAR LA CONTRASENA DEL USUARIO*/
function pass(id_mensajero){
  
    document.data_mensajero_pass.id_mensajero_pass.value = id_mensajero;
    document.data_mensajero_pass.mensajero_pass.value ="";
    document.data_mensajero_pass.mensajero_passw.value ="";
    $("#alertPassw").html('');
}

$( document ).ready(function() {
  $("#update_pass").click(function(){

    var pos = $('#mensajero_pass').val();
    var len = pos.length;

    if(len < 1){
            $('#alertPassw').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert!</strong> La Contraseñas no debe estar vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');

    }else if(len < 8) {
            $('#alertPassw').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert!</strong> La contraseñas debe tener como minimo 8 caracteres.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');

    }else if ($('#mensajero_pass').val() != $('#mensajero_passw').val()) {
            $('#alertPassw').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
            '<strong>Alert!</strong> Las Contraseñas no Coinciden.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
            //event.preventDefault();
        }else{
          var duda ='password';
          $.ajax({
             type: "POST",
             url: "php/mensajerocontroller.php",
             data: $('#data_mensajero_pass').serialize()+'&duda='+duda,
             success: function(resp){
			   console.log(resp);
               $("#table_mensajero").load(location.href+" #table_mensajero>*","");
               $('#modal_pass_mensajero').modal('hide');
               $('#alertPassw').hide();
              $.notify({
                icon: "add_alert",
                message: "La contraseña se actualizo con exitos."
              },{
                type: 'success',
                timer: 2000,
                placement: {
                  from: 'top',
                  align: 'center'
              }
            });
          }
        });
      }
  });
});


 /*FUNCION DEL MODAL PARA EDITAR EL USUARIO*/
function open_mensajero(proceso,id_mensajero,id_negocio,nombre,apellido,cedula,telefono,
						 correo,direccion,imei,dispositivo,username,pass,creador)
{   
	document.data_mensajero.creador.value = creador;
	document.data_mensajero.id_mensajero.value = id_mensajero;
    document.data_mensajero.id_negocio.value = id_negocio;
    document.data_mensajero.nombre.value = nombre;
    document.data_mensajero.apellido.value = apellido;
    document.data_mensajero.cedula.value = cedula;
    document.data_mensajero.telefono.value = telefono;
    document.data_mensajero.correo.value = correo;
    document.data_mensajero.direccion.value = direccion;
    document.data_mensajero.imei.value = imei;
    document.data_mensajero.dispositivo.value = dispositivo;
    document.data_mensajero.username.value = username;
    document.data_mensajero.pass.value = "";
    document.data_mensajero.passw.value = "";
	
    $("#alert_mensajero").html('');
    $('#modal_mensajero').on('shown.bs.modal', function () {
        var modal = $(this);
        if (proceso === 'new'){                            
            $('#save_mensajero').show();
            $('#update_mensajero').hide();
            $('#hide-ps').show();
            $('#hide-ps2').show();              
            modal.find('.modal-title').html('<i class="fas fa-biking"></i> Añadir Mensajero');        
        }else if (proceso === 'edit'){
            $('#save_mensajero').hide();                    
            $('#update_mensajero').show();
            $('#hide-ps').hide();
            $('#hide-ps2').hide();                    
            modal.find('.modal-title').html('<i class="fas fa-biking"></i> Modificar Mensajero');
        }
    });
}

 /*FUNCION QUE AGREGA Y EDITA EL USUARIO*/
$( document ).ready(function() {

  $("#save_mensajero").click(function(){
    var duda ='save_mensajero';
    var dispositivo = $("#dispositivo").val();
    var imei = $("#imei").val();
    var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();
    var cedula = $("#cedula").val();
    var telefono = $("#telefono").val();
	var username = $("#username").val();
    var correo = $("#correo").val();
    var direccion = $("#direccion").val();
    var ps = $("#pass").val();
    var ps2 = $("#passw").val();
	  
    if (dispositivo.length == 0) {
      $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Dispositivo no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (imei.length == 0) {
      $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> IMEI no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (nombre.length == 0) {
      $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show"  role="alert">'+
            '<strong>Alerta!</strong> Nombre no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (apellido.length == 0) {
      $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> El Apellido no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (cedula.length == 0) {
      $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Cedula vacio, por favor completar.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (telefono.length == 0) {
      $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> El Telefono no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (username.length == 0) {
      $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Usuario vacio, por favor completar.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (correo.length == 0) {
      $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> El correo electrónico no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (direccion.length == 0) {
      $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Direccion vacia, por favor completar.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if(ps.length < 1){
            $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show"  role="alert">'+
            '<strong>Alerta!</strong> La contraseña no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');

    }else if(ps.length < 8) {
            $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show"  role="alert">'+
            '<strong>Alerta!</strong> La contraseña debe tener más de 8 caracteres.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (ps != ps2) {
            $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show"  role="alert">'+
            '<strong>Alerta!</strong> Las contraseña no coinciden.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
    $.ajax({
      type: "POST",
      url: "php/mensajerocontroller.php",
      data: $('#data_mensajero').serialize() +'&duda='+duda,
      success: function(resp){ 
      console.log(resp);
       $("#table_mensajero").load(location.href+" #table_mensajero>*","");
       $('#modal_mensajero').modal('hide');
       $('.empety').val('');
      $.notify({
         icon: "add_alert",
        message: "El Mensajero se agrego con exitos."
      },{
         type: 'success',
         timer: 2000,
         placement: {
            from: 'top',
            align: 'center'
        }
      });
        }
      });
  }
  });

  $("#update_mensajero").click(function(){
    var duda ='update_mensajero';
    var dispositivo = $("#dispositivo").val();
    var imei = $("#imei").val();
    var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();
    var cedula = $("#cedula").val();
    var telefono = $("#telefono").val();
	var username = $("#username").val();
    var correo = $("#correo").val();
    var direccion = $("#direccion").val();
    var ps = $("#pass").val();
    var ps2 = $("#passw").val();
	  
    if (dispositivo.length == 0) {
      $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Dispositivo no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (imei.length == 0) {
      $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> IMEI no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (nombre.length == 0) {
      $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show"  role="alert">'+
            '<strong>Alerta!</strong> Nombre no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (apellido.length == 0) {
      $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> El Apellido no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (cedula.length == 0) {
      $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Cedula vacio, por favor completar.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (telefono.length == 0) {
      $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> El Telefono no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (username.length == 0) {
      $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Usuario vacio, por favor completar.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (correo.length == 0) {
      $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> El correo electrónico no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (direccion.length == 0) {
      $('#alertmensajero').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Direccion vacia, por favor completar.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
    $.ajax({
      type: "POST",
      url: "php/mensajerocontroller.php",
      data: $('#data_mensajero').serialize() +'&duda='+duda,
      success: function(resp){ 
        console.log(resp);
        $("#table_mensajero").load(location.href+" #table_mensajero>*","");
        $('#modal_mensajero').modal('hide');
        $.notify({
         icon: "add_alert",
          message: "El Mensajero se actualizo con exitos."
        },{
            type: 'warning',
            timer: 2000,
            placement: {
            from: 'top',
            align: 'center'
            }
          });
        }
        });
    }
});

         
});

function delete_mensajero(id){
  $.confirm({
    icon: "fas fa-exclamation-circle",
    title: 'Confirmar!',
    content: 'Desea eliminar este Mensajero?',
    buttons: {
        confirmar: function () {
           
$.post("php/mensajerocontroller.php",
  {
	duda: 'delete',
    id_mensajero: id,
  },
  function(data){
    $("#table_mensajero").load(location.href+" #table_mensajero>*","");
  });

  $.notify({
      icon: "add_alert",
      message: "El Mensajero se elimino con éxito."

  },{
      type: 'danger',
      timer: 2000,
      placement: {
            from: 'top',
            align: 'center'
      }
  });
        },
        cancelar: function () {
            $.alert('<div class="jconfirm-title-c"><span class="jconfirm-icon-c"><i class="fas fa-exclamation-circle"></i></span><span class="jconfirm-title">Cancelado!</span></div><div class="jconfirm-content-pane no-scroll" style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); height: auto; max-height: 277.719px;margin-bottom: -5px;"><div class="jconfirm-content" id="jconfirm-box955"><div>No se eliminará este Mensajero.</div></div></div>');  
        }
    }
});
  
}