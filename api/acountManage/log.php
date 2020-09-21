<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

require_once __DIR__ . '/../../DataBaseManager.php';
require_once __DIR__ . '/../../service/AcountManager.php';

$json = json_decode($_POST['data'], true);

if (isset($json['mail']) && isset($json['password'])){
    $manager = new DataBaseManager();
    $accountManager = new AcountManager($manager);

    $result = $accountManager->log($json['mail'], $json['password']);

    if ($result){
        session_start();
        $_SESSION['token'] = $result;
        echo $result;
        http_response_code(200);
        die();
    }
    else{
        http_response_code(400);
        die();
    }
}