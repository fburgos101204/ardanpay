function evaluar_()
{
  var tipo = $("#t_interes_valida").val();
  if (tipo == "Interes Fijo") { interes_fijo_(); }
    else if (tipo == "Disminuir Cuotas") { disminiur_cuotas_(); }
	else if (tipo == "Cuota Fija"){ cuotas_fija_(); }
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

function interes_fijo_()
{
  var id_solicitud = $("#id_solicitud_").val();
  var id_prestamo = $("#id_prestamo_valida").val();
  var interes = $("#interes_valida").val();
  var cuotas = $("#cuotas_valida").val();
  var monto = $("#monto_valida").val();
  var ciclo = $("#ciclo_pago_valida").val();
  monto = parseFloat(monto);
  var aux = monto/cuotas;
  var res = aux*(interes/10);
  var pagar = (res+aux);
  var result = 0;
  var fecha = new Date($("#fecha_valida").val());

  var no_cuota = 1;

  for (var i = 1; i <= cuotas; i++) {
    var date = fecha.getFullYear() + '-' + (fecha.getMonth() + 1) + '-' + (fecha.getDate()+1);
    guardar_prestamo(i,id_prestamo,date,monto,aux,res,pagar);
    monto -= aux;
    result += pagar;
    
    if(ciclo == "1"){  fecha.setDate(fecha.getDate() + 1); }
    if(ciclo == "7"){  fecha.setDate(fecha.getDate() + 7); }
    if(ciclo == "15"){  fecha.setDate(fecha.getDate() + 15); }
    if(ciclo == "30"){ fecha.setMonth(fecha.getMonth()+ 1); }
    if(ciclo == "365"){ fecha.setYear(fecha.getYear() + 1); }
    



  }
}

function disminiur_cuotas_()
{
  var interes = $("#interes_valida").val();
  var cuotas = $("#cuotas_valida").val();
  var monto = $("#monto_valida").val();
  var ciclo = $("#ciclo_pago_valida").val();
  var id_prestamo = $("#id_prestamo_valida").val();
  monto = parseFloat(monto);
  var aux = monto/cuotas;
  var res = aux*(interes/10);
  var pagar = (res+aux);
  var result = 0;
  var fecha = new Date($("#fecha_valida").val());
  var aux1 = aux;

  for (var i = 1; i <= cuotas; i++) {
    result += pagar;
    var date = fecha.getFullYear() + '-' + (fecha.getMonth() + 1) + '-' + (fecha.getDate()+1);
    guardar_prestamo(i,id_prestamo,date,monto,aux1,res,pagar);
    monto -= aux1;
    aux = monto/cuotas;
    res = aux*(interes/10);
    pagar = aux1+res;
    
    if(ciclo == "1"){  fecha.setDate(fecha.getDate() + 1); }
    if(ciclo == "7"){  fecha.setDate(fecha.getDate() + 7); }
    if(ciclo == "15"){  fecha.setDate(fecha.getDate() + 15); }
    if(ciclo == "30"){ fecha.setDate(fecha.getDate() + 30); }
    if(ciclo == "365"){ fecha.setDate(fecha.getDate() + 365); }

  }
}

function cuotas_fija_()
{
  var interes = $("#interes_valida").val();
  var cuotas = $("#cuotas_valida").val();
  var monto = $("#monto_valida").val();
  var ciclo = $("#ciclo_pago_valida").val();
  var id_prestamo = $("#id_prestamo_valida").val();
  var fecha = new Date($("#fecha_valida").val());
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

/*
function update_prestamo_()
{
  var id_solicitud = $("#id_solicitud_").val();
  var id_prestamo = $("#id_prestamo_").val();
  var tipo_interes = $("#t_interes_").val();
  var interes = $("#interes_").val();
  
  var id_prestamo = $("#id_prestamo_").val();
  var tipo_interes = $("#t_interes_").val();
  var interes = $("#interes_").val();

  var data = new FormData();
  data.append("proceso","update_prestamo");
  data.append("id_solicitud",id_solicitud);
  data.append("id_prestamo",id_prestamo);
  data.append("tipo_interes",tipo_interes);
  data.append("interes",interes);

  $.ajax({
      type: "POST",
      url: "php/historial_solicitud.php",
      contentType:false,
      data: data,
      cache: false,
      processData: false, 
      success: function(res){ 
       console.log(res);
     }
    });

}

function onload_(id_solicitud, id_prestamo,monto,cuotas,modalidad)
{
    document.data_crear_prestamo.id_solicitud_.value = id_solicitud;
    document.data_crear_prestamo.id_prestamo_.value = id_prestamo;
    document.data_crear_prestamo.monto_.value = monto;
    document.data_crear_prestamo.interes_.value = "0";
    document.data_crear_prestamo.cuotas_.value = cuotas;
    document.data_crear_prestamo.ciclo_.value = modalidad;
    document.data_crear_prestamo.t_interes_.value = "Interes Fijo";
}
*/