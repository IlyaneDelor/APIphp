<?php

require_once __DIR__ . '/../../DataBaseManager.php';
require_once __DIR__. '/../../service/ServiceManger.php';

//header('Content-Type: application/json');


;
$json = json_decode($_POST['data'], true);


if(isset($json['name']) && isset($json['price'])){
    $manager = new DatabaseManager();
    $serviceManager = new ServiceManger($manager);
    $service = $serviceManager->addNewService($json['name'], $json['price']);


    if ($service === null){
        http_response_code(409);
        die();
    }
    http_response_code(201);
    echo json_encode($service->jsonSerialize());
} else{
    http_response_code(410);
    die();
}