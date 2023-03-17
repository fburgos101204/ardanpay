<?php    
header("Access-Control-Allow-Origin:*");

function parseToXML($htmlStr){
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

$con=mysqli_connect('localhost', 'user_financiera', '*Wb75cz8','xilus_financiera');
$id = 0;

$negocio = $_GET['negocio'];
$query = mysqli_query($con,"SELECT * FROM mensajeros WHERE negocio = $negocio");
header("Content-type: text/xml");
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;

if ($query->num_rows >= 1) {
while ($row = @mysqli_fetch_array($query)){

  echo '<marker ';
	
  echo 'dispositivo="' . $row['dispositivo'] . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['lng'] . '" ';
  echo 'name="'.$row['nombre'] . '" ';
  echo 'apellido="'.$row['apellido'] . '" ';
  echo 'id_mensajero="'.$row['id_mensajero'] . '" ';
  echo '/>';

  $ind = $ind + 1;
}

echo '</markers>';
}

?>