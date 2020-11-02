<?php

require_once './bddRequete.inc.php';
//test de la méthode d'envois des données

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET') {
    //récupération de la donnée 'commande'
    $commande = filter_input(INPUT_GET, 'commande');
    switch ($commande) {

        case 'delBdd':
            //suprimé la basse de donné
            delBdd(); 
            //recrée la basse
            createBdd();
            break;
        //a appelé lors de la création d'une nouvelle ligne par utilisateur
        case 'nouvelleLigne':
            $numero = filter_input(INPUT_GET, 'ligne');
            ajoutLigne($numero);
            break;
        //a appelé lors de l'envoie de donné d'une ligne crée par l'utilisateur
        case 'mise_jour_ligne':
            $ligne = filter_input(INPUT_GET, 'ligne');
            $report = filter_input(INPUT_GET, 'report');
            $exp = filter_input(INPUT_GET, 'exp');
            $dpt = filter_input(INPUT_GET, 'dpt');
            $edi = filter_input(INPUT_GET, 'edi');
            $hrev = filter_input(INPUT_GET, 'hRev');
            $transporteur = filter_input(INPUT_GET, 'transporteur');
            $hLiv = filter_input(INPUT_GET, 'hliv');
            $destinataire = filter_input(INPUT_GET, 'destinataire');
            $nbSupp = filter_input(INPUT_GET, 'nbsupp');
            $quai = filter_input(INPUT_GET, 'quai');
            $cariste = filter_input(INPUT_GET, 'cariste');
            $debutCariste = filter_input(INPUT_GET, 'debCariste');
            $finCariste = filter_input(INPUT_GET, 'finCariste');
            $hAriv = filter_input(INPUT_GET, 'hariv');
            $porte = filter_input(INPUT_GET, 'porte');
            $chargeur = filter_input(INPUT_GET, 'chargeur');
            $debutChargeur = filter_input(INPUT_GET, 'chargeurdeb');
            $finChargeur = filter_input(INPUT_GET, 'chargeurfin');
            $nbSuppChargeur = filter_input(INPUT_GET, 'nbsuppcharg');
            $nbRaq = filter_input(INPUT_GET, 'nbraq');
            $nbpalLeg = filter_input(INPUT_GET, 'nbpalleg');
            $site = filter_input(INPUT_GET, 'site');
            
            mise_jour_ligne($ligne, $report, $exp, $dpt, $edi, $hrev, $transporteur, $hLiv, $destinataire, $nbSupp, $quai, $cariste, $debutCariste, $finCariste, $hAriv, $porte, $chargeur, $debutChargeur, $finChargeur, $nbSuppChargeur, $nbRaq, $nbpalLeg, $site);
            break;
        //a appelé pour les page visuel
        case 'renvoyerTable':
            renvoyerTableau();
            break;
        default :
            header('Content-Type: application/json');
            echo json_encode("commande inconnue");
    }
}