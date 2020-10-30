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
            break;
        case 'voir_la_base':
            voirBass();
            break;
        //a appelé lors de la création d'une nouvelle ligne par utilisateur
        case 'nouvelleLigne':
            $numero = filter_input(INPUT_GET, 'ligne');
            ajoutLigne($numero);
            break;
        //a appelé lors de l'envoie de donné d'une ligne crée par l'utilisateur
        case 'envoyerligne':
            break;
        //a appelé lors de l'envoie de donné d'une ligne crée par le fichier
        case 'envoyer_tableau':
            break;
        //a appelé a chaque minute pour le visuel des reader 
        case 'demande_tableau':
            break;
        //a appelé lors de upload du fichier 
        case 'premier_lancement':
            break;
        case 'renvoyerTable':
            renvoyerTableau();
            break;
        default :
            header('Content-Type: application/json');
            echo json_encode("commande inconnue");
    }
}