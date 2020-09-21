<?php


require_once __DIR__ . '/../../DataBaseManager.php';
require_once __DIR__ . '/../../service/InterventionManage.php';


$json = json_decode($_POST['data'], true);



if (isset($json['id'])) {
    $manager = new DatabaseManager();
    $interventionManage = new InterventionManage($manager);
    $interventionManage->refuseIntervention($json['id']);

    $intervention = $interventionManage->find($json['id']);
    echo json_encode($intervention);

    http_response_code(201);
    die();
}