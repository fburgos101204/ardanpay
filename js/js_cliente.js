function new_cliente(creador,ngc)
{
    open_cliente("save_cliente",null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,creador,ngc,null);
}

function mora(id,mora)
{
  document.data_mora.id_cliente_mora.value = id;
  document.data_mora.mora.value = mora;
}


function asignar_mora()
{
  var duda = "asignar_mora";
  $.ajax({
      type: "POST",
      url: "php/moracontroller.php",
      data: $("#data_mora").serialize()+"&proceso="+duda,
      success: function(res){ 
       console.log(res);
       $("#cliente_tabla").load(location.href+" #cliente_tabla>*","");
       $('#modal_mora').modal('hide');
     }
    });
}

function cargar(id)
{
  document.referencia_data.id_client_ref.value = id;
  var duda ="mostrar";
  $.ajax({
      type: "POST",
      url: "php/garantescontroller.php",
      data: "id_client_ref="+id+"&duda="+duda,
      success: function(resp){ console.log("cargado"); clear_ref(); $("#detalles").html(resp); }
    });
}

function open_cliente(action,id_cliente,nombre,apellido,sexo,telefono,estado_civil,cedula,
                      correo,direccion,fecha_nacimiento,celular,tipo_vivienda,
                      ocupacion,titulo,ingreso,facebook,instagram,dependientes,ruta_i,ruta_c, creador,ngc,nacionalidad){    
  
    document.data_cliente.id_cliente.value = id_cliente;
    document.data_cliente.creador.value = creador;
    document.data_cliente.nombre.value = nombre;
    document.data_cliente.apellido.value = apellido;
    document.data_cliente.telefono.value = telefono;
    document.data_cliente.cedula.value = cedula;
    document.data_cliente.correo.value = correo;
    document.data_cliente.direccion.value = direccion;
    document.data_cliente.id_negocio.value = ngc;

    document.data_cliente.sexo.value = sexo;
    document.data_cliente.estado_civil.value = estado_civil;
    document.data_cliente.fecha_nacimiento.value = fecha_nacimiento;
    document.data_cliente.celular.value = celular;
    document.data_cliente.tipo_vivienda.value = tipo_vivienda;
    document.data_cliente.ocupacion.value = ocupacion;
    document.data_cliente.titulo.value = titulo;
    document.data_cliente.ingreso.value = ingreso;
    document.data_cliente.facebook.value = facebook;
    document.data_cliente.instagram.value = instagram;
    document.data_cliente.dependientes.value = dependientes;
	
    document.data_cliente.nacionalidad.value = nacionalidad;
	
	$("#garante_table").html("");
	$("#referencia_table").html("");
	
	 $.ajax({
      type: "POST",
      url: "php/garantecontroller.php",
      data: 'id_cliente_garante='+id_cliente+'&duda=show_on',
      success: function(resp){	console.log(resp); $("#garante_table").html(resp);  } });
	
	 $.ajax({
      type: "POST",
      url: "php/referenciacontroller.php",
      data: 'id_cliente_referencia='+id_cliente+'&duda=show_on',
      success: function(resp){	console.log(resp); $("#referencia_table").html(resp);  } });
	
	/*
    document.data_cliente.id_ref.value = id_ref;
    document.data_cliente.nombre_ref.value = nombre_ref;
    document.data_cliente.telefono_ref.value = telefono_ref;
    document.data_cliente.tipo_ref.value = tipo_ref;
    document.data_cliente.cedula_ref.value = cedula_ref;
    document.data_cliente.direccion_ref.value = direccion_ref;
    document.data_cliente.parentesco.value = parentesco;
	*/


    if (ruta_c == null || ruta_c.length <= 0) {
      var ruta_cedula = "Choose file";
    }else{
      var ruta_cedula = ruta_c.replace("../docs/"+cedula+"/", "");
      console.log(ruta_cedula);
    }

    if (ruta_i == null || ruta_i.length <= 0) {
      var ruta_img = "files/logo_user.jpg";
    }else
    {
      var ruta_img = ruta_i.replace("../", "");
      console.log(ruta_img);
    }
    $("#img_cliente img").prop("src", ruta_img);
    $("#choosen_file").html(ruta_cedula);


    $('#alertPass').html("");
    $('#modal_cliente').on('shown.bs.modal', function () {
        var modal = $(this);
        if (action === 'save_cliente'){                       
            $('#save_cliente').show();
            $('#update_cliente').hide();             
            modal.find('.modal-title').html('<i class="fas fa-users"></i> Agregando Cliente');        
        }else if (action === 'update_cliente'){
            $('#save_cliente').hide();                    
            $('#update_cliente').show();                   
            modal.find('.modal-title').html('<i class="fas fa-users"></i> Modificar Cliente');
        }
    });
}

