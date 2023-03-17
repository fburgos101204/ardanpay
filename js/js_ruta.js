function new_ruta(negocio)
{
    document.data_ruta.direccion.value = "";
    document.data_ruta.id_negocio.value = negocio;
}

function open_ruta(action,id_ruta,ruta)
{    
	onload_cliente('list_cliente',id_ruta);
	onload_mensajero('list_mensajero',id_ruta);
    document.data_ruta_assign.id_ruta.value = id_ruta;
    document.data_ruta_assign.dir_ruta.value = ruta;
    $('#alertruta_dir').html("");
    
}
function onload_cliente(action,id_ruta)
{    
    $.ajax({
     	type: "POST",
     	url: "php/rutaslistcontroller.php",
    	data: "id_ruta="+id_ruta+"&proceso="+action,
     	success: function(resp){ $("#info_cliente").html(resp);	}
	 });
}

function onload_mensajero(action,id_ruta)
{    
     $.ajax({
     	type: "POST",
     	url: "php/rutaslistcontroller.php",
    	data: "id_ruta="+id_ruta+"&proceso="+action,
     	success: function(resp){ 
			
			if(resp != ""){
				$("#btn_asg_mjr").hide(); 
			}else{
				$("#btn_asg_mjr").show();
			}
			$("#info_mensajero").html(resp);
		}
	 	});
}

function Delete(id)
{
  $.confirm({
   icon: "fas fa-exclamation-circle",
   title: 'Confirmar!',
   content: 'Desea eliminar esta Ruta?',
   buttons: {
       confirmar: function () {
              var duda ="delete";
                $.ajax({
                  type: "POST",
                  url: "php/rutacontroller.php",
                  data: "id_ruta="+id+"&proceso="+duda,
                  success: function(resp){

                   $("#ruta_tabla").load(location.href+" #ruta_tabla>*","");
                   
                  $.notify({
                     icon: "add_alert",
                    message: "La Ruta se elimino con exito."
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
        },
        cancelar: function ()
        {
            $.alert('<div class="jconfirm-title-c"><span class="jconfirm-icon-c"><i class="fas fa-exclamation-circle"></i></span><span class="jconfirm-title">Cancelado!</span></div><div class="jconfirm-content-pane no-scroll" style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); height: 24px; max-height: 277.719px;margin-bottom: -5px;"><div class="jconfirm-content" id="jconfirm-box955"><div>No se eliminará esta Ruta.</div></div></div>');  
        }
    	}
		});
}



$(document).ready(function(){
	
  $("#btn_save_ruta").click(function(){
    var duda = "save_ruta";
    var direccion = $("#direccion").val();
    if (direccion.length <= 0) {
      $('#alertruta').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Direccion vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
      $.ajax({
          type: "POST",
          url: "php/rutacontroller.php",
          data: $("#data_ruta").serialize()+"&proceso="+duda,
          success: function(resp){
            console.log(resp);
            $("#ruta_tabla").load(location.href+" #ruta_tabla>*","");
  			$('#modal_ruta').modal('hide');
          }
        });
    }
  });

  $("#btn_update_ruta").click(function(){
    var duda = "update_ruta";
    var direccion = $("#dir_ruta").val();
    if (direccion.length <= 0) {
      $('#alertruta_dir').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Direccion vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
      $.ajax({
          type: "POST",
          url: "php/rutacontroller.php",
          data: $("#data_ruta_assign").serialize()+"&proceso="+duda,
          success: function(resp){
            console.log(resp);
            $("#ruta_tabla").load(location.href+" #ruta_tabla>*","");
  			$('#modal_ruta_assign').modal('hide');
          }
        });
    }
  });
	
});