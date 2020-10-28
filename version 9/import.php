<?php

//import.php

//les variables pour les id 

//nombre de ligne
$nbligne = 1;
//heure de debut du cariste
$time_Cariste_h_Deb="caristeHdeb";
//heure de fin du cariste
$time_Cariste_h_Fin="caristeHfin";
//nom du cariste
$nom_Cariste="nomCariste";
//nombre de palette du Cariste
$nb_pal_Cariste="nbPalCariste";

//heure de debut du chargeur
$time_Chargeur_h_Deb="chargeurHdeb";
//heure de fin du chargeur
$time_Chargeur_h_Fin="chargeurhfin";
//nom du chargeur
$nom_Chargeur="nomChargeur";
//nombre de palette du chargeur
$nb_pal_Chargeur="nbPalChargeur";
//id de nbligne
$nb_ligne = "nbLigne";
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
           $destock_deb = $time_Cariste_h_Deb.$nbligne;
           $destock_fin = $time_Cariste_h_Fin.$nbligne;
           $destock_nom_Cariste = $nom_Cariste.$nbligne;
           $destock_nb_pal = $nb_pal_Cariste.$nbligne;
           
           $charg_deb = $time_Chargeur_h_Deb.$nbligne;
           $charg_fin = $time_Chargeur_h_Fin.$nbligne;
           $charg_nomChargeur = $nom_Chargeur.$nbligne;
           $charg_nb_pal = $nb_pal_Chargeur.$nbligne;
           
           $nb_id_ligne = $nb_ligne.$nbligne;         
           
           //evite les ligne vide
            if ($row[2] !== "") {
                array_push($data, array(               
                    'ligne' => "<span id='$nbligne'>$nbligne</span>",
                    'expo_Mag' => $expMag,
                    'report' => "<input type='text' id='$nb_id_ligne' style='width: 40px; height: 10px'/>" ,
                    'dpt' => utf8_encode($row[3]),
                    'hrev' => utf8_encode($row[5]),
                    'transporteur' => utf8_encode($row[7]),
                    'edi' => utf8_encode($row[8]),
                    'destinataires' => utf8_encode($row[11]),
                    'heure_Liv' => utf8_encode($row[13]),
                    'nb_Supp' => "<input type='number' id='$destock_nb_pal' style='width: 80px; height: 10px' value='$row[14]' onchange='diffTimeCarist()'/>",
                    'quai' => "<input type='text'/>",
                    'cariste' => "<input type='text' id='$destock_nom_Cariste'/>",
                    'destock_HD' => "<input type='time' id='$destock_deb' onchange='diffTimeCarist()'/>",
                    'destock_HF' => "<input type='time' id='$destock_fin' onchange='diffTimeCarist()'/>",
                    'h_Arriv' => "<input type='time'/>",
                    'porte' => "<input type='text'/>",
                    'chargeur' => "<input type='text' id='$charg_nomChargeur'/>",
                    'charg_H_Deb' => "<input type='time' id='$charg_deb' onchange='diffTimeCharg()'/>",
                    'charg_H_Fin' => "<input type='time' id='$charg_fin' onchange='diffTimeCharg()'/>",
                    'nb_Supp_Charg' => "<input type='number' id='$charg_nb_pal' style='width: 80px' onchange='diffTimeCharg()'/>",
                    'nb_Raq' => "<input type='number' style='width: 80px'/>",
                    'nb_pal_leg' => "<input type='number' style='width: 80px'/>",
                    'site' => "<input type='text'/>"
                ));
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
        'site' => "pb upload"
    );
}
// envoyer le contenu au format json
header('Content-Type: application/json;charset=utf-8');
echo json_encode($data);
