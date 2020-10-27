<?php

define("SERVEURBD", "localhost");
define("LOGIN", "root");
define("MOTDEPASSE", "toto");
define("NOMDELABASE", "ma_bases");

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

function voirBass() {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->prepare("SELECT * FROM stage");
        $requete->execute() or die(print_r($requete->errorInfo()));
        echo '<table>';
        echo '<tr>';
        echo '<th>ligne</th>';
        echo '<th>exp</th>';
        echo '<th>report</th>';
        echo '</tr>';
        while ($ligne = $requete->fetch()) {
            echo '<tr>';
            echo '<td>';
            echo $ligne['ligne'];
            echo '</td>';
            echo '<td>';
            echo $ligne['exp'];
            echo '</td>';
            echo '<td>';
            echo $ligne['report'];
            echo '</td>';
            echo '<tr>';
        }
        echo '</table>';
        $requete->closeCursor();
    } catch (PDOException $ex) {
        print "Erreur !: " . $ex->getMessage() . "<br/>";
        die();
    }
}

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

function createBdd() {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->prepare("CREATE TABLE stage (ligne int(10), exp varchar(60), report varchar(2), dpt int(10), edi int(10), hRev time(0), transporteur varchar(60), hLiv time(0), destinataire varchar(60), nbSupp int(10), quai varchar(20), cariste varchar(40), debutCariste time(0), finCariste time(0), hAriv time(0), porte varchar(20), chargeur varchar(40), debutCarg time(0), finCharg time(0), nbSuppCarhg int(10), nbRaq int(10), nbPalLeg int(10), site varchar(60));");
        $requete->execute() or die(print_r($requete->errorInfo()));
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function renvoiTable() {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->prepare("SELECT * form stage");
        $requete->execute() or die(print_r($requete->errorInfo()));
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function ajoutLigne($ligne) {
    try {
        $test = "succces";
        $bdd = connexionBdd();
        $requete = $bdd->prepare("INSERT INTO test (ligne) VALUES (:ligne)");
        $requete->bindParam(':ligne', $ligne);
        $requete->execute() or die(print_r($requete->errorInfo()));




        $requete->closeCursor();
        header('Content-type: application/json');
        echo json_encode($test);
    } catch (PDOException $ex) {
        print "Erreur !: " . $ex->getMessage() . "<br/>";
        die();
    }
}

function ajouterLignebdd($ligne, $exp, $report, $dpt, $edi, $h_rev, $transporteur, $h_liv, $destinataire, $nb_supp, $quai, $cariste, $debut_cariste, $fin_cariste, $h_ariv, $porte, $chargeur, $debut_charg, $fin_chargeur, $nb_supp_charges, $nb_raq, $nb_pal_leg, $site){
       try {    
        $bdd = connexionBdd();
       $requete = $bdd->prepare("insert into stage (ligne, exp, report, dpt, edi, hRev, transporteur, hLiv, destinataire, nbSupp, quai, cariste, debutCariste, finCariste, hAriv, porte, chargeur, debutCharg, finCharg, nbSuppCharge, nbRaq, nbPalLeg, site) values(:ligne, :exp, :report, :dpt, :edi, :h_rev, :transporteur, :h_liv, :destinataire, :nb_supp, :quai, :cariste, :debut_cariste, :fin_cariste, :h_ariv, :porte, :chargeur, :debut_charg, :fin_charg, :nb_supp_charge, :nb_raq, :nb_pal_leg, :site)");
        $requete->bindParam(':ligne', $ligne);  $requete->bindParam(':exp', $exp); $requete->bindParam(':report', $report);  $requete->bindParam(':dpt', $dpt);$requete->bindParam(':edi', $edi); $requete->bindParam(':h_rev', $h_rev); $requete->bindParam(':transporteur', $transporteur); $requete->bindParam(':h_liv', $h_liv); $requete->bindParam(':destinataire', $destinataire); $requete->bindParam(':nb_supp', $nb_supp);  $requete->bindParam(':quai', $quai); $requete->bindParam(':cariste', $cariste); $requete->bindParam(':debut_cariste', $debut_cariste); $requete->bindParam(':fin_cariste', $fin_cariste); $requete->bindParam(':h_ariv', $h_ariv); $requete->bindParam(':porte', $porte); $requete->bindParam(':chargeur', $chargeur); $requete->bindParam(':debut_charg', $debut_charg); $requete->bindParam(':fin_charg', $fin_chargeur); $requete->bindParam(':nb_supp_charge', $nb_supp_charges); $requete->bindParam(':nb_raq', $nb_raq);  $requete->bindParam(':nb_pal_leg', $nb_pal_leg);$requete->bindParam(':site', $site);   
        $requete->execute() or die(print_r($requete->errorInfo()));
        $requete->closeCursor();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

