<?php
if(isset($_GET['negocio'])){
require_once('config/db.php');
$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
$negocio = $_GET['negocio'];
$query = "SELECT prt.id_prestamo,CONCAT(clt.nombre,' ',clt.apellido) as cliente,clt.cedula,clt.direccion,clt.telefono,clt.celular,prt.fecha_creado,
prt.capital_inicial,amrt.monto_pagar as balance_al_dia,htp.fecha as ultimo_pago,prt.fecha, prt.capital_pendiente,prt.estado,prt.ciclo_pago,prt.cuota FROM clientes AS clt
LEFT JOIN prestamo AS prt ON clt.id_cliente = prt.id_cliente 
LEFT JOIN amortizacion AS amrt ON prt.id_prestamo = amrt.id_prestamo 
LEFT JOIN historial_pagos AS htp ON prt.id_prestamo = htp.id_prestamo 
WHERE clt.negocio = $negocio and prt.estado != 'Cancelado'
GROUP BY prt.id_prestamo 
ORDER BY prt.id_prestamo ASC,htp.fecha DESC";
	
$run = $con->query($query);
header('Content-type: application/excel');
$filename = 'datacredito.xls';
header("Content-Disposition: attachment; filename=$filename");

$data = "<html xmlns:x='urn:schemas-microsoft-com:office:excel'>
<head>
    <!--[if gte mso 9]>
    <xml>
        <x:ExcelWorkbook>
            <x:ExcelWorksheets>
                <x:ExcelWorksheet>
                    <x:Name>Sheet 1</x:Name>
                    <x:WorksheetOptions>
                        <x:Print>
                            <x:ValidPrinterInfo/>
                        </x:Print>
                    </x:WorksheetOptions>
                </x:ExcelWorksheet>
            </x:ExcelWorksheets>
        </x:ExcelWorkbook>
    </xml>
    <![endif]-->
</head>
<body>
<table border='1' width='100%' cellpadding='5'>
<tr style='text-align:center;'>
	<th style='background:yellow;'>NOMBRE</th>
	<th style='background:yellow;'>CEDULA-RNC</th>
	<th style='background:gray'>DIRECCION</th>
	<th style='background:gray'>TELEFONO 1</th>
	<th style='background:gray'>TELEFONO 2</th>
	<th style='background:yellow'>NUMERO DE CUENTA</th>
	<th style='background:yellow'>FECHA APERTURA</th>
	<th style='background:yellow'>MONTO FORMALIZADO</th>
	<th style='background:#B22222'>ESTATUS</th>
	<th style='background:#B22222'>BALANCE AL DIA</th>
	<th style='background:#B22222'>MONTO EN ATRASO</th>
	<th style='background:#B22222'>FECHA ULTIMO PAGO</th>
	<th style='background:#B22222'>FECHA DE VENCIMIENTO</th>
</tr>";
if ($run->num_rows >= 1) {
   $i = 1;
   while($row = $run->fetch_object()){
   $cap_incial = number_format($row->capital_inicial);
   $cap_pendiente = number_format($row->capital_pendiente);
	   
	$dias = ($row->ciclo_pago) * ($row->cuota);
	$fecha_actual = date($row->fecha_creado);
	$fecha_vence = date("Y-m-d",strtotime($fecha_actual."+ $dias days"));
	   
   if($row->capital_pendiente == 0){ $estado = "S"; }
   else if($row->estado == "Asunto Legal"){ $estado = "L"; }
   else if($row->estado == "Atrasado"){ $estado = "A"; }
   else{ $estado = "N"; }
   if($estado == "A"){ $cap_pend = 0; }else{ $cap_pend = $cap_pendiente; $cap_pendiente = 0;}
   $cuenta = $i."A";
   $i++;
$data .= 
"<tr>
	<td>$row->cliente</td>
	<td>$row->cedula</td>
	<td>$row->direccion</td>
	<td>$row->telefono</td>
	<td>$row->celular</td>
	<td>$cuenta</td>
	<td>$row->fecha_creado</td>
	<td>$cap_incial</td>
	<td>$estado</td>
	<td>$cap_pend</td>
	<td>$cap_pendiente</td>
	<td>$row->fecha</td>
	<td>$fecha_vence</td>
</tr>";
	}
}
$data .= 
"</table>
</body>
</html>";
echo $data;

}
?>