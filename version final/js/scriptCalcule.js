//envoyée les donné du fichier vers le tableau
function upload(event) {

    event.preventDefault();
    $.ajax({
        url: "./php/import.php",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (jsonData)
        {
            $('#csv_file').val('');

            $('#data-planning').DataTable({
                data: jsonData,
                dataType: 'json',
                fixedHeader: false,
                "lengthMenu": [[5, 10, 15, 25, 50, 100, -1], [5, 10, 15, 25, 50, 100, "Tous"]],
                'iDisplayLength': -1,
                columns: [

                    {data: "ligne"},
                    {data: "expo_Mag"},
                    {data: "report"},
                    {data: "dpt"},
                    {data: "edi"},
                    {data: "hrev"},
                    {data: "transporteur"},
                    {data: "heure_Liv"},
                    {data: "destinataires"},
                    {data: "nb_Supp"},
                    {data: "quai"},
                    {data: "cariste"},
                    {data: "destock_HD"},
                    {data: "destock_HF"},
                    {data: "h_Arriv"},
                    {data: "porte"},
                    {data: "chargeur"},
                    {data: "charg_H_Deb"},
                    {data: "charg_H_Fin"},
                    {data: "nb_Supp_Charg"},
                    {data: "nb_Raq"},
                    {data: "nb_pal_leg"},
                    {data: "observation"},
                    {data: "envoyer"}
                ]

            });


        }
    });
    $("#ajoute_ligne").css("display", "block");
    $("#nbSuppTotal").css("display", "block");
    $("#visuel").css("display", "block");
    $("#slash").css("display", "block");
    $("#nbSupp").css("display", "block");
    $("#nbSuppRestant").css("display", "block");
    
    $("#nbSuppchargRestant").css("display", "block");
    $("#nbSuppChargTotal").css("display", "block");
    $("#nbSuppcharg").css("display", "block");
    $("#slashcharg").css("display", "block");
       
    setTimeout("changerCouleur()", 4000);
    setTimeout("nombreDeSupp()", 4000);
}


function diffTimeCharg() {

    var id = $(this).attr('id');
    var numero = id.substring(12);
    console.log("id  :" + id);
    console.log("numero:" + numero);

    var t = $('#data-planning').DataTable();

    var nomChargeur = "nomChargeur";

    var nb = numero;



    let nomchargeur = nomChargeur + nb;
    document.getElementById(nomchargeur).style.backgroundColor = "#00FF00";
    
    
    var memoire = 0;
    var forceint = 0;
    var deja_la = 0;

    var nbSupp = "nbPalChargeur";
    let nbsupp = nbSupp + nb;
    var suppUti = "nbPalChargeurNew";
    let suppUtilisateur = suppUti +nb;
    
    var acutelle = document.getElementById("nbSuppcharg").innerText;
    
    if (document.getElementById(nbsupp) !== null){  
    deja_la = parseFloat(acutelle, 10);
    if (deja_la > 1) {
        memoire += deja_la;
        var test = document.getElementById(nbsupp).value;
        forceint = parseFloat(test, 10);
        memoire += forceint/2;
        document.getElementById("nbSuppcharg").innerHTML = memoire;

    } else {
        var test = document.getElementById(nbsupp).value;
        forceint = parseFloat(test, 10);
        memoire += forceint/2;
        document.getElementById("nbSuppcharg").innerHTML = memoire;
    }
    }else{
        deja_la = parseFloat(acutelle, 10);
    if (deja_la > 1) {
        memoire += deja_la;
        var test = document.getElementById(suppUtilisateur).value;
        forceint = parseFloat(test, 10);
        memoire += forceint/2;
        document.getElementById("nbSuppcharg").innerHTML = memoire;

    } else {
        var test = document.getElementById(suppUtilisateur).value;
        forceint = parseFloat(test, 10);
        memoire += forceint/2;
        document.getElementById("nbSuppcharg").innerHTML = memoire;
    }
    }
}


