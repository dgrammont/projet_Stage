

$(document).ready(function () {
    $('#upload_csv').on('submit', function (event) {

        event.preventDefault();
        $.ajax({
            url: "import.php",
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
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
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
                        {data: "site"}
                    ]
                });
            }
        });
        document.getElementById("ajoute_ligne").style.display = "block";
        document.getElementById("del_Talbe").style.display = "block";
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

    var nbLigneReport = "nbLigne";
    nbLigneReport += nbLigne;
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
    var text = "<input type='text'/>";
    var number = "<input type='number'/>";
    var time = "<input type='time' />";
    var report = "<input type='text' id='" + nbLigneReport + "' style='width: 40px; height: 10px'/>";
    var raq = "<input type='number' style='width: 80px'/>";
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
        expo_Mag: text,
        report: report,
        dpt: number,
        edi: number,
        hrev: time,
        transporteur: text,
        heure_Liv: time,
        destinataires: text,
        nb_Supp: nbPalCariste,
        quai: text,
        cariste: nomCariste,
        destock_HD: timeDebCariste,
        destock_HF: timeFinCariste,
        h_Arriv: time,
        porte: text,
        chargeur: nomChargeur,
        charg_H_Deb: timeDebChargeur,
        charg_H_Fin: timeFinChargeur,
        nb_Supp_Charg: nbPalCharg,
        nb_Raq: raq,
        nb_pal_leg: raq,
        site: text

    }).draw(false);
}

// suprimé la table 

function deleteTable() {
    var answer = window.confirm("Vous allez surprimé le planning!");
    if (answer === true) {
        document.location.reload(true);
    } else {

    }
}

$(document).ready(function () {


    n = new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    document.getElementById("date").innerHTML = d + "/" + m + "/" + y;

});


$("#data-planning").dataTable( {
"pageLength": pageSize,
dom: domVal,
"buttons": [
{extend:'excel',exportOptions: {format: {
body: function ( data, row, column, node ) {
//
//check if type is input using jquery
return $(data).is("input") ?
$(data).val():
data;
}
}
}}
, {extend:'pdf'}
]} );

