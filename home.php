<?php 
$active_home = 'active';
include_once("header/header.php");
if ($permisos->{'inicio'} == "on"  || isset($_POST['location'])) {
include_once("header/menu.php");
?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<div id="content-wrapper">
<div class="container-fluid">
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
     <a href="">Estadísticas</a>
  </li>
<li class="breadcrumb-item active">Gráficas de Estadísticas</li>
</ol>
<?php 
	require_once('config/db.php');
	$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	/*Total de Capital Pendiente*/
	$query = "SELECT SUM(prt.capital_pendiente) AS res,SUM(prt.interes) AS interes FROM prestamo AS prt
				INNER JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente 
				WHERE (prt.estado = 'Al dia' OR prt.estado = 'Atrasado') AND clt.negocio = $negocio";
	$runs = $con->query($query);
	$result_total_prestado = $runs->fetch_object();
	$total_prestado = $result_total_prestado->res;
	
	/*Total de Interes Pendiente*/
	$query = "SELECT SUM(amrt.interes) AS res FROM amortizacion AS amrt
				INNER JOIN prestamo AS prt ON amrt.id_prestamo = prt.id_prestamo
				INNER JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente 
				WHERE amrt.estado = 'Pendiente' AND
						(prt.estado = 'Al dia' OR prt.estado = 'Atrasado') AND clt.negocio = $negocio";
	$runes = $con->query($query);
	$result_total_interes = $runes->fetch_object();
	$total_interes = $result_total_interes->res;
	
	/*Prestamos Atrasados*/
	$query = "SELECT prt.* FROM prestamo AS prt
				INNER JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente 
				WHERE prt.estado = 'Atrasado' AND clt.negocio = $negocio";
	$run = $con->query($query);
    $total_atrasado = ($run->num_rows >=  1) ? $run->num_rows : 0;
	
	/*Prestamos Asunt. Legal*/
	$query = "SELECT prt.* FROM prestamo AS prt 
				INNER JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente 
				WHERE prt.estado = 'Asunto Legal' and clt.negocio = $negocio";
	$run = $con->query($query);
    $total_asunt_legal = (1 <= $run->num_rows) ? $run->num_rows : 0;
	
	/*Prestamos Cancelados*/
	$query = "SELECT  prt.* FROM prestamo AS prt 
				INNER JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente 
				WHERE  prt.estado = 'Cancelado'	and	clt.negocio = $negocio";
	$run = $con->query($query);
    $total_cancelado = (1 <= $run->num_rows) ? $run->num_rows : 0;
	
	/*Prestamos Activos*/
	$query = "SELECT prt.* FROM prestamo AS prt 
				INNER JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente 
				WHERE prt.estado != 'Completado' and
				prt.estado != 'Cancelado' and
				prt.estado !='Asunto Legal' and
				clt.negocio = $negocio  AND clt.estado = 1";
	$run = $con->query($query);
    $total_activos = (1 <= $run->num_rows) ? $run->num_rows : 0;
	
	$query = "SELECT buscar_mes(MONTH(htp.fecha)) AS mes,
				SUM(htp.capital) as sum_capital,SUM(htp.interes) as sum_interes,
				SUM(htp.mora) as sum_mora,
				(SUM(htp.interes)+SUM(htp.mora)) as res,
				(SUM(htp.interes)+SUM(htp.mora)+SUM(htp.capital)) as res2
				FROM historial_pagos AS htp 
				INNER JOIN prestamo AS prt ON htp.id_prestamo = prt.id_prestamo
				INNER JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente 
				WHERE htp.estado = 'Pagada' and YEAR(htp.fecha) = YEAR(NOW()) AND clt.negocio = $negocio AND clt.estado = 1
				GROUP BY MONTH(htp.fecha) ASC";
	$run = $con->query($query);
	$ran = $con->query($query);
	$row_cobrados = $con->query($query);
	$row_cobradox = $con->query($query);
	
	$query = "SELECT buscar_mes(MONTH(prt.fecha)) AS mes,
				SUM(prt.capital_inicial) as prestado,
				(SUM(prt.capital_inicial) - SUM(prt.capital_pendiente)) as devuelto 
				FROM prestamo AS prt
				INNER JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente 
				WHERE prt.estado != 'Cancelado' and YEAR(prt.fecha) = YEAR(NOW()) AND clt.negocio = $negocio AND clt.estado = 1
				GROUP BY MONTH(prt.fecha) ASC";
	$riin = $con->query($query);
	$rion = $con->query($query);
	$riun = $con->query($query);
?>
<div class="row">
          <div class="col-xl-2 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
					<i class="fas fa-money"></i>
                </div>
                <div class="mr-5"><strong>Préstamos Activos:</strong> <?php echo $total_activos; ?></div>
              </div>
              <!--<a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Ver Detalles</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>-->
            </div>
          </div>
          <div class="col-xl-2 col-sm-6 mb-3">
            <div class="card text-black bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-exclamation"></i>
                </div>
                <div class="mr-5"><strong>Préstamos Atrasados:</strong> <?php echo ($total_atrasado); ?></div>
              </div>
              <!--<a class="card-footer text-black clearfix small z-1" href="#">
                <span class="float-left">Ver Detalles</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>-->
            </div>
          </div>
          <div class="col-xl-2 col-sm-6 mb-3">
            <div class="card text-white bg-info o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-balance-scale-left"></i>
                </div>
                <div class="mr-5"><strong>Préstamos en Legal:</strong> <?php echo $total_asunt_legal; ?></div>
              </div>
              <!--<a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Ver Detalles</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>-->
            </div>
          </div>
          <div class="col-xl-2 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-ban"></i>
                </div>
                <div class="mr-5"><strong>Préstamos Cancelados:</strong> <?php echo $total_cancelado; ?></div>
              </div>
              <!--<a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Ver Detalles</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>-->
            </div>
          </div>
	
		 <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-black bg-default o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
					<i class="fas fa-calendar-check"></i>
                </div>
                <div class="mr-5"><strong>Total Prestado:</strong> <?php echo "RD$ ".number_format($total_prestado,2); ?></div>
				 <br>
                <div class="mr-5"><strong>Total Interes:</strong> <?php echo "RD$ ".number_format($total_interes,2); ?></div>
              </div>
              <!--<a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Ver Detalles</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>-->
            </div>
          </div>
        </div>
	
<br>
<br>
<style>
.card-footer {
    padding: 0.75rem 1.25rem;
    background-color: rgb(242, 242, 242);
    border-top: 1px solid rgba(0, 0, 0, 0.2);
}
.tab-contents{
	border-left:1px solid #dfdfdf;
	border-bottom:1px solid #dfdfdf;
	border-right:1px solid #dfdfdf;
  	/*box-shadow: 10px 10px 5px #aaaaaa;*/
    height: 444px; max-height: 444px; 
}
</style>
	
<div class="form-row">
<?php if ($permisos->{'grafica_estadistica'} == "on"){ ?>
<div class="form-group col-sm-12 col-md-7 col-lg-7 col-xl-7 ouno">
	<nav class="nav nav-tabs">
  		<a data-toggle="tab" href="#container_ingresos" class="nav-item nav-link active">Ingresos</a>
  		<a data-toggle="tab" href="#container_capital" class="nav-item nav-link">Capital</a>
  		<a data-toggle="tab" href="#container_cobrados" class="nav-item nav-link">Cobrados</a>
	</nav>
	<div class="tab-content tab-contents">
	<div id="container_ingresos" class="tab-pane fade in active show" style="min-width: 360px;  height: 100%; margin: 0 auto"></div>
		
  	<div id="container_capital" class="tab-pane fade" style="min-width: 360px; height: 100%; margin: 0 auto"></div>
		
	<div id="container_cobrados" class="tab-pane fade" style="min-width: 360px; height: 100%;  margin: 0 auto"></div>
</div>
</div>
<?php } ?>

<div class="form-group col-sm-12 col-md-5 col-lg-5 col-xl-5 odos">
	
<nav class="nav nav-tabs">
  	<a data-toggle="tab" href="#container_general" class="nav-item nav-link active">General</a>
  	<a data-toggle="tab" href="#container_al_dia" class="nav-item nav-link">Pendiente</a>
  	<a data-toggle="tab" href="#container_mora" class="nav-item nav-link">Mora</a>
  	<a data-toggle="tab" href="#container_atrasado" class="nav-item nav-link">Atrasados</a>
  	<a data-toggle="tab" href="#container_legal" class="nav-item nav-link">Legal</a>
</nav>
<div class="tab-content">	
	
<div class="tab-contents tab-pane fade in active show" id="container_general"  style="overflow:auto;">
    <div class="card-body mb-4" style="padding:0px !important;">
    <div class="table-responsive">
	<div class="form-group mt-4 col-md-12">
		<input type="text" class="form-control" name="bsc_general" id="bsc_general" placeholder="Buscar" stlye="float:right">
	</div>
	<table class="table table-hover table-bordered"  width="100%" cellspacing="0" >
	   <tbody  class="hoverclass bbo" id="table_general">
		 <?php
		   $query = "SELECT prt.id_prestamo,prt.tipo_prestamo, prt.cuota, prt.capital_pendiente, cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) AS faltas,
			(CASE
			WHEN proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) >= 1 THEN  'Atrasado'
			WHEN  proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) = 0 and TIMESTAMPDIFF(day, DATE_FORMAT(NOW(), '%Y-%m-%d'), proximo_pago) < -5 THEN 'Mora'
			WHEN proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) = 0 and TIMESTAMPDIFF(day, DATE_FORMAT(NOW(), '%Y-%m-%d'), proximo_pago) >= -5 THEN 'Al dia'
			END)  as esta,
			prt.proximo_pago,amrt.monto_pagar,amrt.estado,COUNT(amrt.no_cuota) as no_cuota,
			CONCAT(clt.nombre, ' ',clt.apellido) as cliente FROM prestamo AS prt 
			INNER JOIN amortizacion AS amrt ON prt.id_prestamo = amrt.id_prestamo
			INNER JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente
			WHERE
			amrt.estado = 'Pendiente' and
			prt.estado != 'Cancelado' and
			prt.estado !='Asunto Legal' and
			prt.estado != 'Completado' and
			cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) >= 0  and
			clt.negocio = $negocio AND clt.estado = 1
			GROUP BY prt.id_prestamo
			ORDER BY clt.nombre asc,prt.proximo_pago ASC,amrt.no_cuota DESC";
	 	   $clientes_general = $con->query($query);
		   if($clientes_general->num_rows >= 1){
		   while ($row = $clientes_general->fetch_object()) { ?>
		
		 <?php if($row->esta == "Al dia"){ ?>
         <tr data-href="detalle_prestamo.php?tmp=<?php echo base64_encode($row->id_prestamo); ?>&tp=<?php echo base64_encode($row->tipo_prestamo); ?>" style="cursor:pointer;background-color: #dff0d8 !important;">
		 <?php }elseif($row->esta == "Atrasado"){ ?>
         <tr  data-href="detalle_prestamo.php?tmp=<?php echo base64_encode($row->id_prestamo); ?>&tp=<?php echo base64_encode($row->tipo_prestamo); ?>" style="cursor:pointer;background-color: #f2dede !important;">
		 <?php }elseif($row->esta == "Mora"){ ?>
         <tr  data-href="detalle_prestamo.php?tmp=<?php echo base64_encode($row->id_prestamo); ?>&tp=<?php echo base64_encode($row->tipo_prestamo); ?>" style="cursor:pointer; background-color: #fcf8e3 !important;">
		 <?php }elseif($row->esta == NULL){  ?>
		 <tr data-href="detalle_prestamo.php?tmp=<?php echo base64_encode($row->id_prestamo); ?>&tp=<?php echo base64_encode($row->tipo_prestamo); ?>">
		 <?php  } ?>
           <td>
			   	<div class="form-row">
					<div class="form-group colx-6 col-sm-6 col-md-6 col-xl-6">
						<label style="font-size:18px;font-weight:bold;"><?php echo $row->cliente; ?></label>
					</div>
					<div class="form-group almob colx-6 col-sm-6 col-md-6 col-xl-6" align="right">
		   				<span><strong>Cuota:</strong> <?php echo "RD$ ".number_format($row->monto_pagar,2); ?></span>
					</div>
				</div>
			   	<div class="form-row">
					<div class="form-group colx-6 col-sm-6 col-md-6 col-xl-6">
						<label><strong>Capt. Actual:</strong> <?php echo "RD$ ".number_format($row->capital_pendiente,2); ?></label>
						<br>
						<label><strong>Cuot. Paga:</strong> <?php echo ($row->cuota-$row->no_cuota)."/".$row->cuota; ?></label>
					</div>
					<div class="form-group almob colx-6 col-sm-6 col-md-6 col-xl-6" align="right">
					<?php if($row->esta == "Al dia"){ ?>
		   				<label><strong>Pendiente</strong></label>
					<?php }elseif($row->esta == "Atrasado"){ ?>
		   				<label><strong><?php if($row->faltas > $row->no_cuota){ echo $row->no_cuota; }else{ echo $row->faltas;} ?> Cuotas Pendientes</strong></label>
					<?php }elseif($row->esta == "Mora"){ ?>
		   				<label><strong>Mora</strong></label>
					<?php } ?><br>
					<label><?php echo $row->proximo_pago; ?></label>
						
					</div>
				   	<?php $cant_general += 1; $total_general += $row->monto_pagar;  ?>
				</div>
			 </td>
		   
         </tr>
		 <?php }  }
		  if($cant_general == null){ $total_general = 0;$cant_general = 0; ?>
		  <tr  data-href="#">
			  <td align="center">No hay personas pendientes este mes.</td>
		  </tr>
		 <?php } ?>
       </tbody>
	 </table>
   </div>
 </div>
