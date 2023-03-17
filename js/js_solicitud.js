function upload(codigo_metodo,id_metodo,metodo,id_solicitud,id_cliente,monto,cuota,ciclo,interes_valida,t_interes_valida,fecha_valida,estado,fecha_creacion){

    $.ajax({
      type: "POST",
      url: "php/historial_solicitud.php",
      data: "proceso=historial"+"&id_cliente="+id_cliente,
      success: function(resp){
        $("#info").html(resp);
      }
    });
    if (estado != "Aceptado") {
      $(".retirar_de_hidden").hide();
      $("#disponible_hidden").hide();
      $("#entidad_hidden").hide();
      $("#no_cheque_hidden").hide();
      document.data_solicitud_prestamo.retirar_de.value = "Caja";
      $("#retirar_de").trigger("change");
      $("#entidad_caja").trigger("change");
    }
    else
    {
      if (metodo == "Banco") {
        document.data_solicitud_prestamo.retirar_de.value = "Banco";
        document.data_solicitud_prestamo.entidad_banco.value = id_metodo;
        $("#entidad_banco").trigger("change");
        $("#retirar_de").trigger("change");
        $("#entidad_caja").trigger("change");
        document.data_solicitud_prestamo.no_codigo.value = codigo_metodo;

      }else if (metodo == "Caja") {
        document.data_solicitud_prestamo.retirar_de.value = "Caja";

        document.data_solicitud_prestamo.entidad_caja.value = id_metodo;
        $("#entidad_caja").trigger("change");
        $("#retirar_de").trigger("change");
        $("#entidad_caja").trigger("change");
      }
      else
      {

        document.data_solicitud_prestamo.retirar_de.value = "Caja";
        $("#retirar_de").trigger("change");
        $("#entidad_caja").trigger("change");
      }
    }

    $("#monto_valida").attr("readonly",false);
    $("#cuotas_valida").attr("readonly",false);
    $("#ciclo_pago_valida").attr("disabled",false);
    $("#estado_valida").attr("disabled",false);

    $("#fecha_creacion").attr("readonly",false);
	
    $("#interes_valida").attr("readonly",false);
    $("#t_interes_valida").attr("readonly",false);
    $("#fecha_valida").attr("disabled",false);

    $("#retirar_de").attr("disabled",false);
    $("#entidad_caja").attr("disabled",false);
    $("#entidad_banco").attr("disabled",false);
    $("#no_codigo").attr("disabled",false);


    $("#update_sol_pres").show();
    document.data_solicitud_prestamo.id_solicitud_.value = id_solicitud;
    document.data_solicitud_prestamo.id_cliente_solicitud.value = id_cliente;
    document.data_solicitud_prestamo.monto_valida.value = monto;
    document.data_solicitud_prestamo.cuotas_valida.value = cuota;
    document.data_solicitud_prestamo.ciclo_pago_valida.value = ciclo;

    document.data_solicitud_prestamo.interes_valida.value = interes_valida;
    document.data_solicitud_prestamo.t_interes_valida.value = t_interes_valida;
    document.data_solicitud_prestamo.fecha_valida.value = fecha_valida;
    document.data_solicitud_prestamo.fecha_creacion.value = fecha_creacion;

    document.data_solicitud_prestamo.estado_valida.value = estado;
    if (estado == "Aceptado") {
      $("#update_sol_pres").hide();
      $("#monto_valida").prop("readonly",true);
      $("#cuotas_valida").prop("readonly",true);
      $("#ciclo_pago_valida").prop("disabled",true);
      $("#estado_valida").prop("disabled",true);
      $("#interes_valida").attr("readonly",true);
      $("#t_interes_valida").attr("readonly",true);
      $("#fecha_valida").attr("disabled",true);
      $("#retirar_de").attr("disabled",true);
      $("#entidad_caja").attr("disabled",true);
      $("#entidad_banco").attr("disabled",true);
      $("#no_codigo").attr("disabled",true);
      $("#fecha_creacion").attr("readonly",true);
    }
	
	
	$("#garante_table").html("");
	$("#referencia_table").html("");
	 $.ajax({
      type: "POST",
      url: "php/garantecontroller.php",
      data: 'id_cliente_garante='+id_cliente+'&duda=show_on',
      success: function(resp){	console.log(resp); $("#garante_table_valida").html(resp); 


// tablamob

   $('.table-responsive-stack').find("th").each(function (i) {
      
      $('.table-responsive-stack td:nth-child(' + (i + 1) + ')').prepend('<span class="table-responsive-stack-thead">'+ $(this).text() + ':</span> ');
      $('.table-responsive-stack-thead').hide();
   });

  
   
   
   
$( '.table-responsive-stack' ).each(function() {
  var thCount = $(this).find("th").length; 
   var rowGrow = 100 / thCount + '%';
   //console.log(rowGrow);
   $(this).find("th, td").css('flex-basis', rowGrow);   
});
   
   
   
   
function flexTable(){
   if ($(window).width() < 768) {
      
   $(".table-responsive-stack").each(function (i) {
      $(this).find(".table-responsive-stack-thead").show();
      $(this).find('thead').hide();
   });
      
    
   // window is less than 768px   
   } else {
      
      
   $(".table-responsive-stack").each(function (i) {
      $(this).find(".table-responsive-stack-thead").hide();
      $(this).find('thead').show();
   });
      
      

   }
  // flextable   
}      
 
flexTable();
   
window.onresize = function(event) {
    flexTable();
};

//endtablamob

       } });
	
	 $.ajax({
      type: "POST",
      url: "php/referenciacontroller.php",
      async: false, 
      data: 'id_cliente_referencia='+id_cliente+'&duda=show_on',
      success: function(resp){	console.log(resp); $("#referencia_table_valida").html(resp);  }});


}


