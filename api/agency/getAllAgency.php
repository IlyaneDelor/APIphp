<?php
require_once __DIR__ . '/../../DataBaseManager.php';
require_once __DIR__ . '/../../service/AgencyManager.php';

$manager = new DataBaseManager();
$agencyManager = new AgencyManager($manager);

$allAgency = $agencyManager->getAllAgency();

if ($allAgency != null){
    echo json_encode($allAgency);
    http_response_code(200);
    die();
}

http_response_code(400);
die();