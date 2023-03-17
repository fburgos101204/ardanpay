function clean_edit(cant_reajuste,mont_inicial,capital_p_inicial,capital_pendiente)
{
  document.frm_edit_prestamo.cant_reajust.value = cant_reajuste;
  document.frm_edit_prestamo.edit_monto_inicial.value = mont_inicial;
  document.frm_edit_prestamo.edit_capital_p_inicial.value = capital_p_inicial;
  document.frm_edit_prestamo.edit_capital_pendiente.value = capital_pendiente;
	  
  var fecha = new Date();
  document.frm_edit_prestamo.edit_t_interes.value = "Interes Fijo";
  document.frm_edit_prestamo.edit_cuotas.value = 0;
  document.frm_edit_prestamo.edit_ciclo_pago.value = 30;
  document.frm_edit_prestamo.edit_interes_porcentaje.value = 0;
}

function editar_prestamo()
{
	var ip_prestamo = $("#id_id_prestamo").val();
	$.ajax({
      type: "POST",
      url: "php/controllereditprestamo.php",
      data: $("#frm_edit_prestamo").serialize()+"&id_presta="+ip_prestamo+"&proceso=nada",
      success: function(resp){ console.log(resp); },
	  complete: function(resp){ console.log(resp); 
		aux_guardar_editar();
        window.setTimeout(function(){window.location.reload()}, 2000);
        window.setTimeout(function(){ $("#modal_edicion_prestamo").modal("hide"); }, 1500);
		}
    });
}

$(document).ready(function(){
	$("#btn_update_prestamo").click(function(){
	  var edit_cuotas = $("#edit_cuotas").val();
	  var edit_interes_porcentaje = $("#edit_interes_porcentaje").val();
	  if (edit_cuotas.length == 0 || edit_cuotas == 0) {
      	$('#alertedit').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Debe asignar un minimo de cuotas.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	  }else if (edit_interes_porcentaje.length == 0 || edit_interes_porcentaje == 0) {
      	$('#alertedit').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Debe asingar un porcentaje de interes.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	  }else{
		editar_prestamo();
	  }
	});
});