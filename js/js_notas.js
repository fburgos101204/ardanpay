function onload_nota(id_prestamo) {
$.ajax({
      type: "POST",
      url: "php/notascontroller.php",
      data: 'id_prestamo='+id_prestamo+'&duda=show_on',
      success: function(resp){	console.log(resp); $("#nota_table").html(resp);  } });
}

function add_nota(id_prestamo)
{
	var nota = $("#anota").val();
	$.ajax({
         	type: "POST",
         	url: "php/notascontroller.php",
      		data: 'id_prestamo='+id_prestamo+'&nota='+nota+'&duda=save',
         	success: function(resp){ 
			console.log(resp);
		    onload_nota(id_prestamo);
			$("#modal_nota").modal("hide");	
				return false; 

			}
	});
}



$(document).ready(function(){
$(document).on('click', 'button.btn_delete_garante', function () {
     $(this).closest('tr').remove();
     return false;
});
$(document).on('click', 'button.btn_drop_garante', function () {
     $(this).closest('tr').remove();
     return false;
}); 
});