function diffTimeCarist() {
     
    var id = $(this).attr('id');
    var numero = id.substring(11);
    console.log("id  :" + id);
    console.log("numero:" + numero);

    var nomCariste = "nomCariste";

    var nb = numero;

    let nomcarist = nomCariste + nb;
    document.getElementById(nomcarist).style.backgroundColor = "#00FF00";   



    var memoire = 0;
    var forceint = 0;
    var deja_la = 0;

    var nbSupp = "nbPalCariste";
    let nbsupp = nbSupp + nb;
    var suppUti = "nbPalCaristeNew";
    let suppUtilisateur = suppUti +nb;
    
    var acutelle = document.getElementById("nbSupp").innerText;
    
    if (document.getElementById(nbsupp) !== null){  
    deja_la = parseFloat(acutelle, 10);
    if (deja_la > 1) {
        memoire += deja_la;
        var test = document.getElementById(nbsupp).value;
        forceint = parseFloat(test, 10);
        memoire += forceint/2;
        document.getElementById("nbSupp").innerHTML = memoire;

    } else {
        var test = document.getElementById(nbsupp).value;
        forceint = parseFloat(test, 10);
        memoire += forceint/2;
        document.getElementById("nbSupp").innerHTML = memoire;
    }
    }else{
        deja_la = parseFloat(acutelle, 10);
    if (deja_la > 1) {
        memoire += deja_la;
        var test = document.getElementById(suppUtilisateur).value;
        forceint = parseFloat(test, 10);
        memoire += forceint/2;
        document.getElementById("nbSupp").innerHTML = memoire;

    } else {
        var test = document.getElementById(suppUtilisateur).value;
        forceint = parseFloat(test, 10);
        memoire += forceint/2;
        document.getElementById("nbSupp").innerHTML = memoire;
    }
    }
}



