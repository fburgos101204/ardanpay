
<?php 
if (isset($_POST['proceso'])) {
	require_once('../config/db.php');
	$class = new Historial_Solicitud();
	/*********PRESTAMO***********/
	$proceso = $_POST['proceso'];
	if ($proceso == "historial") {
		$id_cliente = $_POST['id_cliente'];
		$rows = $class->read_historial($id_cliente);
    	if ($rows->num_rows >= 1) {
    		while($row = $rows->fetch_object()){ ?>
	

			<div class="row">
				<div class="col-md-4">
				        <img style="border-radius: 10px; margin: 0 auto 20px auto; display: block;" src="<?php
				        if(strlen($row->path_img_cliente) != 0){
				        	echo str_replace("../","",$row->path_img_cliente);
				        }else{
				        	echo "files/logo_user.jpg";
				        }  ?>" class="img_solicitud">
				</div>
				<div class="col-md-4">
						<label><span class="font-weight">Cliente: </span>
						<?php echo $row->nombre." ".$row->apellido; ?></label>
						<br>
						<label><span class="font-weight">Cédula: </span>
						<?php if (strlen($row->path_cedula) != 0){ ?>
							<a target="_bank" href="<?php echo str_replace("../","",$row->path_cedula); ?>"><?php echo $row->cedula; ?></a>
						<?php }else{ echo $row->cedula; } ?>
						</label>
						<br>
						<label><span class="font-weight">Nacionalidad: </span>
						<?php echo $row->nacionalidad; ?></label>
						<br>
						<label><span class="font-weight">Telefono: </span>
						<?php echo $row->telefono; ?></label>
						<br>
						<label><span class="font-weight">Celular: </span>
						<?php echo $row->celular; ?></label>
						<br>
						
						<label><span class="font-weight">Dirección: </span>
						<?php echo $row->direccion; ?></label>
				</div>
				<div class="col-md-4">
						<label><span class="font-weight">Correo: </span>
						<?php echo $row->correo; ?></label>
						<label><span class="font-weight">F. Nacimiento: </span>
						<?php echo $row->fecha_nacimiento; ?></label>
						<br>
						<label><span class="font-weight">Sexo: </span>
						<?php echo $row->sexo; ?></label>
						<br>
						<label><span class="font-weight">Estado Civil: </span>
						<?php echo $row->estado_civil; ?></label>
						<br>
						<label><span class="font-weight">Mayor Titulo: </span>
						<?php echo $row->titulo; ?></label>
						

				</div>
			</div>

 			<hr>

			<div class="row">
				<div class="col-md-4">
					<label><span class="font-weight">Tipo de Vivienda: </span>
					<?php echo $row->tipo_vivienda; ?></label>
					<br>
					<label><span class="font-weight">Ocupación: </span>
					<?php echo $row->ocupacion; ?></label>
					<br>
				</div>
				<div class="col-md-4">
					<label><span class="font-weight">Facebook: </span>
					<?php echo $row->facebook; ?></label>
					<br>
					<label><span class="font-weight">Instagram: </span>
					<?php echo $row->instagram; ?></label>
				</div>
				<div class="col-md-4">
					<label><span class="font-weight">Dependiente: </span>
					<?php echo $row->dependientes; ?></label>
					<br>
					<label><span class="font-weight">Ingresos: </span>RD$ 
					<?php echo number_format($row->ingreso,"2"); ?></label>
				</div>
		</div>
<?php }
    }
	}else if($proceso == "update_estado")
	{
		$id_solicitud = $_POST['id_solicitud_'];
		$monto = $_POST['monto_valida'];
		$cuotas = $_POST['cuotas_valida'];
		$ciclo = $_POST['ciclo_pago_valida'];
		$estado = $_POST['estado_valida'];

		$fecha_creacion = $_POST['fecha_creacion'];
		
		$interes = $_POST['interes_valida'];
		$t_interes = $_POST['t_interes_valida'];
		$fecha = $_POST['fecha_valida'];

		$id_cliente_solicitud = $_POST['id_cliente_solicitud'];

		$result = $class->update_estado($id_solicitud,$id_cliente_solicitud,$monto,$cuotas,$ciclo,$interes,$t_interes,$fecha,$estado,$fecha_creacion);
		if ($estado == "Aceptado") {
			if ($result->num_rows >= 1) {
    			while($row = $result->fetch_object()){ 
    				echo $row->id_prestamo_vuelta;
    			}}
		}
	}else if($proceso == "update_prestamo")
	{
		$id_solicitud = $_POST['id_solicitud'];
		$id_prestamo = $_POST['id_prestamo'];
		$tipo_interes = $_POST['tipo_interes'];
		$interes = $_POST['interes'];
		$class->update_prestamo($id_solicitud,$id_prestamo, $tipo_interes,$interes);
		

	}
}
else
{
	require_once('config/db.php');
}
class Historial_Solicitud
{
	public function __construct()
	{
		$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->db_connection = $con;
	}

