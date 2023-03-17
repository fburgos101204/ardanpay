function printData()
{
   var divToPrint=document.getElementById("table_report_cliente");
   newWin= window.open("report_client.php");
   newWin.document.write(divToPrint.outerHTML);
    var css =`#table_report_cliente {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 98%;
}

#table_report_cliente td, #table_report_cliente th {
  border: 1px solid #ddd;
  padding: 7px;
}

#table_report_cliente tr:nth-child(even){background-color: #f2f2f2;}

#table_report_cliente tr:hover {background-color: #ddd;}

#table_report_cliente th {
  padding-top: 11px;
  padding-bottom: 11px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}`;
   var div = $("<div />", {
    html: '&shy;<style>' + css + '</style>'
  }).appendTo( newWin.document.body);
   newWin.print();

   newWin.close();
}


function buscar_reporte(negocio)
{
	var tipo = "prestamo";
	var desde = $("#desde_reporte").val();
	var hasta = $("#hasta_reporte").val();
	var estado = $("#estado_reporte").val();
	$.ajax({
      	type: "POST",
      	url: "php/reportcontroller.php",
		data: "negocio="+negocio+"&tipo="+tipo+"&desde="+desde+"&hasta="+hasta+"&estado="+estado,
      	success: function(resp){
			console.log(resp);
			$("#table_report").html(resp);
		}
	});
}

function buscar_reporte_estado_negocio()
{
	var estado = $("#estado_reporte").val();
	$.ajax({
      	type: "POST",
      	url: "php/reportcontroller.php",
		data: "estado="+estado+"&tipo=estado_negocio",
      	success: function(resp){
			console.log(resp);
			$("#table_report_estado_negocio").html(resp);
		}
	});
}

function buscar_cliente(negocio)
{
	var tipo = "cliente";
	$.ajax({
      	type: "POST",
      	url: "php/reportcontroller.php",
		data: "negocio="+negocio+"&tipo="+tipo,
      	success: function(resp){
			console.log(resp);
			$("#table_report_cliente").html(resp);
		}
	});
}

function buscar_reporte_pagos_servicio()
{
	var tipo = "pago_servicio";
	var desde = $("#desde_reporte").val();
	var hasta = $("#hasta_reporte").val();
	var negocio = $("#negocio").val();
	var tipo_p = $("#tipo_p").val();
	
	$.ajax({
      	type: "POST",
      	url: "php/reportcontroller.php",
		data: "desde="+desde+"&hasta="+hasta+"&tipo=pago_servicio&negocio="+negocio+"&tipo_p="+tipo_p+"&tipo="+tipo,
      	success: function(resp){
			console.log(resp);
			$("#table_report_pago_servicio").html(resp);
		}
	});
}