<?php 
if (isset($_POST['proceso'])) {
  require_once('../config/db.php');
  $class = new Alert_Controller();
  if(isset($_POST['creador']))
  {
    $creador = $_POST['creador'];
    $run = $class->read_all($creador);
    if ($run->num_rows  >= 1) { ?>
	  <!--<audio autoplay>
 	   <source src="alerta.mp3" type="audio/mp3">
	  </audio>-->
    <?php while($row = $run->fetch_object()){ ?>
      <a class="dropdown-item" href="solicitud_prestamo.php">Prestamo de <?php echo $row->cliente ?> Modificado</a>
  <?php } 
  }
  }else if (isset($_POST['inspector'])) {
    $run = $class->read_admin($_POST['inspector']);
    if ($run->num_rows  >= 1) {
    while($row = $run->fetch_object()){ ?>
      <a class="dropdown-item" href="solicitud_prestamo.php">Prestamo de <?php echo $row->cliente ?> Pendiente</a>
<?php }}
}
}
else
{
  require_once("config/db.php");
}
class Alert_Controller
{
  
  function __construct()
  {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $conn;
  }

  public function change_status($creador,$id_alert,$estatus)
  {
    $query = "CALL change_status($id_alert,'$estatus',$creador)";
    $run = $this->db_connection->query($query);
    echo $query;
  }
  public function read_all($creador)
  {
    $query = "SELECT sl.*,CONCAT(ctl.nombre,' ',ctl.apellido) as cliente FROM solicitud_prestamo as sl
            INNER JOIN clientes AS ctl ON sl.id_cliente = ctl.id_cliente
            WHERE sl.creador = $creador AND (sl.estado = 'Modificado' OR sl.estado = 'Validado')";
    $run = $this->db_connection->query($query);
        return $run; 
  }
  public function read_admin($id_negocio)
  {
    $query = "SELECT sl.*,CONCAT(ctl.nombre,' ',ctl.apellido) as cliente FROM solicitud_prestamo as sl
            INNER JOIN clientes AS ctl ON sl.id_cliente = ctl.id_cliente
            WHERE sl.estado = 'Revisar' and ctl.negocio = $id_negocio";
    $run = $this->db_connection->query($query);
    return $run; 
  }
}
?>