<div class="card-footer text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="font-weight: 600 !important; position: absolute;bottom: 0;width: 97.5%;" align="right">
<span style="float:left;"><?php echo "Cant: ".$cant_general; ?></span>
<span style="float:right;"><?php echo "Total por Cobrar: RD$ ".number_format($total_general,2); ?></span>
</div>
</div>


	
<div class="tab-contents tab-pane fade" id="container_al_dia"  style="overflow:auto;">
    <div class="card-body mb-4" style="padding:0px !important;">
    <div class="table-responsive">
	<div class="form-group mt-4 col-md-12">
		<input type="text" class="form-control" name="bsc_general_pendiente" id="bsc_general_pendiente" placeholder="Buscar" stlye="float:right">
	</div>
	<table class="table table-hover table-bordered"  width="100%" cellspacing="0">
	   <tbody  class="hoverclass bbo" id="table_general_pendiente">
		 <?php
		   $query = "SELECT prt.id_prestamo,prt.tipo_prestamo,amrt.no_cuota, prt.cuota, prt.capital_pendiente, cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) AS faltas,
			(CASE
				WHEN proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) >= 1 THEN  'Atrasado'
				WHEN  proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) = 0  and TIMESTAMPDIFF(day, DATE_FORMAT(NOW(), '%Y-%m-%d'), proximo_pago) < -5 THEN 'Mora'
				WHEN  proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) = 0 and TIMESTAMPDIFF(day, DATE_FORMAT(NOW(), '%Y-%m-%d'), proximo_pago) >= -5  THEN 'Al dia'
			END)  as esta,
			prt.proximo_pago,amrt.monto_pagar,amrt.estado,COUNT(amrt.no_cuota) as no_cuota,
			CONCAT(clt.nombre, ' ',clt.apellido) as cliente FROM prestamo AS prt 
			INNER JOIN amortizacion AS amrt ON prt.id_prestamo = amrt.id_prestamo
			INNER JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente
			WHERE MONTH(prt.proximo_pago) = MONTH(NOW()) and
			amrt.estado = 'Pendiente' and
			prt.estado != 'Cancelado' and
			prt.estado !='Asunto Legal' and
			prt.estado != 'Completado' and
			clt.negocio = $negocio AND clt.estado = 1
			GROUP BY prt.id_prestamo
			ORDER BY clt.nombre asc,prt.proximo_pago ASC,amrt.no_cuota DESC";
	 	   $clientes_al_dia = $con->query($query);
		   if($clientes_al_dia->num_rows >= 1){
		   while ($row = $clientes_al_dia->fetch_object()) { ?>
			
		 <?php if($row->esta == "Al dia"){ ?>
         <tr data-href="detalle_prestamo.php?tmp=<?php echo base64_encode($row->id_prestamo); ?>&tp=<?php echo base64_encode($row->tipo_prestamo); ?>" style="cursor:pointer;background-color: #dff0d8 !important;">
           <td>
			   	<div class="form-row">
					<div class="form-group colx-6 col-sm-6 col-md-6 col-xl-6">
						<label style="font-size:18px;font-weight:bold;"><?php echo $row->cliente; ?></label>
					</div>
					<div class="form-group almob colx-6 col-sm-6 col-md-6 col-xl-6" align="right">
		   				<span><strong>Cuota:</strong> <?php echo "RD$ ".number_format($row->monto_pagar,2); ?></span>
					</div>
				</div>
			   	<div class="form-row">
					<div class="form-group colx-6 col-sm-6 col-md-6 col-xl-6">
						<label><strong>Capt. Actual:</strong> <?php echo "RD$ ".number_format($row->capital_pendiente,2); ?></label>
						<br>
						<label><strong>Cuot. Paga:</strong> <?php echo ($row->cuota-$row->no_cuota)."/".$row->cuota; ?></label>
					</div>
					<div class="form-group almob colx-6 col-sm-6 col-md-6 col-xl-6" align="right">
					<?php if($row->esta == "Al dia"){ ?>
		   				<label><strong>Pendiente</strong></label>
					<?php }elseif($row->esta == "Atrasado"){ ?>
		   				<label><strong><?php if($row->faltas > $row->no_cuota){ echo $row->no_cuota; }else{ echo $row->faltas;} ?> Cuotas Pendientes</strong></label>
					<?php }elseif($row->esta == "Mora"){ ?>
		   				<label><strong>Mora</strong></label>
					<?php } ?><br>
					<label><?php echo $row->proximo_pago; ?></label>
					</div>
				   	<?php $cant_al_dia += 1; $total_al_dia += $row->monto_pagar;  ?>
				</div>
			 </td>
		   
         </tr>
		 <?php }}  }
		  if($cant_al_dia == null){ $total_al_dia = 0;$cant_al_dia = 0; ?>
		  <tr  data-href="#">
			  <td align="center">No Hay Personas Pendiestes este Mes</td>
		  </tr>
		 <?php } ?>
       </tbody>
	 </table>
   </div>
 </div>
