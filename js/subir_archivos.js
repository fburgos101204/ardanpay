
/* function subir(name)
{
  var file_name = "file_"+name;
  var id = $("#id_vehiculo_foto").val();
  var inputFileImage = document.getElementById(file_name);
  var file = inputFileImage.files[0];
  var data = new FormData();

  data.append('id_vehiculo',id);
  data.append('archivo',file);
  data.append('proceso',name);
  data.append('titulo',name);

  $.ajax({
      type: "POST",
      url: "php/subir_vehiculo_foto.php",
      contentType:false,
      data: data,
      cache: false,
      processData: false, 
      beforeSend: function() {
      },
      success: function(resp){ 
		  console.log(resp);
        if (resp.length == 0) {
          $("#btn_delete_"+name).show();
          $("#img_"+name).hide();
          $("#check_"+name).show();
          $("#no_check_"+name).hide();
        }else{
          $("#no_check_"+name).show();
          $("#check_"+name).hide();
        }
       }
    });
}*/

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

/*function borrar_bank_state(name,aux)
{
  var ruta = $("."+name).html();
  var titulo = $('#'+aux).html();
  var id = $("#id_cliente_archivo").val();
  $.ajax({
    type: "POST",
    url: "php/historial_adjunto.php",
    data: "id_cliente="+id+"&ruta="+ruta+"&titulo="+titulo+"&proceso=delete",
    success: function(resp){ 
      $("#btn_delete_"+name).hide();
      $("."+name).html("Choose file");
      $("#check_"+name).hide();
    }
  });
}*/

$(document).ready(function(){

$(".img_file_inpt").on("change", function(e) {
    var fileName = e.target.files[0];
	let reader = new FileReader();
	var id_lot = this.id;
	id_lot = id_lot.replace("file_","");
  	reader.readAsDataURL(fileName);
	reader.onload = function(){
    var image = document.createElement('img');

    $("#"+id_lot+" img").prop("src", reader.result);
	};
});

$(".custom-file-input").on("change", function(e) {
    var fileName = e.target.files[0].name;
  
    $(".custom-file-label").html(fileName);
 
});
	
$('.custom_img').click(function(){
  var images = $(this).attr("src");
  $("#full_screen").prop("src",images);      
});
	
});

