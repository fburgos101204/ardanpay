function cargar_datos(fecha_pagar,abono_capital,capital_pendiente,interes,pago_selector,mora_app) {
	
	var diff = mora(fecha_pagar);
	document.data_agregar_pago.moras_cargos.value = mora_app;
	var cuota = abono_capital + interes;

	var capital = capital_pendiente+interes;
	$("#cuota_pagar").prop("checked",true);
	$("#cuota_pagar").trigger("change");
	$("#cuota_pagar").val(cuota);
	$("#cancelar_pagar").val(capital_pendiente);
	$("#rd_cancelar").attr("value",capital);
	$("#solo_interes").val(interes);
	$("#otro_monto").val("otro_monto");

	$("#pago_selector").val(pago_selector);


	$("#tipo_pago").val("Efectivo");
	$("#tipo_pago").change();

	document.data_agregar_pago.descuento_interes.value = 0;

	document.data_agregar_pago.monto_picket.value = cuota;
	document.data_agregar_pago.total_pagar.value = cuota;
	cuota =parseFloat(cuota);

	abono_capital = parseFloat(abono_capital);

	capital_pendiente = parseFloat(capital);

	abono_capital = parseFloat(interes);

	$(".l_cuota_pagar span").text(" Cuota: RD$ "+number_format(cuota,2,".",","));
	$(".l_cancelar_pagar span").text(" Saldar: RD$ "+number_format(capital_pendiente,2,".",","));
	$(".l_solo_interes span").text(" Interés: RD$ "+number_format(interes,2,".",","));
	$("#total_a_pg").html(number_format(cuota,2,".",","));
	
	$("#moras_cargos").trigger("keyup");
}

function monto_picket(valor)
{
	$("#monto_picket").prop("value",valor);
}

