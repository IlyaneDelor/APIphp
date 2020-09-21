<?php

require_once __DIR__.'/../../DataBaseManager.php';
require_once __DIR__.'/../../service/InterventionManage.php';
require_once __DIR__.'/../../service/AcountManager.php';

session_start();
$json = json_decode($_POST['data'], true);

 $manager = new DataBaseManager();
 $interventionManager = new InterventionManage($manager);
 $accountManager = new AcountManager($manager);


if(isset($_SESSION['token'])){
    $idCustomer = $accountManager->getIdFromToken($_SESSION['token']);
}
else{
    http_response_code(402);
    die();
}

if ( isset($idCustomer) && isset($json['title']) && isset($json['service']) && isset($json['address']) && isset($json['cityCode']) && isset($json['city']) && isset($json['serviceDate']) && isset($json['serviceHour']) && isset($json['duration']) && isset($json['detail'])){
    echo $idCustomer . $json['title'] . $json['service'] . $json['address'] . $json['cityCode'] . $json['city'] . $json['serviceDate'] . $json['serviceHour'] . $json['duration']. $json['detail'] . $json['postalCode'] . $json['city'];

    $newIntervention = $interventionManager->addNewIntervention($json['title'], $json['service'], $json['address'], $json['cityCode'], $json['city'], $json['serviceDate'], $json['serviceHour'], $json['duration'], $json['detail'], $idCustomer);

//    if ($newIntervention != null){
//        http_response_code(200);
//        die();
//    }
//    else{
//        http_response_code(400);
//        die();
//    }
}