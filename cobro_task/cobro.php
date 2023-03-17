<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
<div class="payment-frm">
    <form id="paymentFrm" name="paymentFrm">
            <input type="hidden" name="user_id" id="user_id" value="">
            <input type="hidden" name="monto" id="monto" value="">
            <input type="hidden" name="name" id="name" value="">
            <input type="hidden" name="email" id="email" value="">
            <input type="hidden" name="card_number" id="card_number" value="">
            <input type="hidden" name="month_expire" id="month_expire" value="">
            <input type="hidden" name="year_expire" id="year_expire" value="">
            <input type="hidden" name="cvv" id="cvv" value="">
        	<input id="token" name="token" type="hidden" value="">
    </form>
</div>
<script>
$(document).ready(function(){	
	
	TCO.loadPubKey('production');
	//TCO.loadPubKey('sandbox');
	setTimeout(function(){ evaluar()}, 2000);
	clearTimeout();
});
// Called when token created successfully.
function evaluar()
{	
	<?php
  	require_once('../config/db.php');
	$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$query = "SELECT clt.email, pgs.*,pgs.nombre_tarjeta as name, cbr.monto, cbr.fecha_pago FROM tarjeta_credito AS pgs
				INNER JOIN cobro AS cbr ON pgs.id_cliente = cbr.id_cliente
				INNER JOIN negocio AS ngc ON pgs.id_cliente = clt.id_user
				WHERE pgs.predeterminada = 1 AND cbr.metodo_pago = 'Tarjeta' AND cbr.fecha_pago <= NOW()";
	$run = $con->query($query);
    if($run->num_rows > 0){
		while($row = $run->fetch_object() ) {
  	?>
	$("#user_id").val('<?php echo $row->id_cliente; ?>');
	$("#monto").val('<?php echo $row->monto; ?>');
	$("#name").val('<?php echo $row->name; ?>');
	$("#email").val('<?php echo $row->email; ?>');
	$("#card_number").val('<?php echo $row->card_number; ?>');
    $("#cvv").val('<?php echo $row->cvv; ?>');
    $("#month_expire").val('<?php echo $row->month_expire; ?>');
   	$("#year_expire").val('<?php echo $row->year_expire; ?>');
	
	tokenRequest();
	<?php }} ?>
}
var successCallback = function(data) {
  var myForm = document.getElementById('paymentFrm');
  
  // Set the token as the value for the token input
  	myForm.token.value = data.response.token.token;
	console.log(data.response.token.token);
  	$.ajax({
      type: "POST",
      url: "paymentSubmit.php",
      data: $("#paymentFrm").serialize(),
      success: function(resp){
  		console.log(resp);
	  }
  });
};

// Called when token creation fails.
var errorCallback = function(data) {
  if (data.errorCode === 200) {
    tokenRequest();
  } else {
    console.log(data.errorMsg);
  }
};

function tokenRequest() {
  // Setup token request arguments
  
   	// Fake One --> sellerId: "901414623",
    // Fake One --> publishableKey: "21BA6A4F-211A-488F-8C35-9F65ECD4F5BB",
	// Real One -->
    // Real One --> 
  var args = {
	sellerId: "250201935736",
	publishableKey: "878B2254-269D-49CB-AEEB-0EA9304F8926",
	ccNo: $("#card_number").val(),
    cvv: $("#cvv").val(),
    expMonth: $("#month_expire").val(),
    expYear: $("#year_expire").val()
  };
  
  // Make the token request
  TCO.requestToken(successCallback, errorCallback, args);
  
}
</script>