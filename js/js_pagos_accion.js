function saldar_deuda_asunto_legal()
{
	$.confirm({
    icon: "fas fa-exclamation-circle",
    title: 'Confirmar!',
    content: 'Desea saldar este prestamo?',
    buttons: {
   		confirmar: function () {
			$.ajax({
        		type: "POST",
       			url: "php/pago_accion.php",
        		data: $("#data_saldar_deuda").serialize()+"&proceso=saldar_deuda",
        		success: function(resp){
					$("html").load(location.href+" html>*","");
					$("html").load(location.href+" html>*","");
					location.reload();
        		}
    		});
		},
    	cancelar: function () {
       		$.alert('<div class="jconfirm-title-c"><span class="jconfirm-icon-c"><i class="fas fa-exclamation-circle"></i></span><span class="jconfirm-title">Cancelado!</span></div><div class="jconfirm-content-pane no-scroll" style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); height: auto; max-height: 277.719px;margin-bottom: -5px;"><div class="jconfirm-content" id="jconfirm-box955"><div>Prestamo No saldado.</div></div></div>');  
        }
    }
	});
}

function imprimir(id_historial,tipo,empresa)
{
  window.open("factura.php?id_historial="+id_historial+"&tpd="+tipo+"&empresa="+empresa,"_blank");
}


function onload_saldar_deuda_legal(id_prestamo,capital_pendiente,creador)
{
  document.data_saldar_deuda.cap_pediente.value = capital_pendiente;
  document.data_saldar_deuda.id_prestamo_saldar_cap.value = id_prestamo;
  document.data_saldar_deuda.creador_cap.value = creador;
  document.data_saldar_deuda.tipo_pago_capt.value = "Efectivo";
  $("#tipo_pago_capt").trigger("change");




}


function onload_imprimir(tmp,tp,negocio)
{
  document.data_imprimir_contrato.tmp_negocio.value = negocio;
  document.data_imprimir_contrato.tp.value = tmp;
  document.data_imprimir_contrato.tmps.value = tp;
}
function imprimir_contrato()
{
  var tmp = $("#tmps").val();
  var tp = $("#tp").val();
  var tmp_negocio = $("#tmp_negocio").val();
  var not = $("#id_notario").val();
  var url = "http://puntocredito.net/contratos/contrato.php?tmp="+tmp+"&tp="+tp+"&not="+not+"&tmp_negocio="+tmp_negocio;
  $("#data_url").val(url);
  console.log(url);
  $("#data_imprimir_contrato").attr("action","/contratos/PDFContrato.php");  $("#data_imprimir_contrato").submit();
}
function eliminar_pago(id_prestamo,id_historial,capital_pagado,total_pagado,caja,banco,no_cuota,concepto,capital_restante,capital_inicial,cantidad_reajustes)
{
	$.confirm({
    icon: "fas fa-exclamation-circle",
    title: 'Confirmar!',
    content: 'Desea eliminar este pago?',
    buttons: {
        confirmar: function () {
	var data = new FormData();
	if (caja != 0 && banco == 0) {
  		data.append('id_metodo',caja);
  		data.append('metodo',"caja");

	}else if(caja == 0 && banco != 0){
  		data.append('id_metodo',banco);
  		data.append('metodo',"banco");
	}
  if (no_cuota > 0) {

    data.append('no_cuota',no_cuota);
  }

  data.append('proceso',"proceso_anulado");
  data.append('id_prestamo',id_prestamo);
  if (cantidad_reajustes == 1) {
    document.frm_ajt_capital.new_capital.value = capital_inicial;
  }

  data.append('id_historial',id_historial);
  data.append('capital_pagado',capital_pagado);
  data.append('total_pagado',total_pagado);
  data.append('concepto',concepto);

  capital_restante = parseFloat(capital_restante) - parseFloat(capital_pagado);


	$.ajax({
        type: "POST",
        url: "php/pago_accion.php",
        contentType:false,
        data: data,
        cache: false,
        processData: false,
        success: function(){
          if (concepto == "Reajuste Capital") {
            $("#new_capital").val(capital_restante);
          }
        },
        complete: function(resp){
          if (concepto == "Reajuste Capital") {
            delete_amortiza(id_prestamo);
          }else{
			$("html").load(location.href+" html>*","");
			$("html").load(location.href+" html>*","");
            location.reload();
          }
        }
    });
	},
    cancelar: function () {
       $.alert('<div class="jconfirm-title-c"><span class="jconfirm-icon-c"><i class="fas fa-exclamation-circle"></i></span><span class="jconfirm-title">Cancelado!</span></div><div class="jconfirm-content-pane no-scroll" style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); height: auto; max-height: 277.719px;margin-bottom: -5px;"><div class="jconfirm-content" id="jconfirm-box955"><div>No se eliminará este pago.</div></div></div>');  
        }
    }
	});

}
function altermort(id_prestamo){
  $.ajax({
    type: "POST",
    url: "php/controllerreajuste.php",
    data: "id_prestamo_change="+id_prestamo,
    success:function(resp){
      console.log(resp);
    },complete:function()
    {
	  $("html").load(location.href+" html>*","");
      $("html").load(location.href+" html>*","");
      location.reload();
    }
  });
}
function delete_amortiza(id_prestamo)
{
  var aux = parseInt($("#id_cuotas").val())*1000;
  $.ajax({
    type: "POST",
    url: "php/controllerreajuste.php",
    data: "id_prestamo_id="+id_prestamo,
    complete:function(resp){
      evaluar_();
      if (ispaused) {
        altermort(id_prestamo);
      }
    }
  });
}


