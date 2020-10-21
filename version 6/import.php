<?php

//import.php

//variable pour les id 

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
           
            if ($row[2] !== "") {
                array_push($data, array(               
                    'ligne' => $nbligne,                    
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
                    'nb_Supp_Charg' => "<input type='number' id='$charg_nb_pal' style='width: 100px' onchange='diffTimeCharg()'/>",
                    'nb_Raq' => "<input type='number' style='width: 100px'/>",
                    'nb_pal_leg' => "<input type='number' style='width: 100px'/>",
                    'site' => "<input type='text'/>",
                ));
                $nbligne = $nbligne + 1;
                
            }
        }
    }
} else { // pb upload
    $data[] = array(
        'numero_De_Dossier' => "pb upload",
        'ville_Enl' => "pb upload",
        'cp_Liv' => "pb upload",
        'date_Enl' => "pb upload",
        'heure_Enl' => "pb upload",
        'date_Liv' => "pb upload",
        'trp' => "pb upload",
        'ref_Chargement' => "pb upload",
        'code_Dest' => "pb upload",
        'date_Liv' => "pb upload",
        'destinataire' => "pb upload",
        'ville_Liv' => "pb upload",
        'heure_Liv' => "pb upload",
        'palette' => "pb upload",
        'mt_Transport' => "pb upload"
    );
}
// envoyer le contenu au format json
header('Content-Type: application/json;charset=utf-8');
echo json_encode($data);
