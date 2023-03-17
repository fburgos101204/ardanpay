var ispaused = false;

function evaluar_()
{
  var fecha = new Date($("#fecha_reajuste").val());
  var ciclo = $("#id_ciclo_pago").val();
  var id_prestamo = $("#id_id_prestamo").val();
  var interes = $("#interes_porcentaje").val();
  var cuotas = $("#id_cuotas").val();
  var monto = $("#new_capital").val();
  var tipo = $("#t_interes_valida").val();
	
  if (tipo == "Interes Fijo") { interes_fijo_(id_prestamo,interes,cuotas,monto,ciclo,fecha); }
    else if (tipo == "Disminuir Cuotas") { disminiur_cuotas_(id_prestamo,interes,cuotas,monto,ciclo,fecha); }
    else if (tipo == "Cuota Fija") { cuotas_fija_(id_prestamo,interes,cuotas,monto,ciclo,fecha); }
    else{ console.log(tipo+" fue lo que llego."); }
}


function aux_guardar_editar()
{
  var fecha = new Date($("#edit_fecha").val());
  var ciclo = $("#edit_ciclo_pago").val();
  var id_prestamo = $("#id_id_prestamo").val();
  var interes = $("#edit_interes_porcentaje").val();
  var cuotas = $("#edit_cuotas").val();
  var cant_reajust =  $("#cant_reajust").val();
  if(cant_reajust >= 1){
	var monto = $("#edit_capital_pendiente").val(); 
  }
  else{
	var monto = $("#edit_monto_inicial").val(); 
  }
  var tipo = $("#edit_t_interes").val();
	
  if (tipo == "Interes Fijo") { interes_fijo_(id_prestamo,interes,cuotas,monto,ciclo,fecha); }
    else if (tipo == "Disminuir Cuotas") { disminiur_cuotas_(id_prestamo,interes,cuotas,monto,ciclo,fecha); }
    else if (tipo == "Cuota Fija") { cuotas_fija_(id_prestamo,interes,cuotas,monto,ciclo,fecha); }
}




function guardar_prestamo(no_cuota,id_prestamo,fecha,balance,abono_capital,interes,monto_pagar)
{
  var data = new FormData();

  data.append("proceso",id_prestamo);
  data.append("no_cuota",no_cuota);
  data.append("id_prestamo",id_prestamo);
  data.append("fecha",fecha);
  data.append("balance",balance);
  data.append("abono_capital",abono_capital);
  data.append("interes",interes);
  data.append("monto_pagar",monto_pagar);

  $.ajax({
      type: "POST",
      url: "php/prestamocontroller.php",
      contentType:false,
      data: data,
      cache: false,
      processData: false, 
      success: function(res){ 
       console.log(res);
     }
    });

}

function interes_fijo_(id_prestamo,interes,cuotas,monto,ciclo,fecha)
{
  if ($("#ctn_reajustes").val() == 1) { monto = $("#capital_inicial_reajustes").val(); }
  fecha.setDate(fecha.getDate() + 1);
  var aux = monto/cuotas;
  var res = monto*(interes/100);
  var pagar = (res+aux);
  var result = 0;


  for (var i = 1; i <= cuotas; i++) {
    var date = fecha.getFullYear() + '-' + (fecha.getMonth() + 1) + '-' + (fecha.getDate());
    guardar_prestamo(i,id_prestamo,date,monto,aux,res,pagar);
    monto -= aux;
    result += pagar;
    
    if(ciclo == "1"){  fecha.setDate(fecha.getDate() + 1); }
    if(ciclo == "7"){  fecha.setDate(fecha.getDate() + 7); }
    if(ciclo == "15"){  fecha.setDate(fecha.getDate() + 15); }
    if(ciclo == "30"){ fecha.setDate(fecha.getDate() + 30); }
    if(ciclo == "365"){ fecha.setDate(fecha.getDate() + 365); }
  }
  if (monto == 0) {
    ispaused = true;
  }
}

function disminiur_cuotas_(id_prestamo,interes,cuotas,monto,ciclo,fecha)
{
  if ($("#ctn_reajustes").val() == 1) { monto= $("#capital_inicial_reajustes").val(); }
  fecha.setDate(fecha.getDate() + 1);
  monto = parseFloat(monto);
  var aux = monto/cuotas;
  var res = aux*(interes/cuotas);
  var pagar = (res+aux);
  var result = 0;
  var aux1 = aux;

  for (var i = 1; i <= cuotas; i++) {
    result += pagar;
    var date = fecha.getFullYear() + '-' + (fecha.getMonth() + 1) + '-' + (fecha.getDate());
    guardar_prestamo(i,id_prestamo,date,monto,aux1,res,pagar);
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
  if (monto == 0) {
    ispaused = true;
  }
}

function cuotas_fija_(id_prestamo,interes,cuotas,monto,ciclo,fecha)
{
  if ($("#ctn_reajustes").val() == 1) { monto= $("#capital_inicial_reajustes").val(); }
  monto = parseFloat(monto);
  fecha.setDate(fecha.getDate() + 1);

  var intere_p = (interes / 100);

  var intere = intere_p+1;

  var valor_pendiente = Math.pow(intere, cuotas); 

  var monto_sp = intere_p*valor_pendiente;
  
  var monto_inf = valor_pendiente-1;

  var res_sp_inf = (monto_sp/monto_inf);
  var intere_aux = monto * intere_p;
  var res_monto_total = monto*res_sp_inf;

  var abono_capital = res_monto_total-intere_aux;
  var monto_intere = res_monto_total-abono_capital;

  for (var i = 1; i <= cuotas; i++) {
    var date = fecha.getFullYear() + '-' + (fecha.getMonth() + 1) + '-' + (fecha.getDate());
    guardar_prestamo(i,id_prestamo,date,monto,abono_capital,monto_intere,res_monto_total);
    monto -= abono_capital; 
    monto_intere = monto*intere_p;
    abono_capital = res_monto_total-monto_intere;
    if(ciclo == "1"){  fecha.setDate(fecha.getDate() + 1); }
    if(ciclo == "7"){  fecha.setDate(fecha.getDate() + 7); }
    if(ciclo == "15"){  fecha.setDate(fecha.getDate() + 15); }
    if(ciclo == "30"){ fecha.setDate(fecha.getDate() + 30); }
    if(ciclo == "365"){ fecha.setDate(fecha.getDate() + 365); }
  }
  if (monto == 0) {
    ispaused = true;
  }
}