<div class="card-footer text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="font-weight: 600 !important; position: absolute;bottom: 0;width: 97.5%;">
<span style="float:left;"><?php echo "Cant: ".$cant_al_dia; ?></span>
<span style="float:right;"><?php echo "Total Pendiente: RD$ ".number_format($total_al_dia,2); ?></span>
</div>
</div>

<div class="tab-contents tab-pane fade" id="container_mora"  style="overflow:auto;">
    <div class="card-body mb-4" style="padding:0px !important;">
    <div class="table-responsive">
	<div class="form-group mt-4 col-md-12">
		<input type="text" class="form-control" name="bsc_general_mora" id="bsc_general_mora" placeholder="Buscar" stlye="float:right">
	</div>
	<table class="table table-hover table-bordered"  width="100%" cellspacing="0">
	   <tbody class="hoverclass bbo" id="table_general_mora">
		 <?php
		   $query = "SELECT prt.id_prestamo,prt.tipo_prestamo,amrt.no_cuota, prt.cuota, prt.capital_pendiente, cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) AS faltas,
			(CASE
				WHEN proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) >= 1 THEN  'Atrasado'
				WHEN  proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) = 0  and TIMESTAMPDIFF(day, DATE_FORMAT(NOW(), '%Y-%m-%d'), proximo_pago) < -5 THEN 'Mora'
				WHEN  proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) = 0 and TIMESTAMPDIFF(day, DATE_FORMAT(NOW(), '%Y-%m-%d'), proximo_pago) >= -5  THEN 'Al dia'
			END)  as esta,
			prt.proximo_pago,amrt.monto_pagar,amrt.estado,COUNT(amrt.no_cuota) as no_cuota,
			CONCAT(clt.nombre, ' ',clt.apellido) as cliente FROM prestamo AS prt 
			INNER JOIN amortizacion AS amrt ON prt.id_prestamo = amrt.id_prestamo
			INNER JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente
			WHERE prt.proximo_pago <= NOW() and
			amrt.estado = 'Pendiente' and
			prt.estado != 'Cancelado' and
			prt.estado !='Asunto Legal' and
			prt.estado != 'Completado' and
			clt.negocio = $negocio AND clt.estado = 1
			GROUP BY prt.id_prestamo
			ORDER BY clt.nombre asc,amrt.no_cuota DESC,prt.proximo_pago asc";
	 	   $clientes_mora = $con->query($query);
		   if($clientes_mora->num_rows >= 1){
		   while ($row = $clientes_mora->fetch_object()) { ?>
			
		 <?php if($row->esta == "Mora"){ ?>
         <tr data-href="detalle_prestamo.php?tmp=<?php echo base64_encode($row->id_prestamo); ?>&tp=<?php echo base64_encode($row->tipo_prestamo); ?>" style="cursor:pointer;background-color: #fcf8e3 !important;">
           <td>
			   	<div class="form-row">
					<div class="form-group colx-6 col-sm-6 col-md-6 col-xl-6">
						<label style="font-size:18px;font-weight:bold;"><?php echo $row->cliente; ?></label>
					</div>
					<div class="form-group almob colx-6 col-sm-6 col-md-6 col-xl-6" align="right">
		   				<span><strong>Cuota:</strong> <?php echo "RD$ ".number_format($row->monto_pagar,2); ?></span>
					</div>
				</div>
			   	<div class="form-row">
					<div class="form-group colx-6 col-sm-6 col-md-6 col-xl-6">
						<label><strong>Capt. Actual:</strong> <?php echo "RD$ ".number_format($row->capital_pendiente,2); ?></label>
						<br>
						<label><strong>Cuot. Paga:</strong> <?php echo ($row->cuota-$row->no_cuota)."/".$row->cuota; ?></label>
					</div>
					<div class="form-group almob colx-6 col-sm-6 col-md-6 col-xl-6" align="right">
					<?php if($row->esta == "Al dia"){ ?>
		   				<label><strong>Pendiente</strong></label>
					<?php }elseif($row->esta == "Atrasado"){ ?>
		   				<label><strong><?php if($row->faltas > $row->no_cuota){ echo 1; }
															else{ echo $row->faltas;} ?> Cuotas Pendientes</strong></label>
					<?php }elseif($row->esta == "Mora"){ ?>
		   				<label><strong>Mora</strong></label>
					<?php } ?><br>
					<label><?php echo $row->proximo_pago; ?></label>
						
					</div>
				   	<?php $cant_mora += 1;
						  $total_mora += $row->monto_pagar;  ?>
				</div>
			 </td>
		   
         </tr>
		 <?php }}  }
		  if($cant_mora == null){ $total_mora = 0;$cant_mora = 0; ?>
		  <tr  data-href="#">
			  <td align="center" >No hay personas en mora.</td>
		  </tr>
		 <?php } ?>
       </tbody>
	 </table>
   </div>
 </div>
