<?php


require_once __DIR__ . '/../../DataBaseManager.php';
require_once __DIR__ . '/../../service/ServiceManger.php';

$manager = new DatabaseManager();
$serviceManager = new ServiceManger($manager);
$service = $serviceManager->getAllServiceValide();

if ($service != null) {
    echo json_encode($service);
    http_response_code(200);
    die();
}

http_response_code(400);
die();