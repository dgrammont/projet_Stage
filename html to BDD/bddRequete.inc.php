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

//permet de voir toutes les entré dans la table (fonctionnel)
function voirBass() {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->prepare("SELECT * FROM stage");
        $requete->execute() or die(print_r($requete->errorInfo()));
        echo '<table>'; echo '<tr>'; echo '<th>ligne</th>'; echo '<th>exp</th>';  echo '<th>report</th>'; echo '<th>dpt</th>';  echo '<th>edi</th>'; echo '<th>hRev</th>';  echo '<th>transporteur</th>'; echo '<th>hLiv</th>';  echo '<th>destinataire</th>'; echo '<th>nbSupp</th>';  echo '<th>quai</th>'; echo '<th>cariste</th>';  echo '<th>debutCariste</th>'; echo '<th>finCariste</th>';  echo '<th>hAriv</th>'; echo '<th>porte</th>';  echo '<th>chargeur</th>'; echo '<th>debutCharg</th>';  echo '<th>finCharg</th>'; echo '<th>nbSuppCharg</th>';  echo '<th>nbRaq</th>'; echo '<th>nbPalLeg</th>';  echo '<th>site</th>'; echo '</tr>';
        while ($ligne = $requete->fetch()) {
            echo '<tr>';  echo '<td>';   echo $ligne['ligne'];  echo '</td>'; echo '<td>'; echo $ligne['exp'];   echo '</td>';   echo '<td>';  echo $ligne['report']; echo '</td>';
            echo '<td>';   echo $ligne['dpt'];  echo '</td>'; echo '<td>'; echo $ligne['edi'];   echo '</td>';   echo '<td>';  echo $ligne['hRev']; echo '</td>'; echo '<td>';   echo $ligne['transporteur'];  echo '</td>'; echo '<td>'; echo $ligne['hLiv'];   echo '</td>';   echo '<td>';  echo $ligne['destinataire']; echo '</td>';echo '<td>';   echo $ligne['nbSupp'];  echo '</td>'; echo '<td>'; echo $ligne['quai'];   echo '</td>';   echo '<td>';  echo $ligne['cariste']; echo '</td>';echo '<td>';   echo $ligne['debutCariste'];  echo '</td>'; echo '<td>'; echo $ligne['finCariste'];   echo '</td>';   echo '<td>';  echo $ligne['hAriv']; echo '</td>';echo '<td>';   echo $ligne['porte'];  echo '</td>'; echo '<td>'; echo $ligne['chargeur'];   echo '</td>';   echo '<td>';  echo $ligne['debutCarg']; echo '</td>';echo '<td>';   echo $ligne['finCharg'];  echo '</td>'; echo '<td>'; echo $ligne['nbSuppCharg'];   echo '</td>';   echo '<td>';  echo $ligne['nbRaq']; echo '</td>';echo '<td>';  echo $ligne['nbPalLeg']; echo '</td>';echo '<td>';  echo $ligne['site']; echo '</td>';         echo '<tr>';   
        }
        echo '</table>';
        $requete->closeCursor();
    } catch (PDOException $ex) {
        print "Erreur !: " . $ex->getMessage() . "<br/>";
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
        $requete = $bdd->prepare("CREATE TABLE stage (ligne int(10), exp varchar(60), report varchar(2), dpt int(10), edi int(10), hRev time(0), transporteur varchar(60), hLiv time(0), destinataire varchar(60), nbSupp int(10), quai varchar(20), cariste varchar(40), debutCariste time(0), finCariste time(0), hAriv time(0), porte varchar(20), chargeur varchar(40), debutCarg time(0), finCharg time(0), nbSuppCharg int(10), nbRaq int(10), nbPalLeg int(10), site varchar(60));");
        $requete->execute() or die(print_r($requete->errorInfo()));
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

// permet de rajouté une ligne avec comme seul atribut le numero de ligne , quand la fonction add est appelé (non fonctionnel)
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

// permet de modifier une ligne (non fonctionnel)
function mise_jour_ligne(){
    try{
    $bdd = connexionBdd();
    $requete = $bdd->prepare("update stage set ligne='1' where ligne='10';");
    $requete->execute() or die(print_r($requete->errorInfo()));
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

//permet d'ajouté des donnée dans une ligne (non fonctionnel)
function ajoutData($ligne){
     try{
    $bdd = connexionBdd();
    $requete = $bdd->prepare("intert into stage set (ligne) values(:ligne);");
    $requete->bindParam(':ligne', $ligne);
    $requete->execute() or die(print_r($requete->errorInfo()));
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

//recupére tous le tableau pour le metre dans la basses de données (non testé)
function ajoutTableau($ligne,$report,$exp,$dpt,$edi,$hrev,$transporteur,$hLiv,$destinataire,$nbSupp,$quai,$cariste,$debutCariste,$finCariste,$hAriv,$porte,$chargeur,$debutChargeur,$finChargeur,$nbSuppChargeur,$nbRaq,$nbpalLeg,$site){
    try{
    $bdd = connexionBdd();
    $requete = $bdd->prepare("insert into stage (ligne) values(:ligne);");
    $requete->bindParam(':ligne',$ligne);
    ajoutTableauDeux($ligne,$report,$exp,$dpt,$edi,$hrev,$transporteur,$hLiv,$destinataire,$nbSupp,$quai,$cariste,$debutCariste,$finCariste,$hAriv,$porte,$chargeur,$debutChargeur,$finChargeur,$nbSuppChargeur,$nbRaq,$nbpalLeg,$site);
    $requete->execute() or die(print_r($requete->errorInfo()));
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
//une fois la ligne crée on ajout toutes les donnée avec commme condition le meme numero ligne 
function ajoutTableauDeux($ligne,$report,$exp,$dpt,$edi,$hrev,$transporteur,$hLiv,$destinataire,$nbSupp,$quai,$cariste,$debutCariste,$finCariste,$hAriv,$porte,$chargeur,$debutChargeur,$finChargeur,$nbSuppChargeur,$nbRaq,$nbpalLeg,$site){
    try{
    $bdd = connexionBdd();
    $requete = $bdd->prepare("update stage set (exp=:exp,report=:report,dpt=:dpt,edi=:edi,hRev=:hRev,transporteur=:transporteur,hLiv=:hLiv,destinataire=:destinataire,nbSupp=:nbSupp,quai=:quai,cariste=:cariste,debutCariste=:debutCariste,finCariste=:finCariste,hAriv=:hAriv,porte=:porte,chargeur=:chargeur,debutChargeur=:debutChargeur,finChargeur=:finChargeur,nbSuppCharg=:nbSuppCarg,nbRaq=:nbRaq,nbPalLeg=:nbPalLeg,site=:site) where ligne = :ligne;");
    
    $requete->bindParam(':ligne', $ligne); $requete->bindParam(':exp', $exp);$requete->bindParam(':report', $report); $requete->bindParam(':dpt', $dpt); $requete->bindParam(':edi', $edi);$requete->bindParam(':hRev', $hrev);$requete->bindParam(':transporteur', $transporteur);$requete->bindParam(':hLiv', $hLiv);$requete->bindParam(':destinataire', $destinataire);$requete->bindParam(':nbSupp', $nbSupp);$requete->bindParam(':quai', $quai);$requete->bindParam(':cariste', $cariste);$requete->bindParam(':debutCariste', $debutCariste);$requete->bindParam(':finCariste', $finCariste);$requete->bindParam(':hAriv', $hAriv);$requete->bindParam(':porte', $porte);$requete->bindParam(':chargeur', $chargeur);$requete->bindParam(':debutChargeur', $debutChargeur);$requete->bindParam(':finChargeur', $finChargeur);$requete->bindParam(':nbSuppChargeur', $nbSuppChargeur);$requete->bindParam(':nbRaq', $nbRaq);$requete->bindParam(':nbPalLeg', $nbpalLeg);$requete->bindParam(':site', $site);
    
    $requete->execute() or die(print_r($requete->errorInfo()));
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

//renvoye tous le contenu de la basses vers le tableau (non testé)
function renvoyerTableau(){
    try{
    $bdd = connexionBdd();
    $requete = $bdd->prepare("select * from stage ;");
    $requete->execute() or die(print_r($requete->errorInfo()));
    echo json_encode($requete);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}