<div class="card-footer text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="font-weight: 600 !important; position: absolute;bottom: 0;width: 97.5%;" align="right">
	
<span style="float:left;"><?php echo "Cant: ".$cant_mora; ?></span>
<span style="float:right;"><?php echo "Total con Mora: RD$ ".number_format($total_mora,2); ?></span>
</div>
</div>
	

<div class="tab-contents tab-pane fade" id="container_atrasado"  style="overflow:auto;">
    <div class="card-body mb-4" style="padding:0px !important;">
    <div class="table-responsive">
	<div class="form-group mt-4 col-md-12">
		<input type="text" class="form-control" name="bsc_general_atrasado" id="bsc_general_atrasado" placeholder="Buscar" stlye="float:right">
	</div>
	<table class="table table-hover table-bordered"  width="100%" cellspacing="0">
	   <tbody class="hoverclass bbo"  id="table_general_atrasado">
		 <?php
		   $query = "SELECT prt.id_prestamo,prt.tipo_prestamo,amrt.no_cuota, prt.cuota, prt.capital_pendiente, cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) AS faltas,
			(CASE
				WHEN proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) >= 1 THEN  'Atrasado'
				WHEN  proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) = 0 and TIMESTAMPDIFF(day, DATE_FORMAT(NOW(), '%Y-%m-%d'), proximo_pago) < -5 THEN 'Mora'
				WHEN  proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) = 0 and TIMESTAMPDIFF(day, DATE_FORMAT(NOW(), '%Y-%m-%d'), proximo_pago) >= -5  THEN 'Al dia'
			END)  as esta,
			prt.proximo_pago,amrt.monto_pagar,amrt.estado,COUNT(amrt.no_cuota) as no_cuota,
			CONCAT(clt.nombre, ' ',clt.apellido) as cliente FROM prestamo AS prt 
			INNER JOIN amortizacion AS amrt ON prt.id_prestamo = amrt.id_prestamo
			INNER JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente
			WHERE prt.proximo_pago <= NOW() and
			amrt.estado = 'Pendiente' and
			prt.estado != 'Cancelado' and
			prt.estado != 'Asunto Legal' and
			prt.estado != 'Completado' and
			clt.negocio = $negocio AND clt.estado = 1
			GROUP BY prt.id_prestamo
			ORDER BY clt.nombre asc,amrt.no_cuota DESC,prt.proximo_pago asc";
	 	   $clientes_atrasado = $con->query($query);
		   if($clientes_atrasado->num_rows >= 1){
		   while ($row_atraso = $clientes_atrasado->fetch_object()) { ?>
			
		 <?php if($row_atraso->esta == "Atrasado"){ ?>
         <tr data-href="detalle_prestamo.php?tmp=<?php echo base64_encode($row_atraso->id_prestamo); ?>&tp=<?php echo base64_encode($row_atraso->tipo_prestamo); ?>" style="cursor:pointer;background-color: #f2dede !important;">
           <td>
			   	<div class="form-row">
					<div class="form-group colx-6 col-sm-6 col-md-6 col-xl-6">
						<label style="font-size:18px;font-weight:bold;"><?php echo $row_atraso->cliente; ?></label>
					</div>
					<div class="form-group almob colx-6 col-sm-6 col-md-6 col-xl-6" align="right">
		   				<span><strong>Cuota:</strong> <?php echo "RD$ ".number_format($row_atraso->monto_pagar,2); ?></span>
					</div>
				</div>
			   	<div class="form-row">
					<div class="form-group colx-6 col-sm-6 col-md-6 col-xl-6">
						<label><strong>Capt. Actual:</strong> <?php echo "RD$ ".number_format($row_atraso->capital_pendiente,2); ?></label>
						<br>
						<label><strong>Cuot. Paga:</strong> <?php echo ($row_atraso->cuota-$row_atraso->no_cuota)."/".$row_atraso->cuota; ?></label>
					</div>
					<div class="form-group almob colx-6 col-sm-6 col-md-6 col-xl-6" align="right">
					<?php if($row->esta == "Al dia"){ ?>
		   				<label><strong>Pendiente</strong></label>
					<?php }elseif($row_atraso->esta == "Atrasado"){ ?>
		   				<label><strong><?php if($row_atraso->faltas > $row_atraso->no_cuota){ echo $row_atraso->no_cuota; }else{ echo $row_atraso->faltas;} ?> Cuotas Pendientes</strong></label>
					<?php }elseif($row_atraso->esta == "Mora"){ ?>
		   				<label><strong>Mora</strong></label>
					<?php } ?><br>
					<label><?php echo $row->proximo_pago; ?></label>
						
					</div>
				   	<?php $cant_atrasado += 1; $total_atrasado += $row_atraso->monto_pagar;  ?>
				</div>
			 </td>
		   
         </tr>
		 <?php }}  }
		  if($cant_atrasado == null){ $total_atrasado = 0;$cant_atrasado = 0; ?>
		  <tr  data-href="#">
			  <td align="center" >No hay personas con pagos atrasados.</td>
		  </tr>
		 <?php } ?>
       </tbody>
	 </table>
   </div>
 </div>
