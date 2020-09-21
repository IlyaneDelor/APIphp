<?php


require_once __DIR__ . '/../../DataBaseManager.php';
require_once __DIR__ . '/../../service/InterventionManage.php';
require_once __DIR__ . '/../../service/AcountManager.php';


$manager = new DatabaseManager();
$accountManager = new AcountManager($manager);
$interventionManage = new InterventionManage($manager);
session_start();
$idCustomer = $accountManager->getIdFromToken($_SESSION['token']);
$intervention = $interventionManage->getAllIntervention($idCustomer);

?>
<?php  
if ($intervention != null){
    echo json_encode($intervention);
    http_response_code(200);
    die();
}

http_response_code(400);
die();

?>