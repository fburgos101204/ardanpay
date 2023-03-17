
<nav class="navbar navbar-expand bramain bg-<?php echo $barcolor; ?> static-top">

    <a class="navbar-brand mr-1 text-<?php echo $font; ?> nempr" href="home.php"><?php echo $empresa; ?></a>

    <button class="btn btn-link btn-sm  text-<?php echo $font; ?> order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar -->
    <ul class="navbar-nav ml-auto  ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <?php include('modal/modal_disminuir_mora.php'); ?>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link text-<?php  echo $font; ?>" data-toggle="modal" data-target="#modal_disminuir_mora" href="#" id="messagesDropdown" role="button">
          <i class="fas fa-comments-dollar"></i>
        </a>
        <div id="notificaciones" class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">No hay Notificaciones</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link  dropdown-toggle text-<?php  echo $font; ?>" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span id="cantidad_notificacion" class="badge badge-danger"></span>
          <i class="fas fa-bell fa-fw"></i>
        </a>
        <div id="notificaciones" class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">No hay Notificaciones</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle text-<?php  echo $font; ?>" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i> <?php echo $usuario; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <!--<a class="dropdown-item" href="#">Settings</a>
          <div class="dropdown-divider"></div>-->
          <a class="dropdown-item " href="login.php?logout">Cerrar Sesión</a>
        </div>
      </li>
    </ul>
  </nav>
	
