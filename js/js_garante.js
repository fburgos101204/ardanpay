function add_garante()
{
	var nombre = $("#nombre_garante").val();
	var cedula = $("#cedula_garante").val();
	var direccion = $("#direccion_garante").val();
	var parentesco = $("#garante_parentesco").val();
	var html = "<tr class='nuevo_garante'><td nowrap>"+nombre+"</td><td nowrap>"+cedula+"</td><td nowrap>"+direccion+"</td><td nowrap>"+parentesco+"</td><td nowrap><button class='btn btn-danger btn_delete_garante' type='button'><i class='material-icons'>delete_forever</i></button></td></tr>";
	$("#garante_table").append(html);
	$("#modal_garante").modal("hide");
    return false;
}
function delete_garante(id_garante)
{
	$.ajax({
         	type: "POST",
         	url: "php/garantecontroller.php",
      		data: 'id_garante='+id_garante+'&id_cliente_garante=0&duda=delete',
         	success: function(resp){ console.log(resp); return false; } });
}

function save_garante(id_cliente)
{
	$('#garante_table > tr.nuevo_garante').each(function() {
    	var nombre = $(this).find("td").eq(0).text();
    	var cedula = $(this).find("td").eq(1).text();
    	var direccion = $(this).find("td").eq(2).text();
    	var parentesco = $(this).find("td").eq(3).text();
    	var formData = new FormData();
		
    	formData.append('duda','save');
    	formData.append('id_cliente_garante',id_cliente);
    	formData.append('nombre_garante',nombre);
    	formData.append('cedula_garante',cedula);
    	formData.append('direccion_garante',direccion);
    	formData.append('garante_parentesco',parentesco);
		
		$.ajax({
         	type: "POST",
         	url: "php/garantecontroller.php",
      		contentType:false,
      		data: formData,
      		cache: false,
      		processData: false,
         	success: function(resp){ console.log(resp); return false; } });
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