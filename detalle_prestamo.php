<?php
    if (isset($_GET['tmp'])) {
    $id_prestamo = base64_decode($_GET['tmp']);
    $tipo_prestamo = base64_decode($_GET['tp']);
	$tipo_amortizacion = base64_decode($_GET['tipo_amortizacion']);	
    include_once("header/header.php");
    include "php/historial_pagos.php";
    include "modal/modal_agregar_pago.php";
    include "modal/modal_ajt_capital.php";
    include "modal/modal_edicion_prestamo.php";
    include "modal/modal_imprimir_contrato.php";
	include "modal/modal_notas.php";
    include "modal/modal_nota.php";
  
?>
<?php
 $du = new Historial_Pagos();
if($tipo_amortizacion == '1'){
$raws = $du->read_cliente_prestamo($id_prestamo,$tipo_prestamo);	
} elseif($tipo_amortizacion == '2'){
$raws = $du->read_cliente_prestamo_capital($id_prestamo,$tipo_prestamo);
} else{
$raws = $du->read_cliente_prestamo_capital($id_prestamo,$tipo_prestamo);
}		
    
    if ($raws->num_rows >= 1) {
    while($ron = $raws->fetch_object()){
        $id_cliente = $ron->id_cliente;
    $estas = $ron->esta;
    $faltas = $ron->faltas;
        $cliente = $ron->cliente;
        $cedula = $ron->cedula;
        $phone = $ron->celular;
    $photo = $ron->path_img_cliente;
        $fecha_creacion = $ron->fecha_creado;
        $fecha_inicio = $ron->fecha;
        $capital_inicial = $ron->capital_inicial;
        $capital_pendiente = $ron->capital_pendiente;
        $proximo_pago = $ron->proximo_pago;
        $estado = $ron->estado;
        $interes_porcentaje = $ron->interes;
        $tipo_interes = $ron->tipo_interes;
        $cuotas = $ron->cuota;
        $no_cuota = $ron->no_cuota;
        $balance = $ron->balance;
        $abono_capital = $ron->abono_capital;
        $interes = $ron->interes_cantidad;
        $fecha_aux = $ron->fecha_aux;
        $fecha_pagar = $ron->fecha_pago;
        $ciclo_pago = $ron->ciclo_pago;
		$nota = $ron->nota;
		$fecha_nota = $ron->fecha_nota;
    }}
  if($estado == "Cancelado" || $estado == "Asunto Legal" || $estado == "Completado"){ $active_report = "active"; }
  else{ $active_prestamo = "active"; }
  if($estado == "Asunto Legal")
  {
    include "modal/modal_saldar_deuda.php";
  }
    include_once("header/menu.php");
    
    $close = new Historial_Pagos();

    $ruws = $close->historial($id_prestamo);

    $aumento = $ruws->num_rows;

    $catn = $close->cantidad_reajustes($id_prestamo);

    $cantidad_reajuste = $catn->num_rows;
    
    if ($catn->num_rows >= 1) {
    while($ron = $catn->fetch_object()){
    $cant_p_inicial = $ron->capital_restante;
    break;
  }}else{ $cant_p_inicial = 0; } 

    $fecha = date($fecha_aux);
   

    // will output 2 days
    

    if ($ciclo_pago == 1) {

      $nuevafecha = strtotime('+'.$aumento.' day',strtotime($fecha));
      
      
    }else if ($ciclo_pago == 7) {

      $nuevafecha = strtotime(($aumento*7).' day',strtotime($fecha));
      

    }else if ($ciclo_pago == 15) {
      $nuevafecha = strtotime('+'.($aumento*15).' day',strtotime($fecha));
      

    }else if ($ciclo_pago == 30) {

      $nuevafecha = strtotime('+'.($aumento*30).' day',strtotime($fecha));
      

    }else if ($ciclo_pago == 365) {

      $nuevafecha = strtotime('+'.($aumento*365).' day',strtotime($fecha));
      
    }

    $date1 = new DateTime($proximo_pago);
    $date2 = new DateTime(date("Y-m-d"));
    $diff = $date1->diff($date2);
    $aumentos = -1;

    if ($date2 > $date1 && $ciclo_pago == 1) { $aumentos = $diff->days; }
    if ($date2 > $date1 && $ciclo_pago == 7) { $aumentos =  intval($diff->days/7); }
    if ($date2 > $date1 && $ciclo_pago == 15) { $aumentos =  intval($diff->days/15); }
    if ($date2 > $date1 && $ciclo_pago == 30) { $aumentos =  $diff->m ; }
    if ($date2 > $date1 && $ciclo_pago == 365) { $aumentos =  $diff->y; }
    
  $aumentos_dias_pasados = $diff->days;
    
    if ($date2 > $date1 && $aumentos_dias_pasados >= 6 && $estado != "Cancelado" && $estado != "Asunto Legal") {
    
      if ($tipo_mora == 2) { $monto_trabajar = $capital_inicial;  }
      else if($tipo_mora == 1) { $monto_trabajar = ($interes+$abono_capital); }
      else { $monto_trabajar = 0; }
      if ($aumentos != 0) {
        $mora_app = $aumentos*$mora_empresa*$monto_trabajar; 
      }else{
        $mora_app = $mora_empresa*$monto_trabajar; 
      }
    if($mora_app < 0){ $mora_app = 0; }
      $du->update_prestamo($id_prestamo,"Atrasado");
    $mora_app_res = "RD$ ".number_format($mora_app,2);
    $sms_mora = "Su pago presenta una mora de $mora_app_res";
    }
    else{
      $mora_app = 0;
      if ($estado != "Cancelado" && $estado != "Asunto Legal") {
        $du->update_prestamo($id_prestamo,"Al Dia");
      }
    $sms_mora = "";

    }
    $proximo_pago = date ('Y-m-d',$nuevafecha);
    $du->update_last_pago($proximo_pago,$id_prestamo);

  $ranking_prc =  $close->read_ranking($id_cliente);
    if ($ranking_prc->num_rows >= 1) {
      while($n_row = $ranking_prc->fetch_object()){
      $ranking_plus = $n_row->mas;
      $ranking_less = $n_row->menos;
    }
  }else{
    $ranking_plus = 0;
    $ranking_less = 0;
  }
  if($capital_pendiente <= 1 && $estado != "Cancelado" && $estado != "Asunto Legal")
  {
    //aqui diremos si esta completo o no
    $du->completar_prestamo($id_prestamo);
  }
    
  $sms_monto = number_format(($abono_capital+$interes),2);
  $sms = "$empresa:  Buenos dia Sr $cliente, Recuerde Realizar Su pago del monto RD$ $sms_monto, $sms_mora";
?>
<input type="hidden" id="ranking_plus" value="<?php echo $ranking_plus; ?>">
<input type="hidden" id="ranking_less" value="<?php echo $ranking_less; ?>">
<input type="hidden" id="id_cliente_ranking" value="<?php echo $id_cliente; ?>">
<input type="hidden" id="ctn_reajustes" value="<?php echo $cantidad_reajuste; ?>">
<input type="hidden" id="capital_inicial_reajustes" value="<?php echo $capital_inicial; ?>">
<input type="hidden" id="id_id_prestamo" value="<?php echo $id_prestamo; ?>">
<input type="hidden" id="id_capital_pediente" value="<?php echo $capital_pendiente; ?>">
<input type="hidden" id="id_abono_capital" value="<?php echo $abono_capital; ?>">
<input type="hidden" id="id_interes" value="<?php echo $interes; ?>">
<input type="hidden" id="id_ciclo_pago" value="<?php echo $ciclo_pago; ?>">
<input type="hidden" id="id_cuotas" value="<?php echo $cuotas; ?>">
<input type="hidden" id="id_no_cuota" value="<?php echo $no_cuota; ?>">
<input type="hidden" id="interes_porcentaje" value="<?php echo $interes_porcentaje; ?>">
<input class="form-control" type="hidden" name="t_interes_valida" id="t_interes_valida" value="<?php echo $tipo_interes; ?>">
<div id="content-wrapper">
<div class="container-fluid">
<ol class="breadcrumb">
<li class="breadcrumb-item"> 
<?php if($tipo_prestamo == "Acuerdo de Pago" && ($estado == 'Al Dia' || $estado == 'Atrasado')){ ?>
  <a href="prestamos.php">Historial de Acuerdo de Pago</a>
<?php }else if($tipo_prestamo == "Prestamo Personal" && ($estado == 'Al Dia' || $estado == 'Atrasado')){ ?>
  <a href="prestamos.php">Historial de Préstamo Personal</a>
<?php }else if($tipo_prestamo == "Prestamo Vehiculo" && ($estado == 'Al Dia' || $estado == 'Atrasado')){ ?>
  <a href="prestamo_vehiculo.php">Historial de Préstamo de Vehículos</a>
<?php }else if($tipo_prestamo == "Prestamo Inmobiliario" && ($estado == 'Al Dia' || $estado == 'Atrasado')){ ?>
  <a href="prestamo_inmobilirario.php">Historial de Préstamo Inmobiliario</a>
<?php }else if ($estado == "Cancelado" || $estado == "Asunto Legal" || $estado == "Completado"){ ?>
  <a href="report_prestamo.php">Reportes</a>
<?php } ?>
</li>
<li class="breadcrumb-item active">Detalles del Préstamos</li>
</ol>
<div class="card mb-3">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
  <i class="fas fa-list"></i> Detalles del Préstamo
        <div style="float: right;">
      <?php  if ($negocio == 0 || $permisos_muestra->{'whatsapp'} == "on"){ ?>
        <a href="https://api.whatsapp.com/send?phone=1<?php echo str_replace('-','',$phone); ?>&text=<?php echo $sms; ?>" target="_blank"><img src="files/whatsapp.png" width="35"></a>
      <?php } ?>
          <?php if ($capital_pendiente > 0 && $estado != "Cancelado" && $estado != "Asunto Legal"): ?>
          <button class="btn" style="color:orange; font-weight: 600;" id="btn_legal">Asunto Legal</button>
          <button class="btn" style="color:red; font-weight: 600;" id="btn_cancelar_prts">Cancelar Préstamo</button>
          <?php endif ?>
      
          <?php if ($capital_pendiente > 0 && $estado != "Cancelado"  && $estado != "Asunto Legal"){ ?>
      
      <?php 
      if ($permisos->{'modificar_prestamo'} == "on"){ 
        $habilitado_ajustar_prestamo = "style='display:none;'"; 
        $deshabilitado_ajustar_prestamo = "";
      }else{ 
        $deshabilitado_ajustar_prestamo = "style='display:none;'"; 
        $habilitado_ajustar_prestamo = "";
      } 
      ?>
      
      <button class="btn text-white" style="font-weight: 600;" id="btn_ajustar_acceso" <?php echo $deshabilitado_ajustar_prestamo; ?>data-toggle="modal" onclick="onload_capital_ajt('<?php echo $id_prestamo; ?>','<?php echo $capital_pendiente; ?>','<?php echo $tipo_interes; ?>')" data-target="#modal_ajt_capital">Ajustar Capital</button>

            <button class="btn text-white" style="font-weight: 600;" id="btn_nota" data-toggle="modal" onclick="onload_nota('<?php echo $id_prestamo; ?>')"  data-target="#modal_notas">Notas</button>
    
      <button class="btn" <?php echo $habilitado_ajustar_prestamo; ?> onclick="onload_validar_btn('btn_ajustar_acceso')" data-toggle='modal' data-target='#modal_seguridad'>Ajustar Capital</button>
      <?php } ?>
          <button class="btn text-white hidden" onclick="show_pgdrt()" id="btn_pagos_realizados" style="font-weight: 600;">Pagos Realizados</button>
          <button class="btn text-white" style="font-weight: 600;" onclick="show_amrtr()" id="btn_amortzacion">Amortización</button>
          <button class="btn text-white" style="display: none; font-weight: 600;">Pagos</button>
      
          <?php if ($capital_pendiente > 0 && $estado != "Cancelado"  && $estado != "Asunto Legal"): ?>
          <button class="btn text-white" style="font-weight: 600;" onclick="clean_edit('<?php echo $cantidad_reajuste; ?>','<?php echo $capital_inicial; ?>','<?php echo $cant_p_inicial; ?>','<?php echo $capital_pendiente; ?>')" data-toggle="modal" data-target="#modal_edicion_prestamo">Editar</button>
          <?php endif ?>
      
      
          
      
      <button class="btn dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#2ab200; font-weight: 700;">Imprimir</button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" target="_blank" href="imprimir_pagos.php?tp=<?php echo $_GET['tmp']; ?>">Pagos</a>
          <a class="dropdown-item" target="_blank" href="imprimir_amortizacion.php?tp=<?php echo $_GET['tmp']; ?>" target="_blank">Amortización</a>
        
          <button class="dropdown-item" data-toggle="modal" data-target="#modal_imprimir_contrato" onclick="onload_imprimir('<?php echo $_GET['tmp'];?>','<?php echo $_GET['tp'];?>','<?php echo $negocio;?>')">Contrato</button>
        </div>
      <?php if ($capital_pendiente > 0 && $estado != 'Cancelado'  && $estado != "Asunto Legal"): ?>
            <button onclick="cargar_datos('<?php echo $fecha_pagar; ?>',<?php echo $abono_capital; ?>,<?php echo $capital_pendiente; ?>,<?php echo $interes; ?>,<?php echo $user_id; ?>,'<?php echo $mora_app; ?>')" class="btn btn-light btn-mdax" data-toggle="modal" data-target="#modal_agregar_pago">Agregar Pago</button>
          <?php endif ?>
      
      <?php if ($capital_pendiente > 0 && $estado == "Asunto Legal"): ?>
            <button class="btn btn-info" onclick="onload_saldar_deuda_legal('<?php echo $id_prestamo; ?>','<?php echo $capital_pendiente; ?>',<?php echo $user_id; ?>)"
          data-toggle="modal" data-target="#modal_saldar_deuda">Saldar Deuda</button>
            <?php endif ?>
        </div>
</div>
<div class="card-body" id="table_solicitud">


<div style="font-weight: bold;margin-bottom:10px;">
<label style="height: 0px;" >Estado: <?php 
if (($estado == 'Atrasado' && $estas != "Mora") || $estado == 'Cancelado') {  echo "<strong style='color:red'>"; }
else  if ($estado == 'Asunto Legal' || $estas == "Mora") { echo "<strong style='color:orange'>"; }
else if ($estado == 'Al Dia' || $estado == 'Completado'){ echo "<strong style='color:green'>"; }  
if($estado == 'Cancelado' || $estado == 'Asunto Legal' || $estado == 'Completado' || $estado == 'Al Dia'){ echo $estado; }
else if($estas =="Atrasado" || $estas == "Mora"){ echo $estas; }

echo '</strong>'; ?></label>
<?php 
if($estas == "Atrasado" && $estado != 'Completado'  && $estado != 'Al Dia'){ echo $faltas." Cuotas Pendientes"; } ?>
<div class="rate" align="right">
  <input type="radio" disabled id="star5" name="rate" value="5" />
  <label for="star5" disabled title="Excelente">5 stars</label>
  <input type="radio" disabled id="star4" name="rate" value="4" />
  <label for="star4" disabled title="Bueno">4 stars</label>
  <input type="radio" disabled id="star3" name="rate" value="3" />
  <label for="star3" disabled title="Intermedio">3 stars</label>
  <input type="radio" disabled id="star2" name="rate" value="2" />
  <label for="star2" disabled title="Estable">2 stars</label>
  <input type="radio" disabled id="star1" name="rate" value="1" />
  <label for="star1" disabled title="Mal">1 star</label>
</div>

<style>
.rate {
  float: right;
  height: 0px;
}

.rate:not(:checked) > input {
  position: absolute;
  top: -9999px;
}

.rate:not(:checked) > label {
  float: right;
  width: 1em;
  overflow: hidden;
  white-space: nowrap;
  cursor: pointer;
  font-size: 25px;
  color: #ccc;
}

.rate:not(:checked) > label:before { content: '★ '; }

.rate > input:checked ~ label { color: #ffc700; }

.rate:not(:checked) > label:hover, .rate:not(:checked) > label:hover ~ label { color: #deb217; }

.rate > input:checked + label:hover, .rate > input:checked + label:hover ~ label, .rate > input:checked ~ label:hover, .rate > input:checked ~ label:hover ~ label, .rate > label:hover ~ input:checked ~ label { color: #c59b08; }
</style>
</div>
<div class="form-row no-margin detalles_info" style="padding-top:10px;border-radius:10px;margin-bottom: 18px; border: 1px solid gray;
  box-shadow: 10px 10px 5px #aaaaaa;">

    <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4">
      <div class="form-group">
   <?php if ($photo === ''){ ?>
        <img src="img/perfill.jpg" class="detalles_img" style="width: 240px;border-radius: 10px;height: 218px;margin-left: 5px;margin-bottom: 10px;">
   <?php }else{ ?>
    <img src="<?php echo substr($photo,3); ?>" class="detalles_img" style="width: 240px;border-radius: 10px;height: 218px;margin-left: 5px;margin-bottom: 10px;">
   <?php } ?>
      </div>
    </div>
        
    <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4 detalle_p" style="padding: 2%; font-size: 18px;">
    <div class="form-group">
      <label><strong>Cliente: </strong><span> <?php echo $cliente; ?></span></label>
      </div>
    
      <div class="form-group">
      <label><strong>Capital Actual: </strong><span id="capital_actual">RD$ <?php echo number_format($capital_pendiente,2); ?></span></label>
      </div>

      <div class="form-group">
      <label><strong>Fecha Creación: </strong><span id="fecha_inicio"><?php echo $fecha_creacion; ?></span></label>
      </div>

      <div class="form-group">
      <label for=""><strong>Amortización: </strong><span id="amortizacion"><?php echo $tipo_interes; ?></span></label>
      </div>

      <div class="form-group">
      <label for=""><strong>Cuotas: </strong><span id="cuotas">
      <?php 
        if ($no_cuota == $cuotas && $capital_pendiente == 0) {
            echo ($no_cuota)." / ".$cuotas; 
        }else{ 
          echo ($no_cuota)." / ".$cuotas; 
        } 
      ?>
      </span>
      </label>
		  
      </div>
	      <label for=""><strong>Notas: </strong><span id="cuotas">
     
	<?php 
    if (empty($nota)) {
          echo "<strong style='color:blue;'> No hay notas para mostrar. </strong>";
      }else{  
           echo "<strong style='color:red;'> $nota</strong>";
		}
      ?>
      </span>
      </label>	
    </div>

    <div class="form-group col-sm-12 col-md-4 col-lg-4 col-xl-4 detalle_s" style="padding: 2%;font-size: 18px;">
    
    <div class="form-group">
      <label for=""><strong> Cédula: </strong> <span id="capital_inicial"><?php echo $cedula; ?></span></label>
      </div>
    
      <div class="form-group">
      <label for=""><strong> Capital Inicial:</strong> <span id="capital_inicial">RD$ <?php echo number_format($capital_inicial,2); ?></span></label>
      </div>

      <div class="form-group">
        <label for="interes"><strong>% Interés:</strong> <span id="interes"><?php echo $interes_porcentaje; ?> %</span></label>
      </div>

      <div class="form-group">
      <label for=""><strong>Modalidad Pago: </strong><span id="modalidad_pago">
        <?php
           if ($ciclo_pago == 1){ echo 'Diario'; }
           else if ($ciclo_pago == 7){ echo 'Semanal'; }
           else if ($ciclo_pago == 15){ echo 'Quincenal'; }
           else if ($ciclo_pago == 30){ echo 'Mensual'; }
           else if ($ciclo_pago == 365){ echo 'Anual'; }
        ?></span>
      </label>
      </div>

      <div class="form-group">
      <label for=""><strong>Próximo Pago: </strong><span id="proximo_pago"><?php echo $proximo_pago; ?></span></label>
      </div>

    </div>


</div>


<div class="table-responsive mt-5">


<!---Pagos Realizados-->
<div id="pagos_realizados">
<table class="table table-bordered table-hover" width="100%" cellspacing="0">
<thead>
  <th></th>
  <th style="white-space: nowrap;">Concepto</th>
  <th style="white-space: nowrap;">Fecha</th>
  <th style="white-space: nowrap;">Capital</th>
  <th style="white-space: nowrap;">Interés</th>
  <th style="white-space: nowrap;">Mora</th>
  <th style="white-space: nowrap;">Descuento</th>
  <th style="white-space: nowrap;">Total Pagado</th>
  <th style="white-space: nowrap;">Capital Restante</th>
  <th></th>
</thead>

<tbody>
<?php
    $rows = $du->read_historial($id_prestamo);
    $aux = 0;
    if ($rows->num_rows >= 1) {
    while($row = $rows->fetch_object()){
?>
    <tr>
  <td style="white-space: nowrap;" align="center">
    <button style="padding:10px 10px;" type="button" class="btn btn-success btn-round" onclick="imprimir('<?php print($row->id_historial); ?>','<?php echo $tipo_prestamo; ?>','<?php echo $empresa ?>')" title="Imprimir Pago"><i class="material-icons">print</i></button>
    </td>
      <td style="white-space: nowrap;"><?php print($row->concepto); ?></td>
      <td style="white-space: nowrap;"><?php print(date("Y-m-d",strtotime($row->fecha))); ?></td>
      <td style="white-space: nowrap;"><?php print("RD$ ".number_format($row->capital)); ?></td>
      <td style="white-space: nowrap;"><?php print("RD$ ".number_format($row->interes)); ?></td>
      <td style="white-space: nowrap;"><?php print("RD$ ".number_format($row->mora,'2')); ?></td>
      <td style="white-space: nowrap;"><?php print("RD$ ".number_format($row->descuento,'2')); ?></td>
      <td style="white-space: nowrap;"><?php print("RD$ ".number_format($row->total_pagado,'2')); ?></td>
      <td style="white-space: nowrap;"><?php print("RD$ ".number_format($row->capital_restante)); ?></td>
      <td style="white-space: nowrap;" align="center">

        <?php  if ($negocio == 0 || $permisos->{'eliminar_pago'} == "on"){ ?>
      <?php if (($capital_pendiente > 0 && $estado != "Cancelado"  && $estado != "Asunto Legal") || $estado == "Completado"): ?>
        <?php 
          if ($aux == 0){
          $aux = 1; 
        ?>
        <button style="padding:10px 10px; border-radius:20%;" type="button" class="btn btn-danger btn-round" onclick="eliminar_pago('<?php print($id_prestamo); ?>','<?php print($row->id_historial); ?>','<?php echo $row->capital; ?>','<?php echo $row->total_pagado; ?>','<?php echo $row->caja; ?>','<?php echo $row->banco; ?>','<?php echo $row->no_cuota; ?>','<?php echo $row->concepto; ?>','<?php echo $row->capital_restante; ?>','<?php echo $capital_inicial; ?>','<?php echo $cantidad_reajuste; ?>')" title="Eliminar Pago"><i class="material-icons">delete</i></button>
        <?php } ?>
        <?php endif ?>
    <?php } ?>
      </td>
    </tr>
<?php } 
     }else{
        echo "<tr>";
        echo "<td colspan='10' style='font-size:20px;' class='my-5' align='center'>No hay Pagos Realizados</td>";
        echo "</tr>";
}?>     
  </tbody>
</table>
</div>


<!---Amortizacion-->

<div class="hidden" id="amortazion">
<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
<thead>
  <th>No. Cuota</th>
  <th>Fecha Pago</th>
  <th>Balance</th>
  <th>Abono Capital</th>
  <th>Interés</th>
  <th>Monto Pagar</th>
  <th>Estado</th>
</thead>

<tbody>
<?php
    $rows = $du->read_amortazion($id_prestamo);
    if ($rows->num_rows >= 1) {
    while($row = $rows->fetch_object()){
?>
    <tr>
      <td align="center"><?php print($row->no_cuota); ?></td>
      <td><?php print(date("Y-m-d",strtotime($row->fecha))); ?></td>
      <td><?php print("RD$ ".number_format($row->balance,'2')); ?></td>
      <td><?php print("RD$ ".number_format($row->abono_capital,'2')); ?></td>
      <td><?php print("RD$ ".number_format($row->interes,'2')); ?></td>
      <td><?php print("RD$ ".number_format($row->monto_pagar,'2')); ?></td>
      <td><?php 
              if ($row->estado == "Pendiente") {
                print("<strong style='color:blue;'>".$row->estado."</strong>");
              }else{
                print("<strong style='color:green;'>".$row->estado."</strong>");
              } ?>
                
      </td>
    </tr>
<?php } 
     }else{
        echo "<tr>";
        echo "<td colspan='7' style='font-size:25px;' align='center'>No hay Pagos Realizados</td>";
        echo "</tr>";
}?>     
  </tbody>
</table>
</div>

</div>
</div>
</div>
</div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<script type="text/javascript" src="js/txt.js"></script>
<script type="text/javascript" src="js/js_pagos_accion.js"></script>
<script type="text/javascript" src="js/js_prcs_detalles.js"></script>
<script type="text/javascript" src="js/js_pagar_cuota.js"></script>
<script type="text/javascript" src="js/js_pago_detalles.js"></script>
<script type="text/javascript" src="js/js_reajuste.js"></script>
<script type="text/javascript" src="js/js_editar_prestamo.js"></script>
<script type="text/javascript" src="js/js_ranking.js"></script>
<script type="text/javascript" src="js/js_notas.js"></script>
<?php include_once("header/footer.php"); }  ?>