function onload_validar(modulo)
{
	document.frm_seguridad.seguridad_user.value = "";
	document.frm_seguridad.seguridad_pass.value = "";
	document.frm_seguridad.location.value = modulo;
	$("#validar_modulo_box").show();
	$("#validar_btn_box").hide();
	$("#validar_txt_box").hide();
}

function onload_validar_txt(txt)
{
	document.frm_seguridad.seguridad_user.value = "";
	document.frm_seguridad.seguridad_pass.value = "";
	txt = "validar_txt('"+txt+"')";
	$("#validar_modulo_box").hide();
	$("#validar_txt_box").show();
	$("#validar_btn_box").hide();
	$('#validar_txt_box').attr('onclick', txt);
}


function onload_validar_btn(btn)
{
	document.frm_seguridad.location.value = btn;
	document.frm_seguridad.seguridad_user.value = "";
	document.frm_seguridad.seguridad_pass.value = "";
	$("#validar_modulo_box").hide();
	$("#validar_txt_box").hide();
	$("#validar_btn_box").hide();
	$("#validar_btn_box").show();
}



function validar()
{
	var modulo = $("#location").val();
	$.ajax({
      type: "POST",
      url: "php/seguritycontroller.php",
      data: $("#frm_seguridad").serialize(),
      success: function(res){ 
       if(res){	 $("#frm_seguridad").attr("action",modulo+".php");  $("#frm_seguridad").submit(); }
	   else{  
	   	$('#alertseguridad').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert!</strong> Credenciales no validas.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	   }
     }
    });
}


function validar_txt(txt)
{
	$.ajax({
      type: "POST",
      url: "php/seguritycontroller.php",
      data: $("#frm_seguridad").serialize(),
      success: function(res){ 
       if(res){	
		   $("#"+txt).removeAttr("readonly");
		   $("#"+txt).removeAttr("data-toggle");
		   $("#"+txt).removeAttr("data-target");
		   $("#"+txt).removeAttr("onclick");
		   $("#modal_seguridad").modal("hide");
	   }
	   else{  
	   	$('#alertseguridad').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert!</strong> Credenciales no validas.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	   }
     }
    });
}

function validar_btn()
{
	var modulo = $("#location").val();
	$.ajax({
      type: "POST",
      url: "php/seguritycontroller.php",
      data: $("#frm_seguridad").serialize(),
      success: function(res){ 
       if(res){	
		   $("#"+modulo).click();
		   $("#modal_seguridad").modal("hide");
	   }
	   else{  
	   	$('#alertseguridad').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alert!</strong> Credenciales no validas.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
	   }
     }
    });
}
