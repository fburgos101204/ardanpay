<?php
// Check whether token is not empty
if(!empty($_POST['token'])){
    
    // Token info
    $token  = $_POST['token'];
	
    // Card info
    $card_num = str_replace (" ", "",$_POST['card_number']);
    $card_cvv = $_POST['cvv'];
    $card_exp_month = $_POST['month_expire'];
    $card_exp_year = $_POST['year_expire'];
    
    // Buyer info
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
 	$email = $_POST['email'];
    $phoneNumber = '555-555-5555';
    $addrLine1 = '123 Test St';
    $city = 'Columbus';
    $state = 'OH';
    $zipCode = '43123';
    $country = 'USA';
	
    // Item info
    $itemPrice = 
    $itemName = 'Pago Mensual';
    $itemNumber = 'PS123456';
    $itemPrice = $_POST['monto'];;
    $currency = 'DOP';
    $orderID = 'SKA92712382139';
    
    // Include 2Checkout PHP library
    require_once("2checkout-php/Twocheckout.php");
    
    // Real one --> 
	Twocheckout::sellerId('250201935736');
    // Fake one --> Twocheckout::sellerId('901414623');
    // Set API key
    // Real one --> */
	Twocheckout::privateKey('FBB1D577-AB35-4A0D-AD13-82E06F622833');
    // Fake one --> Twocheckout::privateKey('E361FABA-BDFD-459A-8821-14097A3C560D');*/
	
    Twocheckout::sandbox(false);
    
    try {
        // Charge a credit card
        $charge = Twocheckout_Charge::auth(array(
            "merchantOrderId" => $orderID,
            "token"      => $token,
            "currency"   => $currency,
            "total"      => $itemPrice,
            "billingAddr" => array(
                "name" => $name,
                "addrLine1" => $addrLine1,
                "city" => $city,
                "state" => $state,
                "zipCode" => $zipCode,
                "country" => $country,
                "email" => $email,
                "phoneNumber" => $phoneNumber
            )
        ));
        
        // Check whether the charge is successful
        if ($charge['response']['responseCode'] == 'APPROVED') {
            
            // Order details
            $orderNumber = $charge['response']['orderNumber'];
            $total = $charge['response']['total'];
            $transactionId = $charge['response']['transactionId'];
            $currency = $charge['response']['currencyCode'];
            $status = $charge['response']['responseCode'];
            
            // Include database config file
            
			require_once("../config/db.php");
        	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            // Insert order info to database
            $sql = "INSERT INTO historial_pago(id_cliente, card_num, card_cvv, card_exp_month, card_exp_year, item_name, item_number, item_price, currency, paid_amount, order_number, txn_id, payment_status, created, modified) VALUES($user_id, '".$card_num."', '".$card_cvv."', '".$card_exp_month."', '".$card_exp_year."', '".$itemName."', '".$itemNumber."','".$itemPrice."', '".$currency."', '".$total."', '".$orderNumber."', '".$transactionId."', '".$status."', NOW(), NOW())";
            $insert = $conn->query($sql);
            $insert_id = $conn->insert_id;
			
			
			$query = "SELECT * FROM cobro WHERE id_cliente = $user_id";
			echo $query;
			$resultados = $conn->query($query);
			$fecha_actual = date("d-m-Y");
			$nueva_fecha = "aqui";
      		if ($resultados->num_rows >= 1) {
      			while ($row = $resultados->fetch_object()) {
					echo $row->modalidad_pago;
					echo $row->fecha_pago;
            		$nueva_fecha = date("Y-m-d",strtotime($row->fecha_pago."+ ".$row->modalidad_pago." days"));
				}}
			
			$query = "UPDATE cobro SET fecha_pago = '$nueva_fecha' WHERE id_cliente = $user_id";
			$conn->query($query);
			echo $query;
			
        }
    } catch (Twocheckout_Error $e) {
        $statusMsg = '<h2>Transaction failed!</h2>';
        $statusMsg .= '<p>'.$e->getMessage().'</p>';
    }
    
}else{
    $statusMsg = "<p>Form submission error...</p>";
}
echo $statusMsg;
?>