<div class="card-footer text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="font-weight: 600 !important; position: absolute;bottom: 0;width: 97.5%;" align="">
<span style="float:left;"><?php echo "Cant: ".$cant_atrasado; ?></span>
<span style="float:right;">
	<?php echo "Total Atrasado: RD$ ".number_format($total_atrasado,2); ?></span>
</div>
</div>
	
	
	


<div class="tab-contents tab-pane fade" id="container_legal"  style="overflow:auto;">
    <div class="card-body mb-4" style="padding:0px !important;">
    <div class="table-responsive">
	<div class="form-group mt-4 col-md-12">
		<input type="text" class="form-control" name="bsc_general_legal" id="bsc_general_legal" placeholder="Buscar" stlye="float:right">
	</div>
	<table class="table table-hover table-bordered"  width="100%" cellspacing="0">
	   <tbody class="hoverclass bbo" id="table_general_legal">
		 <?php
		   $query = "SELECT prt.id_prestamo,prt.tipo_prestamo,amrt.no_cuota, prt.cuota, prt.capital_pendiente, cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) AS faltas,
			(CASE
			WHEN proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) >= 1 THEN  'Atrasado'
			WHEN  proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) = 0 THEN 'Mora'
			WHEN  proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) = 0 and TIMESTAMPDIFF(day, DATE_FORMAT(NOW(), '%Y-%m-%d'), proximo_pago) >= -5  THEN 'Al dia'
			END)  as esta,
			prt.proximo_pago,amrt.monto_pagar,amrt.estado,COUNT(amrt.no_cuota) as no_cuota,
			CONCAT(clt.nombre, ' ',clt.apellido) as cliente FROM prestamo AS prt 
			INNER JOIN amortizacion AS amrt ON prt.id_prestamo = amrt.id_prestamo
			INNER JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente
			WHERE prt.estado = 'Asunto Legal' and
			clt.negocio = $negocio AND clt.estado = 1
			GROUP BY prt.id_prestamo
			ORDER BY clt.nombre asc,amrt.no_cuota DESC,prt.proximo_pago asc";
	 	   $clientes_legal = $con->query($query);
		   if($clientes_legal->num_rows >= 1){
		   while ($row = $clientes_legal->fetch_object()) { ?>
			
         <tr data-href="detalle_prestamo.php?tmp=<?php echo base64_encode($row->id_prestamo); ?>&tp=<?php echo base64_encode($row->tipo_prestamo); ?>" target="_blank"style="cursor:pointer;background-color: #f2dede !important;">
           <td>
			   	<div class="form-row">
					<div class="form-group colx-6 col-sm-6 col-md-6 col-xl-6">
						<label style="font-size:18px;font-weight:bold;"><?php echo $row->cliente; ?></label>
					</div>
					<div class="form-group almob colx-6 col-sm-6 col-md-6 col-xl-6" align="right">
		   				<span><strong>Cuota:</strong> <?php echo "RD$ ".number_format($row->monto_pagar,2); ?></span>
					</div>
				</div>
			   	<div class="form-row">
					<div class="form-group colx-6 col-sm-6 col-md-6 col-xl-6">
						<label><strong>Capt. Actual:</strong> <?php echo "RD$ ".number_format($row->capital_pendiente,2); ?></label>
						<br>
						<label><strong>Cuot. Paga:</strong> <?php echo ($row->cuota-$row->no_cuota)."/".$row->cuota; ?></label>
					</div>
					<div class="form-group almob colx-6 col-sm-6 col-md-6 col-xl-6" align="right">
		   				<label><strong>Legal</strong></label>
					</div>
				   	<?php $total_legal += $row->monto_pagar;  ?>
				</div>
			 </td>
		   
         </tr>
		 <?php }  }
		  if($total_legal == null){ ?>
		  <tr  data-href="#">
			  <td colspan="3" align="center">No hay personas en asuntos legales.</td>
		  </tr>
		 <?php } ?>
       </tbody>
	 </table>
   </div>
 </div>
