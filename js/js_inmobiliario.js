function new_casa(creador)
{
    open_casa("save_casa",null,null,null,null,null,null,null,null,null,null,creador);
    
}
function open_casa(action,id_casa,tipo,color,direccion,habitacion,baño,cocina,sala,comedor,descripcion,creador,foto_1,foto_2,foto_3){    
  
    document.data_casa.id_casa.value = id_casa;
    document.data_casa.tipo.value = tipo;
    document.data_casa.color.value = color;
    document.data_casa.direccion.value = direccion;
    document.data_casa.habitacion.value = habitacion;
    document.data_casa.baño.value = baño;
    document.data_casa.cocina.value = cocina;
    document.data_casa.sala.value = sala;
    document.data_casa.comedor.value = comedor;
    document.data_casa.descripcion.value = descripcion;
    document.data_casa.creador.value = creador;
	
	
	if (foto_1 == null || foto_1.length <= 0) {
      var part_frontal = "Choose file";
    }else{
      var part_frontal = foto_1.replace("inmobiliaria/", "");
      console.log(foto_1);
    }
    $("#part_frontal img").prop("src", part_frontal);
	
	if (foto_2 == null || foto_2.length <= 0) {
      var part_trasera = "Choose file";
    }else{
      var part_trasera = foto_2.replace("inmobiliaria/", "");
      console.log(foto_2);
    }
    $("#part_trasera img").prop("src", part_trasera);
	
	if (foto_3 == null || foto_3.length <= 0) {
      var lat_derecho = "Choose file";
    }else{
      var lat_derecho = foto_3.replace("inmobiliaria/", "");
      console.log(foto_3);
    }
    $("#lat_derecho img").prop("src", lat_derecho);
	
    $('#alertPass').html("");
    $('#modal_inmobiliriario').on('shown.bs.modal', function () {
        var modal = $(this);
        if (action === 'save_casa'){                       
            $('#save_casa').show();
            $('#update_casa').hide();                    
        }else if (action === 'update_casa'){
            $('#save_casa').hide();                    
            $('#update_casa').show();                   
        }
    });
}
function Delete(id)
{

  var duda ="delete";
    $.ajax({
      type: "POST",
      url: "php/inmobiliariacontroller.php",
      data: "id_casa="+id+"&proceso="+duda,
      success: function(resp){

       $("#table_inmobiliario").load(location.href+" #table_inmobiliario>*","");
       
      $.notify({
         icon: "add_alert",
        message: "La Inmobiliaria se elimino con exito."
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
  $("#save_casa").click(function(){

    var duda ='save_casa';
    var creador = $("#creador").val();
    var tipo = $("#tipo").val();
    var color = $("#color").val();
    var direccion = $("#direccion").val();
    var habitacion = $("#habitacion").val();
    var baño = $("#baño").val();
    var cocina = $("#cocina").val();
    var sala = $("#sala").val();
    var comedor = $("#comedor").val();
    var descripcion = $("#descripcion").val();



    if (tipo.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong> Marca vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (color.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong> Modelo vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (direccion.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong> Año vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (habitacion.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong> Color vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (baño.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong> Tipo Electronico vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (cocina.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert!</strong> Matricula vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (sala.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert!</strong> Chasis vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (descripcion.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert!</strong> Motor vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
    $.ajax({
      type: "POST",
      url: "php/inmobiliariacontroller.php",
      data: $('#data_casa').serialize() +'&proceso='+duda,
      success: function(resp){
       $("#table_inmobiliario").load(location.href+" #table_inmobiliario>*","");
       $('#modal_inmobiliriario').modal('hide');
       $('.empety').val('');
      $.notify({
         icon: "add_alert",
        message: "La Inmobiliaria se ha agregado con exito."
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

  $("#update_casa").click(function(){
    var duda ='update_casa';
    var tipo = $("#tipo").val();
    var color = $("#color").val();
    var direccion = $("#direccion").val();
    var habitacion = $("#habitacion").val();
    var baño = $("#baño").val();
    var cocina = $("#cocina").val();
    var sala = $("#sala").val();
    var comedor = $("#comedor").val();
    var descripcion = $("#descripcion").val();



    if (tipo.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong> Marca vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (color.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong> Modelo vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (direccion.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong> Año vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (habitacion.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong> Color vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (baño.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong> Tipo Electronico vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (cocina.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert!</strong> Matricula vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (sala.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert!</strong> Chasis vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (descripcion.length == 0) {
      $('#alertPass').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert!</strong> Motor vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
	var form = $('#data_casa')[0];
    var formData = new FormData(form);

    var inputFileImage = document.getElementById('file_part_frontal');
    var file1 = inputFileImage.files[0];
    formData.append('file_part_frontal',file1);
    console.log(file1);
	
	var inputFileImage3 = document.getElementById('file_part_trasera');
    var file3 = inputFileImage3.files[0];
    formData.append('file_part_trasera',file3);
    console.log(file3);
	
	var inputFileImage4 = document.getElementById('file_lat_derecho');
    var file4 = inputFileImage4.files[0];
    formData.append('file_lat_derecho',file4);
    console.log(file4);
	
    formData.append('proceso','update');
		
 	var part_frontal = $("#part_frontal img").attr("src");
    var part_trasera = $("#part_trasera img").attr("src");
    var lat_derecho = $("#lat_derecho img").attr("src");
	
    formData.append('aux_part_frontal',part_frontal);
    formData.append('aux_part_trasera',part_trasera);
    formData.append('aux_lat_derecho',lat_derecho);
		
    $.ajax({
      type: "POST",
      url: "php/inmobiliariacontroller.php",
	  contentType:false,
      data: formData,
      cache: false,
      processData: false, 
      success: function(resp){ 
		  console.log(resp);
        $("#table_inmobiliario").load(location.href+" #table_inmobiliario>*","");
        $('#modal_inmobiliriario').modal('hide');
        $.notify({
         icon: "add_alert",
          message: "La Inmobiliaria se actualizo con exito."
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