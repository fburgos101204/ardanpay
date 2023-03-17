<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('config/db.php');
//ob_start();  
include_once("header/header.php");

error_reporting(E_ALL);
?>

<style>
	body{
		background-color: white !important;
	}

	.col-sm-6 {
		-webkit-box-flex: 0;
    	-ms-flex: 0 0 50%;
    	flex: 0 0 50%;
    	max-width: 50%;
	}


@media (max-width: 575.98px) { 
/*
	.col-sm-6 {
		-webkit-box-flex: 0 !important;
    	-ms-flex: 0 0 50% !important;
    	flex: 0 0 50% !important;
    	max-width: 50% !important;
	}
*/
	.row {
		border-top: none !important; 
		padding: 0 !important;
	}

	.titulm, .txtm {
	  text-align: center !important;
	  margin: 0px 20px;
	  padding-top: 15px !important;
	  padding-left: 0px !important;
	  padding-right: 0px !important;
	}

	.snd {
    	display: block;
    }


 }


@media (max-width: 767.98px) { 

	.row {
		border-top: none !important; 
		padding: 0 !important;
	}
    
    
	
	.titulm, .txtm {
	  text-align: center !important;
	  margin: 0px 20px;
	  padding-top: 15px !important;
	  padding-left: 0px !important;
	  padding-right: 0px !important;
	}

	.snd {
    	display: block;
    }


 }

.snd {
  display: none;
}

@media only screen and (767.98px) {
  .snd {
    display: block;
  }
}

@media only screen and (max-width: 575.98px) {
  .snd {
    display: block;
  }
}

</style>

<?php 
$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$tipo = $_GET['tpd'];

