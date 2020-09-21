<?php


require_once __DIR__ . '/../../DataBaseManager.php';
require_once __DIR__ . '/../../service/ServiceManger.php';//header('Content-Type: application/json');


;
$json = json_decode($_POST['data'], true);


if (isset($json['id']) && isset($json['price'])) {
    $manager = new DatabaseManager();
    $serviceManager = new ServiceManger($manager);
    $isOk = $serviceManager->updatePrice($json['id'], $json['price']);

    if($isOk) {
        $service = $serviceManager->find($json['id']);
        echo json_encode($service);
        http_response_code(200);
        die();
    }
//    echo $json['id'];;
    http_response_code(400);
    die();
}