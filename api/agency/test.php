<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../DataBaseManager.php';
require_once __DIR__ . '/../../service/AgencyManager.php';

$manager = new DataBaseManager();
$agencyManager = new AgencyManager($manager);
echo


//$newAgency = $agencyManager->addNewAgency('sdfsdfsdfsd', '95610', 'colommiers');
//$allAgency = $agencyManager->getAllAgency();
//$agencyManager->updateAddress(20, 'ouaaaiiiee', 77550);
//$allAgency = $agencyManager->find(20);

echo $newAgency->jsonSerialize();