<?php if($negocio !=0 && $fecha_vence_plan < date("Y-m-d")){ ?>
<div align="center" style="color:black;font-weight:bold;
    font-family: verdana,arial;
    font-size: 12pt;
    /* text-align: center; */
    /* padding: 0px 5px 7px 5px; */
    top: 5%;
    left: 5%;
    right: 5%;
    /* margin: 0 auto; */
    width: 100%;
    background-color: #fc6262;
    z-index: 1;
    height: 5%;
    opacity: 0.6;
    line-height: 50px;">Recuerde que debe pagar su servicio, o este sera deshabilitado!</div>
<?php } ?>
  <div id="wrapper">
    <ul class="sidebar navbar-nav navbar-inverse bgx-<?php echo $barcolor; ?> toggled">
		
		
      	<?php  if ($negocio == 0 || $permisos_muestra->{'inicio'} == "on"){ ?>
     	<li class="nav-item <?php echo $active_home.' text-muted'; ?> ">
     	<?php if ($permisos->{'inicio'} == "on"){ ?>
        <a class="nav-link text-<?php if($active_home){ echo $font; } ?>" href="home.php">
	  	<?php }else{ ?>
        <a class="nav-link text-<?php if($active_home){ echo $font; } ?>" href="#" onclick="onload_validar('home')" data-toggle="modal" data-target="#modal_seguridad">
	  <?php } ?><i class="fas fa-home"></i><span> Inicio</span>
        </a>
      	</li>
		<?php } ?>
	  
	  
      	<?php  if ($negocio == 0 || $permisos_muestra->{'sol_prestamo'} == "on"){ ?>
      	<li class="nav-item <?php echo $solicitud_prestamo.' text-muted'; ?>">
      	<?php if ($permisos->{'sol_prestamo'} == "on"){ ?>
        <a class="nav-link text-<?php if($solicitud_prestamo){ echo $font; } ?>" href="solicitud_prestamo.php">
      	<?php }else{ ?>
        <a class="nav-link text-<?php if($solicitud_prestamo){ echo $font; } ?>" href="#" onclick="onload_validar('solicitud_prestamo')" data-toggle="modal" data-target="#modal_seguridad">
		<?php } ?><i class="fas fa-hand-holding-usd"></i><span> Solicitud de Préstamo</span></a>
     	</li>
		<?php } ?>

      	<li class="nav-item dropdown <?php echo $active_prestamo.' text-muted'; ?>">
        <a class="nav-link dropdown-toggle text-<?php if($active_prestamo){ echo $font; } ?>" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-balance-scale"></i><span> Préstamos</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header"> Préstamos</h6>
			
      	  <?php  if ($negocio == 0 || $permisos_muestra->{'prestamo_personal'} == "on"){ ?>
      	  <?php if ($permisos->{'prestamo_personal'} == "on"){ ?>
          <a class="dropdown-item" href="prestamos.php">
		  <?php }else{ ?>
          <a class="dropdown-item"  href="#" onclick="onload_validar('prestamos')" data-toggle="modal" data-target="#modal_seguridad">
		  <?php } ?><i class="fas fa-coins"></i><span> Prést. Personales</span></a>
		  <?php } ?>
	

      	  <?php if ($permisos->{'prestamo_semanal'} == "on"){ ?>
          <a class="dropdown-item" href="prestamos_semanal.php">
		  <?php }else{ ?>
          <a class="dropdown-item"  href="#" onclick="onload_validar('prestamos')" data-toggle="modal" data-target="#modal_seguridad">
		  <?php } ?><i class="fas fa-file-signature"></i><span> Prést. Semanales</span></a>
			  
      	  <?php  if ($negocio == 0 || $permisos_muestra->{'prestamo_inmobilirario'} == "on"){ ?>
      	  <?php if ($permisos->{'prestamo_inmobilirario'} == "on"){ ?>
          <a class="dropdown-item" href="prestamo_inmobilirario.php">
		  <?php }else{ ?>
          <a class="dropdown-item" href="#" onclick="onload_validar('prestamo_inmobilirario')" data-toggle="modal" data-target="#modal_seguridad">
		  <?php } ?><i class="fas fa-hotel"></i><span> Prést. Inmobiliarios</span></a>
		  <?php } ?>
			  
      	  <?php  if ($negocio == 0 || $permisos_muestra->{'prestamo_vehiculo'} == "on"){ ?>
      	  <?php if ($permisos->{'prestamo_vehiculo'} == "on"){ ?>
          <a class="dropdown-item" href="prestamo_vehiculo.php">
		  <?php }else{ ?>
          <a class="dropdown-item" href="#" onclick="onload_validar('prestamo_vehiculo')" data-toggle="modal" data-target="#modal_seguridad">
		  <?php } ?><i class="fas fa-car"></i><span> Prést. Vehículos</span></a>
		  <?php } ?>
        </div>
      	</li>

      <li class="nav-item dropdown <?php echo $active_historia.' text-muted';; ?>">

        <a class="nav-link dropdown-toggle text-<?php if($active_historia){ echo $font; } ?>" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-info-circle"></i><span> Historial</span></a>

        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Hist. Transacciones</h6>
			
      	  <?php  if ($negocio == 0 || $permisos_muestra->{'historial_pago'} == "on"){ ?>
		  <?php if ($permisos->{'historial_pago'} == "on"){ ?>
          <a class="dropdown-item" href="historial_pagos.php">
          <?php }else{ ?>
          <a class="dropdown-item" href="#" onclick="onload_validar('historial_pagos')" data-toggle="modal" data-target="#modal_seguridad">
		  <?php } ?><i class="fas fa-history"></i><span> Historial Pagos</span></a>
		  <?php } ?>
		  
      	  <?php  if ($negocio == 0 || $permisos_muestra->{'historial_retiro'} == "on"){ ?>
		  <?php if ($permisos->{'historial_retiro'} == "on"){ ?>
          <a class="dropdown-item" href="historial_retiros.php">
          <?php }else{ ?>
          <a class="dropdown-item" href="#" onclick="onload_validar('historial_retiros')" data-toggle="modal" data-target="#modal_seguridad">
		  <?php } ?><i class="fas fa-history"></i><span> Historial de Retiros</span></a>
		  <?php } ?>
			  
        </div>
      </li>
		
      
      <li class="nav-item dropdown <?php echo $active_personal.' text-muted';; ?>">

        <a class="nav-link dropdown-toggle text-<?php if($active_personal){ echo $font; } ?>" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-address-book"></i><span> Personal</span></a>
		<div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Registros Personales</h6>
			
      	  <?php  if ($negocio == 0 || $permisos_muestra->{'cliente'} == "on"){ ?>
		  <?php if ($permisos->{'cliente'} == "on"){ ?>
          <a class="dropdown-item" href="cliente.php">
          <?php }else{ ?>
		  <a class="dropdown-item" href="#" onclick="onload_validar('cliente')" data-toggle="modal" data-target="#modal_seguridad">
		  <?php } ?><i class="fas fa-users"></i><span> Clientes</span></a>
		  <?php } ?>
			
      	  <?php  if ($negocio == 0 || $permisos_muestra->{'vehiculo'} == "on"){ ?>
		  <?php if ($permisos->{'vehiculo'} == "on"){ ?>
          <a class="dropdown-item" href="vehiculo.php">
          <?php }else{ ?>
		  <a class="dropdown-item" href="#" onclick="onload_validar('vehiculo')" data-toggle="modal" data-target="#modal_seguridad">
		  <?php } ?><i class="fas fa-car"></i><span> Vehículos</span></a>
		  <?php } ?>
			  
			  
      	  <?php  if ($negocio == 0 || $permisos_muestra->{'inmobilirario'} == "on"){ ?>
		  <?php if ($permisos->{'inmobilirario'} == "on"){ ?>
          <a class="dropdown-item" href="inmobilirario.php">
          <?php }else{ ?>
		  <a class="dropdown-item" href="#" onclick="onload_validar('inmobilirario')" data-toggle="modal" data-target="#modal_seguridad">
		  <?php } ?><i class="fas fa-hotel"></i><span> Inmobiliarios</span></a>
		  <?php } ?>
			  
        </div>
      </li>
			  
	  <li class="nav-item dropdown <?php echo $active_empresa.' text-muted';; ?>">

        <a class="nav-link dropdown-toggle text-<?php if($active_empresa){ echo $font; } ?>" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-sitemap"></i><span> Empresa</span></a>

        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Registros Empresariales</h6>
			  
      	  <?php  if ($negocio == 0 || $permisos_muestra->{'caja'} == "on"){ ?>
		  <?php if ($permisos->{'caja'} == "on"){ ?>
          <a class="dropdown-item" href="caja.php">
          <?php }else{ ?>
		  <a class="dropdown-item" href="#" onclick="onload_validar('caja')" data-toggle="modal" data-target="#modal_seguridad">
		  <?php } ?><i class="fas fa-box-open"></i><span> Cajas</span></a>
		  <?php } ?>
			  
      	  <?php  if ($negocio == 0 || $permisos_muestra->{'banco'} == "on"){ ?>
		  <?php if ($permisos->{'banco'} == "on"){ ?>
          <a class="dropdown-item" href="banco.php">
          <?php }else{ ?>
		  <a class="dropdown-item" href="#" onclick="onload_validar('banco')" data-toggle="modal" data-target="#modal_seguridad">
		  <?php } ?><i class="fas fa-university"></i><span> Bancos</span></a>
		  <?php } ?>
			  
      	  <?php  if ($negocio == 0 || $permisos_muestra->{'mensajero'} == "on"){ ?>
		  <?php if ($permisos->{'mensajero'} == "on"){ ?>
          <a class="dropdown-item" href="mensajero.php">
          <?php }else{ ?>
		  <a class="dropdown-item" href="#" onclick="onload_validar('mensajero')" data-toggle="modal" data-target="#modal_seguridad">
		  <?php } ?><i class="fas fa-biking"></i><span> Mensajeros</span></a>
		  <?php } ?>
			  
      	  <?php  if ($negocio == 0 || $permisos_muestra->{'notario'} == "on"){ ?>
		  <?php if ($permisos->{'notario'} == "on"){ ?>
          <a class="dropdown-item" href="notario.php">
          <?php }else{ ?>
		  <a class="dropdown-item" href="#" onclick="onload_validar('notario')" data-toggle="modal" data-target="#modal_seguridad">
		  <?php } ?><i class="fas fa-gavel"></i><span> Notarios</span></a>
		  <?php } ?>
		  
			  
      	  <?php  if ($negocio == 0 || $permisos_muestra->{'ranking'} == "on"){ ?>
		  <?php if ($permisos->{'ranking'} == "on"){ ?>
          <a class="dropdown-item" href="ranking.php">
          <?php }else{ ?>
		  <a class="dropdown-item" href="#" onclick="onload_validar('ranking')" data-toggle="modal" data-target="#modal_seguridad">
		  <?php } ?><i class="fas fa-star"></i><span> Ranking</span></a>
		  <?php } ?>
			  
      	  <?php  if ($negocio == 0 || $permisos_muestra->{'ruta'} == "on"){ ?>
		  <?php if ($permisos->{'ruta'} == "on"){ ?>
          <a class="dropdown-item"  href="rutas.php">
          <?php }else{ ?>
		  <a  class="dropdown-item" href="#" onclick="onload_validar('rutas')" data-toggle="modal" data-target="#modal_seguridad">
		  <?php } ?><i class="fas fa-road"></i><span> Rutas</span></a>
		  <?php } ?>
			  
        </div>
      </li>
			  
			  
	  <li class="nav-item <?php echo $active_rutas.' text-muted'; ?>">
		
      </li>
		  
      <li class="nav-item <?php echo $active_usuario.' text-muted'; ?>">
        <a class="nav-link text-<?php if($active_usuario){ echo $font; } ?>" href="#" onclick="onload_calculator('','','',30,'Interes Fijo')" data-toggle="modal" data-target="#modal_calculadora">
          <i class="fas fa-calculator"></i><span> Calculadora</span></a>
      </li>
		  
     
		
		
	  <li class="nav-item dropdown <?php echo $active_admin.' text-muted';; ?>">
        <a class="nav-link dropdown-toggle text-<?php if($active_admin){ echo $font; } ?>" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-tools"></i>
		<span> Administración</span></a>

        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
		  
		<h6 class="dropdown-header"> Administración</h6>
			
		<?php if ($permisos->{'configuracion'} == "on"){ ?>
        <a class="dropdown-item" href="metodo_pago.php">
		<?php }else{ ?>
		<a class="dropdown-item" href="#" onclick="onload_validar('metodo_pago')" data-toggle="modal" data-target="#modal_seguridad">
		<?php } ?><i class="fa fa-id-card" aria-hidden="true"></i><span> Tarjeta de Pago</span></a>	
			
		
      	<?php  if ($negocio == 0 || $permisos_muestra->{'usuario'} == "on"){ ?>
		<?php if ($permisos->{'usuario'} == "on"){ ?>
        <a class="dropdown-item" href="usuario.php">
        <?php }else{ ?>
		<a class="dropdown-item" href="#" onclick="onload_validar('usuario')" data-toggle="modal" data-target="#modal_seguridad">
		<?php } ?><i class="fas fa-user-cog"></i><span> Usuarios</span></a>
		<?php } ?>
			
		
      	<?php  if ($negocio == 0 || $permisos_muestra->{'usuario'} == "on"){ ?>
		<?php if ($permisos->{'usuario'} == "on"){ ?>
        <a class="dropdown-item" href="contratos.php">
        <?php }else{ ?>
		<a class="dropdown-item" href="#" onclick="onload_validar('contratos')" data-toggle="modal" data-target="#modal_seguridad">
		<?php } ?><i class="fas fa-file-word"></i><span> Contratos</span></a>
		<?php } ?>
			
      	<?php  if ($negocio == 0 || $permisos_muestra->{'configuracion'} == "on"){ ?>
		<?php if ($permisos->{'configuracion'} == "on"){ ?>
        <a class="dropdown-item" href="config.php">
		<?php }else{ ?>
		<a class="dropdown-item" href="#" onclick="onload_validar('config')" data-toggle="modal" data-target="#modal_seguridad">
		<?php } ?><i class="fas fa-cog"></i><span> Configuración</span></a> 
		<?php } ?>  
        </div>
      </li>
			
		<?php if($negocio == 0){ ?>
		<li class="nav-item dropdown <?php echo $active_admind.' text-muted';; ?>">
        <a class="nav-link dropdown-toggle text-<?php if($active_admind){ echo $font; } ?>" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fa fa-handshake-o" aria-hidden="true"></i><span> Servicios</span></a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
			
		<h6 class="dropdown-header"> Servicios</h6>
		<?php if ($permisos->{'plan'} == "on"){ ?>
        <a class="dropdown-item" href="plan.php">
		<?php }else{ ?>
		<a  class="dropdown-item" href="#" onclick="onload_validar('plan')" data-toggle="modal" data-target="#modal_seguridad">
		<?php } ?><i class="fa fa-flag" aria-hidden="true"></i><span> Planes</span></a>
			
		<?php if ($permisos->{'negocio'} == "on"){ ?>
        <a class="dropdown-item" href="negocio.php">
		<?php }else{ ?>
		<a  class="dropdown-item" href="#" onclick="onload_validar('negocio')" data-toggle="modal" data-target="#modal_seguridad">
		<?php } ?><i class="fas fa-business-time"></i><span> Negocio</span></a>
			
        <a class="dropdown-item" href="usuario_admin.php"><i class="fas fa-user-cog"></i><span> Administradores</span></a>
			
		<h6 class="dropdown-header"> Pago de Servicios</h6>
		<?php if ($permisos->{'pago_efectivo'} == "on"){ ?>
        <a class="dropdown-item" href="historial_efectivo.php">
		<?php }else{ ?>
		<a  class="dropdown-item" href="#" onclick="onload_validar('historial_efectivo')" data-toggle="modal" data-target="#modal_seguridad">
		<?php } ?><i class="fa fa-money"></i><span> Pagos Efectivo</span></a>
			
		<?php if ($permisos->{'pago_tarjeta'} == "on"){ ?>
        <a class="dropdown-item" href="pago_tarjeta.php">
		<?php }else{ ?>
		<a  class="dropdown-item" href="#" onclick="onload_validar('pago_tarjeta')" data-toggle="modal" data-target="#modal_seguridad">
		<?php } ?><i class="fa fa-id-card" aria-hidden="true"></i><span> Pagos Tarjeta</span></a>
			
			
		<h6 class="dropdown-header">Reporte de Servicios</h6>
			
		<?php if ($permisos->{'reporte_estado_negocio'} == "on"){ ?>
		<a class="dropdown-item" href="report_estado_negocio.php">
		<?php }else{ ?>
		<a  class="dropdown-item" href="#" onclick="onload_validar('report_estado_negocio')" data-toggle="modal" data-target="#modal_seguridad">
		<?php } ?><i class="fa fa-business-time" aria-hidden="true"></i><span> Estado Negocio</span></a>
				
			
		<?php if ($permisos->{'reporte_pago_servicio'} == "on"){ ?>
        <a class="dropdown-item" href="report_pagos.php">
		<?php }else{ ?>
		<a  class="dropdown-item" href="#" onclick="onload_validar('report_pagos')" data-toggle="modal" data-target="#modal_seguridad">
		<?php } ?><i class="fa fa-money" aria-hidden="true"></i><span> Pagos Servicios</span></a>
        </div>
     	</li>
      	<?php } ?>
			
			
	<li class="nav-item dropdown <?php echo $active_report.' text-muted';; ?>">
        <a class="nav-link dropdown-toggle text-<?php if($active_report){ echo $font; } ?>" href="#" 
		   id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-list-alt"></i><span> Reportes</span></a>
        	<div class="dropdown-menu" aria-labelledby="pagesDropdown">
          	<h6 class="dropdown-header">Listado de Reportes </h6>
          	<a class="dropdown-item" href="report_prestamo.php"><i class="fas fa-coins"></i>				<span> R. Préstamos</span></a>
			<a class="dropdown-item" href="report_cliente.php"><i class="fas fa-user-friends"></i>				<span>Clientes x Prestamos</span></a>	
			<?php if ($negocio == 0){ ?>
			<a class="dropdown-item" href="new_datacredito.php">
			<i class="fas fa-list"></i><span> Data Crédito</span></a> 
        	<?php }else{ ?>
			<a class="dropdown-item" href="datac_redito_users.php?negocio=<?php echo $negocio; ?>">
			<i class="fas fa-list"></i><span> Data Crédito</span></a> 
			<?php } ?>
			
        </div>
      </li> 
    </ul>