function new_solicitud(creador,ngc)
{
    $("#alertsolicitud").html('');
    document.data_solicitud.id_negocio.value = ngc;
    document.data_solicitud.creador.value = creador;
    document.data_solicitud.nombre.value = null;
    document.data_solicitud.apellido.value = null;
    document.data_solicitud.telefono.value = null;
    document.data_solicitud.cedula.value = null;
    document.data_solicitud.correo.value = null;
    document.data_solicitud.direccion.value = null;

    document.data_solicitud.nacionalidad.value = null;
    document.data_solicitud.sexo.value = null;
    document.data_solicitud.estado_civil.value = null;
    document.data_solicitud.fecha_nacimiento.value = null;
    document.data_solicitud.celular.value = null;
    document.data_solicitud.tipo_vivienda.value = null;
    document.data_solicitud.ocupacion.value = null;
    document.data_solicitud.titulo.value = null;
    document.data_solicitud.ingreso.value = null;
    document.data_solicitud.facebook.value = null;
    document.data_solicitud.instagram.value = null;
    document.data_solicitud.dependientes.value = null;

    document.data_solicitud.monto.value = null;
    document.data_solicitud.cuotas.value = null;

	$("#garante_table").html("");
	$("#referencia_table").html("");
    $("#ciclo").trigger("change");
	
}

function monetizar()
{ 
    $.ajax({
        type: "POST",
        url: "php/monetizarcontroller.php",
        data: $("#data_solicitud_prestamo").serialize(),
        complete:function(rep)
        {
          $("#table_solicitud").load(location.href+" #table_solicitud>*","");
          $('#modal_estado_solicitud').modal('hide');
        }
      });
}

function modificar_estado()
{
  var retirar_de = $("#retirar_de").val();
  var no_codigo = $("#no_codigo").val();

  var estado_valida = $("#estado_valida").val();
  var monto_valida = parseInt($("#monto_valida").val());
  var disponible_id = parseInt($("#disponible_id").val());


  if (estado_valida == "Aceptado" && disponible_id < monto_valida) {
    $('#alertfrmsolictud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
        '<strong>Monto Insuficientes! </strong>El monto solicitado no puede ser desembosado por esta entidad.'+
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
        '<span aria-hidden="true">&times;</span>'+
        '</button></div>');
  }else if (retirar_de == "Banco" && no_codigo.length == 0) {
    $('#alertfrmsolictud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
        '<strong>Alerta! </strong>Debe poner el numero de Cheque o Deposito.'+
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
        '<span aria-hidden="true">&times;</span>'+
        '</button></div>');
  }else{
  $.ajax({
      type: "POST",
      url: "php/historial_solicitud.php",
      data: $("#data_solicitud_prestamo").serialize()+"&proceso=update_estado",
      success: function(resp){
        console.log(resp);
        document.data_solicitud_prestamo.id_prestamo_valida.value = resp;
      },
      complete:function(resp)
      {
        if ($("#estado_valida").val() == "Aceptado") {
            evaluar_();
            monetizar();
        }else{
          	$("#table_solicitud").load(location.href+" #table_solicitud>*","");
			$("#modal_estado_solicitud").modal("hide");
		}
      }
  });
  }
}

