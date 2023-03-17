<?php
if(isset($_GET['negocio'])){
require_once('../config/db.php');
$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
$negocio = $_GET['negocio'];
$tipo_negocio = $_GET['tipo_negocio'];
	
$query = "SELECT clt.id_cliente as id_cliente_p,CONCAT(clt.nombre,' ',clt.apellido) AS cliente, prt.* FROM prestamo AS prt 
INNER JOIN clientes AS clt ON prt.id_cliente = clt.id_cliente
WHERE clt.negocio = $negocio and prt.tipo_prestamo = '$tipo_negocio' 
GROUP BY prt.id_prestamo";
	
$run = $con->query($query);
header('Content-type: application/excel');
$filename = "Backup  $tipo_negocio.xls";
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
<tr style='text-align:center;background-color:#B0E0E6'>
	<td>ID Cliente</td>
	<td>Cliente</td>
	<td>Tipo Prestamo</td>
	<td>Cuotas</td>
	<td>Tipo Interes</td>
	<td>Interes</td>
	<td>Ciclo Pago</td>
	<td>Fecha Creado</td>
	<td>Capital Inicial</td>
	<td>Capital Pendiente</td>
	<td>Estado</td>
	<td>Proximo Pago</td>
</tr>";
if ($run->num_rows >= 1) {
   $i = 1;
   while($row = $run->fetch_object()){
  
$data .= 
"<tr>
	<td>$row->id_cliente_p</td>
	<td>$row->cliente</td>
	<td>$row->tipo_prestamo</td>
	<td>$row->cuota</td>
	<td>$row->tipo_interes</td>
	<td>$row->interes</td>
	<td>$row->ciclo_pago</td>
	<td>$row->fecha_creado</td>
	<td>$row->capital_inicial</td>
	<td>$row->capital_pendiente</td>
	<td>$row->estado</td>
	<td>$row->proximo_pago</td>
</tr>";
	}
}
$data .= "</table></body></html>";
echo $data;
}
?>