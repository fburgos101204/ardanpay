function onload_calculator(monto,interes,cuotas,ciclo,t_interes)
{
    $("#tbody_make").html('');
    document.data_calculator.monto_calculador.value = monto;
    document.data_calculator.interes_calculador.value = interes;
    document.data_calculator.cuotas_calculador.value = cuotas;
    document.data_calculator.ciclo_calculador.value = ciclo;
    document.data_calculator.t_interes_calculador.value = t_interes;
    $("#t_interes_calculador").trigger("change");
}

function onload_calculator_prestamo()
{
	var monto = $("#new_capital").val();
	var interes = $("#interes_porcentaje").val();
	var cuotas = $("#id_cuotas").val();
	var ciclo = $("#id_ciclo_pago").val();
	var t_interes = $("#t_interes_valida").val();
    $("#tbody_make").html('');
    document.data_calculator.monto_calculador.value = monto;
    document.data_calculator.interes_calculador.value = interes;
    document.data_calculator.cuotas_calculador.value = cuotas;
    document.data_calculator.ciclo_calculador.value = ciclo;
    document.data_calculator.t_interes_calculador.value = t_interes;
    $("#t_interes_calculador").trigger("change");
	$("#btn_calcular").trigger("click");
}

function evaluar()
{
  var tipo = $("#t_interes_calculador").val();
  if (tipo == "Interes Fijo") {  interes_fijo(); }
  else if (tipo == "Disminuir Cuotas") { disminiur_cuotas(); }
  else if (tipo == "Cuota Fija"){ cuotas_fija(); }
}
function number_format (number, decimals, dec_point, thousands_sep) {
        number = number.toFixed(decimals);
        var nstr = number.toString();
        nstr += '';
        x = nstr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? dec_point + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');
        return x1 + x2;
}
function interes_fijo()
{
  
  var interes = $("#interes_calculador").val();
  var cuotas = $("#cuotas_calculador").val();
  var monto = $("#monto_calculador").val();
  var ciclo = $("#ciclo_calculador").val();
  var html = "";
  monto = parseFloat(monto);
  var aux = monto/cuotas;
  var res = monto*(interes/100);
  var pagar = (res+aux);
  var result = 0;
  var fecha = new Date($("#fecha_calculador").val());


  for (var i = 0; i < cuotas; i++) {
   
    var date = fecha.getDate()+1 + '/' + (fecha.getMonth() + 1) + '/' + fecha.getFullYear();

    html += "<tr><td nowrap>"+date+"</td><td nowrap>RD$ "+number_format(pagar,2,'.',',')+"</td><td nowrap>RD$ "+number_format(monto,2,'.',',')+"</td><td nowrap>RD$ "+number_format(aux,2,'.',',')+"</td><td nowrap>RD$ "+number_format(res,2,'.',',')+"</td></tr>";
    monto -= aux;
    result += pagar;

    if(ciclo == "1"){  fecha.setDate(fecha.getDate() + 1); }
    if(ciclo == "7"){  fecha.setDate(fecha.getDate() + 7); }
    if(ciclo == "15"){  fecha.setDate(fecha.getDate() + 15); }
    if(ciclo == "30"){ fecha.setDate(fecha.getDate() + 30); }
    if(ciclo == "365"){ fecha.setDate(fecha.getDate() + 365); }
    



  }
  html += "<tr><td colspan='5' align='left'>Intéres + Capital: <strong>RD$"+number_format(result,2,'.',',')+"</strong></td></tr>"
  $("#tbody_make").html(html);
}

function disminiur_cuotas()
{
  var interes = $("#interes_calculador").val();
  var cuotas = $("#cuotas_calculador").val();
  var monto = $("#monto_calculador").val();
  var ciclo = $("#ciclo_calculador").val();
  monto = parseFloat(monto);
  var html = "";
  var aux = monto/cuotas;
  var res = aux*(interes/cuotas);
  var pagar = (res+aux);
  var result = 0;
  var fecha = new Date($("#fecha_calculador").val());

  var aux1 = aux;
  for (var i = 0; i < cuotas; i++) {
    result += pagar;
    var  date = fecha.getDate()+1 + '/' + (fecha.getMonth() + 1) + '/' + fecha.getFullYear();
    html += "<tr><td nowrap>"+date+"</td><td nowrap>RD$ "+number_format(pagar,2,'.',',')+"</td><td nowrap>RD$ "+number_format(monto,2,'.',',')+"</td><td nowrap>RD$ "+number_format(aux1,2,'.',',')+"</td><td nowrap>RD$ "+number_format(res,2,'.',',')+"</td></tr>";
    monto -= aux1;
    aux = monto/cuotas;
    res = aux*(interes/cuotas);
    pagar = aux1+res;
    if(ciclo == "1"){  fecha.setDate(fecha.getDate() + 1); }
    if(ciclo == "7"){  fecha.setDate(fecha.getDate() + 7); }
    if(ciclo == "15"){  fecha.setDate(fecha.getDate() + 15); }
    if(ciclo == "30"){ fecha.setDate(fecha.getDate() + 30); }
    if(ciclo == "365"){ fecha.setDate(fecha.getDate() + 365); }

  }
  html += "<tr><td colspan='5' align='left'>Intéres + Capital: <strong>RD$ "+number_format(result,2,'.', ',')+"</strong></td></tr>"
  $("#tbody_make").html(html);
}

