function create_inmobiliario()
{
	var form = $('#data_crear_prestamo_inmobiliario')[0];
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
	
    formData.append('proceso','save');
    /*var img = $("#img_cliente img").attr("src");
    var crd = $("#choosen_file").html();
	
    formData.append('aux_img',img);
    formData.append('aux_cedula',crd);*/
	
	
  $.ajax({
      type: "POST",
      url: "php/inmobiliariacontroller.php",
	  contentType:false,
      data: formData,
      cache: false,
      processData: false, 
      success: function(res){
		document.data_crear_prestamo_inmobiliario.id_inmobiliario_prestamo.value = $("#id_cliente").val();
      },
      complete:function()
      {
		create_prestamo();
      }
    });
}

function create_prestamo()
{
  var tipo = $("#retirar_de").val();
  if (tipo == "Caja") {
    var codigo = 0;
    var id_metodo = $("#entidad_caja").val();
  }else{
    var codigo = $("#no_codigo").val();
    var id_metodo = $("#entidad_banco").val();
  }

  $.ajax({
      type: "POST",
      url: "php/detalleprestamo.php",
      data: $("#data_crear_prestamo_inmobiliario").serialize()+"&proceso=insertar"+"&id_metodo="+id_metodo+"&tipo="+tipo+"&cd_pr="+codigo+"&tipo_prestamo=Prestamo Inmobiliario",
      success: function(res){
        document.data_crear_prestamo_inmobiliario.id_id_prestamo.value = res;
      },
      complete:function()
      {
        evaluar_();
        $("#modal_crear_prestamo_inmobiliario").modal("hide");
       	$("#table_prt_inmobiliario").load(location.href+" #table_prt_inmobiliario>*","");
        //window.setTimeout(function(){window.location.reload()}, 1000);
      }
    });
}


function new_prestamo(creador)
{
  	document.data_crear_prestamo_inmobiliario.creador.value = creador;
	document.data_crear_prestamo_inmobiliario.retirar_de.value = "Caja";
    document.data_crear_prestamo_inmobiliario.tipo.value = "Apartamento";
    document.data_crear_prestamo_inmobiliario.color.value = "";
    document.data_crear_prestamo_inmobiliario.direccion.value = "";
    document.data_crear_prestamo_inmobiliario.habitacion.value = 0;
    document.data_crear_prestamo_inmobiliario.baño.value = 0;
    document.data_crear_prestamo_inmobiliario.cocina.value = 0;
    document.data_crear_prestamo_inmobiliario.sala.value = 0;
    document.data_crear_prestamo_inmobiliario.comedor.value = 0;
    document.data_crear_prestamo_inmobiliario.descripcion.value = "";
    document.data_crear_prestamo_inmobiliario.creador.value = creador;
    $("#retirar_de").trigger("change");
    $("#entidad_caja").trigger("change");
    $("#id_ciclo_pago").trigger("change");
}

/*function onload_img(id_vehiculo)
{
   document.imagen_form.id_vehiculo_foto.value = id_vehiculo;
   $(".custom_img").prop("src","img/front_car.png");
   $.ajax({
      type: "POST",
      url: "php/historial_archivos.php",
      data: "id_vehiculo="+id_vehiculo+"&proceso=extraer",
      success: function(resp){
		console.log(resp);
        resp = jQuery.parseJSON(resp);
        $.each(resp, function(index, value) {
		  $("#"+value.titulo+" img").prop("src",value.ruta);
		  console.log(value.titulo+" ruta:"+value.ruta);
      });
      }
    });
}*/

