<?php 
  $active_empresa = 'active';
  $tabla = 'Ranking';
  include_once("header/header.php");
if ($permisos->{'caja'} == "on"  || isset($_POST['location'])) {
  include_once("header/menu.php");
  include "php/rankingcontroller.php";
  include "modal/modal_lectura.php";
?>
<div id="content-wrapper">
<div class="container-fluid">
<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="">Registro Empresarial</a>
</li>
<li class="breadcrumb-item active"><?php echo $tabla; ?></li>
</ol>
<div class="card mb-3">
<div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
  <i class="fas fa-star"></i> Ranking Clientes</div>
<div class="card-body">
  <div class="table-responsive" id="ranking_tabla">
    <table class="table table-bordered datatable" width="100%" cellspacing="0">
        <thead>
          <th style="white-space:nowrap;">Cliente</th>
          <th style="white-space:nowrap;">Al día</th>
          <th style="white-space:nowrap;">Atrasos</th>
        </thead>
        <tbody class="hoverclass">
        <?php
          $du = new RankingController();
          $rows = $du->read($negocio);
          if ($rows->num_rows >= 1) {
          	while($row = $rows->fetch_object()){
        	?>
        <tr data-toggle="modal" data-target="#modal_lectura"  onclick="on_load_lectura(<?php echo $row->id_cliente; ?>)">
          <td nowrap><?php print($row->cliente); ?></td>
          <td nowrap><?php print($row->mas); ?></td>
			    <td nowrap><?php print($row->menos); ?></td>

        </tr>
        <?php } }else{
        echo "<tr>";
        echo "<td nowrap colspan='8' style='font-size:25px;' align='center'>No hay Registros</td>";
        echo "</tr>";
        }?>     
        </tbody>
    </table>
  </div>
</div>
</div>
</div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<script type="text/javascript" src="js/js_ranking.js"></script>
<?php 
	include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>