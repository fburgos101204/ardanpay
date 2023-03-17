function new_negocio()
{
	var today = new Date();
	var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    open_negocio("save",null,null,-1,null,date,30,null,null);
	$("#modalidad").trigger("change");
}

function open_negocio(action,id_negocio,nombre,estado,plan,proximo_pago,modalidad,email,telefono){    
  
    document.data_negocio.plan_negocio.value = plan;
	$("#plan_negocio").trigger("change");
    document.data_negocio.id_negocio.value = id_negocio;
    document.data_negocio.nombre.value = nombre;
    document.data_negocio.estado_negocio.value = estado;
    document.data_negocio.proximo_pago.value = proximo_pago;
    document.data_negocio.modalidad.value = modalidad;
    document.data_negocio.email.value = email;
    document.data_negocio.telefono.value = telefono;

    $('#alertPass').html("");
    $('#modal_negocio').on('shown.bs.modal', function () {
        var modal = $(this);
        if (action === 'save'){                       
            $('#save_negocio').show();
            $('#update_negocio').hide();             
            modal.find('.modal-title').html('<i class="fas fa-business-time"></i> Agregando Negocio');        
        }else if (action === 'update'){
            $('#save_negocio').hide();     
            $('#update_negocio').show();                   
            modal.find('.modal-title').html('<i class="fas fa-business-time"></i> Modificar Negocio');
        }
    });
}

function Delete(id)
{

  var duda ="delete";
    $.ajax({
      type: "POST",
      url: "php/negociocontroller.php",
      data: "id_negocio="+id+"&proceso="+duda,
      success: function(resp){
      $("#negocio_tabla").load(location.href+" #negocio_tabla>*","");
      $.notify({
         icon: "add_alert",
        message: "El Negocio se elimino con exito."
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
}


$( document ).ready(function() {
  $("#save_negocio").click(function(){

    var duda ='save';
    var plan_negocio = $("#plan_negocio").val();
    var nombre = $("#nombre").val();
    var email = $("#email").val();
	var telefono = $("#telefono").val();
	var estado_negocio = $("#estado_negocio").val();
	  
    if (plan_negocio.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong>Debe asignar un plan.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (nombre.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong>Nombre vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (email.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong>Correo Electronico vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (telefono.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong>Telefono vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (estado_negocio == -1) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong>Debe asignar un estado de negocio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
    $.ajax({
      type: "POST",
      url: "php/negociocontroller.php",
      data: $('#data_negocio').serialize() +'&proceso='+duda,
      success: function(resp){
		  
	  /*CREACION DEL CONTRATO*/	  
      $.ajax({
      	type: "POST",
      	url: "php/contratocontroller.php",
      	data: "negocio="+resp,
		success: function(resp){ console.log(resp); } });
	  /*CREACION DEL CONTRATO*/	 
		  
       $("#negocio_tabla").load(location.href+" #negocio_tabla>*","");
       $('#modal_negocio').modal('hide');
       $('.empety').val('');
      $.notify({
         icon: "add_alert",
        message: "El Negocio se ha generado con exito."
      },{
         type: 'success',
         timer: 2000,
         placement: {
            from: 'top',
            align: 'center'
      }
  });
      }
    });}
  });

  $("#update_negocio").click(function(){
    var duda ='update';
    var plan_negocio = $("#plan_negocio").val();
    var nombre = $("#nombre").val();
    var email = $("#email").val();
	var telefono = $("#telefono").val();
	var estado_negocio = $("#estado_negocio").val();
	  
    if (plan_negocio.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong>Debe asignar un plan.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (nombre.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong>Nombre vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (email.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong>Correo Electronico vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (telefono.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong>Telefono vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (estado_negocio == -1) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong>Debe asignar un estado de negocio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
    $.ajax({
      type: "POST",
      url: "php/negociocontroller.php",
      data: $('#data_negocio').serialize() +'&proceso='+duda,
      success: function(resp){ 
	   console.log(resp);
       $("#negocio_tabla").load(location.href+" #negocio_tabla>*","");
       $('#modal_negocio').modal('hide');
        $.notify({
         icon: "add_alert",
          message: "El Negocio se actualizo con exito."
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
	
$("#modalidad").change(function(){
      var aumt = parseInt($(this).children(":selected").val());
	  var fecha = new Date(); 
	  fecha.setDate(fecha.getDate() + aumt);
	  console.log(fecha.getDate());
	  if(fecha.getDate() <= 9){ var dia = "0"+fecha.getDate(); }else{ var dia = fecha.getDate(); }
	  if((fecha.getMonth()+ 1) <= 9){ var mes = "0"+(fecha.getMonth()+ 1); }else{ var mes = (fecha.getMonth()+ 1); }
	  var date = fecha.getFullYear() + '-' + mes + '-' + dia;
		console.log(date);
	  $("#proximo_pago").val(date);
  });
});