function mora(fecha_pago)
{
  var fecha_pagos = moment(fecha_pago);
  var fecha = new Date();
  var day = fecha.getDate()+1;
  var month = fecha.getMonth() + 1;
  var year = fecha.getFullYear();
  var datee = year + "-" + month + "-" + day;
  datee = new Date(datee);
  var fecha_actual = moment(datee);
  return fecha_pagos.diff(fecha_actual, 'month');
	
}
$(document).ready(function(){
	$("#btn_legal").click(function(){
		var id_prestamo = $("#id_id_prestamo").val();
		$.confirm({
   			icon: "fas fa-exclamation-circle",
   			title: 'Confirmar!',
   			content: 'Desea pasar para asunto legal este Prestamo?',
   			buttons: {
       confirmar: function () {
		$.ajax({
      		type: "POST",
      		url: "php/detalleprestamo.php",
      		data: "id_prestamo="+id_prestamo+"&proceso=asunto_legal",
      		success: function(resp){
              $.notify({
                 icon: "add_alert",
                 message: "El Prestamo ha sido pasado para Asunto Legal."
              },{
                 type: 'danger',
                 timer: 2000,
                 placement: {
                 from: 'top',
                 align: 'center' }  });
            },complete: function(res){ location.reload(); }
          	});
        	},
        	cancelar: function ()
        	{
            	$.alert('<div class="jconfirm-title-c"><span class="jconfirm-icon-c"><i class="fas fa-exclamation-circle"></i></span><span class="jconfirm-title">Cancelado!</span></div><div class="jconfirm-content-pane no-scroll" style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); height: auto; max-height: 277.719px;margin-bottom: -5px;"><div class="jconfirm-content" id="jconfirm-box955"><div>No se ha sido pasado para asunto legal este prestamo.</div></div></div>');  
        }
    }
});
	});
	$("#btn_cancelar_prts").click(function(){
		var id_prestamo = $("#id_id_prestamo").val();
		$.confirm({
   			icon: "fas fa-exclamation-circle",
   			title: 'Confirmar!',
   			content: 'Desea cancelar este Prestamo?',
   			buttons: {
       confirmar: function () {
       $.ajax({
      		type: "POST",
      		url: "php/detalleprestamo.php",
      		data: "id_prestamo="+id_prestamo+"&proceso=cancelar",
            success: function(resp){
              $.notify({
                 icon: "add_alert",
                 message: "El Prestamo ha sido cancelado."
              },{
                 type: 'danger',
                 timer: 2000,
                 placement: {
                 from: 'top',
                 align: 'center' }  });
            },complete: function(res){ location.reload(); }
          	});
        	},
        	cancelar: function ()
        	{
            	$.alert('<div class="jconfirm-title-c"><span class="jconfirm-icon-c"><i class="fas fa-exclamation-circle"></i></span><span class="jconfirm-title">Cancelado!</span></div><div class="jconfirm-content-pane no-scroll" style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); height: auto; max-height: 277.719px;margin-bottom: -5px;"><div class="jconfirm-content" id="jconfirm-box955"><div>No se ha cancelado este prestamo.</div></div></div>');  
        }
    }
});
	});
	$("#radio_button input:radio").change(function () {

		if ($(this).val() != "otro_monto") {
			var mont = 0
			if ($(this).attr("id") == "cancelar_pagar" && $("#anular_interes").prop("checked") == false) {
				mont = $("#rd_cancelar").val();
			}else
			{
				mont = $(this).val();
			}
			monto_picket(mont);
		}
		
		if ($(this).val() == "no_interes_monto") {

			var val = 0;
			var total =  0;
	 		$("#monto_capital_no_interes").prop("disabled",false);
	 		if ($("#monto_capital_no_interes").val() != null) { 
	 			val = $("#monto_capital_no_interes").val();
	 			val = parseFloat(val);
	 			total = number_format(val,2,".",",");
	 		}

	 		$("#monto_picket").val(val);
	 		$("#total_pagar").val(val);
	 		$("#total_a_pg").html(total);

	 	}else if ($(this).val() == "otro_monto") {

			monto_picket(0);
	 		$("#monto_capital_no_interes").prop("disabled",true);
	 		$("#form_monto").show();
			$("#total_pagar_total").val(0);
	 		$("#total_a_pg").html(0);
	 		$("#monto_capital_no_interes").val();
	 		$("#total_pagar").val(0);

	 	}else{

	 		$("#monto_capital_no_interes").prop("disabled",true);
	 		$("#monto_capital").val(0);
	 		$("#form_monto").hide();
	 		$("#monto_capital_no_interes").val();
	 		var total = parseFloat($("#monto_picket").val());
	 		total = number_format(total,2,".",",");
	 		$("#total_a_pg").html(total);
	 		$("#total_pagar").val($("#monto_picket").val());
	 	}
    });

    $("#radio_button input[type='checkbox']").change(function () {

	 		var mont_cancel = parseFloat($("#cancelar_pagar").val());
	 		var intereses = parseFloat($("#solo_interes").val());
	 		if($(this).is(":checked")){
	 			$(".l_cancelar_pagar span").text(" Saldar: RD$ "+number_format(mont_cancel,2,".",","));
	 			
	 			$(".l_cuota_pagar").hide();
				$("#cancelar_pagar").prop("checked",true);
				$("#cancelar_pagar").trigger("change");
	 			$(".l_solo_interes").hide();
	 			$("#form_monto").hide();
	 			$("#descuento_hidden").val(0);
	 			$("#descuento_hidden").hide();
	 			$(".monto_capit").show();
	 			$(".l_otro_monto").hide();
            }
            else if($(this).is(":not(:checked)")){
            	$(".l_cancelar_pagar span").text(" Saldar: RD$ "+number_format(mont_cancel+intereses,2,".",","));
				$("#cuota_pagar").prop("checked",true);
				$("#cuota_pagar").trigger("change");
	 			$(".monto_capit").hide();
	 			$("#descuento_hidden").val(0);
	 			$("#descuento_hidden").show();
	 			$(".l_cuota_pagar").show();
	 			$(".l_solo_interes").show();
	 			$(".l_otro_monto").show();
            }
    });


    $("#monto_capital_no_interes").keyup(function () {

	 		var val = 0;
			var total =  0;
	 		if ($("#monto_capital_no_interes").val() != "") { 

				$("#monto_picket").val($(this).val());
	 			$("#total_pagar").val($(this).val());
	 			val = $("#monto_capital_no_interes").val();
	 			val = parseFloat(val);
	 			total = number_format(val,2,".",",");
	 		}

	 		$("#monto_picket").val(val);
	 		$("#total_a_pg").html(total);


	 		total = number_format(total,2,".",",");
	 		$("#total_a_pg").html(total);
    });



    $("#monto_capital").keyup(function () {
	 		var valor = 0;
	 		var total = 0;
	 		if ($("#monto_capital").val() != "") {
	 			valor = $(this).val();
	 			total = parseFloat(valor);
	 			if ($("#moras_cargos").val() != "") {
	 				total = parseFloat(valor) + parseFloat($("#moras_cargos").val())
	 			}
	 		}
			monto_picket(valor);
	 		$("#total_pagar").val(total);
	 		total = number_format(parseFloat(total),2,".",",");
	 		$("#total_a_pg").html(total);
    });


    $("#moras_cargos").keyup(function () {

	 		var sub = $("#monto_picket").val();
			var total =  $("#monto_picket").val();
			if ($("#moras_cargos").val() == "") {
				$("#moras_cargos").val(0);
			}
	 		if ($("#moras_cargos").val() != "") { 
	 			sub = parseFloat(total)  + parseFloat($("#moras_cargos").val()) - parseFloat($("#descuento_interes").val());
	 			total = number_format(sub,2,".",",");
	 		}else{
	 			sub = parseFloat(total) - parseFloat($("#descuento_interes").val());
	 			total = number_format(sub,2,".",",");
	 		}
	 		$("#total_pagar").val(sub);
	 		$("#total_a_pg").html(total);
	 		
    });

    $("#descuento_interes").keyup(function () {

	 		var sub = $("#monto_picket").val();
			var total =  $("#monto_picket").val();
			if ($("#descuento_interes").val() == "") {
				$("#descuento_interes").val(0);
			}
	 		if ((parseInt($(this).val()) <= parseInt($("#solo_interes").val()))) { 
	 			sub = parseFloat(total) + parseFloat($("#moras_cargos").val())  - parseFloat($("#descuento_interes").val());
	 			total = number_format(sub,2,".",",");
	 			$('#alertpago').html('');
	 		}
	 		else
	 		{
	 			$('#alertpago').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            		'<strong>Alerta!</strong> El descuento debe ser menor o igual al interes.'+
            		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            		'<span aria-hidden="true">&times;</span>'+
            		'</button></div>');
	 			sub = parseFloat(total) + parseFloat($("#moras_cargos").val());
	 			total = number_format(sub,2,".",",");
	 		
	 		}
	 		$("#total_pagar").val(sub);
	 		$("#total_a_pg").html(total);
	 		
    });

    $("#tipo_pago").change(function () {
    	if ($(this).val() != "Efectivo") {
    		$(".banco_pago").show();
    		$(".no_cheque").show();
    		$(".id_caja").hide();
    	}
    	else
    	{
    		$(".banco_pago").hide();
    		$(".no_cheque").hide();
    		$(".id_caja").show();
    	}
    });

});