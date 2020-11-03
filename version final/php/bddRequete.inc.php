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

//permet de vidé la base de donné 
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

// permet de modifier une ligne crée par utilisateur (fonctionnel)
function mise_jour_ligne_uti($ligne, $report, $exp, $dpt, $edi, $hrev, $transporteur, $hLiv, $destinataire, $nbSupp, $quai, $cariste, $debutCariste, $finCariste, $hAriv, $porte, $chargeur, $debutChargeur, $finChargeur, $nbSuppChargeur, $nbRaq, $nbpalLeg, $site) {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->prepare("update stage set exp=:exp,report=:report,dpt=:dpt,edi=:edi,hRev=:hRev,transporteur=:transporteur,hLiv=:hLiv,destinataire=:destinataire,nbSupp=:nbSupp,quai=:quai,cariste=:cariste,debutCariste=:debutCariste,finCariste=:finCariste,hAriv=:hAriv,porte=:porte,chargeur=:chargeur,debutCharg=:debutChargeur,finCharg=:finChargeur,nbSuppCharg=:nbSuppCharg,nbRaq=:nbRaq,nbPalLeg=:nbPalLeg,site=:site where ligne = :ligne;");

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

// permet de modifier une ligne crée par le fichier (fonctionnel)
function mise_jour_ligne_file($ligne, $report, $quai, $cariste, $debutCariste, $finCariste, $hAriv, $porte, $chargeur, $debutChargeur, $finChargeur, $nbSuppChargeur, $nbRaq, $nbpalLeg, $site) {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->prepare("update stage set report=:report,quai=:quai,cariste=:cariste,debutCariste=:debutCariste,finCariste=:finCariste,hAriv=:hAriv,porte=:porte,chargeur=:chargeur,debutCharg=:debutChargeur,finCharg=:finChargeur,nbSuppCharg=:nbSuppCharg,nbRaq=:nbRaq,nbPalLeg=:nbPalLeg,site=:site where ligne = :ligne;");

        $requete->bindParam(':ligne', $ligne);
        $requete->bindParam(':report', $report);
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
            $ligne = $row['ligne'];
            if ($ligne == null) {
                $ligne = ' ';
            }
            $expMag = $row['exp'];
            if ($expMag == null) {
                $expMag = ' ';
            }
            $report = $row['report'];
            if ($report == null) {
                $report = ' ';
            }
            $dpt = $row['dpt'];
            if ($dpt == null) {
                $dpt = ' ';
            }
            $edi = $row['edi'];
            if ($edi == null) {
                $edi = ' ';
            }
            $hRev = $row['hRev'];
            if ($hRev == null) {
                $hRev = ' ';
            }
            $transporteur = $row['transporteur'];
            if ($transporteur == null) {
                $transporteur = ' ';
            }
            $hLiv = $row['hLiv'];
            if ($hLiv == null) {
                $hLiv = ' ';
            }
            $destinataire = $row['destinataire'];
            if ($destinataire == null) {
                $destinataire = ' ';
            }
            $nbSupp = $row['nbSupp'];
            if ($nbSupp == null) {
                $nbSupp = ' ';
            }
            $quai = $row['quai'];
            if ($quai == null) {
                $quai = ' ';
            }
            $cariste = $row['cariste'];
            if ($cariste == null) {
                $cariste = ' ';
            }
            $debutCariste = $row['debutCariste'];
            if ($debutCariste == null) {
                $debutCariste = ' ';
            }
            $finCariste = $row['finCariste'];
            if ($finCariste == null) {
                $finCariste = ' ';
            }
            $hAriv = $row['hAriv'];
            if ($hAriv == null) {
                $hAriv = ' ';
            }
            $porte = $row['porte'];
            if ($porte == null) {
                $porte = ' ';
            }
            $chargeur = $row['chargeur'];
            if ($chargeur == null) {
                $chargeur = ' ';
            }
            $debutChargeur = $row['debutCharg'];
            if ($debutChargeur == null) {
                $debutChargeur = ' ';
            }
            $finChargeur = $row['finCharg'];
            if ($finChargeur == null) {
                $finChargeur = ' ';
            }
            $nbSuppCharg = $row['nbSuppCharg'];
            if ($nbSuppCharg == null) {
                $nbSuppCharg = ' ';
            }
            $nbRaq = $row['nbRaq'];
            if ($nbRaq == null) {
                $nbRaq = ' ';
            }
            $nbPalLeg = $row['nbPalLeg'];
            if ($nbPalLeg == null) {
                $nbPalLeg = ' ';
            }
            $site = $row['site'];
            if ($site == null) {
                $site = ' ';
            }
            array_push($data, array(
                'ligne' => $ligne,
                'expo_Mag' => $expMag
                ,
                'report' => $report,
                'dpt' => $dpt,
                'edi' => $edi,
                'hrev' => $hRev,
                'transporteur' => $transporteur,
                'heure_Liv' => $hLiv,
                'destinataire' => $destinataire,
                'nb_Supp' => $nbSupp,
                'quai' => $quai,
                'cariste' => $cariste,
                'destock_HD' => $debutCariste,
                'destock_HF' => $finCariste,
                'h_Arriv' => $hAriv,
                'porte' => $porte,
                'chargeur' => $chargeur,
                'charg_H_Deb' => $debutChargeur,
                'charg_H_Fin' => $finChargeur,
                'nb_Supp_Charg' => $nbSuppCharg,
                'nb_Raq' => $nbRaq,
                'nb_pal_leg' => $nbPalLeg,
                'site' => $site
            ));
        }

        header('Content-type: application/json;charset=utf-8');
        echo json_encode($data);
    } catch (PDOException $ex) {
        print "Erreur !: " . $ex->getMessage() . "<br/>";
        die();
    }
}
