<?php

//import.php

//variable pour les id 

//nombre de ligne
// doit etre remplacé par le nombre de ligne +1 envoyer par ajax 
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

//essay de lecture de i qui envoyer par le ajax
$i=$_FILES[nbligne];
echo $i;

$expMag = "EXPE MAG";
$uploaddir = '/home/grammont/Documents/VersionFinalCsv/'; // repertoir ou sera stocke finalement le fichier
$uploadfile = $uploaddir . basename($_FILES['csv_file']['name']);
$data = array();
if (move_uploaded_file($_FILES['csv_file']['tmp_name'], $uploadfile)) { // upload ok
    if (!empty($uploadfile)) {
        $file_data = fopen($uploadfile, 'r');
        fgetcsv($file_data, 0, ";");
        while ($row = fgetcsv($file_data, 0, ";")) {
           
            $nbligne=$nbligne+1;
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
                    //retrait de toute les row  pour etre remplacer par des zone vierge
                    //nombre de ligne deja presente +1
                    'ligne' => "<span id='$nbligne'>$nbligne</span>",
                    //text
                    'expo_Mag' => "<input type='text'/>",                   
                    
                    'report' => "<input type='text' style='width: 40px; height: 10px'/>" ,
                        
                    'dpt' => "<input type='number' style='width: 80px; height: 10px'/>",
                    
                    'hrev' =>  "<input type='time' />",
                    
                    'transporteur' => "<input type='text'/>", 
                    
                    'edi' => "<input type='number' style='width: 80px; height: 10px'/>",
                    
                    'destinataires' => "<input type='text'/>", 
                    
                    'heure_Liv' => "<input type='time' />",
                    
                    'nb_Supp' => "<input type='number' id='$destock_nb_pal' style='width: 80px; height: 10px' onchange='diffTimeCarist()'/>",
                    
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
