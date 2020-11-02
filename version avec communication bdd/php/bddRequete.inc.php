<?php

define("SERVEURBD", "localhost");
define("LOGIN", "root");
define("MOTDEPASSE", "toto");
define("NOMDELABASE", "ma_bases");

//connection avec la basse de donnée (fonctionnel)
function connexionBdd() {
    try {
        $pdoOptions = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $bdd = new PDO('mysql:host=' . SERVEURBD . ';dbname=' . NOMDELABASE, LOGIN, MOTDEPASSE, $pdoOptions);
        $bdd->exec("set names utf8");
        return $bdd;
    } catch (PDOException $ex) {
        print "Erreur!: " . $ex->getMessage() . "<br/>";
        die();
    }
}

function viderBass() {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->query("delete from stage;");
        $requete->execute() or die(print_r($requete->errorInfo()));
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

//suprime la bases de donnée (fonctionnel)
function delBdd() {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->prepare("DROP TABLE stage");
        $requete->execute() or die(print_r($requete->errorInfo()));
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

//crée la bases de donnée (fonctionnel)
function createBdd() {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->prepare("CREATE TABLE stage (ligne int(10), exp varchar(60), report varchar(2), dpt int(10), edi int(10), hRev time(0), transporteur varchar(60), hLiv time(0), destinataire varchar(60), nbSupp int(10), quai varchar(20), cariste varchar(40), debutCariste time(0), finCariste time(0), hAriv time(0), porte varchar(20), chargeur varchar(40), debutCharg time(0), finCharg time(0), nbSuppCharg int(10), nbRaq int(10), nbPalLeg int(10), site varchar(60));");
        $requete->execute() or die(print_r($requete->errorInfo()));
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

// lors de la création d'une ligne ajoute sont numeros de ligne dans la basse dans le champ ligne (fonctionnel)
function ajoutLigne($ligne) {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->prepare("INSERT INTO stage (ligne) VALUES (:ligne)");
        $requete->bindParam(':ligne', $ligne);
        $requete->execute() or die(print_r($requete->errorInfo()));
        $requete->closeCursor();
        header('Content-type: application/json');
    } catch (PDOException $ex) {
        print "Erreur !: " . $ex->getMessage() . "<br/>";
        die();
    }
}

// permet de modifier une ligne (non fonctionnel)
//Erreur !: SQLSTATE[HY093]: Invalid parameter number: parameter was not defined
function mise_jour_ligne($ligne, $report, $exp, $dpt, $edi, $hrev, $transporteur, $hLiv, $destinataire, $nbSupp, $quai, $cariste, $debutCariste, $finCariste, $hAriv, $porte, $chargeur, $debutChargeur, $finChargeur, $nbSuppChargeur, $nbRaq, $nbpalLeg, $site) {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->prepare("update stage set (exp=:exp,report=:report,dpt=:dpt,edi=:edi,hRev=:hRev,transporteur=:transporteur,hLiv=:hLiv,destinataire=:destinataire,nbSupp=:nbSupp,quai=:quai,cariste=:cariste,debutCariste=:debutCariste,finCariste=:finCariste,hAriv=:hAriv,porte=:porte,chargeur=:chargeur,debutChargeur=:debutChargeur,finChargeur=:finChargeur,nbSuppCharg=:nbSuppCarg,nbRaq=:nbRaq,nbPalLeg=:nbPalLeg,site=:site) where ligne = :ligne;");

        $requete->bindParam(':ligne', $ligne);
        $requete->bindParam(':exp', $exp);
        $requete->bindParam(':report', $report);
        $requete->bindParam(':dpt', $dpt);
        $requete->bindParam(':edi', $edi);
        $requete->bindParam(':hRev', $hrev);
        $requete->bindParam(':transporteur', $transporteur);
        $requete->bindParam(':hLiv', $hLiv);
        $requete->bindParam(':destinataire', $destinataire);
        $requete->bindParam(':nbSupp', $nbSupp);
        $requete->bindParam(':quai', $quai);
        $requete->bindParam(':cariste', $cariste);
        $requete->bindParam(':debutCariste', $debutCariste);
        $requete->bindParam(':finCariste', $finCariste);
        $requete->bindParam(':hAriv', $hAriv);
        $requete->bindParam(':porte', $porte);
        $requete->bindParam(':chargeur', $chargeur);
        $requete->bindParam(':debutChargeur', $debutChargeur);
        $requete->bindParam(':finChargeur', $finChargeur);
        $requete->bindParam(':nbSuppCharg', $nbSuppChargeur);
        $requete->bindParam(':nbRaq', $nbRaq);
        $requete->bindParam(':nbPalLeg', $nbpalLeg);
        $requete->bindParam(':site', $site);

        $requete->execute() or die(print_r($requete->errorInfo()));
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

//renvoye tous le contenu de la basses vers le tableau (non fonctionel)
function renvoyerTableau() {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->query("select * from stage ;");
        $data = array();
        while ($row = $requete->fetch()) {
            array_push($data, array(
                'ligne' => $row['ligne'],
                'expo_Mag' => $row['exp'],
                'report' => $row['report'],
                'dpt' => $row['dpt'],
                'edi' => $row['edi'],
                'hrev' => $row['hRev'],
                'transporteur' => $row['transporteur'],
                'heure_Liv' => $row['hLiv'],
                'destinataire' => $row['destinataire'],
                'nb_Supp' => $row['nbSupp'],
                'quai' => $row['quai'],
                'cariste' => $row['cariste'],
                'destock_HD' => $row['debutCariste'],
                'destock_HF' => $row['finCariste'],
                'h_Arriv' => $row['hAriv'],
                'porte' => $row['porte'],
                'chargeur' => $row['chargeur'],
                'charg_H_Deb' => $row['debutCharg'],
                'charg_H_Fin' => $row['finCharg'],
                'nb_Supp_Charg' => $row['nbSuppCharg'],
                'nb_Raq' => $row['nbRaq'],
                'nb_pal_leg' => $row['nbPalLeg'],
                'site' => $row['site']
            ));
        }
        header('Content-type: application/json');
        echo json_encode($data);
    } catch (PDOException $ex) {
        print "Erreur !: " . $ex->getMessage() . "<br/>";
        die();
    }
}