<script>
function consultar_inspector()
{
  var da = "nada";
  var inspector = '<?php echo $negocio; ?>';
  $.ajax({
      type: "POST",
      url: "php/notificacioncontroller.php",
      data: "proceso="+da+"&inspector="+inspector,
    success: function(resp){
      if(resp.length > 0)
      {
        $("#notificaciones").html(resp);
        var numero = $("#notificaciones a").length;
        $("#cantidad_notificacion").html(numero);
      }
      else
      {
        $("#cantidad_notificacion").html('');
        $("#notificaciones").html('<a class="dropdown-item" href="#">No hay Notificaciones</a>');
      }
    }
  });
}
function consultar_secretaria()
{
  var da = "nada";
  var creador = '<?php echo $user_id; ?>';
  $.ajax({
      type: "POST",
      url: "php/notificacioncontroller.php",
      data: "proceso="+da+"&creador="+creador,
    success: function(resp){
      if(resp.length > 0)
      {
        $("#notificaciones").html(resp);
        var numero = $("#notificaciones a").length;
        $("#cantidad_notificacion").html(numero);
      }
      else
      {
        $("#cantidad_notificacion").html('');
        $("#notificaciones").html('<a class="dropdown-item" href="#">No hay Notificaciones</a>');
      }
    }
  });
}
if ('<?php echo $nivel ?>' != 2) {
  window.setInterval(consultar_inspector, 5000);
}else{
  window.setInterval(consultar_secretaria, 5000);
}
</script>
			