function cuotas_fija()
{
  var interes = $("#interes_calculador").val();
  var cuotas = $("#cuotas_calculador").val();
  var monto = $("#monto_calculador").val();
  monto = parseFloat(monto);
  var ciclo = $("#ciclo_calculador").val();
  var fecha = new Date($("#fecha_calculador").val());
  fecha.setDate(fecha.getDate() + 1);

  var intere_p = (interes / 100);

  var intere = intere_p+1;

  var valor_pendiente = Math.pow(intere, cuotas); 

  var monto_sp = intere_p*valor_pendiente;
  
  var monto_inf = valor_pendiente-1;
  var html = '';
  var res_sp_inf = (monto_sp/monto_inf);
  var intere_aux = monto * intere_p;
  var res_monto_total = monto*res_sp_inf;
  var result = 0;
  var abono_capital = res_monto_total-intere_aux;
  var monto_intere = res_monto_total-abono_capital;

  for (var i = 1; i <= cuotas; i++) {
    var  date = fecha.getFullYear() + '-' + (fecha.getMonth() + 1) + '-' + (fecha.getDate());
	result += res_monto_total;
	html += "<tr><td nowrap>"+date+"</td><td nowrap>RD$ "+number_format(res_monto_total,2,'.',',')+"</td><td nowrap>RD$ "+number_format(monto,2,'.',',')+"</td><td nowrap>RD$ "+number_format(abono_capital,2,'.',',')+"</td><td nowrap>RD$ "+number_format(monto_intere,2,'.',',')+"</td></tr>";
	  
    monto -= abono_capital; 
    monto_intere = monto*intere_p;
    abono_capital = res_monto_total-monto_intere;
	  
    if(ciclo == "1"){  fecha.setDate(fecha.getDate() + 1); }
    if(ciclo == "7"){  fecha.setDate(fecha.getDate() + 7); }
    if(ciclo == "15"){  fecha.setDate(fecha.getDate() + 15); }
    if(ciclo == "30"){ fecha.setDate(fecha.getDate() + 30); }
    if(ciclo == "365"){ fecha.setDate(fecha.getDate() + 365); }
  }
  html += "<tr><td colspan='5' align='left'>Intéres + Capital: <strong>RD$ "+number_format(result,2,'.', ',')+"</strong></td></tr>"
  $("#tbody_make").html(html);
}


$(document).ready(function(){
	
	
  $("#btn_calcular").click(function(){
	  
	var tipo = $("#t_interes_calculador").val();
	var pagar = $("#monto_cuota_txt").val();
	if(tipo == "Interes Fijo" && pagar.length != 0){
		var cuotas = $("#cuotas_calculador").val();
  		var monto = $("#monto_calculador").val();
		var aux = monto / cuotas;
		var cantidad_interes = (pagar-aux);
		var cantidad_nula = (cantidad_interes/monto)
  		var interes = (cantidad_nula*100);
		$("#interes_calculador").val(interes);
	}
    evaluar();
  });
	
  $("#t_interes_calculador").change(function(){
  	 if ($(this).val() == "Interes Fijo") {  $("#hidden_tipo_calculadora").show(); }
	 else{ $("#hidden_tipo_calculadora").hide(); }
  });
	
  $("#t_interes_valida").change(function(){
  	 if ($(this).val() == "Interes Fijo") {  
		 $("#hidden_monto_cuota_prestamo").show(); }
	 else{ 
		 $("#hidden_monto_cuota_prestamo").hide(); }
  });
	
  $("#prestamo_monto_cuota_txt").keyup(function(){
	var tipo = $("#t_interes_valida").val();
	var pagar = $(this).val();
	if(tipo == "Interes Fijo" && pagar.length != 0){
		var cuotas = $("#id_cuotas").val();
  		var monto = $("#new_capital").val();
		var aux = monto / cuotas;
		var cantidad_interes = (pagar-aux);
		var cantidad_nula = (cantidad_interes/monto)
  		var interes = (cantidad_nula*100);
		$("#interes_porcentaje").val(interes);
	}});
});