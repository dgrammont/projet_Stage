

$(document).ready(function () {
    n = new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    document.getElementById("date").innerHTML = d + "/" + m + "/" + y;
     visuel();
    
});

 function visuel (event) {

        event.preventDefault();
        $.ajax({
            url: "./php/controleur.php",
            method: "GET",
            data: {
            'commande': 'renvoyerTable'
            },
            success: function (donnees, status, xhr) {
                 $('#data-planning').DataTable({
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
                        {data: "site"}
                    ]

                });
            
            },
        error: function (xhr, status, error) {
            console.log("param : " + JSON.stringify(xhr));
            console.log("status : " + status);
            console.log("error : " + error);
        }
            
  
    });
}


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

//afficher tous le tableau toutes les 5 min
function afficher_table() {
    $.ajax({
        url: "./php/controleur.php",
        data: {
            'commande': 'renvoyerTable'
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
    // recharge la page dns 5 min
    setTimeout("reloadPage()", 300000);

}

//recharge la page    
function reloadPage() {
    document.location.reload(true);
}

