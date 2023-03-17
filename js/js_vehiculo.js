function open_vehiculo(id_vehiculo,marca,modelo,tiempo,color,tipo,matricula,foto_1,foto_2,foto_3,foto_4)
{
  	document.data_vehiculo.id_vehiculo.value = id_vehiculo;
	document.data_vehiculo.marca_vehiculo.value = marca;
	document.data_vehiculo.modelo_vehiculo.value = modelo;
	document.data_vehiculo.matricula_vehiculo.value = matricula;
	document.data_vehiculo.año_vehiculo.value = tiempo;
	document.data_vehiculo.color_vehiculo.value = color;
	document.data_vehiculo.tipo_vehiculo.value = tipo;
	
	if (foto_1 == null || foto_1.length <= 0) {
      var part_frontal = "Choose file";
    }else{
      var part_frontal = foto_1.replace("../docs/"+matricula+"/", "");
      console.log(foto_1);
    }
    $("#part_frontal img").prop("src", part_frontal);
	
	if (foto_2 == null || foto_2.length <= 0) {
      var part_trasera = "Choose file";
    }else{
      var part_trasera = foto_2.replace("../docs/"+matricula+"/", "");
      console.log(foto_2);
    }
    $("#part_trasera img").prop("src", part_trasera);
	
	if (foto_3 == null || foto_3.length <= 0) {
      var lat_derecho = "Choose file";
    }else{
      var lat_derecho = foto_3.replace("../docs/"+matricula+"/", "");
      console.log(foto_3);
    }
    $("#lat_derecho img").prop("src", lat_derecho);
	
	if (foto_4 == null || foto_4.length <= 0) {
      var lat_izquierda = "Choose file";
    }else{
      var lat_izquierda = foto_4.replace("../docs/"+matricula+"/", "");
      console.log(foto_4);
    }
    $("#lat_izquierda img").prop("src", lat_izquierda);
	
}

function crear_vehiculo()
{
	var form = $('#data_vehiculo')[0];
    var formData = new FormData(form);

    var inputFileImage = document.getElementById('file_part_frontal');
    var file1 = inputFileImage.files[0];
    formData.append('file_part_frontal',file1);
    console.log(file1);

    var inputFileImage2 = document.getElementById('file_lat_izquierda');
    var file2 = inputFileImage2.files[0];
    formData.append('file_lat_izquierda',file2);
    console.log(file2);
	
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
    var lat_izquierda = $("#lat_izquierda img").attr("src");
    var lat_derecho = $("#lat_derecho img").attr("src");
	
    formData.append('aux_part_frontal',part_frontal);
    formData.append('aux_part_trasera',part_trasera);
    formData.append('aux_lat_izquierda',lat_izquierda);
    formData.append('aux_lat_derecho',lat_derecho);
	
	
  $.ajax({
      type: "POST",
      url: "php/vehiculocontroller.php",
	  contentType:false,
      data: formData,
      cache: false,
      processData: false, 
      success: function(res){
		  console.log(res);
	  },complete:function(resp)
	  {
		  location.reload();
		  $("#modal_vehiculo").modal("hide");
	  }
  });
}

function drop_vehiculo(id_vehiculo)
{
	$.ajax({
      type: "POST",
      url: "php/vehiculocontroller.php",
      data: "proceso=delete&id_vehiculo="+id_vehiculo,
      success: function(res){
		  console.log(res);
	  },complete:function(resp)
	  {
		 location.reload();
	  }
  });
}


$(document).ready(function(){
	$("#update_vehiculo").click(function(){
		crear_vehiculo();
	});
});