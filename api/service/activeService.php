<?php


require_once __DIR__ . '/../../DataBaseManager.php';
require_once __DIR__ . '/../../service/ServiceManger.php';//header('Content-Type: application/json');


;
$json = json_decode($_POST['data'], true);


if (isset($json['id'])) {
    $manager = new DatabaseManager();
    $serviceManager = new ServiceManger($manager);
    $serviceManager->activeService($json['id']);

    $service = $serviceManager->find($json['id']);
    echo json_encode($service);

//    echo $json['id'];

    http_response_code(201);
    die();
}