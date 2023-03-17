<?php 
$active_historia = "active";
include_once("header/header.php");
if ($permisos->{'historial_pago'} == "on"  || isset($_POST['location'])) {
  include_once("header/menu.php");
  include "php/historial_pagos.php";
  include "modal/modal_filtro_pagos.php";
?>
  <div id="content-wrapper">
    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="">Historiales</a>  
        </li>
        <li class="breadcrumb-item active">Pagos Realizados</li>
      </ol>
      <div class="card mb-3">
        <div class="card-header font-weight-bold text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>" style="margin-top: 0px !important;">
          <p>
            <i class="fas fa-history"></i> Historial de Pagos
          </p>

          <button style="float:right;"type="button" class="btn btn-light btn-mdax"  data-toggle="modal" 
          data-target="#modal_filtro_pagos" onclick="onload_filtro(<?php echo $negocio; ?>)">Filtrar</button>

        </div>
        <div class="card-body">
          <div class="table-responsive" id="table_solicitud">
            <table class="table table-bordered table-hover datatable" width="100%" cellspacing="0">
              <thead>
                <th nowrap>Cobrado Por</th>
                <th nowrap>Estado</th>
                <th nowrap>Entidad</th>
                <th nowrap>Tipo de Pago</th>
                <th nowrap>No Depósito</th>
                <th nowrap>Cliente</th>
                <th nowrap>Concepto</th>
                <th nowrap>Fecha</th>
                <th nowrap>Capital</th>
                <th nowrap>Intéres</th>
                <th nowrap>Mora</th>
                <th nowrap>Descuento</th>
                <th nowrap>Total Pagado</th>
                <th nowrap>Capital Restante</th>
              </thead>
              <tbody>
                <?php
                $class = new Historial_Pagos();
                $rows = $class->read_historial_complete($negocio);
                if ($rows->num_rows >= 1) {
                  while($row = $rows->fetch_object()){
                    ?>
                    <tr>
                      <td nowrap>
                        <?php if ($row->creado == '') {
                           print($row->mensajero);
                        } else {
                          print($row->creado); 
                        }?>
                        </td>
                      <td nowrap>
                        <?php 
                        if ($row->estado == "Anulada") {
                          echo "<strong style='color:red'>$row->estado</strong>";
                        }else if ($row->estado == "Prestamo Anterior"){
                         echo "<strong style='color:orange'>$row->estado</strong>";
                       }else{
                        echo "<strong style='color:green'>$row->estado</strong>";
                      }
                      ?>
                    </td>
                    <td nowrap>
                      <?php 
                      if (strlen($row->caja_pagada) <= 0) {
                        echo $row->banco_pagado;
                      }else
                      {
                        echo $row->caja_pagada;
                      } 
                      ?> 
                    </td>
                    <td nowrap><?php print($row->tipo_pago); ?></td>
                    <td nowrap>
                      <?php 
                      if (strlen($row->caja_pagada) <= 0) {
                        echo $row->no_deposito;
                      }else
                      {
                        echo "Sin Codigo";
                      } 
                      ?> 
                    </td>
                    <td nowrap><?php print($row->cliente); ?></td>
                    <td nowrap><?php print($row->concepto); ?></td>
                    <td nowrap><?php print(date("Y-m-d",strtotime($row->fecha))); ?></td>
                    <td nowrap><?php $capital_total += $row->capital; print("RD$ ".number_format($row->capital)); ?></td>
                    <td nowrap><?php $interes_total += $row->interes; print("RD$ ".number_format($row->interes)); ?></td>
                    <td nowrap><?php $mora_total += $row->mora; print("RD$ ".number_format($row->mora,'2')); ?></td>
                    <td nowrap><?php $descuento_total += $row->descuento; print("RD$ ".number_format($row->descuento,'2')); ?></td>
                    <td nowrap><?php $pagado_total += $row->total_pagado; print("RD$ ".number_format($row->total_pagado,'2')); ?></td>
                    <td nowrap><?php $capital_restante_total += $row->capital_restante; print("RD$ ".number_format($row->capital_restante)); ?></td>
                  </tr>
                <?php } 
              }else{
                echo "<tr>";
                echo "<td nowrap colspan='14 style='font-size:25px;' align='center'>No hay Pagos Realizados</td>";
                echo "</tr>";
              }?>     
            </tbody>
            <tfoot id="t_foot">
              <tr style="background:#c0e0dc;">
                <th nowrap colspan="8" style="text-align:right !important;">Total: </th>
                <th nowrap colspan="1">
                 <?php echo "RD$ ".number_format($capital_total,'2'); ?>
               </th>
               <th nowrap colspan="1">
                 <?php echo "RD$ ".number_format($interes_total,'2'); ?>
               </th>
               <th nowrap colspan="1">
                 <?php echo "RD$ ".number_format($mora_total,'2'); ?>
               </th>
               <th nowrap colspan="1">
                 <?php echo "RD$ ".number_format($descuento_total,'2'); ?>
               </th>
               <th nowrap colspan="1">
                 <?php echo "RD$ ".number_format($pagado_total,'2'); ?>
               </th>
               <th nowrap colspan="1">
                 <?php echo "RD$ ".number_format($capital_restante_total,'2'); ?>
               </th>
             </tr>
           </tfoot>
         </table>
       </div>
     </div>
   </div>
 </div>
</div>
<script src="js/js_filtrar_pago.js"></script>
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<?php 
include_once("header/footer.php"); }
else{ echo '<meta http-equiv="Refresh" content="0;URL=404.php">'; } ?>