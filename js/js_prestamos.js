function new_prestamo(creador)
{
  	document.data_crear_prestamo.creador.value = creador;
	document.data_crear_prestamo.retirar_de.value = "Caja";
    $("#retirar_de").trigger("change");
    $("#entidad_caja").trigger("change");
    $("#id_ciclo_pago").trigger("change");
}


function create_prestamo()
{
  var tipo = $("#retirar_de").val();
  if (tipo == "Caja") {
    var codigo = 0;
    var id_metodo = $("#entidad_caja").val();
  }else{
    var codigo = $("#no_codigo").val();
    var id_metodo = $("#entidad_banco").val();
  }

  $.ajax({
      type: "POST",
      url: "php/detalleprestamo.php",
      data: $("#data_crear_prestamo").serialize()+"&proceso=insertar"+"&id_metodo="+id_metodo+"&tipo="+tipo+"&cd_pr="+codigo,
      success: function(res){
        document.data_crear_prestamo.id_id_prestamo.value = res;
      },
      complete:function()
      {
        evaluar_();
        $("#modal_crear_prestamo").modal("hide");
        window.setTimeout(function(){window.location.reload()}, 1000);
      }
    });
}


$(document).ready(function(){


  $("#registrar_prestamo").click(function(){
    var monto =  parseInt($("#new_capital").val());
    var cuotas = $("#id_cuotas").val();
    var ciclo_pago = $("#id_ciclo_pago").val();
    var interes = $("#interes_porcentaje").val();
    var t_interes = $("#t_interes_valida").val();
    var disponible_id = parseInt($("#disponible_id").val());
	var tipo_prestamo = $("#tipo_prestamo").val();
    if (monto.length == 0 || monto == 0) {
      $('#alertprestamo').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Debe asignar un monto mayor a 0.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (cuotas.length == 0 || cuotas == 0) {
      $('#alertprestamo').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Debe asignar una cantidad de cuotas superior a 0.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (ciclo_pago.length == 0 || ciclo_pago == 0) {
      $('#alertprestamo').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Debe asignar una Modalidad.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if ((interes.length == 0 || interes == 0) && tipo_prestamo != "Acuerdo de Pago") {
      $('#alertprestamo').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Debe asignar un minimo de interes.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (t_interes.length == 0 || t_interes == 0) {
      $('#alertprestamo').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>De asignar un tipo de Interes.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (disponible_id < monto || disponible_id == 0) {
      $('#alertprestamo').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Fondos Insuficientes.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
      create_prestamo();
    }
  });


	$(".hoverclass tr").click(function(){
   		 window.location = $(this).data("href");
 	});

 	$("#estado_valida").change(function(){
      if ($(this).val() != "Aceptado") {
        $("#retirar_de_hidden").hide();
        $("#entidad_hidden").hide();
        $("#disponible_hidden").hide();
        $("#no_cheque_hidden").hide();
      }else{
        $("#retirar_de_hidden").show();
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
      var monto = $(this).children(":selected").attr("class");
      document.data_crear_prestamo.disponible_id.value = monto;
  });

  $("#entidad_banco").change(function(){
      var monto = $(this).children(":selected").attr("class");
      document.data_crear_prestamo.disponible_id.value = monto;
  });
	
	$("#id_ciclo_pago").change(function(){
      var aumt = parseInt($(this).children(":selected").val());
	  var fecha = new Date(); 
	  fecha.setDate(fecha.getDate() + aumt);
	  if(fecha.getDate() <= 9){ var dia = "0"+fecha.getDate(); }else{ var dia = fecha.getDate();}
	  if((fecha.getMonth()+ 1) <= 9){ var mes = "0"+(fecha.getMonth()+ 1); }else{ var mes = (fecha.getMonth()+ 1); }
	  var date = fecha.getFullYear() + '-' + mes + '-' + dia;
	  $("#fecha_reajuste").val(date);
  });
});