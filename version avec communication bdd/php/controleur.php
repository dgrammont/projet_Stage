<?php

require_once './bddRequete.inc.php';
//test de la méthode d'envois des données

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET') {
    //récupération de la donnée 'commande'
    $commande = filter_input(INPUT_GET, 'commande');
    switch ($commande) {
        case 'ajoutLigne':
            //récupération du numéro de ligne
            $numero = filter_input(INPUT_GET, 'ligne');
            ajoutLigne($numero);
            break;
        case 'delBdd':
            //suprimé la basse de donné
            delBdd(); 
            //recrée la basse
            createBdd();
        case 'voir_la_base':
            voirBass();
        //a apelé lor de la création d'une nouvelle ligne
        case 'nouvelleLigne':
            $numero = filter_input(INPUT_GET, 'ligne');
            ajoutLigne($numero);
        default :
            header('Content-Type: application/json');
            echo json_encode("commande inconnue");
    }
}