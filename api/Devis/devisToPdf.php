<?php

use Spipu\Html2Pdf\Html2Pdf;

ini_set('display_errors', 1);
error_reporting(E_ALL);
//require_once __DIR__.'/../../html2pdf/src/Html2Pdf.php';
//require __DIR__ . '/../function.php';
require __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../../service/ServiceManger.php';

$json = json_decode($_POST['data'], true);

//if (isset($json['name']) && isset($json['firstName']) && isset($json['mail']) && isset($json['address']) && isset($json['postalCode']) && isset($json['city']) && isset($json['service'])) {


    $manager = new DataBaseManager();
    $serviceManager = new ServiceManger($manager);
    $serviceInfo = $serviceManager->find($json['service']);



    $user = array(
        "id" => 1,
        "siret" => "152 356 785",
        "firstname" => "Pomoc",
        "lastname" => "services",
        "email" => "pomocServices@gmail.com",
        "portable" => "06.25.35.45.35",
        "address" => "26 Avenue du Bourg\n75000 Paris"
    );

    $client = array(
        "id" => 1,
        "firstname" => $json['name'],
        "lastname" => $json['firstName'],
        "mail" => $json['mail'],
        "portable" => "",
        "address" => $json['address'] . " " . $json['postalCode'] . " " . $json['city'],
        "infos" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium eos tempora, magni delectus porro cum labore eligendi."
    );

    $project = array(
        "id" => 1,
        "name" => $serviceInfo['jobs'],
        "status" => 1,
        "infos" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium eos tempora, magni delectus porro cum labore eligendi.",
        "created" => 1,
        "paid" => false,
        "client_id" => 1,
        "user_id" => 1
    );

    $tasks[] = array(
        "id" => 1,
        "ref" => "96ER1",
        "description" => $serviceInfo['jobs'],
        "price" => $serviceInfo['price'],
        "quantity" => $json['duration'],
        "project_id" => 1
    );


    ob_start();
    $total = 0;
    $total_tva = 0;
    ?>

    <style type="text/css">
        table {
            width: 100%;
            color: #717375;
            font-family: helvetica;
            line-height: 5mm;
            border-collapse: collapse;
        }

        h2 {
            margin: 0;
            padding: 0;
        }

        p {
            margin: 5px;
        }

        .border th {
            border: 1px solid #000;
            color: white;
            background: #000;
            padding: 5px;
            font-weight: normal;
            font-size: 14px;
            text-align: center;
        }

        .border td {
            border: 1px solid #CFD1D2;
            padding: 5px 10px;
            text-align: center;
        }

        .no-border {
            border-right: 1px solid #CFD1D2;
            border-left: none;
            border-top: none;
            border-bottom: none;
        }

        .space {
            padding-top: 250px;
        }

        .10
        p {
            width: 10%;
        }

        .15
        p {
            width: 15%;
        }

        .25
        p {
            width: 25%;
        }

        .50
        p {
            width: 50%;
        }

        .60
        p {
            width: 60%;
        }

        .75
        p {
            width: 75%;
        }
    </style>
    <page backtop="10mm" backleft="10mm" backright="10mm" backbottom="10mm" footer="page;">

        <page_footer>
            <hr/>
            <p>Fait a Paris, le <?php echo date("d/m/y"); ?></p>
            <p>Signature du particulier, suivie de la mension manuscrite "bon pour accord".</p>
        </page_footer>

        <table style="vertical-align: top;">
            <tr>
                <td class="75p">
                    <strong><?php echo $user['firstname'] . " " . $user['lastname']; ?></strong><br/>
                    <?php echo nl2br($user['address']); ?><br/>
                    <strong>SIRET:</strong> <?php echo $user['siret']; ?><br/>
                    <?php echo $user['email']; ?>
                </td>
                <td class="25p">
                    <strong><?php echo $client['firstname'] . " " . $client['lastname']; ?></strong><br/>
                    <?php echo nl2br($client['address']); ?><br/>
                </td>
            </tr>
        </table>

        <table style="margin-top: 50px;">
            <tr>
                <td class="50p"><h2>Devis</h2></td>
                <td class="50p" style="text-align: right;">Emis le <?php echo date("d/m/y"); ?></td>
            </tr>

        </table>

        <table style="margin-top: 30px;" class="border">
            <thead>
            <tr>
                <th class="60p">Description</th>
                <th class="10p">Quantité</th>
                <th class="15p">Prix Unitaire</th>
                <th class="15p">Montant</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?php echo $task['description']; ?></td>
                    <td><?php echo $task['quantity']; ?></td>
                    <td><?php echo $task['price']; ?> €</td>
                    <td><?php
                        $price_tva = $task['price'] * $task['quantity'] * 1.2;
                        echo $price_tva;
                        ?>
                        €
                    </td>

                    <?php
                    $total += $task['price'] * $task['quantity'];
                    $total_tva += $price_tva;
                    ?>
                </tr>
            <?php endforeach ?>

            <tr>
                <td class="space"></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td colspan="2" class="no-border"></td>
                <td style="text-align: center;" rowspan="3"><strong>Total:</strong></td>
                <td>HT : <?php echo $total; ?> €</td>
            </tr>
            <tr>
                <td colspan="2" class="no-border"></td>
                <td>TVA : <?php echo($total_tva - $total) ?> €</td>
            </tr>
            <tr>
                <td colspan="2" class="no-border"></td>
                <td>TTC : <?php echo $total_tva; ?> €</td>
            </tr>
            </tbody>
        </table>

    </page>

    <?php
    $content = ob_get_clean();

    try {
        $pdf = new Html2Pdf();
        $pdf->pdf->SetAuthor('DOE John');
        $pdf->pdf->SetTitle('Devis');
        $pdf->pdf->SetSubject('Devis' . $serviceInfo['jobs']);
        $pdf->pdf->SetKeywords('HTML2PDF, Devis, PHP');
        $pdf->writeHTML($content);

//$pdfContent = $html2pdf->output('my_doc.pdf', 'S');

//$contentPdf = $pdf->output();
        echo $content;
    } catch (\Spipu\Html2Pdf\Exception\Html2PdfException $e) {
        echo $e->getMessage();
    }
    http_response_code(200);
    die();
//}
//else{
//    http_response_code(400);
//    die();
//}