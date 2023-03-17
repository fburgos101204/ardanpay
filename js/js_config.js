function subir()
{
  var inputFileImage = document.getElementById('file_img_empresa');
  var logo = inputFileImage.files[0];
  var img = $("#img_empresa img").attr("src");
  var form = $('#form_config')[0];
  var negocio = $('#negocio').val();
  var mora_config = $('#mora_config').val();
  var tipo_mora = $('#tipo_mora').val();
  var data = new FormData(form);
  var barcolor = $("input[name='barcolor']:checked").val();
  var fontcolor = $("input[name='fontcolor']:checked").val();
  data.append('proceso',"nada");
  data.append('barcolor',barcolor);
  data.append('fontcolor',fontcolor);
  data.append('archivo',logo);
  data.append('mora_config',mora_config);
  data.append('tipo_mora',tipo_mora);
  data.append('aux_img',img);
  data.append('id_negocio',negocio);

  $.ajax({
      type: "POST",
      url: "php/configcontroller.php",
      contentType:false,
      data: data,
      cache: false,
      processData: false, 
      beforeSend: function() {

      },
      success: function(resp){ 
        console.log(resp);
        location.reload();
		    $.notify({
          icon: "add_alert",
          message: "Configuracion Actualizada."
        },{
           type: 'success',
           timer: 1000,
           placement: {
              from: 'top',
              align: 'center'
        }
        });
       
       }
    });
}

$(document).ready(function(){color_conf_font
  var color = $("#color_conf").val();
  $(".container #"+color).prop('checked', true);
  var co = $("#color_conf_font").val();
  $(".container2 #"+co).prop('checked', true);
});