	public function read_historial($id_cliente)
	{
		$query = "SELECT clt.*, ref.nombre as nombreref, ref.telefono as telefonoref, ref.parentesco, ref.tipo_ref FROM clientes as clt
		LEFT JOIN referencias as ref on clt.id_cliente = ref.id_cliente
		WHERE clt.id_cliente=$id_cliente
		GROUP BY clt.id_cliente";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function solicitudes($id,$tipo)
	{
		if ($tipo != 'negocio') { $creador = "AND sp.creador = $id"; }
		else if ($tipo == 'negocio') { $creador = "AND clt.negocio = $id"; }
				 
		$query = "SELECT prt.fecha_creado,rtsptr.codigo as codigo_metodo,rtsptr.id_metodo,rtsptr.metodo,sp.id_solicitud, prt.id_prestamo, rf.id_ref,rf.nombre as nombre_ref, rf.telefono as telefono_ref, rf.tipo_ref, rf.parentesco,sp.*,CONCAT(urs.firstname, ' ', urs.lastname) as creador_name, clt.* FROM solicitud_prestamo as sp
			INNER JOIN clientes as clt on sp.id_cliente = clt.id_cliente
			LEFT JOIN referencias as rf on clt.id_cliente = rf.id_cliente
			INNER JOIN users as urs on clt.creador = urs.user_id
			LEFT JOIN prestamo as prt on sp.id_solicitud = prt.id_solicitud
            LEFT JOIN retiros_prestamo AS rtsptr ON prt.id_prestamo = rtsptr.id_prestamo
			WHERE sp.estado != 'Listo' $creador
			GROUP BY sp.id_solicitud";
		$run = $this->db_connection->query($query);
		return $run;
	}

	public function update_prestamo($id_solicitud,$id_prestamo, $tipo_interes,$interes)
	{
		$query = "UPDATE solicitud_prestamo SET estado = 'Listo' WHERE id_solicitud = $id_solicitud";
		$run = $this->db_connection->query($query);
		echo $query;
		$query = "UPDATE prestamo SET tipo_interes = '$tipo_interes', interes = $interes WHERE id_prestamo = $id_prestamo";
		$run = $this->db_connection->query($query);
		echo $query;
	}

	public function update_estado($id_solicitud,$id_cliente_solicitud,$monto,$cuotas,$ciclo,$interes,$t_interes,$fecha,$estado,$fecha_creacion)
	{
		$query = "UPDATE solicitud_prestamo SET monto=$monto, cuotas=$cuotas,ciclo_pago=$ciclo,estado = '$estado',t_interes='$t_interes', interes=$interes,fecha_inicio='$fecha'
					WHERE id_solicitud=$id_solicitud";
		$run = $this->db_connection->query($query);
		if ($estado == "Aceptado") {
			$select = "SELECT * FROM prestamo WHERE id_solicitud=$id_solicitud";
			$run = $this->db_connection->query($select);
			if ($run->num_rows == 0) {
				$query = "INSERT INTO prestamo (id_solicitud,id_cliente,cuota,ciclo_pago,interes,tipo_interes,fecha,fecha_aux,proximo_pago,capital_inicial,capital_pendiente,estado,fecha_creado)
						VALUES($id_solicitud,$id_cliente_solicitud,$cuotas,'$ciclo',$interes,'$t_interes','$fecha','$fecha','$fecha',$monto,$monto,'Al Dia','$fecha_creacion')";
				$run = $this->db_connection->query($query);
				$select = "SELECT LAST_INSERT_ID() as id_prestamo_vuelta";
				$run = $this->db_connection->query($select);
				return $run;
			}
		}
	}


	public function Delete($id)
	{
		$query = "DELETE FROM cobro WHERE id_prestamo=".$id;
		$run = $this->db_connection->query($query);
		$query = "DELETE FROM prestamo WHERE id_prestamo=".$id;
		$run = $this->db_connection->query($query);
	}

}


?>