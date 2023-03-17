function save_cuota()
{
  var data = new FormData();
  var id_cliente_ranking = $("#id_cliente_ranking").val();
  var id_solicitud = $("#monto_picket").val();
  var total_pagado = $("#total_pagar").val();
  var id_prestamo = $("#id_id_prestamo").val();
  var fecha = $("#fecha_pago").val();
  var cancelar_pagar = $("#cancelar_pagar").val();
  var no_cuotas = parseInt($("#id_no_cuota").val()) + 1;
  var cuotas = $("#id_cuotas").val();
  var capital_restante = $("#id_capital_pediente").val();
  var capital = $("#id_abono_capital").val();
  var interes = $("#id_interes").val();
  var otro_monto = $("#monto_capital").val();
  var monto_capt = 0;
  var tipo_pago = $("#tipo_pago").val();
  var caja = $("#id_caja").val();
  var monto_capital_no_interes = $("#monto_capital_no_interes").val();
  if (tipo_pago != "Efectivo") {
    var banco = $("#banco_pago").val();
    var no_deposito = $("#no_cheque").val();

    data.append("banco",banco);
    data.append("no_deposito",no_deposito);
  }
  else{
    data.append("id_caja",caja);
  }
  data.append("tipo_pago",tipo_pago);
  if ( $("#nota").val() != "") {
    data.append("nota",$("#nota").val());
  }


  var concepto = "";
  var mora = 0;
  var descuento = 0;
  if ($("#moras_cargos").val() != "") { mora = $("#moras_cargos").val(); }

  if ($("#descuento_interes").val() != "") { descuento = $("#descuento_interes").val(); }
	
  if ($("#cuota_pagar").is(":checked")) {
    concepto = "PAGO CUOTA NO "+no_cuotas+"/"+cuotas;
    data.append("no_cuota",no_cuotas);
    data.append("interes",interes);
    data.append("capital",capital);
    monto_capt = capital;
  }
  else if($("#no_interes_monto").is(":checked")){

    concepto = "ABONO CAPITAL";
    data.append("capital",monto_capital_no_interes);
    data.append("interes",0);
    monto_capt = 1;
    
  }
  else if($("#solo_interes").is(":checked"))
  {
    data.append("interes",interes);
    concepto = "PAGO INTERES";
    data.append("capital",0);
    monto_capt = 1;
  }
  else if($("#cancelar_pagar").is(":checked"))
  {
    data.append("interes",interes);
    concepto = "PAGO CUOTA NO "+no_cuotas+"/"+cuotas;
    data.append("no_cuota",no_cuotas);
    data.append("capital",cancelar_pagar);
    monto_capt = 1;
  }
  else if($("#otro_monto").is(":checked")){

    data.append("interes",interes);
    if (parseInt(otro_monto) >= parseInt(interes)) {
      otro_monto = parseInt(otro_monto) - parseInt(interes);
      concepto = "PAGO CUOTA NO "+no_cuotas+"/"+cuotas;
      data.append("no_cuota",no_cuotas);
      data.append("capital",otro_monto);
      data.append("interes",interes);
      monto_capt = otro_monto;
	  otro_concepto = "OtroMonto";
    }
    else{
      data.append("capital",0);

    }
  }
  data.append("id_cliente",id_cliente_ranking);
  data.append("id_prestamo",id_prestamo);
  data.append("fecha",fecha);
  data.append("proceso","pagar");
  data.append("concepto",concepto);
  data.append("mora",mora);
  if (parseInt(descuento) > parseInt(interes)) { descuento = 0;}

  data.append("descuento",descuento);
  data.append("capital_restante",capital_restante);
  data.append("pago_selector",pago_selector);

  var pago_selector = $("#pago_selector").val()
  data.append("pago_selector",pago_selector);
  
  if (monto_capt <= 0) {
    $('#alertpago').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!</strong>El monto debe ser mayor al interes.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');

  }else{
    $.ajax({
      type: "POST",
      url: "php/historial_pagos.php",
      contentType:false,
      data: data,
      cache: false,
      processData: false, 
      success: function(res){
        console.log(res);
        if (tipo_pago != "Efectivo") { 
          guardar_banco(); 
        }else{ 
          guardar_caja(); 
        }

        //NOTIFICACIONES AL MENSAJERO
        $.ajax({
           type: "POST",
           url: "https://xilusbank.com/keys/notificar.php",
           contentType:false,
           data: data,
           cache: false,
           processData: false, 
           success: function(rese){
              console.log('Notificacion enviada '+rese);
           }
        });
        
      }
    });
  }
}

function guardar_caja()
{
  var duda = "pagar_cuota";
  var id_caja = $("#id_caja").val();
  var monto = $("#total_pagar").val();
  $.ajax({
      type: "POST",
      url: "php/cajacontroller.php",
      data: "monto_pagar="+monto+"&id_caja="+id_caja+"&proceso="+duda, 
      complete: function(resp)
      {
		$("html").load(location.href+" html>*","");
		$("html").load(location.href+" html>*","");
        location.reload();
      }
    });
}


function guardar_banco()
{
  var duda = "pagar_cuota";
  var id_banco = $("#banco_pago").val();
  var monto = $("#total_pagar").val();
  $.ajax({
      type: "POST",
      url: "php/bancocontroller.php",
      data: "monto_pagar="+monto+"&id_banco="+id_banco+"&proceso="+duda, 
      success: function(res){ 
      },
      complete: function(resp)
      {
		$("html").load(location.href+" html>*","");
		$("html").load(location.href+" html>*","");
        location.reload();
      }
    });
}
$(document).ready(function(){
  $("#btn_pagar").click(function(){
      save_cuota();
  });
});