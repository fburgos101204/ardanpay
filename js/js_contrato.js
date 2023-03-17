function guardar_contrato(contrato)
{
	var negocio = $("#negocio_contrato").val();
	var html = encodeURIComponent(CKEDITOR.instances[contrato].getData());
	$.ajax({
      	type: "POST",
      	url: "php/contratocontroller.php",
		data: "html="+html+"&negocio="+negocio+"&contrato="+contrato,
      	success: function(resp){ 
			$.notify({
                    icon: "add_alert",
                    message: " El Contrato ha sido guardado."
                  },{
                    type: 'success',
                    timer: 1000,
                    placement: {
                      from: 'top',
                      align: 'center'
                  }
                  });
			console.log(resp); 
		}
	});
}
function load_contrato(contrato)
{
	var negocio = $("#negocio_contrato").val();
	var datos = "../contratos/"+negocio+"/"+contrato+"/"+negocio+"_"+contrato+".html";
	$.get(datos, function(data) {
		CKEDITOR.instances[""+contrato+""].setData(data);
		console.log(data);
	});
	
}
$(document).ready(function(){
	setTimeout(function(){ 
		load_contrato('contrato_personal');
		load_contrato('contrato_vehiculo');
		load_contrato('contrato_inmobiliario');
	}, 500);
});