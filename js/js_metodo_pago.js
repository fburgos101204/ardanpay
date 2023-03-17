function new_pago(negocio)
{
    open_pago("save_pago",null,null,null,null,null,null,null,negocio,negocio);
}

function card(event)
{
  var len = $("#card_number").val().length;
  var dato = $("#card_number").val();
  if (event.keyCode != 8 || event.keyCode != 46) {
  
    if (dato[0] == "5") {  $("#tipo_tarjeta").val("MASTERCARD"); }
    else if(dato[0] == "4") {  $("#tipo_tarjeta").val("VISA"); }
    else if(dato[0] == "3") { $("#tipo_tarjeta").val("AMEX"); }
    else{
      $("#tipo_tarjeta").val("Desconocido");
    }
  if (len == 4 || len == 9 || len == 14) {
      $("#card_number").val(dato+" ");
  }
  }
}

function open_pago(action, id_pago,nombre_tarjeta, card_number,tipo_tarjeta, cvv, month_expire,year_expire,id_negocio,negocio){    
  	
    document.data_metodo_pago.id_pago.value = id_pago;
	if(negocio == 0)
	{
		$("#negocio").val(id_negocio);
		$('#negocio').select2().trigger('change');
	}
	else
	{
    	document.data_metodo_pago.negocio.value = id_negocio;
	}
    document.data_metodo_pago.nombre_tarjeta.value = nombre_tarjeta;
    document.data_metodo_pago.card_number.value = card_number;
    document.data_metodo_pago.tipo_tarjeta.value = tipo_tarjeta;
    document.data_metodo_pago.cvv.value = cvv;
    document.data_metodo_pago.month_expire.value = month_expire;
    document.data_metodo_pago.year_expire.value = year_expire;
	
	
    $('#alertPass').html("");
    $('#modal_metodo_pago').on('shown.bs.modal', function () {
        var modal = $(this);
        if (action == 'save_pago'){
            $('#btn_save').show();
            $('#btn_update').hide();             
            modal.find('.modal-title').html('<i class="far fa-credit-card"></i> Agregar Método de Pagos');        
        }else if (action == 'update_pago'){
            $('#btn_save').hide();                    
            $('#btn_update').show();                   
            modal.find('.modal-title').html('<i class="far fa-credit-card"></i> Modificar Método de Pago');
        }
    });
}
function default_payment(id,negocio)
{
	$.confirm({
    icon: "fas fa-exclamation-circle",
    title: 'Confirmar!',
    content: 'Desea asignar este método de pago como predeterminado?',
    buttons: {
        confirmar: function () {
            var duda ="default_payment";
    $.ajax({
      type: "POST",
      url: "php/metodopagocontroller.php",
      data: "id_pago="+id+"&proceso="+duda,
      success: function(resp){
		console.log(resp);
     	$("#pago_tabla").load(location.href+" #pago_tabla>*","");
		$('#modal_metodo_pago').modal('hide');
       
      $.notify({
         icon: "add_alert",
        message: "Método asignado con éxito."
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
        },
        cancelar: function () {
            $.alert('<div class="jconfirm-title-c"><span class="jconfirm-icon-c"><i class="fas fa-exclamation-circle"></i></span><span class="jconfirm-title">Cancelado!</span></div><div class="jconfirm-content-pane no-scroll" style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); height: 24px; max-height: 277.719px;margin-bottom: -5px;"><div class="jconfirm-content" id="jconfirm-box955"><div>No se ha asignado este método de pago.</div></div></div>');  


        }
    }
});
    
}

function default_drop(id)
{
	$.confirm({
    icon: "fas fa-exclamation-circle",
    title: 'Confirmar!',
    content: 'Desea desasignar este método de pago?',
    buttons: {
        confirmar: function () {
    var duda ="default_drop";
    $.ajax({
      type: "POST",
      url: "php/metodopagocontroller.php",
      data: "id_pago="+id+"&proceso="+duda,
      success: function(resp){
		console.log(resp);
      	$("#pago_tabla").load(location.href+" #pago_tabla>*","");
       	$('#modal_metodo_pago').modal('hide');
       
      $.notify({
         icon: "add_alert",
        message: "Método desasignar con éxito."
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
        },
        cancelar: function () {
            $.alert('<div class="jconfirm-title-c"><span class="jconfirm-icon-c"><i class="fas fa-exclamation-circle"></i></span><span class="jconfirm-title">Cancelado!</span></div><div class="jconfirm-content-pane no-scroll" style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); height: 24px; max-height: 277.719px;margin-bottom: -5px;"><div class="jconfirm-content" id="jconfirm-box955"><div>No se ha desasignado este método de pago.</div></div></div>');  


        }
    }
});
    
}

function delete_pago(id,userid)
{
	$.confirm({
    icon: "fas fa-exclamation-circle",
    title: 'Confirmar!',
    content: 'Desea eliminar este método de pago?',
    buttons: {
        confirmar: function () {
            var duda ="delete";
    $.ajax({
      type: "POST",
      url: "php/metodopagocontroller.php",
      data: "id_pago="+id+"&proceso="+duda+"&userid="+userid,
      success: function(resp){

      $("#pago_tabla").load(location.href+" #pago_tabla>*","");
       $('#modal_metodo_pago').modal('hide');
       
      $.notify({
         icon: "add_alert",
        message: "Método eliminado con éxito."
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
        },
        cancelar: function () {
            $.alert('<div class="jconfirm-title-c"><span class="jconfirm-icon-c"><i class="fas fa-exclamation-circle"></i></span><span class="jconfirm-title">Cancelado!</span></div><div class="jconfirm-content-pane no-scroll" style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); height: 24px; max-height: 277.719px;margin-bottom: -5px;"><div class="jconfirm-content" id="jconfirm-box955"><div>No se eliminará este método de pago.</div></div></div>');  


        }
    }
});
    
}
$( document ).ready(function() {
	
	$("#btn_save").click(function(){
    var duda ='save_pago';
	var negocio = $("#negocio").val();
    var nombre_tarjeta = $("#nombre_tarjeta").val();
    var card_number = $("#card_number").val();
    var tipo_tarjeta = $("#tipo_tarjeta").val();
    var cvv = $("#cvv").val();
	var month_expire = parseInt($("#month_expire").val());
	var year_expire = $("#year_expire").val();

    if (negocio <= 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Debe asignar un Negocio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (nombre_tarjeta.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Debe asignar el nombre del propietario de la tarjeta.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (tipo_tarjeta.length == 0  || tipo_tarjeta == "Desconocido") {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Tarjeta no válida, por favor agregar una válida.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }
    else if (card_number.length == 0 || card_number.length < 19) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Introduzca el número de tarjeta completo.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (cvv.length == 0 || cvv.length < 3) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Debe asignar el CVV.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (month_expire.length == 0 || month_expire.length < 2 || month_expire > 12) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Debe asignar el mes correctamente.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (year_expire.length == 0 || year_expire.length < 4) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Debe asignar el año completo.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else {
    $.ajax({
      type: "POST",
      url: "php/metodopagocontroller.php",
      data: $('#data_metodo_pago').serialize() +'&proceso='+duda,
      success: function(resp){
	   console.log(resp);
       $("#pago_tabla").load(location.href+" #pago_tabla>*","");
       $('#modal_metodo_pago').modal('hide');
       $('.empety').val('');
      $.notify({
         icon: "add_alert",
        message: "Método agregado con éxito."
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

	$("#btn_update").click(function(){
    var duda ='update_pago';
    var negocio = $("#negocio").val();
    var nombre_tarjeta = $("#nombre_tarjeta").val();
    var card_number = $("#card_number").val();
    var tipo_tarjeta = $("#tipo_tarjeta").val();
    var cvv = $("#cvv").val();
	var month_expire = parseInt($("#month_expire").val());
	var year_expire = $("#year_expire").val();

    if (negocio <= 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Debe asignar un Negocio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (nombre_tarjeta.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Debe asignar el nombre del propietario de la tarjeta.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }
    else if (card_number.length == 0 || card_number.length < 19) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Introduzca el número de tarjeta completo.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (cvv.length == 0 || cvv.length < 3) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Debe asignar el CVV.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (month_expire.length == 0 || month_expire.length < 2 || month_expire > 12) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Debe asignar el mes valido, correctamente.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (year_expire.length == 0 || year_expire.length < 4) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong> Debe asignar el año completo.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else {
    $.ajax({
      type: "POST",
      url: "php/metodopagocontroller.php",
      data: $('#data_metodo_pago').serialize() +'&proceso='+duda,
      success: function(resp){ 
	   console.log(resp);
       $("#pago_tabla").load(location.href+" #pago_tabla>*","");
       $('#modal_metodo_pago').modal('hide');
       $('.empety').val('');
      $.notify({
         icon: "add_alert",
        message: "Método actualizado con éxito."
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

