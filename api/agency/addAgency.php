<?php
require_once __DIR__ . '/../../DataBaseManager.php';
require_once __DIR__. '/../../service/AgencyManager.php';

//header('Content-Type: application/json');


//;
$json = json_decode($_POST['data'], true);
//echo $json['address'] . $json['city'] . $json['city'];


if(isset($json['address']) && isset($json['cityCode']) && isset($json['city'])){
    $manager = new DatabaseManager();
    $agencyManager = new AgencyManager($manager);
    $agency = $agencyManager->addNewAgency($json['address'], $json['cityCode'], $json['city']);
//
//
    if ($agency === null){
        http_response_code(409);
        die();
    }
    http_response_code(201);
    $newAgency = $agencyManager->find($agency->getId());
    echo json_encode($newAgency);
} else {
    http_response_code(410);
    die();
}