function Delete(id)
{
  $.confirm({
   icon: "fas fa-exclamation-circle",
   title: 'Confirmar!',
   content: 'Desea eliminar este Cliente?',
   buttons: {
       confirmar: function () {
              var duda ="delete";
                $.ajax({
                  type: "POST",
                  url: "php/clientecontroller.php",
                  data: "id_cliente="+id+"&proceso="+duda,
                  success: function(resp){

                   $("#cliente_tabla").load(location.href+" #cliente_tabla>*","");
                   
                  $.notify({
                     icon: "add_alert",
                    message: "El Cliente se elimino con exito."
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
            $.alert('<div class="jconfirm-title-c"><span class="jconfirm-icon-c"><i class="fas fa-exclamation-circle"></i></span><span class="jconfirm-title">Cancelado!</span></div><div class="jconfirm-content-pane no-scroll" style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); height: auto; max-height: 277.719px;margin-bottom: -5px;"><div class="jconfirm-content" id="jconfirm-box955"><div>No se eliminará este cliente.</div></div></div>');  
        }
    }
});

}


$( document ).ready(function() {
	//$('#modal_cliente').modal({backdrop: 'static', keyboard: false})
  $("#save_mora").click(function(){ asignar_mora(); });
  $("#btn_assign").click(function(){ asignar(); });
  $("#save_cliente").click(function(){
	var cant_ref = $("#referencia_table").children('tr').children('td').length;
    var duda ='save_cliente';
    var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();
    var cedula = $("#cedula").val();
    var telefono = $("#telefono").val();
    var celular = $("#celular").val();
    //var correo = $("#correo").val();
    var direccion = $("#direccion").val();
    var sexo = $("#sexo").val();
    var estado_civil = $("#estado_civil").val();
    var tipo_vivienda = $("#tipo_vivienda").val();
    var ocupacion = $("#ocupacion").val();

    var titulo = $("#titulo").val();
    var ingreso = $("#ingreso").val();

    if (nombre.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Nombre vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (apellido.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Apellido vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (telefono.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Telefono vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (celular.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Celular vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (cedula.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Cedula vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }/*else if (correo.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Correo Electronico vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }*/else if (direccion.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Direccion vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (sexo.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Sexo vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (estado_civil.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Estado Civil vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (tipo_vivienda.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Tipo de Vivienda vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (ocupacion.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Ocupacion vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (titulo.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Mayor Titulo Obtenido vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (ingreso == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Ingresos vacios.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (cant_ref == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Debe crear al menos 1 referencias.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{

    var form = $('#data_cliente')[0];
    var formData = new FormData(form);

    var inputFileImage = document.getElementById('file_img_cliente');
    var file1 = inputFileImage.files[0];

    var inputFileImage2 = document.getElementById('cedula_cliente_img');
    var file2 = inputFileImage2.files[0];
    console.log(file1);
    console.log(file2);
    formData.append('proceso',duda);
    formData.append('archivo_img',file1);
    formData.append('archivo_cedula',file2);


    var img = $("#img_cliente img").attr("src");

    var crd = $("#choosen_file").html();

    formData.append('aux_img',img);
    formData.append('aux_cedula',crd);

    $.ajax({
      type: "POST",
      url: "php/clientecontroller.php",
      contentType:false,
      data: formData,
      cache: false,
      processData: false, 
      success: function(resp){
	   save_ref(resp);
	   save_garante(resp);
       console.log(resp);
       $("#cliente_tabla").load(location.href+" #cliente_tabla>*","");
       $('#modal_cliente').modal('hide');
       $('.empety').val('');
      $.notify({
         icon: "add_alert",
        message: "El Cliente se ha generado con exito."
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

  $("#update_cliente").click(function(){
    var duda ='update_cliente';

	var cant_ref = $("#referencia_table").children('tr').children('td').length;
	var id_clt = $("#id_cliente").val();
    var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();
    var cedula = $("#cedula").val();
    var telefono = $("#telefono").val();
    var celular = $("#celular").val();
    //var correo = $("#correo").val();
    var direccion = $("#direccion").val();
    var sexo = $("#sexo").val();
    var estado_civil = $("#estado_civil").val();
    var tipo_vivienda = $("#tipo_vivienda").val();
    var ocupacion = $("#ocupacion").val();
    var titulo = $("#titulo").val();
    var ingreso = $("#ingreso").val();

    if (nombre.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Nombre vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (apellido.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Apellido vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (telefono.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Telefono vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (celular.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Celular vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (cedula.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Cedula vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }/*else if (correo.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Correo Electronico vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }*/else if (direccion.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Direccion vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (sexo.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Sexo vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (estado_civil.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Estado Civil vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (tipo_vivienda.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Tipo de Vivienda vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (ocupacion.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Ocupacion vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (titulo.length == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Mayor Titulo Obtenido vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (ingreso == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta! </strong>Ingresos vacios.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	}else if (cant_ref == 0) {
      $('#alertcliente').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Debe crear al menos 1 referencias.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
    var form = $('#data_cliente')[0];
    var formData = new FormData(form);

    var inputFileImage = document.getElementById('file_img_cliente');
    var file1 = inputFileImage.files[0];

    var inputFileImage2 = document.getElementById('cedula_cliente_img');
    var file2 = inputFileImage2.files[0];
    console.log(file1);
    console.log(file2);
    formData.append('proceso',duda);
    formData.append('archivo_img',file1);
    formData.append('archivo_cedula',file2);
    
    var img = $("#img_cliente img").attr("src");

    var crd = $("#choosen_file").html();

    formData.append('aux_img',img);
    formData.append('aux_cedula',crd);
    
    $.ajax({
      type: "POST",
      url: "php/clientecontroller.php",
      contentType:false,
      data: formData,
      cache: false,
      processData: false, 
      success: function(resp){ 
        console.log(resp);
	   	save_garante(id_clt);
	   	save_ref(id_clt);
        $("#cliente_tabla").load(location.href+" #cliente_tabla>*","");
        $('#modal_cliente').modal('hide');
        $.notify({
         icon: "add_alert",
          message: "El Cliente se actualizo con exito."
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