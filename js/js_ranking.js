function onload()
{
	var ranking_plus = $("#ranking_plus").val();
	var ranking_less = $("#ranking_less").val();
	var res = parseInt(ranking_plus) - parseInt(ranking_less);
	 if(res >= 5)
	{
		$("#star5").prop("checked",true);
	}
	else if(res <= 0)
	{
		$("#star1").prop("checked",true);
	}
	else if(res => 1 && res < 5)
	{
		$("#star"+res).prop("checked",true);
	}
	 
}


function on_load_lectura(id_cliente)
{
	$.ajax({
		type: "POST",
		url: "php/rankingcontroller.php",
		data: "id_cliente="+id_cliente,
		success: function(resp){ console.log(resp); $("#t_historial_lectura").html(resp); }
	});
}

$(document).ready(function(){
 onload();
});