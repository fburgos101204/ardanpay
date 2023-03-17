function new_pago_efectivo(crd)
{
	document.data_pago_efectivo.crd.value = crd;
	$("#negocio").trigger("change");
}

//Consultar info del negocio
function onload_info(id_negocio)
{
	var duda = "info_efectivo";
	$.ajax({
          type: "POST",
          url: "php/historialefectivocontroller.php",
          data: "id_negocio="+id_negocio+"&proceso="+duda,
          success: function(resp){ $("#info_negocio").html(resp); }
   	});
}

function registrar_pago()
{
	var duda = "save_efectivo";
	$.ajax({
          type: "POST",
          url: "php/historialefectivocontroller.php",
          data: $("#data_pago_efectivo").serialize()+"&proceso="+duda,
          success: function(resp){ 
			$("#modal_pago_efectivo").modal('hide');
       		$("#table_pago_efectivo").load(location.href+" #table_pago_efectivo>*","");
		  }
   	});
}

$(document).ready(function(){
	
	$("#btn_save_pago_efectivo").click(function(){ registrar_pago(); });
	
	$("#negocio").change(function(){
      	var negocio = parseInt($(this).children(":selected").attr("value"));
		onload_info(negocio);
	});
	
});