/*Ajustar Capital*/
function onload_capital_ajt(id_prestamo,capital_actual)
{
  document.frm_ajt_capital.reajuste_id.value = id_prestamo;
  document.frm_ajt_capital.capital_actual.value = capital_actual;
  document.frm_ajt_capital.new_capital.value = capital_actual;

  $("#tipo_pago_reajuste").val("Efectivo");
  $("#tipo_pago_reajuste").trigger("change");
  
}


function guardar_reajuste()
{
  $.ajax({
    type: "POST",
    url: "php/controllerreajuste.php",
    data: $("#frm_ajt_capital").serialize(),
    success: function(resp){
      console.log(resp);
    },
    complete:function(){
      evaluar_();
      if (ispaused) {
        $('#modal_ajt_capital').modal('hide');

        window.setTimeout(function(){ 
	  		$("html").load(location.href+" html>*","");
      		$("html").load(location.href+" html>*",""); 
			window.location.reload()}, 1000);
      }
      
    }
  });

}

$(document).ready(function(){
	
  $("#btn_saldar_deuda").click(function(){ saldar_deuda_asunto_legal() });
	
  $("#tipo_pago_reajuste").change(function () {
      if ($(this).val() != "Efectivo") {
        $(".banco_pago_reajuste").show();
        $(".no_cheque_reajuste").show();
        $(".id_caja_reajuste").hide();
        $("#banco_pago_reajuste").trigger("change");
      }
      else
      {
        $(".banco_pago_reajuste").hide();
        $(".no_cheque_reajuste").hide();
        $(".id_caja_reajuste").show();
        $("#id_caja_reajuste").trigger("change");
      }
  });
	
	
 $("#tipo_pago_capt").change(function () {
      if ($(this).val() != "Efectivo") {
        $(".banco_pago_capt").show();
        $(".no_cheque_capt").show();
        $(".id_caja_capt").hide();
        $("#banco_pago_capt").trigger("change");
      }
      else
      {
        $(".banco_pago_capt").hide();
        $(".no_cheque_capt").hide();
        $(".id_caja_capt").show();
        $("#id_caja_capt").trigger("change");
      }
  });

  $("#id_caja_reajuste").change(function(){
      var monto = $(this).children(":selected").attr("class");
      if (monto == undefined) { monto = 0; }
      document.frm_ajt_capital.disponible_id_reajuste.value = monto;
  });

  $("#banco_pago_reajuste").change(function(){
      var monto = $(this).children(":selected").attr("class");
      if (monto == undefined) { monto = 0; }
      document.frm_ajt_capital.disponible_id_reajuste.value = monto;
  });

  $("#nuevo_monto").keyup(function(){
      var last = $("#capital_actual").val();
      var nuevo = $("#new_capital").val();
      if ($(this).val() != "") { nuevo = parseFloat(last) + parseFloat($(this).val()); }
      document.frm_ajt_capital.new_capital.value = nuevo;
  });


  $("#update_capital").click(function(){
    var nuevo_monto = parseInt($("#nuevo_monto").val());
    var disponible_id_reajuste = parseInt($("#disponible_id_reajuste").val());
    if (nuevo_monto == "" || nuevo_monto.length == 0) {
      $('#alertajustar').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>De asignar un monto.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else if (disponible_id_reajuste < nuevo_monto || disponible_id_reajuste == 0) {
      $('#alertajustar').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
            '<strong>Alerta!  </strong>No hay fondos suficientes para este retiro.'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button></div>');
    }else{
      guardar_reajuste();
    }
  });
});
/*Ajustar Capital*/