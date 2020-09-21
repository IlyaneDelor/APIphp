<?php
require_once __DIR__ . '/../../DataBaseManager.php';
require_once __DIR__. '/../../service/AgencyManager.php';

//header('Content-Type: application/json');


;
$json = json_decode($_POST['data'], true);


if(isset($json['id'])){
    $manager = new DatabaseManager();
    $agencyManager = new AgencyManager($manager);
    $agencyManager->delAgency($json['id']);

    $agency = $agencyManager->find($json['id']);
    echo json_encode($agency);

    http_response_code(201);
    die();
}