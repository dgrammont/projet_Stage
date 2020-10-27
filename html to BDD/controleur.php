<?php

require_once './bddRequete.php';

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET ') {

    $commande = filter_input(INPUT_GET, 'ajoutLigne');
    switch ($commande) {
        case 'ajoutLigne':

            $numero = filter_input(INPUT_GET, 'ligne');
            ajoutLigne($numero);
            break;
        default :
            header('Content-Type: application/json');
            echo json_encode("commande inconnue");
    }
}