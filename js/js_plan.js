function new_plan()
{
    open_plan('save_plan',null,null,0,0,0);
}

function open_plan(action,id_plan,plan,cant_user,cant_prestamo,precio){    
  
    document.data_plan.id_plan.value = id_plan;
    document.data_plan.plan_name.value = plan;
    document.data_plan.precio.value = precio;
    document.data_plan.cant_usuario.value = cant_user;
    document.data_plan.cant_prestamo.value = cant_prestamo;
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
	
    $('#ck_cambio_mora').prop('checked', false);
    $('#ck_cambio_fecha_pagar').prop('checked', false);
    $('#ck_modificar_prestamo').prop('checked', false);
    $('#ck_modificar_cliente').prop('checked', false);
    $('#ck_eliminar_cliente').prop('checked', false);
    $('#ck_grafica_estadistica').prop('checked', false);
    $('#ck_fecha_inicio_prestamo').prop('checked', false);
    $('#ck_whatsapp').prop('checked', false);
	
	
	var permisos = "";
    if (id_plan != null) { permisos = $('#'+id_plan).val();  }
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
	  resp =  (obj.ranking == "on") ? $('#ck_ranking').prop('checked', true) : $('#ck_ranking').prop('checked', false);
	  resp =  (obj.mensajero == "on") ? $('#ck_mensajero').prop('checked', true) : $('#ck_mensajero').prop('checked', false);
	  resp =  (obj.whatsapp == "on") ? $('#ck_whatsapp').prop('checked', true) : $('#ck_whatsapp').prop('checked', false);
		
    }
	
    $('#alertPass').html("");
    $('#modal_plan').on('shown.bs.modal', function () {
        var modal = $(this);
        if (action === 'save_plan'){                       
            $('#btn_save_plan').show();
            $('#btn_update_plan').hide();             
            modal.find('.modal-title').html('<i class="fa fa-flag"></i> Registrar Plan');        
        }else if (action === 'update_plan'){
            $('#btn_save_plan').hide();                    
            $('#btn_update_plan').show();                   
            modal.find('.modal-title').html('<i class="fa fa-flag"></i> Modificar Plan');
        }
    });
}
function drop_plan(id)
{
  $.confirm({
   icon: "fas fa-exclamation-circle",
   title: 'Confirmar!',
   content: 'Desea eliminar este Plan?',
   buttons: {
       confirmar: function () {
              var duda ="delete";
                $.ajax({
                  type: "POST",
                  url: "php/plancontroller.php",
                  data: "id_plan="+id+"&proceso="+duda,
                  success: function(resp){
					  
                   $("#plan_tabla").load(location.href+" #plan_tabla>*","");
					  
                  $.notify({
                    icon: "add_alert",
                    message: "El Plan ha sido eliminado con exito."
                  },{
                     type: 'danger',
                     timer: 2000,
                     placement: {
                        from: 'top',
                        align: 'center'
                  }
                  });
                  }
          });
        },
        cancelar: function ()
        {
            $.alert('<div class="jconfirm-title-c"><span class="jconfirm-icon-c"><i class="fas fa-exclamation-circle"></i></span><span class="jconfirm-title">Cancelado!</span></div><div class="jconfirm-content-pane" style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); height: auto; max-height: 277.719px;margin-bottom: -5px;"><div class="jconfirm-content" id="jconfirm-box955"><div>No se elimino este Plan.</div></div></div>');  
        }
    }
});

}

$(document).ready(function(){
	
  $("#btn_save_plan").click(function(){
	  
    var duda = "save_plan";
	  
    var plan = $("#plan_name").val();
    var precio = $("#precio").val();
    var cant_prestamo = $("#cant_prestamo").val();
    var cant_usuario = $("#cant_usuario").val();
	  
	  
    if (plan.length <= 0) {
      $('#alertplan').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Plan vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (cant_usuario.length <= 0) {
      $('#alertplan').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Debe asignar un minimo de usuarios.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (cant_prestamo.length <= 0) {
      $('#alertplan').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Debe asignar un minimo de prestamos.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if(precio.length <= 0)
    {
      $('#alertplan').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Debe asignar un precio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
		
      $.ajax({
          type: "POST",
          url: "php/plancontroller.php",
          data: $("#data_plan").serialize()+"&proceso="+duda,
          success: function(resp){
            console.log(resp);
  			$("#plan_tabla").load(location.href+" #plan_tabla>*","");
  			$('#modal_plan').modal('hide');
          }
        });
    }
    
  });

  $("#btn_update_plan").click(function(){
	  
    var duda = "update_plan";
	  
    var plan = $("#plan_name").val();
    var precio = $("#precio").val();
    var cant_prestamo = $("#cant_prestamo").val();
    var cant_usuario = $("#cant_usuario").val();
	  
	  
    if (plan.length <= 0) {
      $('#alertplan').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Plan vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (cant_usuario.length <= 0) {
      $('#alertplan').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Debe asignar un minimo de usuarios.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (cant_prestamo.length <= 0) {
      $('#alertplan').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Debe asignar un minimo de prestamos.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if(precio.length <= 0)
    {
      $('#alertplan').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Debe asignar un precio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
		
      $.ajax({
          type: "POST",
          url: "php/plancontroller.php",
          data: $("#data_plan").serialize()+"&proceso="+duda,
          success: function(resp){
            console.log(resp);
  			$("#plan_tabla").load(location.href+" #plan_tabla>*","");
  			$('#modal_plan').modal('hide');
          }
        });
    }
    
  });
});