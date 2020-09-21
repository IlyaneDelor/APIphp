<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

require_once __DIR__ . '/../../DataBaseManager.php';
require_once __DIR__ . '/../../service/AcountManager.php';

$manager = new DataBaseManager();
$acountManager = new AcountManager($manager);

$headerIsCo = "
  <nav class=\"navbar navbar-expand-lg navbar-dark bg-dark static-top\" style=\"padding:0px;margin:0px;border-radius: 0px;\">
    <div class=\"container\" >

      <a href='http://localhost/projetA/ProjetA/php/index.php'><img src=\"http://localhost/projetA/ProjetA/images/logo.png\"/ class=\"logo\"></a>
      <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
        <span class=\"navbar-toggler-icon\"></span>
      </button>
    
      <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">
        <ul class=\"navbar-nav ml-auto\" style=\"padding-left: 85%;\">

          <li class=\"nav-item dis-flex align-items-center justify-content-center\" id=\"navblue\">
            <a class=\"nav-link\"  href=\"http://localhost/projetA/ProjetA/php/serviceRequest.php\">Commander</a>
          </li>

          <li class=\"nav-item dis-flex justify-content-center align-items-center\" id=\"navorange\">
            <a class=\"nav-link\" href=\"http://localhost/projetA/ProjetA/php/devis/Devis.php\">Devis</a>
          </li>
          <li class=\"nav-item dis-flex justify-content-center align-items-center\" id=\"navorange\">
            <a class=\"nav-link\" href=\"http://localhost/projetA/ProjetA/php/interventionHistory.php\">Historique</a>
          </li>
           <li class='nav-item'>
                   
                    <img class='nav-link' style='cursor: pointer' height='30px' width='30px' onclick='deco()' src='http://localhost/projetA/ProjetA/images/icons/turn-off.png' alt=''>

</li>
        </ul>
      </div>
    </div>
  </nav>

";

$header = "


    <nav class=\"navbar navbar-expand-lg navbar-dark bg-dark static-top\" style=\"padding:0px;margin:0px;border-radius: 0px;\">
        <div class=\"container\" >

            <a href='http://localhost/projetA/ProjetA/php/index.php'><img src=\"http://localhost/projetA/ProjetA/images/logo.png\"/ class=\"logo\"></a>
            <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>

            <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">
                <ul class=\"navbar-nav ml-auto\" style=\"padding-left: 85%;\">

                    <li class=\"nav-item\" id=\"navblue\">
                        <a class=\"nav-link\"  href=\"http://localhost/projetA/ProjetA/php/login.html\">Connexion</a>
                    </li>

                    <li class=\"nav-item\" id=\"navorange\">
                        <a class=\"nav-link\" href=\"http://localhost/projetA/ProjetA/php/register/register.html\">Inscription</a>
                    </li>
                    
                    
                </ul>
            </div>
        </div>
    </nav>


";

$headerAdmin = "


    <nav class=\"navbar navbar-expand-lg navbar-dark bg-dark static-top\" style=\"padding:0px;margin:0px;border-radius: 0px;\">
        <div class=\"container\" >

            <a href='http://localhost/projetA/ProjetA/php/index.php'><img src=\"http://localhost/projetA/ProjetA/images/logo.png\"/ class=\"logo\"></a>
            <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>

            <div class=\"collapse navbar-collapse \" id=\"navbarResponsive\" >
                <ul class=\"navbar-nav ml-auto\" style=\"padding-left: 85%;\">

                    <li class=\"nav-item\" id=\"navblue\">
                        <a class=\"nav-link\"  href=\"serviceManage.php\">Service</a>
                    </li>

                    <li class=\"nav-item \" id=\"navorange\">
                        <a class=\"nav-link\" href=\"agencyManage.php\">Agency</a>
                    </li>
                    
                    <li>
                    <button >
                    <img height='30px' width='30px' onclick='deco();' src='http://localhost/projetA/ProjetA/images/icons/turn-off.png' alt=''>
</button>
</li>
                </ul>
            </div>
        </div>
    </nav>


";




session_start();

if(isset($_SESSION['token'])){
    $isCo = $acountManager->isCo($_SESSION['token']);
    if ($isCo == 1){
        if ($acountManager->verifAdmin($_SESSION['token']) != 1)
        {
            echo $headerIsCo;
            http_response_code(200);
            die();
        }
        else{
            echo $headerAdmin;
            http_response_code(200);
            die();
        }
    }
    else{
        echo $header;
        http_response_code(400);
        die();
    }
}else{
    echo $header;
    http_response_code(400);
    die();
}