function guardar_solicitud()
{
    var duda ='save_cliente';
    var solicita ='solicita';
    var form = $('#data_solicitud')[0];
    var formData = new FormData(form);

  	formData.append('solicitud',solicita);
  	formData.append('proceso',duda);
  	var inputFileImage = document.getElementById('file_img_cliente');
  	var file1 = inputFileImage.files[0];

  	var inputFileImage2 = document.getElementById('cedula_cliente_img');
  	var file2 = inputFileImage2.files[0];

  	formData.append('archivo_img',file1);
  	formData.append('archivo_cedula',file2);
    
    var img = $("#img_cliente img").attr("src");

    var crd = $("#choosen_file").html();

    formData.append('aux_img',img);
    formData.append('aux_cedula',crd);

    $.ajax({
      type: "POST",
      url: "php/clientecontroller.php",
      contentType:false,
      data: formData,
      cache: false,
      processData: false,
	  success: function(resp)
 	  {
		  save_ref(resp);
	   	  save_garante(resp);
          console.log(resp);
	  },
      complete: function(resp)
      {
        console.log(resp);
       $("#table_solicitud").load(location.href+" #table_solicitud>*","");
       $('#modal_solicitud').modal('hide');
       $('.empety').val('');
      $.notify({
         icon: "add_alert",
        message: "La solicitud se ha generado con éxito."
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

$( document ).ready(function() {

  $("#estado_valida").change(function(){
      if ($(this).val() != "Aceptado") {
        $(".retirar_de_hidden").hide();
        $("#entidad_hidden").hide();
        $("#disponible_hidden").hide();
        $("#no_cheque_hidden").hide();
      }else{
        $(".retirar_de_hidden").show();
        $("#entidad_hidden").show();
        $("#disponible_hidden").show();
      }
  });

  $("#retirar_de").change(function(){
      if ($(this).val() == "Caja") {

        $("#entidad_caja").show();
        $("#entidad_banco").hide();
        $("#no_cheque_hidden").hide();
        $("#entidad_caja").trigger("change");

      }else if($(this).val() == "Banco") {

        $("#no_cheque_hidden").show();
        $("#entidad_caja").hide();
        $("#entidad_banco").show();
        $("#entidad_banco").trigger("change");
      }
      $("#no_cheque_hidden").val("");
  });

  $("#entidad_caja").change(function(){
      var monto = parseInt($(this).children(":selected").attr("class"));
      document.data_solicitud_prestamo.disponible_id.value = monto;
  });

  $("#entidad_banco").change(function(){
      var monto = parseInt($(this).children(":selected").attr("class"));
      document.data_solicitud_prestamo.disponible_id.value = monto;
  });

  $("#update_sol_pres").click(function(){
      modificar_estado();
  });

  $("#save_solicitud").click(function(){
  	var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();
    var cedula = $("#cedula").val();
    var telefono = $("#telefono").val();
    var celular = $("#celular").val();
    //var correo = $("#correo").val();
    var direccion = $("#direccion").val();
    var sexo = $("#sexo").val();
    var estado_civil = $("#estado_civil").val();
    var tipo_vivienda = $("#tipo_vivienda").val();
    var ocupacion = $("#ocupacion").val();
	var cant_ref = $("#referencia_table").children('tr').children('td').length;
    var titulo = $("#titulo").val();
    var ingreso = $("#ingreso").val();
    //var facebook = $("#facebook").val();
    //var instagram = $("#instagram").val();

    var monto = $("#monto").val();
    var cuotas = $("#cuotas").val();
    var ciclo = $("#ciclo").val();

    if (nombre.length == 0) {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Nombre vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	  $("#nombre").focus();
    }else if (apellido.length == 0) {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Apellido vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	  $("#apellido").focus();
    }else if (telefono.length == 0) {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Telefono vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	  $("#telefono").focus();
    }else if (celular.length == 0) {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Celular vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	  $("#celular").focus();
    }else if (cedula.length == 0) {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Cedula vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	  $("#cedula").focus();
    }/*else if (correo.length == 0) {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Correo Electronico vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	  $("#correo").focus();
    }*/else if (direccion.length == 0) {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Direccion vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	  $("#direccion").focus();
    }else if (sexo == "0") {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Sexo vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	  $("#sexo").focus();
    }else if (estado_civil.length == 0) {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Estado Civil vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	  $("#estado_civil").focus();
    }else if (tipo_vivienda.length == 0) {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Tipo de Vivienda vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	  $("#tipo_vivienda").focus();
    }else if (ocupacion.length == 0) {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Ocupacion vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	  $("#ocupacion").focus();
    }else if (titulo.length == 0) {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Mayor Titulo Obtenido vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	  $("#ocupacion").focus();
    }else if (ingreso == 0 || ingreso == "") {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Ingresos vacios.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	  $("#ingreso").focus();
    }else if (cant_ref == 0) {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Debe asignar al menos 1 referencia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }/*else if (facebook.length == 0) {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Facebook vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (instagram.length == 0) {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Instagram vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }*/
	else if (monto <= 0) {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Monto a Prestar debe ser mayor a  0.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	  $("#monto").focus();
    }else if (cuotas <= 0) {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Cuotas deben ser mayor a 0.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	  $("#cuotas").focus();
    }else if (ciclo.length == 0) {
      $('#alertsolicitud').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Debe seleccionar una Modalidad.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	  $("#ciclo").focus();
    }else{

    	 guardar_solicitud();
    }
  });
	
$("#ciclo").change(function(){
      var aumt = parseInt($(this).children(":selected").val());
	  var fecha = new Date(); 
	  fecha.setDate(fecha.getDate() + aumt);
	  if(fecha.getDate() <= 9){ var dia = "0"+fecha.getDate(); }else{ var dia = fecha.getDate();}
	  if((fecha.getMonth()+ 1) <= 9){ var mes = "0"+(fecha.getMonth()+ 1); }else{ var mes = (fecha.getMonth()+ 1); }
	  var date = fecha.getFullYear() + '-' + mes + '-' + dia;
	  $("#fecha_sol").val(date);
  });
});