// permet de rajouter une ligne 
function addLine() {

    var t = $('#data-planning').DataTable();

    var nbLigne = t.rows().count();
    nbLigne += 1;
    //id report
    var nbLigneReport = "report";
    nbLigneReport += nbLigne;
    //id exp
    var expMag_id = "exp_Mag";
    expMag_id += nbLigne;
    //id dpt
    var dpt_id = "dpt";
    dpt_id += nbLigne;
    //id edi
    var edi_id = "edi";
    edi_id += nbLigne;
    //id hrev
    var hrev_id = "hRev";
    hrev_id += nbLigne;
    //id transporteur
    var transporteur_id = "transporteur";
    transporteur_id += nbLigne;
    //id h livraison
    var hliv_id = "hLiv";
    hliv_id += nbLigne;
    //id destinataire
    var destinataire_id = "destinataire";
    destinataire_id += nbLigne;
    //id quai
    var quai_id = "quai";
    quai_id += nbLigne;
    //h arrivé
    var harriv_id = "hArriv";
    harriv_id += nbLigne;
    //id porte
    var porte_id = "porte";
    porte_id += nbLigne;
    //id nombre de raq
    var nbraq_id = "nbRaq";
    nbraq_id += nbLigne;
    //id nombre de palette legére
    var nbpalleg_id = "nbPalLeg";
    nbpalleg_id += nbLigne;
    //id site 
    var site_id = "site";
    site_id += nbLigne;
    //id du button envoyer
    var envoyer_id = "sendNew";
    envoyer_id += nbLigne;
    //heure de debut du cariste
    var time_Cariste_h_Deb = "caristeHdeb";
    time_Cariste_h_Deb += nbLigne;
    //heure de fin du cariste
    var time_Cariste_h_Fin = "caristeHfin";
    time_Cariste_h_Fin += nbLigne;
    //nom du cariste
    var nom_Cariste = "nomCariste";
    nom_Cariste += nbLigne;
    //nombre de palette du Cariste
    var nb_pal_Cariste = "nbPalCaristeNew";
    nb_pal_Cariste += nbLigne;
    //nombre de palette du chargeur
    var nb_pal_Chargeur = "nbPalChargeurNew";
    nb_pal_Chargeur += nbLigne;
    //nom du chargeur
    var nom_Chargeur = "nomChargeur";
    nom_Chargeur += nbLigne;
    //heure de debut du chargeur
    var time_Chargeur_h_Deb = "chargeurHdeb";
    time_Chargeur_h_Deb += nbLigne;
    //heure de fin du chargeur
    var time_Chargeur_h_Fin = "chargeurhfin";
    time_Chargeur_h_Fin += nbLigne;

    //  var line = "<input type='text' id='" + nbLigne + "' value='" + nbLigne + "' style='width: 40px';/>";
    var line = "<span id='" + nbLigne + "'> " + nbLigne + "</span>";
    var expo_Mag = "<input type'text' id='" + expMag_id + "' style='width: 80px; height: 10px'/>";
    var dpt = "<input type='number' id='" + dpt_id + "'style='width: 80px; height: 10px'/>";
    var edi = "<input type='number' id='" + edi_id + "'style='width: 80px; height: 10px'/>";
    var hrev = "<input type='time' id='" + hrev_id + "'/>";
    var transporteur = "<input type='text' id='" + transporteur_id + "'style='width: 80px; height: 10px'/>";
    var hLiv = "<input type='time'   id='" + hliv_id + "'/>";
    var destinataire = "<input type='text' id='" + destinataire_id + "'/>";
    var quai = "<input type='text' id='" + quai_id + "'style='width: 60px; height: 10px'/>";
    var hariv = "<input type='time' id='" + harriv_id + "'/>";
    var porte = "<input type='text' id='" + porte_id + "'style='width: 50px; height: 10px'/>";
    var submit = "<input type='submit' id='" + envoyer_id + "'/>";
    var report = "<input type='text' id='" + nbLigneReport + "' style='width: 40px; height: 10px'/>";
    var raq = "<input type='number' id='" + nbraq_id + "' style='width: 80px'/>";
    var nbpalleg = "<input type='number' id='" + nbpalleg_id + "' style='width: 80px'/>";
    var site = "<input type='text' id='" + site_id + "'style='width: 80px; height: 10px'/>";
    var nbPalCariste = "<input type='number' id='" + nb_pal_Cariste + "' style='width: 80px' />";
    var nbPalCharg = "<input type='number' id='" + nb_pal_Chargeur + "' style='width: 80px;' />";
    var nomCariste = "<input type='text' id='" + nom_Cariste + "' style='width: 80px; background-color: rgb(255, 0, 0);'/>";
    var nomChargeur = "<input type='text' id='" + nom_Chargeur + "' style='width: 80px; background-color: rgb(255, 0, 0);'/>";
    var timeDebCariste = "<input type='time' id='" + time_Cariste_h_Deb + "' />";
    var timeFinCariste = "<input type='time' id='" + time_Cariste_h_Fin + "' />";
    var timeDebChargeur = "<input type='time' id='" + time_Chargeur_h_Deb + "' />";
    var timeFinChargeur = "<input type='time' id='" + time_Chargeur_h_Fin + "' />";
    t.row.add({

        ligne: line,
        expo_Mag: expo_Mag,
        report: report,
        dpt: dpt,
        edi: edi,
        hrev: hrev,
        transporteur: transporteur,
        heure_Liv: hLiv,
        destinataires: destinataire,
        nb_Supp: nbPalCariste,
        quai: quai,
        cariste: nomCariste,
        destock_HD: timeDebCariste,
        destock_HF: timeFinCariste,
        h_Arriv: hariv,
        porte: porte,
        chargeur: nomChargeur,
        charg_H_Deb: timeDebChargeur,
        charg_H_Fin: timeFinChargeur,
        nb_Supp_Charg: nbPalCharg,
        nb_Raq: raq,
        nb_pal_leg: nbpalleg,
        observation: site,
        envoyer: submit

    }).draw(false);

    $.ajax({
        url: "./php/controleur.php",
        data: {
            'commande': 'nouvelleLigne',
            'ligne': nbLigne
        },
        dataType: 'json',
        method: "GET",
        success: function (donnees, status, xhr) {
            //metre le text de la réponse ajax dans le champs div ayant pour id yes
            $("#yes").text(donnees);
        },
        error: function (xhr, status, error) {
            console.log("param : " + JSON.stringify(xhr));
            console.log("status : " + status);
            console.log("error : " + error);
        }
    });
    
}

// suprimé la table 
function deleteTable() {
    var answer = window.confirm("Vous allez surprimé le planning!");
    if (answer === true) {
        $('#upload_csv').on('submit', upload);

    } else {
        
    }
}


//permet de voir le visuel pour la page qui permet d'envoyer la tableau dans le format voulu. 
function voirVisuel() {
    document.location.href = "exportVisual.html";
}