$(document).ready(function(){
	
	$("#registrar_prestamo_inmobiliario").click(function(){
	
		var tipo = $("#tipo").val();
		var color = $("#color").val();
		var direccion = $("#direccion").val();
		var habitacion = $("#habitacion").val();
		var baño = $("#baño").val();
		var cocina = $("#cocina").val();
		var sala = $("#sala").val();
		var comedor = $("#comedor").val();
		var descripcion = $("#descripcion").val();
		
		var new_capital = parseInt($("#new_capital").val());
		var cuotas = $("#id_cuotas").val();
		var interes_porcentaje = $("#interes_porcentaje").val();
		var disponible = parseInt($("#disponible_id").val());
		
    	if (tipo.length == 0) {
      		$('#alertprestamoinmobiliario').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong> Marca vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    	}else if (color.length == 0) {
      		$('#alertprestamoinmobiliario').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong> Modelo vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    	}else if (direccion.length == 0) {
      		$('#alertprestamoinmobiliario').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong> Año vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    	}else if (habitacion.length == 0) {
      		$('#alertprestamoinmobiliario').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong> Color vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    	}else if (baño.length == 0) {
      		$('#alertprestamoinmobiliario').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert! </strong> Tipo Electronico vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    	}else if (cocina.length == 0) {
      		$('#alertprestamoinmobiliario').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert!</strong> Matricula vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
   		}else if (sala.length == 0) {
      		$('#alertprestamoinmobiliario').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert!</strong> Chasis vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    	}else if (descripcion.length == 0) {
      		$('#alertprestamoinmobiliario').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert!</strong> Motor vacia.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    	}else if (new_capital.length == 0 || new_capital == 0) {
      		$('#alertprestamoinmobiliario').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Debe Asignar un monto.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    	}else if (cuotas.length == 0 || cuotas == 0) {
      		$('#alertprestamoinmobiliario').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Debe asignar una cantidad de cuotas.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    	}else if (interes_porcentaje.length == 0 || interes_porcentaje == 0) {
      		$('#alertprestamoinmobiliario').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Debe asignar un minimo de interes vacio.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    	}else if (disponible < new_capital || disponible == 0) {
      		$('#alertprestamoinmobiliario').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>Fondos Insuficientes para el prestamo.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    	}else{
			create_inmobiliario();
		}
	});
	$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
	
	$(".img_file_inpt").on("change", function(e) {
    var fileName = e.target.files[0];
	let reader = new FileReader();
	var id_lot = this.id;
	id_lot = id_lot.replace("file_","");
  	reader.readAsDataURL(fileName);
	reader.onload = function(){
    var image = document.createElement('img');

    $("#"+id_lot+" img").prop("src", reader.result);
	//subir(id_lot);
	};
	});
	
	$(".hoverclass tr").click(function(){
   		 window.location = $(this).data("href");
 	});

 	$("#estado_valida").change(function(){
      if ($(this).val() != "Aceptado") {
        $("#retirar_de_hidden").hide();
        $("#entidad_hidden").hide();
        $("#disponible_hidden").hide();
        $("#no_cheque_hidden").hide();
      }else{
        $("#retirar_de_hidden").show();
        $("#entidad_hidden").show();
        $("#disponible_hidden").show();
      }
  	});

  	$("#retirar_de").change(function(){
      if ($(this).val() == "Caja") {

        $("#entidad_caja").show();
        $("#entidad_banco").hide();
        $("#no_cheque_hidden").hide();
        $("#entidad_caja").trigger("change");

      }else if($(this).val() == "Banco") {

        $("#no_cheque_hidden").show();
        $("#entidad_caja").hide();
        $("#entidad_banco").show();
        $("#entidad_banco").trigger("change");
      }
      $("#no_cheque_hidden").val("");
  	});

  	$("#entidad_caja").change(function(){
      var monto = $(this).children(":selected").attr("class");
      document.data_crear_prestamo_inmobiliario.disponible_id.value = monto;
  	});

  	$("#entidad_banco").change(function(){
      var monto = $(this).children(":selected").attr("class");
      document.data_crear_prestamo_inmobiliario.disponible_id.value = monto;
  	});
	

	$("#id_ciclo_pago").change(function(){
      var aumt = parseInt($(this).children(":selected").val());
	  var fecha = new Date(); 
	  fecha.setDate(fecha.getDate() + aumt);
	  if(fecha.getDate() <= 9){ var dia = "0"+fecha.getDate(); }else{ var dia = fecha.getDate();}
	  if((fecha.getMonth()+ 1) <= 9){ var mes = "0"+(fecha.getMonth()+ 1); }else{ var mes = (fecha.getMonth()+ 1); }
	  var date = fecha.getFullYear() + '-' + mes + '-' + dia;
		$("#fecha_reajuste").val(date);
  });
});