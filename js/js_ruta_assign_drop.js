function assign_cliente_table()
{    
	var duda = "asignar_cliente";
	var id_cliente = $("#id_cliente").val();
	var id_ruta = $("#id_ruta").val();
	
    $.ajax({
     	type: "POST",
     	url: "php/rutacontroller.php",
    	data:  "id_ruta="+id_ruta+"&id_cliente="+id_cliente+"&proceso="+duda,
     	success: function(resp){ 
			console.log(resp);
			onload_cliente('list_cliente',id_ruta);
  			$('#modal_assign_cliente').modal('hide');
		}
	 });
}

function des_cliente(id_cliente)
{    
	var duda = "desasignar_cliente";
	var id_ruta = $("#id_ruta").val();
    $.ajax({
     	type: "POST",
     	url: "php/rutacontroller.php",
    	data: "id_ruta="+id_ruta+"&id_cliente="+id_cliente+"&proceso="+duda,
     	success: function(resp){ 
			console.log(resp);
			onload_cliente('list_cliente',id_ruta);
		}
	 });
}

function assign_mensajero_table()
{    
	var duda = "asignar_mensajero";
	var id_mensajero = $("#id_mensajero").val();
	var id_ruta = $("#id_ruta").val();
    $.ajax({
     	type: "POST",
     	url: "php/rutacontroller.php",
    	data: "id_ruta="+id_ruta+"&id_mensajero="+id_mensajero+"&proceso="+duda,
     	success: function(resp){ 
			console.log(resp);
			onload_mensajero('list_mensajero',id_ruta);
  			$('#modal_assign_mensajero').modal('hide');
		}
	 });
}

function des_mensajero(id_mensajero)
{    
	var duda = "desasignar_mensajero";
	var id_ruta = $("#id_ruta").val();
    $.ajax({
     	type: "POST",
     	url: "php/rutacontroller.php",
    	data: "id_ruta="+id_ruta+"&id_mensajero="+id_mensajero+"&proceso="+duda,
     	success: function(resp){ 
			console.log(resp);
			onload_mensajero('list_mensajero',id_ruta);
		}
	 });
}



$(document).ready(function(){
	
  $("#btn_save_ruta").click(function(){
  });

  $("#btn_update_ruta").click(function(){
   
  });
	
});