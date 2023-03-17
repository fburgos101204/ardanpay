<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

// Get All Customers
$app->get('/api/prestamo_mensajero/{id_mensajero}', function(Request $request, Response $response){
    $id_mensajero = $request->getAttribute('id_mensajero');
    /*$sql = "SELECT clt.id_cliente,clt.direccion,clt.cedula,clt.path_img_cliente,CONCAT(clt.nombre, ' ', clt.apellido) as cliente, IF ((cuota - COUNT(amrt.no_cuota)) < 0,0,(cuota - COUNT(amrt.no_cuota))) as no_cuota, prt.*,amrt.fecha as fecha_pago,amrt.balance,amrt.abono_capital,amrt.interes as interes_cantidad, amrt.fecha as proximo_pagos FROM prestamo as prt
                INNER JOIN amortizacion AS amrt ON prt.id_prestamo = amrt.id_prestamo
                INNER JOIN clientes as clt on prt.id_cliente = clt.id_cliente
                INNER JOIN mensajeros AS mjr ON clt.negocio = mjr.negocio
                INNER JOIN ruta_mensajero AS rt_mjr ON mjr.id_mensajero = rt_mjr.id_mensajero
                INNER JOIN ruta_cliente AS rt_clt ON rt_mjr.id_ruta = rt_clt.id_ruta
                WHERE amrt.estado != 'Pagada' and prt.proximo_pago <= NOW()
                and prt.estado != 'Asunto Legal' and prt.estado != 'Cancelado' 
                and prt.estado != 'Completado' and mjr.id_mensajero = $id_mensajero and rt_clt.id_cliente IN (clt.id_cliente)
                GROUP BY prt.id_prestamo ORDER BY amrt.fecha asc";*/
	
	$sql = "SELECT (CASE
			WHEN proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) >= 1 THEN  'Atrasado'
			WHEN  proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) = 0 and TIMESTAMPDIFF(day, DATE_FORMAT(NOW(), '%Y-%m-%d'), proximo_pago) < -5 THEN 'Mora'
			WHEN proximo_pago < DATE_FORMAT(NOW(), '%Y-%m-%d') and cantidad_faltas(prt.ciclo_pago,prt.proximo_pago) = 0 and TIMESTAMPDIFF(day, DATE_FORMAT(NOW(), '%Y-%m-%d'), proximo_pago) >= -5 THEN 'Al dia'
			ELSE 'Avanzado'
			END)  as esta,clt.id_cliente,clt.direccion,clt.cedula,clt.path_img_cliente,CONCAT(clt.nombre, ' ', clt.apellido) as cliente, IF ((cuota - COUNT(amrt.no_cuota)) < 0,0,(cuota - COUNT(amrt.no_cuota))) as no_cuota, prt.*,amrt.fecha as fecha_pago,amrt.balance,amrt.abono_capital,amrt.interes as interes_cantidad, amrt.fecha as proximo_pagos FROM prestamo as prt
                INNER JOIN amortizacion AS amrt ON prt.id_prestamo = amrt.id_prestamo
                INNER JOIN clientes as clt on prt.id_cliente = clt.id_cliente
                INNER JOIN mensajeros AS mjr ON clt.negocio = mjr.negocio
                INNER JOIN ruta_mensajero AS rt_mjr ON mjr.id_mensajero = rt_mjr.id_mensajero
                INNER JOIN ruta_cliente AS rt_clt ON rt_mjr.id_ruta = rt_clt.id_ruta
                WHERE prt.estado != 'Cancelado'
                and prt.estado != 'Completado' and mjr.id_mensajero = $id_mensajero and rt_clt.id_cliente IN (clt.id_cliente)
                GROUP BY prt.id_prestamo ORDER BY amrt.fecha asc";
	
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customers);

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get Single Customer
$app->get('/api/prestamo/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT clt.id_cliente,clt.direccion,clt.cedula,clt.path_img_cliente,CONCAT(clt.nombre, ' ', clt.apellido) as cliente, (cuota - COUNT(amrt.no_cuota)) as no_cuota, prt.*,amrt.fecha as fecha_pago,amrt.balance,amrt.abono_capital,amrt.interes as interes_cantidad, amrt.fecha as proximo_pagos,clt.negocio  FROM prestamo as prt
                INNER JOIN amortizacion AS amrt ON prt.id_prestamo = amrt.id_prestamo
                INNER JOIN clientes as clt on prt.id_cliente = clt.id_cliente
                WHERE prt.id_prestamo = $id AND amrt.estado != 'Pagada'
                ORDER BY amrt.fecha asc limit 1";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customere = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customere);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
}); 

/*************************************************************************/
/*************************************************************************/
/*************************************************************************/
/*************************************************************************/
/*************************************************************************/
/*************************************************************************/
/*************************************************************************/
/*************************************************************************/

$app->get('/api/banco/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM banco WHERE id_banco = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customere = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customere);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
}); 

$app->get('/api/banco', function(Request $request, Response $response){
    $sql = "SELECT * FROM banco";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customers);

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

/*************************************************************************/
/*************************************************************************/
/*************************************************************************/
/*************************************************************************/
/*************************************************************************/
/*************************************************************************/
/*************************************************************************/
/*************************************************************************/

$app->get('/api/mensajero/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM mensajeros WHERE id_mensajero = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customere = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customere);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->get('/api/caja/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM caja WHERE negocio = $id ORDER BY id_caja ASC";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customere = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customere);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//Add Direcciones del cliente.
$app->get('/api/address/add', function(Request $request, Response $response){
    date_default_timezone_set('America/Santo_Domingo');

    $id_cliente = $request->getParam('id_cliente');
    $tipo = $request->getParam('tipo');
    $lat = $request->getParam('lat');
    $long = $request->getParam('long');
    $fecha =  date("Y-m-d H:i:s");

    $url="https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$long."&sensor=false&key=AIzaSyB-ac3xmSzZIrXLNF-46hKymj56tKQH-s0";

     $response = file_get_contents($url);
     $json = json_decode($response,true);
     

     $direc = $json['results'][0]['formatted_address'];
     $zip =  $json['results'][1]['address_components'][0]['long_name']; // Zip code
     $ciudad = $json['results'][1]['address_components'][1]['long_name']; // ciudad
     $calle = $json['results'][0]['address_components'][0]['long_name']; // calle
     $direccion = utf8_decode($direc);

      header('Location: https://laundryappmovil.com/access/public/api/address/add?id_cliente='.$id_cliente.'&tipo='.$tipo.'&lat='.$lat.'&long='.$long.'&direccion='.$direccion.'&zip='.$zip.'&ciudad='.$ciudad.'&calle='.$calle);
     
	echo "Hola";
});

?>
