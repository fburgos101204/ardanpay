function filtrar_pago()
{
	var tipo = "t_pago";
	$.ajax({
      	type: "POST",
      	url: "php/reportcontroller.php",
		data: $("#data_filtro_pagos").serialize()+"&tipo="+tipo,
      	success: function(resp){
  			$('#modal_filtro_pagos').modal('hide');
			$("#table_solicitud").html(resp);
		}
	});
}
function onload_filtro(negocio)
{
	document.data_filtro_pagos.negocio.value = negocio;
}

$(document).ready(function(){ 
	$("#btn_filtrar_pago").click(function(){ filtrar_pago(); });
	$("#forma_pago").change(function(){
		if($(this).val() == "Caja"){ $("#hidden-caja").show(); $("#hidden-banco").hide(); }
		else if($(this).val() == "Banco"){ $("#hidden-banco").show(); $("#hidden-caja").hide(); }
	});

});