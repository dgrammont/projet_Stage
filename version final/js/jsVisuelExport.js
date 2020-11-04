
//affiche la basse de donné vers le tableau
function visuel(event) {

    //event.preventDefault();
    $.ajax({
        url: "./php/controleur.php",
        method: "GET",
        data: {
            'commande': 'renvoyerTable'
        },

        success: function (donnees, status, xhr) {
            
     $('#data-planning').DataTable({
                data : donnees,
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
                    {data: "destinataire"},
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
  
 
}

// moyenne des cariste  25 pallete par heure 
function diffTimeCarist() {

  
}

//recharge la page    
function reloadPage() {
    document.location.reload(true);
}

//demare un timer de 5 min 
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            timer = 0;
        }
    }, 1000);
}

//les fonction appelé lorsque le document est pret
$(document).ready(function () {
    n = new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    document.getElementById("date").innerHTML = d + "/" + m + "/" + y;
    setTimeout("reloadPage()", 304000);
    var fiveMinutes = 60 * 5,
    display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
    visuel();

});