if($tipo == "Prestamo Vehiculo"){
	$query = "SELECT CONCAT(clt.nombre, ' ', clt.apellido) as cliente,hpt.* FROM historial_pagos as hpt 
			LEFT JOIN prestamo as prt on hpt.id_prestamo = prt.id_prestamo 
			LEFT JOIN vehiculo as vhl on prt.id_cliente = vhl.id_vehiculo
			LEFT JOIN clientes as clt on vhl.id_cliente = clt.id_cliente
			WHERE hpt.id_historial =".$_GET['id_historial'];
	
}else if($tipo == "Prestamo Personal" || $tipo == "Acuerdo de Pago"){
	$query = "SELECT CONCAT(clt.nombre, ' ', clt.apellido) as cliente,hpt.* FROM historial_pagos as hpt 
			INNER JOIN prestamo as prt on hpt.id_prestamo = prt.id_prestamo 
			INNER JOIN clientes as clt on prt.id_cliente = clt.id_cliente
			WHERE hpt.id_historial =".$_GET['id_historial'];
}
$rows = $con->query($query); 
	if ($rows->num_rows >= 1) {
		while($row = $rows->fetch_object()){ 
			if ($row->total_pagado == 0) {
				$total_pagado = $row->capital;
			}else{
				$total_pagado = $row->total_pagado;
			}
?>

<script>
	$(document).ready(function(){
		var  valor = NumeroALetras('<?php echo $total_pagado; ?>');
    	$("#resultado").html(valor);
		
	});
</script>

<div class="form-row" style="padding-left: 4%;padding-right: 4%;background-color:white;margin-left: 10%;margin-right: 10%;margin-top:10px;border-radius: 10px;border:1px solid black;">

	<table style="width:100% !important;margin-bottom: 30px">
		<tr>
			<th rowspan="3">
				<img width="140"src="<?php echo $logo; ?>" alt="" style="margin-top: 10px;">
			</th>
		</tr>
		<tr>
			<th style="text-align: right;padding-right: 25px">No. Recibo: 
				<span style="border-bottom: 1px black solid;font-weight: 100;">
					<?php echo $row->id_historial; ?>	    
				</span>
			</th>
		</tr>
        <tr>
        	
        </tr>
	</table>

	<table class="table" style="margin-left:2%;width:100% !important;margin-bottom: 30px">

		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

			<div class="row" style="border-top: 1px solid #ccc; padding: 7px 0;">
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 font-weight-bold">RNC:</div>
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6"><?php echo $rnc; ?></div>				
					</div>	
				</div>

				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 font-weight-bold">Teléfono:</div>
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6"><?php echo $telefono_empresa; ?></div>	
					</div>	
				</div>

				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 font-weight-bold">Correo:</div>
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6"><?php echo $correo; ?></div>	
					</div>	
				</div>
			</div>	

			<div class="row" style="border-top: 1px solid #ccc; padding: 7px 0;">
				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 font-weight-bold">Representante</div>
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6"><?php echo $usuario; ?></div>	
					</div>	
				</div>

				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 font-weight-bold">Dirección</div>
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6"><?php echo $direccion; ?></div>
					</div>	
				</div>

				<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 font-weight-bold">Fecha:</div>
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6"><?php echo date("Y-m-d"); ?></div>	
					</div>	
				</div>
			</div>	

		</div>

	</table>



	<table style="width:100% !important;">

		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

			<div class="row" style="margin-bottom: 15px">
				<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="row">
						<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 font-weight-bold titulm">Nombre:</div>
						<div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 txtm" style="border-bottom:1px solid black; padding-top: 20px;"><?php echo $row->cliente; ?></div>	
					</div>	
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="row">
						<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 font-weight-bold titulm" style="padding-top: 20px; padding-left: 40px;">Concepto:</div>
						<div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 txtm" style="border-bottom:1px solid black; text-align: center; padding-top: 20px;">(<?php echo $cuotas = $row->concepto; ?>)</div>
					</div>	
				</div>
			</div>

			<div class="row" style="margin-bottom: 15px">
				<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="row">
						<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 font-weight-bold titulm" style="padding-top: 20px;">Monto:</div>
						<div class="col-sm-10 col-md-10 col-lg-10 col-xl-10 txtm" style="border-bottom:1px solid black; padding-top: 20px;"><span id="resultado"></span></div>	
					</div>	
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="row">
						<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 font-weight-bold titulm" style="padding-top: 20px; padding-left: 40px;">Cargo:</div>
						<div class="col-sm-10 col-md-10 col-lg-10 col-xl-10 txtm" style="border-bottom:1px solid black; text-align: center; padding-top: 20px;">RD$ <?php echo number_format($total_pagado,'2'); ?></div>
					</div>	
				</div>
			</div>

		</div>

	</table>












	<table class="table" style="margin-left:2%;width:100% !important;margin-bottom: 30px; display: none;">
		<tr>
			<th>RNC:</th>
			<td><?php echo $rnc; ?></td>

			<th>Teléfono:</th>
			<td><?php echo $telefono_empresa; ?></td>

			<th>Correo:</th>
			<td><?php echo $correo; ?></td>
		</tr>
		<tr>
			<th>Representante</th>
			<td><?php echo $usuario; ?></td>

			<th>Dirección</th>
			<td><?php echo $direccion; ?></td>

			<th>Fecha:</th>
			<td><?php echo date("Y-m-d"); ?></td>
		</tr>
	</table>




	<table style="width:100% !important; display: none;">
		<tr style="margin-bottom: 15px">
			<th style="text-align: center;">Nombre:</th>
			<td style="border-bottom:1px solid black;">
				<?php echo $row->cliente; ?>
			</td>
			<th style="text-align: center;">Concepto:</th>
			<td style="border-bottom: 1px black solid;text-align: center;">
				(<?php echo $cuotas = $row->concepto; ?>)
			</td>
		</tr>
		<tr>
			<th style="text-align: center;padding-top: 20px">Monto:</th>
			<td style="border-bottom: 1px black solid;padding-top: 20px">
				<span id="resultado"></span>
			</td>
			<th style="text-align: center;padding-top: 20px">Cargo:</th>
			<td style="border-bottom: 1px black solid;padding-top: 20px;text-align: center;">
			    RD$ <?php echo number_format($total_pagado,'2'); ?>	
			</td>
		</tr>
	</table>

	<div class="form-group" style="border: 1px solid black;width: 100%;margin-top: 30px; text-align: center;">
		<h4 style="padding: 20px;">
			<td><?php echo  $cuotas; ?>  Correspondiente a la fecha <?php print(date("Y-m-d",strtotime($row->fecha))); ?></td>
		</h4>
	</div>
	<div class="form-group col" ></div>
</div>



<center>
<a href="com.fidelier.printfromweb://
$bighw$  <?php echo 'CE SOLUCIONES'; ?>$intro$
$bigh$       Recibo: <?php echo $row->id_historial; ?>$intro$
$bigh$       Fecha: <?php echo date('d-m-Y'); ?>$intro$
$bigh$       Hora: <?php echo date('h:i:s a'); ?>$intro$
--------------------------------
$bigh$Usuario: <?php echo $usuario ?>$bigh$$intro$
$bigh$Cliente: <?php echo $row->cliente; ?>$bigh$$intro$
$bigh$RNC: <?php echo $rnc; ?>$bigh$$intro$
$bigh$Tel: <?php echo $telefono_empresa; ?>$bigh$$intro$
$bigh$Correo: <?php echo $correo; ?>$bigh$$intro$
--------------------------------
$bigh$Cargo: <?php echo number_format($total_pagado,'2');?>$bigh$$intro$
$bigh$Concepto: <?php echo $cuotas = $row->concepto; ?>$bigh$$intro$
--------------------------------
$bigh$Sub-total: $smallh$RD$ <?php echo number_format($total_pagado,'2'); ?>$intro$
$bigh$Total: $smallh$RD$ <?php echo number_format($total_pagado,'2'); ?>$intro$$intro$
$smallh$<?php echo $direccion; ?>$smallh$$intro$
$bigh$        *<?php echo $telefono_empresa; ?>*$intro$$intro$$cut$ $cut$$intro$$intro$" class="btn btn-success btn-lg btn-d flotante-l snd" id="enviar"  style="margin-bottom: 10px;margin-top: 10px;width: 50%;height: 100%;background-color: lightgreen;">
<img src="impresora.svg" style="width: 20%"></a>
</center>



<!--<center style="display: none;">
<button  onclick="window.print();" style="margin-bottom: 10px;margin-top: 10px;width: 50%;height: 100%;background-color: lightgreen;" class="form-control printl">
	<img src="impresora.svg" style="width: 20%">
</button>
</center>-->
<script src="js/txt.js"></script>
<?php
}}
/*
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->set_paper('landscape');
$dompdf->set_option('defaultFont', 'Courier');
$dompdf->render();
$pdf = $dompdf->output();
$dompdf->stream("example.pdf", array("Attachment"=>0)); 
*/
?>