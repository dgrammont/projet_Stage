

$(document).ready(function () {
    $('#upload_csv').on('submit', function (event) {

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
//                    dom: 'Bfrtip',
//                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                    fixedHeader: false,
                    "lengthMenu": [[10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "Tous"]],
                    'iDisplayLength': 25,
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
                        {data: "site"},
                        {data: "envoyer"}
                    ]
                });
            }
        });
        document.getElementById("ajoute_ligne").style.display = "block";
        document.getElementById("del_Talbe").style.display = "block";
        document.getElementById("visuel").style.display = "block";
    });

});


// moyenne des chargement 57 palette par heure 

function diffTimeCharg() {
    var nomCharg = "nomChargeur";
    var chargDeb = "chargeurHdeb";
    var chargFin = "chargeurhfin";
    var nbPalCharg = "nbPalChargeur";

    var nb = 1;

    while (nb !== null) {

        let nomcharg = nomCharg + nb;
        let charhdeb = chargDeb + nb;
        let charhfin = chargFin + nb;
        let nbpalcharg = nbPalCharg + nb;

        var time = document.getElementById(charhdeb).value;
        var time2 = document.getElementById(charhfin).value;
        var pmoyChargement = 57 / 60;
        var nbPallete = document.getElementById(nbpalcharg).value;
        var hours = time.split(":")[0];
        var minutes = time.split(":")[1];
        var hours2 = time2.split(":")[0];
        var minutes2 = time2.split(":")[1];
        hours = hours < 10 ? +hours : hours;
        hours2 = hours2 < 10 ? +hours2 : hours2;
        var hDiff = hours2 - hours;
        var mDiff = minutes2 - minutes;


        var tempEnMinutes = (hDiff * 60) + mDiff;
        var production = nbPallete / tempEnMinutes;
        if (nbpalcharg !== null) {
            if (production < pmoyChargement) {
                document.getElementById(nomcharg).style.backgroundColor = "#FF0000";
            } else {
                if (production === pmoyChargement) {
                    document.getElementById(nomcharg).style.backgroundColor = "#FFFFFF";
                } else {
                    document.getElementById(nomcharg).style.backgroundColor = "#00FF00";
                }
            }
            nb = nb + 1;
        }
    }
}


// moyenne des cariste  25 pallete par heure 

function diffTimeCarist() {

    var nomCariste = "nomCariste";
    var carsiteDeb = "caristeHdeb";
    var carsiteFin = "caristeHfin";
    var nbPalCarsite = "nbPalCariste";

    var nb = 1;

    while (nb !== null) {

        let nomcarist = nomCariste + nb;
        let caristhdeb = carsiteDeb + nb;
        let carsitfin = carsiteFin + nb;
        let nbpalcarist = nbPalCarsite + nb;

        var time = document.getElementById(caristhdeb).value;
        var time2 = document.getElementById(carsitfin).value;
        var pmoyCariste = 25 / 60;
        var nbPallete = document.getElementById(nbpalcarist).value;
        var hours = time.split(":")[0];
        var minutes = time.split(":")[1];
        var hours2 = time2.split(":")[0];
        var minutes2 = time2.split(":")[1];
        hours = hours < 10 ? +hours : hours;
        hours2 = hours2 < 10 ? +hours2 : hours2;
        var hDiff = hours2 - hours;
        var mDiff = minutes2 - minutes;


        var tempEnMinutes = (hDiff * 60) + mDiff;
        var production = nbPallete / tempEnMinutes;
        if (nbpalcarist !== null) {
            if (production < pmoyCariste) {
                document.getElementById(nomcarist).style.backgroundColor = "#FF0000";
            } else {
                if (production === pmoyCariste) {
                    document.getElementById(nomcarist).style.backgroundColor = "#FFFFFF";
                } else {
                    document.getElementById(nomcarist).style.backgroundColor = "#00FF00";
                }
            }
            nb = nb + 1;
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
    var  expMag_id = "exp_Mag";
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
    var envoyer_id = "envoyerNew";
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
    var nb_pal_Cariste = "nbPalCariste";
    nb_pal_Cariste += nbLigne;
    //nombre de palette du chargeur
    var nb_pal_Chargeur = "nbPalChargeur";
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

    var line = "<input type='text' id='" + nbLigne + "' value='" + nbLigne + "' style='width: 50px';/>";
    var expo_Mag = "<input type'text' id='"+expMag_id+"'/>";
    var dpt = "<input type='number' id='"+dpt_id+"'/>";
    var edi = "<input type='number' id='"+edi_id+"'/>";
    var hrev = "<input type='time' id='"+hrev_id+"'/>";
    var transporteur = "<input type='text' id='"+transporteur_id+"'/>";
    var hLiv = "<input type='time'   id='"+hliv_id+"'/>";
    var destinataire = "<input type='text' id='"+destinataire_id+"'/>";
    var quai = "<input type='text' id='"+quai_id+"'/>";
    var hariv = "<input type='time' id='"+harriv_id+"'/>";
    var porte = "<input type='text' id='"+porte_id+"'/>";
    var submit = "<input type='submit' id='"+envoyer_id+"'/>";
    var report = "<input type='text' id='" + nbLigneReport + "' style='width: 40px; height: 10px'/>";
    var raq = "<input type='number' id='"+nbraq_id+"' style='width: 80px'/>";
    var nbpalleg = "<input type='number' id='"+nbpalleg_id  +"' style='width: 80px'/>";
    var site = "<input type='text' id='"+site_id+"'/>";
    var nbPalCariste = "<input type='number' id='" + nb_pal_Cariste + "' style='width: 80px' onchange='diffTimeCarist()'/>";
    var nbPalCharg = "<input type='number' id='" + nb_pal_Chargeur + "' style='width: 80px' onchange='diffTimeCharg()'/>";
    var nomCariste = "<input type='text' id='" + nom_Cariste + "' />";
    var nomChargeur = "<input type='text' id='" + nom_Chargeur + "' />";
    var timeDebCariste = "<input type='time' id='" + time_Cariste_h_Deb + "' onchange='diffTimeCarist()'/>";
    var timeFinCariste = "<input type='time' id='" + time_Cariste_h_Fin + "' onchange='diffTimeCarist()'/>";
    var timeDebChargeur = "<input type='time' id='" + time_Chargeur_h_Deb + "' onchange='diffTimeCharg()'/>";
    var timeFinChargeur = "<input type='time' id='" + time_Chargeur_h_Fin + "' onchange='diffTimeCharg()'/>";
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
        site: site,
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
        $.ajax({
        url: "./php/controleur.php",
        data: {
            'commande': 'delBdd'
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
    } else {

    }
}



function voirVisuel(){
    document.location.href = "http://localhost:8000/exportVisual.html";
}

//affiche la date du jour
$(document).ready(function () {

    n = new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    document.getElementById("date").innerHTML = d + "/" + m + "/" + y;
});

 
//$('#data-planning').dataTable( {
//  "initComplete": function(settings, json) {
//    var table = $('#data-planning').DataTable();
//    $('#dataplaning tbody').on('click', '.position', function () {
//    var row = $(this).closest('tr'); 
//    var data = table.row( row ).data().position;
//    console.log(data);
//});  
//} 
//});
//function test(){
//    var table = $('#data-planning').DataTable();
//     
//    $('#data-planning tbody').on('click', 'tr', function () {
//        var data = table.row( this ).data();
//        alert( 'You clicked on '+data[0]+'\'s row' );
//    } );
//}