<?php


require_once __DIR__ . '/../../DataBaseManager.php';
require_once __DIR__ . '/../../service/RegisterCustomerManager.php';

    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json');

//echo var_dump($_POST['data']);
$json = json_decode($_POST['data'], true);

if (isset($json['name']) &&
    isset($json['firstName']) &&
    isset($json['mail']) &&
    isset($json['dateBorn']) &&
    isset($json['tel']) &&
    isset($json['address']) &&
    isset($json['postalCode']) &&
    isset($json['password']) &&
    isset($json['confirmPass'])){

    $manager = new DatabaseManager();
    $registerService = new RegisterCustomerManager($manager);

    $result = $registerService->register($json['name'],
        $json['firstName'],
        $json['mail'],
        $json['dateBorn'],
        $json['tel'],
        $json['address'],
        $json['postalCode'],
        $json['password'],
        $json['confirmPass']);

    if($result == "ok"){
        http_response_code(200);
        die();
    }
    http_response_code(402);
    echo json_encode($result);
    die();
}
//
http_response_code(400);
echo "empty";
die();
//
//
