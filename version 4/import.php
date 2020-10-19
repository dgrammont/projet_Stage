<?php


//import.php
$nbligne=1;
$html="<input type='text'/>";
$expMag ="EXPE MAG";
$uploaddir = '/home/grammont/Documents/VersionFinalCsv/'; // repertoir ou sera stocke finalement le fichier
$uploadfile = $uploaddir . basename($_FILES['csv_file']['name']);
$data = array();
if (move_uploaded_file($_FILES['csv_file']['tmp_name'], $uploadfile)) { // upload ok
    if (!empty($uploadfile)) {
        $file_data = fopen($uploadfile, 'r');
        fgetcsv($file_data, 0, ";");
        while ($row = fgetcsv($file_data, 0, ";")) {
            if($row[2]!==""){
           array_push($data, array(
                
                //'vide' => utf8_encode($row[0]),
                //'vide' => "",
                'ligne' =>$nbligne,
                //'numero_De_Dossier' => utf8_encode($row[1]),
                'expo_Mag' => $expMag,
                //'ville_Enl' => utf8_encode($row[2]),
                'report' => $html,
                //'cp_Liv' => utf8_encode($row[3]),
                'dpt' => utf8_encode($row[3]),
                //'date_Enl' => utf8_encode($row[4]),
                //'heure_Enl' => utf8_encode($row[5]),
                'hrev' => utf8_encode($row[5]),
                //'date_Liv' => utf8_encode($row[6]),
                //'trp' => utf8_encode($row[7]),
                'transporteur' => utf8_encode($row[7]),
                //'ref_Chargement' => utf8_encode($row[8]),
                'edi'=> utf8_encode($row[8]),
                //'code_Dest' => utf8_encode($row[9]),
              //  'date_Liv' => utf8_encode($row[10]),
            //    'destinataire' => utf8_encode($row[11]),
                'destinataires' => utf8_encode($row[11]),
          //      'ville_Liv' => utf8_encode($row[12]),
                'heure_Liv' => utf8_encode($row[13]),
        //        'palette' => utf8_encode($row[14]),
                'nb_Supp' => utf8_encode($row[14]),
      //          'mt_Transport' => utf8_encode($row[15])
                
            ));
            $nbligne=$nbligne+1;
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
//print_r($data);
header('Content-Type: application/json;charset=utf-8');
echo json_encode($data);
