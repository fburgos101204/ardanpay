$(document).ready(function(){
	$("#negocio").change(function(){
	$('#ck_inicio').prop('checked', false);
    $('#ck_sol_prestamo').prop('checked', false);
    $('#ck_prestamo_personal').prop('checked', false);
    $('#ck_prestamo_inmobilirario').prop('checked', false);
    $('#ck_prestamo_semanal').prop('checked', false);
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
	if($(this).val() == 0){ 
	var permisos = $(this).children("option:selected").attr("class");
    if (permisos.length > 0){  
      var obj = jQuery.parseJSON(permisos);

      resp =  (obj.inicio == "on") ? $('#ck_inicio').prop('checked', true) : $('#ck_inicio').prop('checked', false);
      resp =  (obj.sol_prestamo == "on") ? $('#ck_sol_prestamo').prop('checked', true) : $('#ck_sol_prestamo').prop('checked', false);
      resp =  (obj.prestamo_personal == "on") ? $('#ck_prestamo_personal').prop('checked', true) : $('#ck_prestamo_personal').prop('checked', false);
      resp =  (obj.prestamo_inmobilirario == "on") ? $('#ck_prestamo_inmobilirario').prop('checked', true) : $('#ck_prestamo_inmobilirario').prop('checked', false);
	      resp =  (obj.prestamo_semanal == "on") ? $('#ck_prestamo_semanal').prop('checked', true) : $('#ck_prestamo_semanal').prop('checked', false);	
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
    } }
	});
});