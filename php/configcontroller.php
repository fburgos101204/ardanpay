<?php 
if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new ConfigController();

	$empresa = (isset($_POST['empresa'])) ? $_POST['empresa'] : "";
	$rnc = (isset($_POST['rnc'])) ? $_POST['rnc'] : "";
	$mora_config = (isset($_POST['mora_config'])) ? $_POST['mora_config'] : "";
	$correo = (isset($_POST['correo'])) ? $_POST['correo'] : "";
	$telefono = (isset($_POST['telefono_empresa'])) ? $_POST['telefono_empresa'] : "";
	$id_negocio = (isset($_POST['id_negocio'])) ? $_POST['id_negocio'] : "";
	$barcolor = (isset($_POST['barcolor'])) ? $_POST['barcolor'] : "black";
	$fontcolor = (isset($_POST['fontcolor'])) ? $_POST['fontcolor'] : "black";
	$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : "";
	$tipo_mora = (isset($_POST['tipo_mora'])) ? $_POST['tipo_mora'] : "";
	

	$dir = "../files/empresa";

	if(!is_dir($dir))
	{
    	mkdir($dir,0777, true);
	}

	/*FOTOS Y DOCUMENTOS*/
	$tmp_name = (isset($_FILES["archivo"]["tmp_name"])) ?  $_FILES['archivo']["tmp_name"] : "";

  	$name = (isset($_FILES["archivo"]["name"])) ?  $_FILES['archivo']["name"] : $_POST['aux_img'];

	$direct = "files/empresa";
  	$path = $dir."/".$name;


  	if (move_uploaded_file($tmp_name,$path)) { 
  		$path_save = $direct."/".$name;
  	}
  	else
  	{
  		$path_save = $name;
  	}

  	$class->actualizar_empresa($id_negocio,$empresa,$path_save,$rnc,$telefono,$correo,$direccion,$mora_config,$barcolor,$fontcolor,$tipo_mora);




}
else
{
	require_once('config/db.php');
}
class ConfigController
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function actualizar_empresa($id_negocio,$empresa,$logo,$rnc,$telefono,$correo,$direccion,$mora_config,$barcolor,$fontcolor,$tipo_mora)
	{
		$query = "UPDATE configuracion SET empresa='$empresa', logo='$logo',rnc='$rnc',telefono='$telefono',correo='$correo',direccion='$direccion', mora=$mora_config, barcolor = '$barcolor',font='$fontcolor',tipo_mora=$tipo_mora WHERE id_negocio = $id_negocio";
		$run = $this->db_connection->query($query);
		echo $query;
	}

}


?>