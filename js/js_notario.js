function new_notario(creador,negocio)
{
    open_notario("save",null,null,null,null,null,creador,negocio);
    
}
function open_notario(action,id_notario,nombre,apellido,cedula,codigo,creador,negocio){    
  
    document.data_notario.id_negocio.value = negocio;
    document.data_notario.id_notario.value = id_notario;
    document.data_notario.creador.value = creador;
    document.data_notario.nombre.value = nombre;
    document.data_notario.apellido.value = apellido;
    document.data_notario.cedula.value = cedula;
    document.data_notario.codigo.value = codigo;
    document.data_notario.creador.value = creador;

    $('#alertPass').html("");
    $('#modal_notario').on('shown.bs.modal', function () {
        var modal = $(this);
        if (action === 'save'){                       
            $('#save_notario').show();
            $('#update_notario').hide();             
            modal.find('.modal-title').html('<i class="fas fa-gavel"></i> Agregando Notario');        
        }else if (action === 'update'){
            $('#save_notario').hide();     
            $('#update_notario').show();                   
            modal.find('.modal-title').html('<i class="fas fa-gavel"></i> Modificar Notario');
        }
    });
}
function Delete(id)
{

  var duda ="delete";
    $.ajax({
      type: "POST",
      url: "php/notariocontroller.php",
      data: "id_notario="+id+"&proceso="+duda,
      success: function(resp){
      $("#notario_tabla").load(location.href+" #notario_tabla>*","");
      $.notify({
         icon: "add_alert",
        message: "El Notario se elimino con exito."
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

}


$( document ).ready(function() {
  $("#save_notario").click(function(){

    var duda ='save';
    var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();
    var cedula = $("#cedula").val();
    var codigo = $("#codigo").val();

    if (nombre.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong>Nombre vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (apellido.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong>Apellido vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (codigo.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong>Codigo vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (cedula.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong>Cedula vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
    $.ajax({
      type: "POST",
      url: "php/notariocontroller.php",
      data: $('#data_notario').serialize() +'&proceso='+duda,
      success: function(resp){
       console.log(resp);
       $("#notario_tabla").load(location.href+" #notario_tabla>*","");
       $('#modal_notario').modal('hide');
       $('.empety').val('');
      $.notify({
         icon: "add_alert",
        message: "El Notario se ha generado con exito."
      },{
         type: 'success',
         timer: 2000,
         placement: {
            from: 'top',
            align: 'center'
      }
  });
      }
    });}
  });

  $("#update_notario").click(function(){
    var duda ='update';
    var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();
    var cedula = $("#cedula").val();
    var codigo = $("#codigo").val();

    if (nombre.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong>Nombre vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (apellido.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong>Apellido vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (codigo.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong>Codigo vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (cedula.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong>Cedula vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
    $.ajax({
      type: "POST",
      url: "php/notariocontroller.php",
      data: $('#data_notario').serialize() +'&proceso='+duda,
      success: function(resp){ 
        $("#notario_tabla").load(location.href+" #notario_tabla>*","");
        $('#modal_notario').modal('hide');
        $.notify({
         icon: "add_alert",
          message: "El Notario se actualizo con exito."
        },{
         type: 'warning',
         timer: 2000,
         placement: {
            from: 'top',
            align: 'center'
        }
      });
    }
  });
  }
});
         
});