<?php

require_once './bddRequete.inc.php';

$bdd = connexionBdd();
try {
        
       $requete = $bdd->query("delete from stage;");
$requete->execute() or die(print_r($requete->errorInfo()));

}catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

//import.php
//les variables pour les id 
//nombre de ligne
$nbligne = 1;
//heure de debut du cariste
$time_Cariste_h_Deb = "caristeHdeb";
//heure de fin du cariste
$time_Cariste_h_Fin = "caristeHfin";
//nom du cariste
$nom_Cariste = "nomCariste";
//nombre de palette du Cariste
$nb_pal_Cariste = "nbPalCariste";

//heure de debut du chargeur
$time_Chargeur_h_Deb = "chargeurHdeb";
//heure de fin du chargeur
$time_Chargeur_h_Fin = "chargeurhfin";
//nom du chargeur
$nom_Chargeur = "nomChargeur";
//nombre de palette du chargeur
$nb_pal_Chargeur = "nbPalChargeur";
//id de nbligne
//$nb_ligne = "nbLigne";
//la ligne expo mag est toujours egal a EXPE MAG 
$expMag = "EXPE MAG";

$uploaddir = '/home/grammont/Documents/VersionFinalCsv/'; // repertoir ou sera stocke finalement le fichier
$uploadfile = $uploaddir . basename($_FILES['csv_file']['name']);
$data = array();
if (move_uploaded_file($_FILES['csv_file']['tmp_name'], $uploadfile)) { // upload ok
    if (!empty($uploadfile)) {
        $file_data = fopen($uploadfile, 'r');
        fgetcsv($file_data, 0, ";");
     
        while ($row = fgetcsv($file_data, 0, ";")) {

            //ajoue de +1 a la fin de la chaine de caractere 
            $destock_deb = $time_Cariste_h_Deb . $nbligne;
            $destock_fin = $time_Cariste_h_Fin . $nbligne;
            $destock_nom_Cariste = $nom_Cariste . $nbligne;
            $destock_nb_pal = "nbPalCariste" . $nbligne;

            $charg_deb = $time_Chargeur_h_Deb . $nbligne;
            $charg_fin = $time_Chargeur_h_Fin . $nbligne;
            $charg_nomChargeur = "nomChargeur" . $nbligne;
            $charg_nb_pal = "nbPalChargeur" . $nbligne;


            $expMag_id = "exp_Mag" . $nbligne;
            $report_id = "report" . $nbligne;
            $dpt_id = "dpt" . $nbligne;
            $hrev_id = "hRev" . $nbligne;
            $transporteur_id = "transporteur" . $nbligne;
            $edi_id = "edi" . $nbligne;
            $destinataire_id = "destinataire" . $nbligne;
            $heurLiv_id = "hLiv" . $nbligne;
            $quai_id = "quai" . $nbligne;
            $hariv_id = "hArriv" . $nbligne;
            $port_id = "porte" . $nbligne;
            $nbraq_id = "nbRaq" . $nbligne;
            $nbpalleg_id = "nbPalLeg" . $nbligne;
            $site_id = "site" . $nbligne;
            $envoyer_id = "envoyer" . $nbligne;
            //evite les ligne vide
            if ($row[2] !== "") {
                array_push($data, array(
                    'ligne' => "<span id='$nbligne'>$nbligne</span>",
                    'expo_Mag' => "<span id='$expMag_id'>$expMag</span>",
                    'report' => "<input type='text' id='$report_id' style='width: 40px; height: 10px'/>",
                    'dpt' => "<span id='$dpt_id'>" . utf8_encode($row[3]) . "</span>",
                    'hrev' => "<span id='$hrev_id'>" . utf8_encode($row[5]) . "</span>",
                    'transporteur' => "<span id='$transporteur_id'>" . utf8_encode($row[7]) . "</span>",
                    'edi' => "<span id='$edi_id'>" . utf8_encode($row[8]) . "</span>",
                    'destinataires' => "<span id='$destinataire_id'>" . utf8_encode($row[11]) . "</span>",
                    'heure_Liv' => "<span id='$heurLiv_id'>" . utf8_encode($row[13]) . "</span>",
                    'nb_Supp' => "<input type='number' id='$destock_nb_pal' style='width: 80px; height: 10px' value='$row[14]' />",
                    'quai' => "<input type='text' id='$quai_id' style='width: 60px; height: 10px'/>",
                    'cariste' => "<input type='text' id='$destock_nom_Cariste' style='width: 80px '/>",
                    'destock_HD' => "<input type='time' id='$destock_deb'/>",
                    'destock_HF' => "<input type='time' id='$destock_fin' />",
                    'h_Arriv' => "<input type='time' id='$hariv_id'/>",
                    'porte' => "<input type='text' id='$port_id' style='width: 50px; height: 10px'/>",
                    'chargeur' => "<input type='text' id='$charg_nomChargeur' style='width: 80px'/>",
                    'charg_H_Deb' => "<input type='time' id='$charg_deb' />",
                    'charg_H_Fin' => "<input type='time' id='$charg_fin' />",
                    'nb_Supp_Charg' => "<input type='number' id='$charg_nb_pal' style='width: 80px' />",
                    'nb_Raq' => "<input type='number' id='$nbraq_id' style='width: 80px'/>",
                    'nb_pal_leg' => "<input type='number' id='$nbpalleg_id' style='width: 80px'/>",
                    'observation' => "<input type='text' id='$site_id' style='width: 80px; height: 10px'/>",
                    'envoyer' => "<input type='submit' id='$envoyer_id'/>"
                ));
             
                try {
                    $requete = $bdd->prepare("insert into stage (ligne,exp,dpt,edi,hRev,transporteur,hLiv,destinataire,nbSupp) values(:ligne,:exp,:dpt,:edi,:hRev,:transporteur,:hLiv,:destinataire,:nbSupp);");
                    
                    $dpt=utf8_encode($row[3]);
                    $edi=utf8_encode($row[8]);
                    $hrev=utf8_encode($row[5]);
                    $transporteur=utf8_encode($row[7]);
                    $hliv=utf8_encode($row[13]);
                    $destinataire=utf8_encode($row[11]);
                    $nbsupp=utf8_encode($row[14]);
                    
                    $requete->bindParam(':ligne', $nbligne);
                    $requete->bindParam(':exp', $expMag);
                    //$requete->bindParam(':report', $report);
                    $requete->bindParam(':dpt', $dpt);
                    $requete->bindParam(':edi', $edi);
                    $requete->bindParam(':hRev', $hrev);
                    $requete->bindParam(':transporteur', $transporteur);
                    $requete->bindParam(':hLiv',$hliv );
                    $requete->bindParam(':destinataire', $destinataire);
                    $requete->bindParam(':nbSupp',$nbsupp );
                    $requete->execute() or die(print_r($requete->errorInfo()));
                } catch (PDOException $e) {
                    print "Erreur !: " . $e->getMessage() . "<br/>";
                    die();
                }
                $nbligne = $nbligne + 1;
            }
        }
    }
} else { // pb upload
    $data[] = array(
        'ligne' => "pb upload",
        'expo_Mag' => "pb upload",
        'report' => "pb upload",
        'dpt' => "pb upload",
        'hrev' => "pb upload",
        'transporteur' => "pb upload",
        'edi' => "pb upload",
        'destinataires' => "pb upload",
        'heure_Liv' => "pb upload",
        'nb_Supp' => "pb upload",
        'quai' => "pb upload",
        'cariste' => "pb upload",
        'destock_HD' => "pb upload",
        'destock_HF' => "pb upload",
        'h_Arriv' => "pb upload",
        'porte' => "pb upload",
        'chargeur' => "pb upload",
        'charg_H_Deb' => "pb upload",
        'charg_H_Fin' => "pb upload",
        'nb_Supp_Charg' => "pb upload",
        'nb_Raq' => "pb upload",
        'nb_pal_leg' => "pb upload",
        'site' =>  "pb upload",
    );
}
// envoyer le contenu au format json
header('Content-Type: application/json;charset=utf-8');
echo json_encode($data);