//le boutton file n'a pas besoin de toutes les données du tableau
function bouttonEnvoyerFile() {
    var id = $(this).attr('id');
    var numero = id.substring(7);
    console.log("id :" + id);
    console.log("numero:" + numero);

    var time_Cariste_h_Deb_bdd = $('#caristeHdeb' + numero).val();
    var time_Cariste_h_Fin_bdd = $('#caristeHfin' + numero).val();
    var nom_Cariste_bdd = $('#nomCariste' + numero).val();
    var time_Chargeur_h_Deb_bdd = $('#chargeurHdeb' + numero).val();
    var time_Chargeur_h_Fin_bdd = $('#chargeurhfin' + numero).val();
    var nom_Chargeur_bdd = $('#nomChargeur' + numero).val();
    var nb_pal_Chargeur_bdd = $('#nbPalChargeur' + numero).val();
    var report_bdd = $('#report' + numero).val();
    var quai_bdd = $('#quai' + numero).val();
    var hariv_bdd = $('#hArriv' + numero).val();
    var porte_bdd = $('#porte' + numero).val();
    var nbraq_bdd = $('#nbRaq' + numero).val();
    var nbpalleg_bdd = $('#nbPalLeg' + numero).val();
    var site_bdd = $('#site' + numero).val();

    $.ajax({
        url: "./php/controleur.php",
        data: {
            'commande': 'mise_jour_ligne_file',
            'ligne': numero,
            'report': report_bdd,
            'quai': quai_bdd,
            'cariste': nom_Cariste_bdd,
            'debCariste': time_Cariste_h_Deb_bdd,
            'finCariste': time_Cariste_h_Fin_bdd,
            'hariv': hariv_bdd,
            'porte': porte_bdd,
            'chargeur': nom_Chargeur_bdd,
            'chargeurdeb': time_Chargeur_h_Deb_bdd,
            'chargeurfin': time_Chargeur_h_Fin_bdd,
            'nbsuppcharg': nb_pal_Chargeur_bdd,
            'nbraq': nbraq_bdd,
            'nbpalleg': nbpalleg_bdd,
            'site': site_bdd


        },
        dataType: 'json',
        method: "GET",
        success: function (donnees, status, xhr) {
            //metre le text de la réponse ajax dans le champs div ayant pour id yes
            //$("#yes").text(donnees);
        },
        error: function (xhr, status, error) {
            console.log("param : " + JSON.stringify(xhr));
            console.log("status : " + status);
            console.log("error : " + error);
        }
    });
}

//le button uti a besoin de toutes les données du tableau
function bouttonEnvoyerUti() {
    var id = $(this).attr('id');
    var numero = id.substring(7);
    console.log("id  :" + id);
    console.log("numero:" + numero);

    var time_Cariste_h_Deb_bdd = $('#caristeHdeb' + numero).val();
    var time_Cariste_h_Fin_bdd = $('#caristeHfin' + numero).val();
    var nom_Cariste_bdd = $('#nomCariste' + numero).val();
    var nb_pal_Cariste_bdd = $('#nbPalCaristeNew' + numero).val();
    var time_Chargeur_h_Deb_bdd = $('#chargeurHdeb' + numero).val();
    var time_Chargeur_h_Fin_bdd = $('#chargeurhfin' + numero).val();
    var nom_Chargeur_bdd = $('#nomChargeur' + numero).val();
    var nb_pal_Chargeur_bdd = $('#nbPalChargeurNew' + numero).val();
    var expMag_bdd = $('#exp_Mag' + numero).val();
    var report_bdd = $('#report' + numero).val();
    var dpt_bdd = $('#dpt' + numero).val();
    var hrev_bdd = $('#hRev' + numero).val();
    var transporteur_bdd = $('#transporteur' + numero).val();
    var edi_bdd = $('#edi' + numero).val();
    var destinataire_bdd = $('#destinataire' + numero).val();
    var heurLiv_bdd = $('#hLiv' + numero).val();
    var quai_bdd = $('#quai' + numero).val();
    var hariv_bdd = $('#hArriv' + numero).val();
    var porte_bdd = $('#porte' + numero).val();
    var nbraq_bdd = $('#nbRaq' + numero).val();
    var nbpalleg_bdd = $('#nbPalLeg' + numero).val();
    var site_bdd = $('#site' + numero).val();

    $.ajax({
        url: "./php/controleur.php",
        data: {
            'commande': 'mise_jour_ligne_uti',
            'ligne': numero,
            'exp': expMag_bdd,
            'report': report_bdd,
            'dpt': dpt_bdd,
            'edi': edi_bdd,
            'hRev': hrev_bdd,
            'transporteur': transporteur_bdd,
            'hliv': heurLiv_bdd,
            'destinataire': destinataire_bdd,
            'nbsupp': nb_pal_Cariste_bdd,
            'quai': quai_bdd,
            'cariste': nom_Cariste_bdd,
            'debCariste': time_Cariste_h_Deb_bdd,
            'finCariste': time_Cariste_h_Fin_bdd,
            'hariv': hariv_bdd,
            'porte': porte_bdd,
            'chargeur': nom_Chargeur_bdd,
            'chargeurdeb': time_Chargeur_h_Deb_bdd,
            'chargeurfin': time_Chargeur_h_Fin_bdd,
            'nbsuppcharg': nb_pal_Chargeur_bdd,
            'nbraq': nbraq_bdd,
            'nbpalleg': nbpalleg_bdd,
            'site': site_bdd

        },
        dataType: 'json',
        method: "GET",
        success: function (donnees, status, xhr) {

        },
        error: function (xhr, status, error) {
            console.log("param : " + JSON.stringify(xhr));
            console.log("status : " + status);
            console.log("error : " + error);
        }
    });
}

