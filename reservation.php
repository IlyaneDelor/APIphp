<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
    require_once 'DataBaseManager.php';
//    require_once 'Devis.php';

    header("Access-Control-Allow-Origin: *");

function bdd(){
  try
      {
        $bdd = new PDO('mysql:host=127.0.0.1;dbname=pomocServiceDb;charset=utf8', 'ccddr', 'CCDDRtomtom77', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      }
  catch (Exception $e)
      {
              die('Erreur : ' . $e->getMessage());
      }

      return $bdd;
}

//require_once __DIR__.'/DataBaseManager.php';
//require_once __DIR__.'/../../service/InterventionManage.php';
require_once __DIR__.'/service/AcountManager.php';

$manager = new DataBaseManager();
$accountManager = new AcountManager($manager);


session_start();
$json = json_decode($_POST['data'], true);


 $bdd = bdd();

if(isset($_SESSION['token'])){
    $idCustomer = $accountManager->getIdFromToken($_SESSION['token']);
}
else{
    http_response_code(402);
    die();
}



addNewIntervention($json['title'], $json['service'], $json['address'], $json['cityCode'], $json['city'], $json['serviceDate'], $json['serviceHour'], $json['duration'], $json['detail'], $idCustomer);


function addNewIntervention(String $title, $idService, String $address, int $postalCode, String $city, $serviceDate, String $serviceHour, String $duration, String $detail, int $idCustomer){


    $bdd = bdd();

    $q = "INSERT INTO intervention ( title, idService, address, postalCode, city, dateIntervention, hourIntervention, duration, detail, state, idCustomer) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $req = $bdd->prepare($q);
    $req->execute( );

}







