function new_banco(creador,negocio)
{
    open_banco("save_banco",null,null,null,null,null,creador,negocio);
}

function open_banco(action,id_banco,banco,titular,fecha_vencimiento,monto,creador,negocio){    
  
    document.frm_banco.id_negocio.value = negocio;
    document.frm_banco.creador_banco.value = creador;
    document.frm_banco.id_banco.value = id_banco;
    document.frm_banco.banco_name.value = banco;
    document.frm_banco.banco_titular.value = titular;
	if(fecha_vencimiento != null){
    	document.frm_banco.fecha_venci.value = fecha_vencimiento;
	}
    document.frm_banco.banco_monto.value = monto;

    $('#alertPass').html("");
    $('#modal_banco').on('shown.bs.modal', function () {
        var modal = $(this);
        if (action === 'save_banco'){                       
            $('#btn_save_banco').show();
            $('#btn_update_banco').hide();             
            modal.find('.modal-title').html('<i class="fas fa-university"></i> Registrar Banco');        
        }else if (action === 'update_banco'){
            $('#btn_save_banco').hide();                    
            $('#btn_update_banco').show();                   
            modal.find('.modal-title').html('<i class="fas fa-university"></i> Modificar Banco');
        }
    });
}
function Delete(id)
{
  $.confirm({
   icon: "fas fa-exclamation-circle",
   title: 'Confirmar!',
   content: 'Desea eliminar este Banco?',
   buttons: {
       confirmar: function () {
              var duda ="delete";
                $.ajax({
                  type: "POST",
                  url: "php/bancocontroller.php",
                  data: "id_banco="+id+"&proceso="+duda,
                  success: function(resp){

                  $("#banco_tabla").load(location.href+" #banco_tabla>*","");
                   
                  $.notify({
                     icon: "add_alert",
                    message: "El Banco se elimino con exito."
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
            $.alert('<div class="jconfirm-title-c"><span class="jconfirm-icon-c"><i class="fas fa-exclamation-circle"></i></span><span class="jconfirm-title">Cancelado!</span></div><div class="jconfirm-content-pane no-scroll" style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); height: 24px; max-height: 277.719px;margin-bottom: -5px;"><div class="jconfirm-content" id="jconfirm-box955"><div>No se eliminará este Banco.</div></div></div>');  
        }
    }
});

}
function cargarlo()
{
  $("#banco_tabla").load(location.href+" #banco_tabla>*","");
  $('#modal_banco').modal('hide');
}
$(document).ready(function(){
  $("#btn_save_banco").click(function(){
    var duda = "save_banco";

    var name = $("#banco_name").val();
    var banco_titular = $("#banco_titular").val();
    var monto = $("#banco_monto").val();
    if (name.length <= 0) {
      $('#alertcaja').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Nombre del Banco vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if(banco_titular.length <= 0)
    {
      $('#alertcaja').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Titular de Cuenta vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }
    else if(monto.length <= 0)
    {
      $('#alertcaja').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Monto vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
      $.ajax({
          type: "POST",
          url: "php/bancocontroller.php",
          data: $("#frm_banco").serialize()+"&proceso="+duda,
          success: function(resp){
            console.log(resp);
            cargarlo();
          }
        });
    }
    
  });

  $("#btn_update_banco").click(function(){
    var duda = "update_banco";
    var name = $("#banco_name").val();
    var banco_titular = $("#banco_titular").val();
    var monto = $("#banco_monto").val();
    if (name.length <= 0) {
      $('#alertcaja').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Nombre del Banco vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if(banco_titular.length <= 0)
    {
      $('#alertcaja').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Titular de Cuenta vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }
    else if(monto.length <= 0)
    {
      $('#alertcaja').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Monto vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
      $.ajax({
          type: "POST",
          url: "php/bancocontroller.php",
          data: $("#frm_banco").serialize()+"&proceso="+duda,
          success: function(resp){
            console.log(resp);
            cargarlo();
          }
        });
    }
    
  });
});