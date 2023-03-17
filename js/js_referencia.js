function add_ref()
{
	var nombre = $("#nombre_referencia").val();
	var telefono = $("#telefono_referencia").val();
	var tipo_ref = $("#tipo_referencia").val();
	var parentesco = $("#parentesco_referencia").val();
	var html = "<tr  class='nueva_referencia'><td nowrap>"+nombre+"</td><td nowrap>"+telefono+"</td><td nowrap>"+tipo_ref+"</td><td nowrap>"+parentesco+"</td><td nowrap><button class='btn btn-danger btn_delete_ref' type='button'><i class='material-icons'>delete_forever</i></button></td></tr>";
	$("#referencia_table").append(html);
	$("#modal_referencia").modal("hide");
  return false;

}


function delete_referencia(id_referencia)
{
	$.ajax({
         	type: "POST",
         	url: "php/referenciacontroller.php",
      		data: 'id_referencia='+id_referencia+'&id_cliente_referencia=0&duda=delete',
         	success: function(resp){ console.log(resp); return false; } });
}

function save_ref(id_cliente)
{
	$('#referencia_table > tr.nueva_referencia').each(function() {
    	var nombre = $(this).find("td").eq(0).text();
    	var telefono = $(this).find("td").eq(1).text();
    	var tipo = $(this).find("td").eq(2).text();
    	var parentesco = $(this).find("td").eq(3).text();
    	var formData = new FormData();
		
    	formData.append('duda','save');
    	formData.append('id_cliente_referencia',id_cliente);
    	formData.append('nombre_referencia',nombre);
    	formData.append('telefono_referencia',telefono);
    	formData.append('tipo_referencia',tipo);
    	formData.append('parentesco_referencia',parentesco);
		
		$.ajax({
         	type: "POST",
         	url: "php/referenciacontroller.php",
      		contentType:false,
      		data: formData,
      		cache: false,
      		processData: false,
         	success: function(resp){ console.log(resp);return false;  } });
	});
}


$(document).ready(function(){
$(document).on('click', 'button.btn_delete_ref', function () {
     $(this).closest('tr').remove();
     return false;
});
});