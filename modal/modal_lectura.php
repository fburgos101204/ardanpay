<div class="modal fade" id="modal_lectura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-star"></i> Historial de Pagos</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <div class="table-responsive">    
		<table class="table table-bordered" width="100%" cellspacing="0">
        	<thead>
          <th style="white-space:nowrap;">Concepto</th>
  				<th style="white-space:nowrap;">Fecha</th>
  				<th style="white-space:nowrap;">Capital</th>
  				<th style="white-space:nowrap;">Interés</th>
  				<th style="white-space:nowrap;">Mora</th>
  				<th style="white-space:nowrap;">Descuento</th>
  				<th style="white-space:nowrap;">Total Pagado</th>
  				<th style="white-space:nowrap;">Capital Restante</th>
        	</thead>
        	<tbody id="t_historial_lectura">
        	</tbody>
    </table>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold btn-mda" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
      </div>
    </div>
  </div>
</div>