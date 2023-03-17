<?php 
if(isset($_POST['negocio']))
{
	header("Content-Type: text/plain; charset=iso-8859-1");
 	$negocio = urldecode($_POST['negocio']);
	$htmls = '<p>Rep&uacute;blica Dominicana, $fecha_creado</p>

				<p>&nbsp;</p>

				<p>El prestador&nbsp;<strong>$PrestadorNombre</strong>, mayor de edad, estudiante, provisto de la Cedula de Identidad y Electoral No. $RNC, domiciliado y residente en $PrestadorDireccion, entrega la cantidad de $MontoPrestamo, por concepto de un pr&eacute;stamo personal; al beneficiario $ClienteInfo, dicho pr&eacute;stamo se lleva a cabo bajo las siguientes condiciones.</p>

				<p><strong>PRIMERO:</strong>&nbsp;que la suma adeudada ser&aacute; pagada por el deudor en un plazo de $PlazoPrestamo, pudiendo el deudor realizar el pago total si lo estima conveniente a un inter&eacute;s de un $Interes, a partir de la fecha del presente contrato sin interrupci&oacute;n ni retardo alguno;&nbsp;<strong>SEGUNDO:</strong>&nbsp;que para garant&iacute;a y fiel cumplimiento del presente contrato el deudor compromete y afecta en favor del acreedor la universalidad de todos sus bienes presentes y futuros, tanto muebles como inmuebles, quedando los mismos afectados hasta el fiel cumplimiento de la mencionada deuda;&nbsp;<strong>TERCERO:</strong>&nbsp;el deudor reconoce que a falta de pago de la referida deuda establecida en el presente pagar&eacute;, 5 d&iacute;as despu&eacute;s del vencimiento de este, el deudor pagar&aacute; una mora de un $MoraInteres quedando establecido de manera expresa, que a falta de pago de tres mensualidades consecutivas el presente contrato se har&aacute; ejecutable y exigible al pago de su totalidad.</p>

				<p><br />
				&nbsp;</p>

				<table>
				<tbody>
					<tr>
						<td>
						<p>$NombreCliente $ApellidoCliente</p>

						<p>Deudor</p>
						</td>
						<td>
						<p>$PrestadorNombre</p>

						<p>Acreedor</p>
						</td>
					</tr>
				</tbody>
				</table>';
 	$html = (isset($_POST["html"])) ?  urldecode($_POST['html']) : $htmls;
	
 	$contrato = (isset($_POST["contrato"])) ?  urldecode($_POST['contrato']) : 'contrato_personal';
	
	
	
 	$folder = "../contratos/$negocio/$contrato/";
	if (!file_exists($folder)) {
    	mkdir($folder, 0777, true);
	}
 	$ext = ".html";
 	$file_name = $folder."".$negocio."_".$contrato."".$ext;
 	$edit_file = fopen($file_name, 'w');
 	fwrite($edit_file, $html);
 	fclose($edit_file);
	echo $html;
}
?>