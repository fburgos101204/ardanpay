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

// Add Task
$app->post('/api/task/add/key=eyJ1c2VyIjoiZmVybmFuZG8iLCJwcyI6ImYxMDEyMDQyMSIsImFsZyI6IkhTMjU2In0', function(Request $request, Response $response){
    $task_id = $request->getParam('task_id');
    $cliente = $request->getParam('cliente');
    $tipo = $request->getParam('tipo');
    $descripcion = $request->getParam('descripcion');
    $conductor = $request->getParam('conductor');
    $direccion = $request->getParam('direccion');
    $fecha =  date("Y-m-d H:i:s");
    $adres = utf8_decode($direccion);

    $sql = "INSERT INTO tarea (task_id, cliente, tipo, descripcion, conductor, direccion, fecha, botones) VALUES
    (:task_id,:cliente,:tipo,:descripcion,:conductor,:direccion,:fecha,:botones)";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':task_id', $task_id);
        $stmt->bindParam(':cliente',  $cliente);
        $stmt->bindParam(':tipo',      $tipo);
        $stmt->bindParam(':descripcion',      $descripcion);
        $stmt->bindParam(':conductor',    $conductor);
        $stmt->bindParam(':direccion',       $adres);
        $stmt->bindParam(':fecha',      $fecha);
        $stmt->bindParam(':botones',      'Aceptada');

        $stmt->execute();

        echo '{"notice": {"text": "task Added"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->get('/api/task/{id}/key=eyJ1c2VyIjoiZmVybmFuZG8iLCJwcyI6ImYxMDEyMDQyMSIsImFsZyI6IkhTMjU2In0', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM tarea WHERE task_id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customer = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customer);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


/*$app->delete('/api/task/delete/{id}/key=eyJ1c2VyIjoiZmVybmFuZG8iLCJwcyI6ImYxMDEyMDQyMSIsImFsZyI6IkhTMjU2In0', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "DELETE FROM tarea WHERE task_id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "Customer Deleted"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});*/