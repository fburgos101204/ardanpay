<?php
if(isset($_GET['negocio'])){
require_once('../config/db.php');
$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
$negocio = $_GET['negocio'];
$query = "SELECT * FROM clientes WHERE negocio = $negocio";
	
$run = $con->query($query);
header('Content-type: application/excel');
$filename = 'backup_clientes.xls';
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
	<th>NOMBRE</th>
	<th>Sexo</th>
	<th>Telefono</th>
	<th>Celular</th>
	<th>Cedula</th>
	<th>Correo</th>
	<th>Direccion</th>
	<th>Fecha Nacimiento</th>
	<th>Estado Civil</th>
	<th>Facebook</th>
	<th>Instagram</th>
	<th>Dependientes</th>
	<th>Titulo</th>
	<th>Ocupacion</th>
	<th>Ingreso</th>
</tr>";
if ($run->num_rows >= 1) {
   $i = 1;
   while($row = $run->fetch_object()){
  
$data .= 
"<tr>
	<td>$row->nombre"." "."$row->apellido</td>
	<td>$row->sexo</td>
	<td>$row->telefono</td>
	<td>$row->celular</td>
	<td>$row->cedula</td>
	<td>$row->correo</td>
	<td>$row->direccion</td>
	<td>$row->fecha_nacimiento</td>
	<td>$row->estado_civil</td>
	<td>$row->facebook</td>
	<td>$row->instagram</td>
	<td>$row->dependientes</td>
	<td>$row->titulo</td>
	<td>$row->ocupacion</td>
	<td>$row->ingreso</td>
</tr>";
	}
}
$data .= "</table></body></html>";
echo $data;
}
?>