function changerCouleur() {

    var t = $('#data-planning').DataTable();
    var nbLigne = t.rows().count();



    var nomCariste = "nomCariste";
    var nomChargeur = "nomChargeur";


    var nb = 1;


    while (nb <= nbLigne) {
        let nomcarist = nomCariste + nb;
        let nomcharg = nomChargeur + nb;



        document.getElementById(nomcarist).style.backgroundColor = "#FF0000";
        document.getElementById(nomcharg).style.backgroundColor = "#FF0000";
        nb++;
    }

}

function nombreDeSupp() {
    var t = $('#data-planning').DataTable();
    var nbLigne = t.rows().count();
    var memoire = 0;
    var forceint;
    var nb = 1;

    var nbSupp = "nbPalCariste";
    while (nb <= nbLigne) {
        let nbsupp = nbSupp + nb;

        var test = document.getElementById(nbsupp).value;
        forceint = parseInt(test, 10);
        nb++;
        memoire += forceint;
    }
    document.getElementById("nbSuppTotal").innerHTML = memoire;
    document.getElementById("nbSuppChargTotal").innerHTML = memoire;
    
}

function ajouterSupp(){
    
    var id = $(this).attr('id');
    var numero = id.substring(15);
    console.log("id  :" + id);
    console.log("numero:" + numero);
    
    var nombreDeSupport = "nbPalCaristeNew";
    let nbsupp = nombreDeSupport + numero;
    
    var acutelle = document.getElementById("nbSuppTotal").innerText;
    var actuelleEnInt = parseInt(acutelle , 10);
    var forceint = parseInt(document.getElementById(nbsupp).value , 10);
    
    if(forceint !== universelle){
        actuelleEnInt = actuelleEnInt - universelle;
        actuelleEnInt = actuelleEnInt + forceint ;
        document.getElementById("nbSuppTotal").innerText = actuelleEnInt;
        document.getElementById("nbSuppChargTotal").innerText = actuelleEnInt;
        
    }else{
        actuelleEnInt = actuelleEnInt + forceint;
        document.getElementById("nbSuppTotal").innerText = actuelleEnInt;
        document.getElementById("nbSuppChargTotal").innerText = actuelleEnInt;
    }
     universelle = forceint ;
     
}

$(document).ready(function () {
    //envoyer du fichier
    // $('#upload_csv').on('submit', upload);
    n = new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    universelle = 0;
    //date du jour
    document.getElementById("date").innerHTML = d + "/" + m + "/" + y;
    $(document).on("click", "input[id^=envoyer]", bouttonEnvoyerFile);
    $(document).on("click", "input[id^=sendNew]", bouttonEnvoyerUti);
    $(document).on("click", "input[id^=upload]", deleteTable);
    $(document).on('change', "input[id^=caristeHfin]", diffTimeCarist);
    $(document).on('change', "input[id^=chargeurhfin]", diffTimeCharg);
    $(document).on('change', "input[id^=nbPalCaristeNew]",ajouterSupp);


});