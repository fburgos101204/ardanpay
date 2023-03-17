function new_caja(creador,negocio)
{
    open_caja("save_caja",null,null,null,creador,negocio);
}

function open_caja(action,id_caja,nombre,monto,creador,negocio){    
  
    document.frm_caja.id_negocio.value = negocio;
    document.frm_caja.creador_caja.value = creador;
    document.frm_caja.id_caja.value = id_caja;
    document.frm_caja.caja_name.value = nombre;
    document.frm_caja.monto_caja.value = monto;

    $('#alertPass').html("");
    $('#modal_caja').on('shown.bs.modal', function () {
        var modal = $(this);
        if (action === 'save_caja'){                       
            $('#btn_save_caja').show();
            $('#btn_update_caja').hide();             
            modal.find('.modal-title').html('<i class="fas fa-box-open"></i> Registrar Caja');        
        }else if (action === 'update_caja'){
            $('#btn_save_caja').hide();                    
            $('#btn_update_caja').show();                   
            modal.find('.modal-title').html('<i class="fas fa-box-open"></i> Modificar Caja');
        }
    });
}
function Delete(id)
{
  $.confirm({
   icon: "fas fa-exclamation-circle",
   title: 'Confirmar!',
   content: 'Desea eliminar esta Caja?',
   buttons: {
       confirmar: function () {
              var duda ="delete";
                $.ajax({
                  type: "POST",
                  url: "php/cajacontroller.php",
                  data: "id_caja="+id+"&proceso="+duda,
                  success: function(resp){

                   $("#caja_tabla").load(location.href+" #caja_tabla>*","");
                   
                  $.notify({
                     icon: "add_alert",
                    message: "La Caja se elimino con exito."
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
            $.alert('<div class="jconfirm-title-c"><span class="jconfirm-icon-c"><i class="fas fa-exclamation-circle"></i></span><span class="jconfirm-title">Cancelado!</span></div><div class="jconfirm-content-pane no-scroll" style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); height: 24px; max-height: 277.719px;margin-bottom: -5px;"><div class="jconfirm-content" id="jconfirm-box955"><div>No se eliminará esta Caja.</div></div></div>');  
        }
    }
});

}
function cargarlo()
{
  $("#caja_tabla").load(location.href+" #caja_tabla>*","");
  $('#modal_caja').modal('hide');
}
$(document).ready(function(){
  $("#btn_save_caja").click(function(){
    var duda = "save_caja";
    var name = $("#caja_name").val();
    var monto = $("#monto_caja").val();
    if (name.length <= 0) {
      $('#alertcaja').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Identificador vacio.'+
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
          url: "php/cajacontroller.php",
          data: $("#frm_caja").serialize()+"&proceso="+duda,
          success: function(resp){
            console.log(resp);
            cargarlo();
          }
        });
    }
    
  });

  $("#btn_update_caja").click(function(){
    var duda = "update_caja";
    var name = $("#caja_name").val();
    var monto = $("#monto_caja").val();
    if (name.length <= 0) {
      $('#alertcaja').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Identificador vacio.'+
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
          url: "php/cajacontroller.php",
          data: $("#frm_caja").serialize()+"&proceso="+duda,
          success: function(resp){
            console.log(resp);
            cargarlo();
          }
        });
    }
    
  });
});