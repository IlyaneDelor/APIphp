<?php

require_once __DIR__ . '/../../DataBaseManager.php';
require_once __DIR__ . '/../../service/AcountManager.php';


session_start();
if (isset($_SESSION['token'])){
    $manager = new DataBaseManager();
    $acountManager = new AcountManager($manager);

    $verifMail = $acountManager->getVerifMail($_SESSION['token']);

    if ($verifMail != 1){
        echo $verifMail['verifMail'];
        http_response_code(401);
        die();
    }
    if($verifMail == 1){
        http_response_code(200);
    }
}
else{
    http_response_code(400);
    die();
}