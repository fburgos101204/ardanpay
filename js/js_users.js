 /*FUNCION DEL MODAL PARA CREAR EL USUARIO*/
function newCbUser(id_negocio){
	if(id_negocio == 0){ id_negocio = -1; }
    openCbUser('new', null, null, null, null, null, 1,id_negocio);
}
/*FUNCION DE RESETEAR LA CONTRASENA DEL USUARIO*/
function pass(user_id){
  
    document.formCbUserPass.users_id.value = user_id;
    document.formCbUserPass.psw.value ="";
    document.formCbUserPass.psw2.value ="";
    $("#alertPass").html('');
}

$( document ).ready(function() {
  $("#update-pass").click(function(){
	  
      var pos = $('#psw').val();
      var len = pos.length;

    if(len < 1){
            $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert!</strong> Password cannot be blank.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');

    }else if(len < 8) {
            $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert!</strong> The password must be greater than 8 characters.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');

    }else if ($('#psw').val() != $('#psw2').val()) {
            $('#alertPass').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
            '<strong>Alert!</strong> Password and Confirm Password dont match.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
            //event.preventDefault();
        }else{
          var duda ='pass';
          $.ajax({
             type: "POST",
             url: "php/UserController.php",
             data: $('#formCbUserPass').serialize()+'&duda='+duda,
             success: function(resp){ 
               $("#rUsers").load(location.href+" #rUsers>*","");
               $('#Pass-User').modal('hide');
               $('#alertPass').hide();
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
function openCbUser(action, user_id, firstname, lastname, user_name, user_email,  nivel,negocio){   
	document.formCbUser.negocio.value = negocio;
	$("#negocio").trigger("change");
    document.formCbUser.user_id.value = user_id;
    document.formCbUser.firstname.value = firstname;
    document.formCbUser.lastname.value = lastname;
    document.formCbUser.user_name.value = user_name;
    document.formCbUser.user_email.value = user_email;
    document.formCbUser.nivel.value = nivel;
    $("#alertuser").html('');
    $('#ck_inicio').prop('checked', false);
    $('#ck_sol_prestamo').prop('checked', false);
    $('#ck_prestamo_personal').prop('checked', false);
    $('#ck_prestamo_inmobilirario').prop('checked', false);
    $('#ck_prestamo_vehiculo').prop('checked', false);
    $('#ck_historial_pago').prop('checked', false);
    $('#ck_historial_retiro').prop('checked', false);
    $('#ck_cliente').prop('checked', false);
    $('#ck_vehiculo').prop('checked', false);
    $('#ck_inmobilirario').prop('checked', false);
    $('#ck_caja').prop('checked', false);
    $('#ck_banco').prop('checked', false);
    $('#ck_notario').prop('checked', false);
    $('#ck_user').prop('checked', false);
    $('#ck_config').prop('checked', false);
    $('#ck_ruta').prop('checked', false);
    $('#ck_ranking').prop('checked', false);
    $('#ck_mensajero').prop('checked', false);
	
	
    $('#ck_negocio').prop('checked', false);
    $('#ck_plan').prop('checked', false);
    $('#ck_p_efectivo').prop('checked', false);
    $('#ck_p_tarjeta').prop('checked', false);
    $('#ck_r_estado_negocio').prop('checked', false);
    $('#ck_pago_servicio').prop('checked', false);
	
    $('#ck_cambio_mora').prop('checked', false);
    $('#ck_cambio_fecha_pagar').prop('checked', false);
    $('#ck_modificar_prestamo').prop('checked', false);
    $('#ck_modificar_cliente').prop('checked', false);
    $('#ck_eliminar_cliente').prop('checked', false);
    $('#ck_grafica_estadistica').prop('checked', false);
    $('#ck_fecha_inicio_prestamo').prop('checked', false);
    $('#ck_eliminar_pago').prop('checked', false);
	
    var permisos = "";
    if (user_id != null) { permisos = $('#'+user_id).val();  }
    if (permisos.length > 0){  
      var obj = jQuery.parseJSON(permisos);

      resp =  (obj.inicio == "on") ? $('#ck_inicio').prop('checked', true) : $('#ck_inicio').prop('checked', false);
      resp =  (obj.sol_prestamo == "on") ? $('#ck_sol_prestamo').prop('checked', true) : $('#ck_sol_prestamo').prop('checked', false);
      resp =  (obj.prestamo_personal == "on") ? $('#ck_prestamo_personal').prop('checked', true) : $('#ck_prestamo_personal').prop('checked', false);
      resp =  (obj.prestamo_inmobilirario == "on") ? $('#ck_prestamo_inmobilirario').prop('checked', true) : $('#ck_prestamo_inmobilirario').prop('checked', false);
      resp =  (obj.prestamo_vehiculo == "on") ? $('#ck_prestamo_vehiculo').prop('checked', true) : $('#ck_prestamo_vehiculo').prop('checked', false);
      resp =  (obj.historial_pago == "on") ? $('#ck_historial_pago').prop('checked', true) : $('#ck_historial_pago').prop('checked', false);
      resp =  (obj.historial_retiro == "on") ? $('#ck_historial_retiro').prop('checked', true) : $('#ck_historial_retiro').prop('checked', false);
      resp =  (obj.cliente == "on") ? $('#ck_cliente').prop('checked', true) : $('#ck_cliente').prop('checked', false);
      resp =  (obj.vehiculo == "on") ? $('#ck_vehiculo').prop('checked', true) : $('#ck_vehiculo').prop('checked', false);
      resp =  (obj.inmobilirario == "on") ? $('#ck_inmobilirario').prop('checked', true) : $('#ck_inmobilirario').prop('checked', false);
      resp =  (obj.caja == "on") ? $('#ck_caja').prop('checked', true) : $('#ck_caja').prop('checked', false);
      resp =  (obj.banco == "on") ? $('#ck_banco').prop('checked', true) : $('#ck_banco').prop('checked', false);
      resp =  (obj.notario == "on") ? $('#ck_notario').prop('checked', true) : $('#ck_notario').prop('checked', false);
      resp =  (obj.usuario == "on") ? $('#ck_user').prop('checked', true) : $('#ck_user').prop('checked', false);
      resp =  (obj.configuracion == "on") ? $('#ck_config').prop('checked', true) : $('#ck_config').prop('checked', false);
      resp =  (obj.cambio_mora == "on") ? $('#ck_cambio_mora').prop('checked', true) : $('#ck_cambio_mora').prop('checked', false);
      resp =  (obj.cambio_fecha_pagar == "on") ? $('#ck_cambio_fecha_pagar').prop('checked', true) : $('#ck_cambio_fecha_pagar').prop('checked', false);
      resp =  (obj.modificar_prestamo == "on") ? $('#ck_modificar_prestamo').prop('checked', true) : $('#ck_modificar_prestamo').prop('checked', false);
      resp =  (obj.modificar_cliente == "on") ? $('#ck_modificar_cliente').prop('checked', true) : $('#ck_modificar_cliente').prop('checked', false);
      resp =  (obj.eliminar_cliente == "on") ? $('#ck_eliminar_cliente').prop('checked', true) : $('#ck_eliminar_cliente').prop('checked', false);
      resp =  (obj.grafica_estadistica == "on") ? $('#ck_grafica_estadistica').prop('checked', true) : $('#ck_grafica_estadistica').prop('checked', false);
      resp =  (obj.fecha_inicio_prestamo == "on") ? $('#ck_fecha_inicio_prestamo').prop('checked', true) : $('#ck_fecha_inicio_prestamo').prop('checked', false);
	  resp =  (obj.ruta == "on") ? $('#ck_ruta').prop('checked', true) : $('#ck_ruta').prop('checked', false);
	  resp =  (obj.negocio == "on") ? $('#ck_negocio').prop('checked', true) : $('#ck_negocio').prop('checked', false);
	  resp =  (obj.ranking == "on") ? $('#ck_ranking').prop('checked', true) : $('#ck_ranking').prop('checked', false);
	  resp =  (obj.mensajero == "on") ? $('#ck_mensajero').prop('checked', true) : $('#ck_mensajero').prop('checked', false);
	  resp =  (obj.plan == "on") ? $('#ck_plan').prop('checked', true) : $('#ck_plan').prop('checked', false);
	  resp =  (obj.pago_efectivo == "on") ? $('#ck_p_efectivo').prop('checked', true) : $('#ck_p_efectivo').prop('checked', false);
	  resp =  (obj.pago_tarjeta == "on") ? $('#ck_p_tarjeta').prop('checked', true) : $('#ck_p_tarjeta').prop('checked', false);
	  resp =  (obj.reporte_estado_negocio == "on") ? $('#ck_r_estado_negocio').prop('checked', true) : $('#ck_r_estado_negocio').prop('checked', false);
	  resp =  (obj.reporte_pago_servicio == "on") ? $('#ck_r_pago_servicio').prop('checked', true) : $('#ck_r_pago_servicio').prop('checked', false);
		
	  resp =  (obj.eliminar_pago == "on") ? $('#ck_eliminar_pago').prop('checked', true) : $('#ck_eliminar_pago').prop('checked', false);
		

    }
                            
    $('#User').on('shown.bs.modal', function () {
        var modal = $(this);
        if (action === 'new'){                            
            $('#save-user').show();
            $('#update-user').hide();
            $('#hide-ps').show();
            $('#hide-ps2').show();              
            modal.find('.modal-title').html('<i class="fas fa-user-cog"></i> Crear Nuevo Usuario');        
        }else if (action === 'edit'){
            $('#save-user').hide();                    
            $('#update-user').show();
            $('#hide-ps').hide();
            $('#hide-ps2').hide();                    
            modal.find('.modal-title').html('<i class="fas fa-user-cog"></i> Editar Usuario');
        }
    });
}

 /*FUNCION QUE AGREGA Y EDITA EL USUARIO*/
$( document ).ready(function() {

  $("#save-user").click(function(){
    var duda ='save';
    var name = $("#firstname").val();
    var lastname = $("#lastname").val();
    var user_name = $("#user_name").val();
    var ps = $("#ps").val();
    var ps2 = $("#ps2").val();
    var user_email = $("#user_email").val();
    var nivel = $("#nivel").val();
    var cod_negocio = $("#negocio").val();
	  
    if (name.length == 0) {
      $('#alertuser').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Nombre no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (lastname.length == 0) {
      $('#alertuser').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Apellido no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (user_name.length == 0) {
      $('#alertuser').html('<div class="alert alert-warning alert-dismissible fade show"  role="alert">'+
            '<strong>Alerta!</strong> Nombre de usuario no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if(ps.length < 1){
            $('#alertuser').html('<div class="alert alert-warning alert-dismissible fade show"  role="alert">'+
            '<strong>Alerta!</strong> La contraseña no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');

    }else if(ps.length < 8) {
            $('#alertuser').html('<div class="alert alert-warning alert-dismissible fade show"  role="alert">'+
            '<strong>Alerta!</strong> La contraseña debe tener más de 8 caracteres.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (ps != ps2) {
            $('#alertuser').html('<div class="alert alert-warning alert-dismissible fade show"  role="alert">'+
            '<strong>Alerta!</strong> Las contraseña no coinciden.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
            //event.preventDefault();
    }else if (user_email.length == 0) {
      $('#alertuser').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> El correo electrónico no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (nivel.length == 0) {
      $('#alertuser').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Usuario vacio, por favor completar.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (cod_negocio == -1) {
      $('#alertuser').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Debe asignar un negocio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
    $.ajax({
      type: "POST",
      url: "php/UserController.php",
      data: $('#formCbUser').serialize() +'&duda='+duda,
      success: function(resp){ 
      console.log(resp);
       $("#rUsers").load(location.href+" #rUsers>*","");
       $('#User').modal('hide');
       $('.empety').val('');
      $.notify({
         icon: "add_alert",
        message: "El Usuario "+name+" Se agrego con exitos."
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

  $("#update-user").click(function(){
    var duda ='update';
    var name = $("#firstname").val();
    var lastname = $("#lastname").val();
    var user_name = $("#user_name").val();
    var user_email = $("#user_email").val();
    var nivel = $("#nivel").val();
    var cod_negocio = $("#negocio").val();
	  
    if (name.length == 0) {
      $('#alertuser').html('<div class="alert alert-warning alert-dismissible fade show"  role="alert">'+
            '<strong>Alerta!</strong> Nombre no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (lastname.length == 0) {
      $('#alertuser').html('<div class="alert alert-warning alert-dismissible fade show"  role="alert">'+
            '<strong>Alerta!</strong> Apellido no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (user_name.length == 0) {
      $('#alertuser').html('<div class="alert alert-warning alert-dismissible fade show"  role="alert">'+
            '<strong>Alerta!</strong> Nombre de usuario no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (user_email.length == 0) {
      $('#alertuser').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> El correo electrónico no puede estar en blanco.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (nivel.length == 0) {
      $('#alertuser').html('<div class="alert alert-warning alert-dismissible fade show"  role="alert">'+
            '<strong>Alerta!</strong> Usuario vacio, por favor completar.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (cod_negocio == -1) {
      $('#alertuser').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Debe asignar un negocio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
    $.ajax({
      type: "POST",
      url: "php/UserController.php",
      data: $('#formCbUser').serialize() +'&duda='+duda,
      success: function(resp){ 
        console.log(resp);
       	$("#rUsers").load(location.href+" #rUsers>*","");
        $('#User').modal('hide');
        $.notify({
         icon: "add_alert",
          message: "El Usuario "+name+" se actualizo con exitos."
        },{
            type: 'warning',
            timer: 2000,
            placement: {
            from: 'top',
            align: 'center'
            }
          });
       	$("#id_datatable").load(location.href+" #id_datatable>*","");
        }
        });
    }
});

         
});

/*FUNCION QUE ELIMINA EL USUARIO*/
function delete_user(from, align, name, id){
  $.confirm({
    icon: "fas fa-exclamation-circle",
    title: 'Confirmar!',
    content: 'Desea eliminar este Usuario?',
    buttons: {
        confirmar: function () {
           
$.post("php/delete_user.php",
  {
    id: id,
  },
  function(data){
       location.reload();
  });

  $.notify({
      icon: "add_alert",
      message: "El usuario se elimino con éxito."

  },{
      type: 'success',
      timer: 2000,
      placement: {
            from: 'top',
            align: 'center'
      }
  });
        },
        cancelar: function () {
            $.alert('<div class="jconfirm-title-c"><span class="jconfirm-icon-c"><i class="fas fa-exclamation-circle"></i></span><span class="jconfirm-title">Cancelado!</span></div><div class="jconfirm-content-pane no-scroll" style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); height: auto; max-height: 277.719px;margin-bottom: -5px;"><div class="jconfirm-content" id="jconfirm-box955"><div>No se eliminará este usuario.</div></div></div>');  
        }
    }
});
  
}