<div class="card-footer text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="font-weight: 600 !important; position: absolute;bottom: 0;width: 97.5%;">
<span style="float:left;"><?php echo "Cant: ".$clientes_legal->num_rows; ?></span>
<span style="float:right;"><?php echo "Total: RD$ ".number_format($total_legal,2); ?></span>
</div>
</div>
	
	
</div>

	
<!-- Final de Tab-->
</div>
<!-- Final de Tab-->

</div>
	
<div class="card mb-3" style="height: 600px;">
  <div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
    <i class="fas fa-location-arrow"></i> Conductores</div>
  <div class="card-body" style="padding: 0rem;">
	<div id="map"  style="height: -webkit-fill-available; height: 100%;width: 100%;"></div>
  </div>
</div>
</div>
</div>
<script>
/*****************************/
/*AQUI VA EL CODIGO DEL MAPA*/
/*****************************/
  var infoWindow = null;  
  var map = null;
  var markersArray = [];
  var pathArray = [];

function initMap() {

  var myLatlng = new google.maps.LatLng(18.735693, -70.1626511);
  var myOptions = {
      zoom : 9,
      center : myLatlng,
      mapTypeId : google.maps.MapTypeId.ROADMAP,
      disableDefaultUI: false
  }
    
  map = new google.maps.Map(document.getElementById("map"),myOptions); 

  infoWindow = new google.maps.InfoWindow;        
  updateMaps();
  window.setInterval(updateMaps, 8000);
  }
          
  function clearOverlays() {
    for (var i = 0; i < markersArray.length; i++ ) {
     markersArray[i].setMap(null);
    }
  }

  function clearpath() {
    for (var i = 0; i < pathArray.length; i++ ) {
     pathArray[i].setMap(null);
    }
  }
   
  function updateMaps() {

    clearOverlays();
    clearpath();
    
    var timestamp = new Date().getTime();
    var url = 'https://xilusbank.com/keys/imarkerFirst.php?t='+timestamp+'&negocio='+<?php echo $negocio; ?>;

    $.ajax({
      url:url,
      method:'GET',
      success:function(data) {
      console.log(data);
      $(data).find("marker").each(
          function() {
            var marker = $(this);///'/'
            var name = marker.attr("name");
            var lat = marker.attr("lat");
            var lng = marker.attr("lng");
            var dispositivo = marker.attr("dispositivo");
            var apellido = marker.attr("apellido");
            var id_mensajero = marker.attr("id_mensajero");


      var latlng = new google.maps.LatLng(parseFloat(marker.attr("lat")), parseFloat(marker.attr("lng")));
      var html = "<strong>Nombre :</strong> "+name+" "+apellido;
      

      var flightPlanCoordinates = [
             new google.maps.LatLng(lat,lng),
      ];

      var flightPath = new google.maps.Polyline({
          path: flightPlanCoordinates,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

      img = "keys/delivery.png"

      var icone = {
           url: img, // url
           scaledSize: new google.maps.Size(80, 80), // scaled size
           /*origin: new google.maps.Point(0,0), // origin
           anchor: new google.maps.Point(0, 0) // anchor*/
         };

      var marker = new google.maps.Marker({
          position : latlng,
          //draggable: true,//le dmos la propiedad de arrastrar el marcador
          map : map,
          center:latlng,
          icon: icone,
      });

      google.maps.event.addListener(marker, 'click', function() {
          infoWindow.setContent(html);
      
      map.setCenter(marker.getPosition());
      infoWindow.open(map, marker);
      map.setZoom(18);
      
      });           
            
          markersArray.push(marker);
          pathArray.push(flightPath);
          flightPath.setMap(map);
          
          
          });
      }
    });

    }
/**************************************/
/**************************************/
/**************************************/
/**************************************/
/**************************************/
Highcharts.setOptions({
    lang: {
        decimalPoint: ',',
        thousandsSep: '.'
    },

    tooltip: {
        valueDecimals: 2 
    }
});
// Chart de Ingresos
Highcharts.chart('container_ingresos', {
    chart: {
        type: 'column',
    },
    title: {
        text: 'Información General de Ingresos'
    },
    subtitle: {
        text: 'Click para Ver Detalles'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
    	min: 0,
        title: {
            text: 'Total'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: 'RD$ {point.y:.1f} '
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>RD$ {point.y:.2f}</b> en Total<br/>'

    },

    series: [
        {
            name: "Ingresos",
            colorByPoint: true,
            data: [
				
   				<?php while ($row = $run->fetch_object()) { ?>
                {
                    name: '<?php echo $row->mes; ?>',
                    y: <?php echo ($row->res)+0; ?>,
					y: <?php echo ($row->res)+0; ?>,
                    drilldown: "<?php echo $row->mes; ?>"
                },
   				<?php } ?>
            	]
        }
    ],
    drilldown: {
        series: [
			<?php while ($row = $ran->fetch_object()) { ?>
            {
                name: '<?php echo $row->mes; ?>',
                id: '<?php echo $row->mes; ?>',
                data: [
                    [
                        "Interes",
                        <?php echo $row->sum_interes; ?>
                    ],
					[
                        "Mora",
                        <?php echo $row->sum_mora; ?>
                    ],
                ]
            },
			<?php } ?>
        ]
    }
});
		
//Capital 

Highcharts.chart('container_capital', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'Flujo de Capital Empresarial'
  },
  xAxis: {
    categories: [
      <?php while ($row = $riin->fetch_object()) { 
			echo "'".$row->mes."',";
		}?>
    ],
    crosshair: true
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Total'
    }
  },
  tooltip: {
    headerFormat: '<p style="font-size:12px">{point.key}</p><table style="width:100px;">',
    pointFormat: '<tr><td style="font-size:12px; color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="font-size:11px; padding:0"><b>RD$ {point.y:.1f}</b></td></tr>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
  },
  plotOptions: {
    column: {
      pointPadding: 0.2,
      borderWidth: 0
    }
  },
  series: [{
    name: 'Prestado',
    data: [
		<?php while ($row = $rion->fetch_object()) { 
			echo $row->prestado.",";
		}?>
	],
	color:"#ff6868"

  }, {
    name: 'Pagado',
    data: [
		<?php while ($row = $riun->fetch_object()) { 
			echo $row->devuelto.",";
		}?>
	],
	color:"#69c278"

  }]
});
// Chart de Cobrados
Highcharts.chart('container_cobrados', {
    chart: {
        type: 'column',
    },
    title: {
        text: 'Información General de Cobrados'
    },
    subtitle: {
        text: 'Click para Ver Detalles'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
    	min: 0,
        title: {
            text: 'Total'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: 'RD$ {point.y:.1f} '
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>RD$ {point.y:.2f}</b> en Total<br/>'
    },

    series: [
        {
            name: "Cobrados",
            colorByPoint: true,
            data: [
				
   				<?php while ($row = $row_cobradox->fetch_object()) { ?>
                {
                    name: '<?php echo $row->mes; ?>',
                    y: <?php echo $row->res2; ?>,
					y: <?php echo $row->res2; ?>,
                    drilldown: "<?php echo $row->mes; ?>"
                },
   				<?php } ?>
            	]
        }
    ],
    drilldown: {
        series: [
			<?php while ($row = $row_cobrados->fetch_object()) { ?>
            {
                name: '<?php echo $row->mes; ?>',
                id: '<?php echo $row->mes; ?>',
                data: [
					[
                        "Capital",
                        <?php echo $row->sum_capital; ?>
                    ],
                    [
                        "Interes",
                        <?php echo $row->sum_interes; ?>
                    ],
					[
                        "Mora",
                        <?php echo $row->sum_mora; ?>
                    ],
                ]
            },
			<?php } ?>
        ]
    }
});	
	
$(document).ready(function(){
$(".hoverclass tr").click(function(){ window.open($(this).data("href"), '_blank'); });
$("#bsc_general").keyup(function(){
    	var that = this, $allListElements = $('#table_general > tr > td');
    	var $matchingListElements = $allListElements.filter(function(i, li){
        var listItemText = $(li).text().toUpperCase(),searchText = that.value.toUpperCase();
    	return ~listItemText.indexOf(searchText);
    });
    $allListElements.hide();
    $matchingListElements.show();
	});
$("#bsc_general_pendiente").keyup(function(){
    	var that = this, $allListElements = $('#table_general_pendiente > tr > td');
    	var $matchingListElements = $allListElements.filter(function(i, li){
        var listItemText = $(li).text().toUpperCase(),searchText = that.value.toUpperCase();
    	return ~listItemText.indexOf(searchText);
    });
    $allListElements.hide();
    $matchingListElements.show();
	});
$("#bsc_general_mora").keyup(function(){
    	var that = this, $allListElements = $('#table_general_mora > tr > td');
    	var $matchingListElements = $allListElements.filter(function(i, li){
        var listItemText = $(li).text().toUpperCase(),searchText = that.value.toUpperCase();
    	return ~listItemText.indexOf(searchText);
    });
    $allListElements.hide();
    $matchingListElements.show();
	});
$("#bsc_general_atrasado").keyup(function(){
    	var that = this, $allListElements = $('#table_general_atrasado > tr > td');
    	var $matchingListElements = $allListElements.filter(function(i, li){
        var listItemText = $(li).text().toUpperCase(),searchText = that.value.toUpperCase();
    	return ~listItemText.indexOf(searchText);
    });
    $allListElements.hide();
    $matchingListElements.show();
	});
$("#bsc_general_legal").keyup(function(){
    	var that = this, $allListElements = $('#table_general_legal > tr > td');
    	var $matchingListElements = $allListElements.filter(function(i, li){
        var listItemText = $(li).text().toUpperCase(),searchText = that.value.toUpperCase();
    	return ~listItemText.indexOf(searchText);
    });
    $allListElements.hide();
    $matchingListElements.show();
	});
$("#bsc_general").keyup(function(){
    	var that = this, $allListElements = $('#table_general > tr > td');
    	var $matchingListElements = $allListElements.filter(function(i, li){
        var listItemText = $(li).text().toUpperCase(),searchText = that.value.toUpperCase();
    	return ~listItemText.indexOf(searchText);
    });
    $allListElements.hide();
    $matchingListElements.show();
	});
});
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-ac3xmSzZIrXLNF-46hKymj56tKQH-s0&callback=initMap"></script>
<?php 
	}else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } include_once("header/footer.php");  ?>