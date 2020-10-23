
<!DOCTYPE html>
<html>
    <head>
        <title>Import CSV File into Jquery Datatables using PHP Ajax</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <style>
            .box
            {
                max-width:800px;
                width:100%;
                margin: 0 auto;;
            }

        </style>
    </head>
    <body>
        <div class="container-md" style="margin-left: 24px;margin-right: 24px;">
            <br />
            <h3 align="center">Import CSV File into Jquery Datatables using PHP Ajax</h3>
            <br />
            <form id="upload_csv" method="post" enctype="multipart/form-data">
                <div class="col-md-3">
                    <br />
                </div>  
                <div class="col-md-4">  
                    <input type="file" name="csv_file" id="csv_file" accept=".csv" style="margin-top:15px;" />
                </div>  
                <div class="col-md-5">  
                    <input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
                </div>  
                <div style="clear:both"></div>
            </form>
            <br />
            <br />
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="data-planning">
                    <caption>Planning final</caption>
                    <thead>

                        <tr>
                            <th>Ligne</th>
                            <th>Expe-Mag-Transfert-reverse</th>  
                            <th>report</th>
                            <th>DPT</th>
                            <th>N°EDI</th>
                            <th>H_REV</th>
                            <th>Trasporteur</th>
                            <th>H_Liv</th>
                            <th>Destinataire</th>
                            <th>nb_supp</th>
                            <th>Quai</th>
                            <th>Cariste</th>
                            <th>Destock_H_Deb</th>
                            <th>Destock_H_Fin</th>
                            <th>H_Arriv</th>
                            <th>Porte</th>
                            <th>chargeur</th>
                            <th>Charg_h_Deb</th>
                            <th>Charg_h_Fin</th>
                            <th>Nb_supp_Chargées</th>
                            <th>Nb_RAQ</th>
                            <th>Nb_Pal_legères</th>
                            <th>site</th>
                        </tr>

                    </thead>
                </table>
                <input type="button" value="ajouté ligne" id="button" onclick="addLine()">
            </div>               
        </div>
    </body>
</html>


<script>

    $(document).ready(function () {
        $('#upload_csv').on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url: "import.php",
                method: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (jsonData)
                {
                    $('#csv_file').val('');

                    $('#data-planning').DataTable({
                        data: jsonData,
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
        });
    });
    

</script>
<!-- moyenne des chargement 57 palette par heure -->
<script>
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

</script>
<!-- moyenne des cariste  25 pallete par heure -->
<script>
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

</script>
<!-- le script pour rajouter une ligne -->
<!--<script>
    function addLine() {

        //compte le nombre de ligne deja presente dans le ficher
        var nbLigne = 1;
        while (document.getElementById(nbLigne) !== null) {
            nbLigne++;
        }	

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

        var t = $('#data-planning').DataTable();


        t.row.add([
            //ligne
            "<span id='" + nbLigne + "'>" + nbLigne + "</span>",
            //expe mag
            "<input type='text'/>",
            //report        
            "<input type='text' style='width: 40px; height: 10px'/>",
            //dpt
            "<input type='number' style='width: 80px; height: 10px'/>",
            //n edi
            "<input type='number' style='width: 80px; height: 10px'/>",
            //h_rev
            "<input type='text'/>",
            //transporteur
            "<input type='number' style='width: 80px; height: 10px'/>",
            //h_liv
            "<input type='text'/>",
            //destinaitre
            "<input type='text' />",
            //nb_supp
            "<input type='number' id='" + nb_pal_Cariste + "' style='width: 80px; height: 10px' onchange='diffTimeCarist()'/>",
            //quai
            "<input type='text'/>",
            //cariste
            "<input type='text' id='" + nom_Cariste + "'/>",
            //destock h deb
            "<input type='time' id='" + time_Cariste_h_Deb + "' onchange='diffTimeCarist()'/>",
            //destock h fin
            "<input type='time' id='" + time_Cariste_h_Fin + "' onchange='diffTimeCarist()'/>",
            //H_arriv
            "<input type='time'/>",
            //porte
            "<input type='text'/>",
            //nom chargeur
            "<input type='text' id='" + nom_Chargeur + "'/>",
            //hcharg _ h deb
            "<input type='time' id='" + time_Chargeur_h_Deb + "' onchange='diffTimeCharg()'/>",
            //charg h fin
            "<input type='time' id='" + time_Chargeur_h_Fin + "' onchange='diffTimeCharg()'/>",
            //nb pal chargeur
            "<input type='number' id=" + nb_pal_Chargeur + " style='width: 100px' onchange='diffTimeCharg()'/>",
            //nb raq
            "<input type='number' style='width: 100px'/>",
            //nb pal leg
            "<input type='number' style='width: 100px'/>",
            //site
            "<input type='text'/>"
        ]).draw(false);
      

        //  $('#addRow').click();
    }
</script>-->


<script>
function addLine() {
    var t = $('#data-planning').DataTable();
     var nbLigne = 1;
       
        while (document.getElementById(nbLigne) !== null) {
            nbLigne++;
        }	
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

    var line = "<input type='text' id='"+nbLigne+"' value='"+nbLigne+"' style='width: 50px';/>";
    var text = "<input type='text'/>";
    var number = "<input type='number'/>";
    var time = "<input type='time' />";
    var report = "<input type='text'  style='width: 40px; height: 10px'/>";
    var raq= "<input type='number' style='width: 80px'/>";
    var nbPalCariste = "<input type='number' id='"+nb_pal_Cariste+"' style='width: 80px'/>";
    var nbPalCharg ="<input type='number' id='"+nb_pal_Chargeur+"' style='width: 80px'/>";
    var nomCariste = "<input type='text' id='"+nom_Cariste+"' />";
    var nomChargeur = "<input type='text' id='"+nom_Chargeur+"' />";
    var timeDebCariste = "<input type='time' id='"+time_Cariste_h_Deb+"'/>";
    var timeFinCariste = "<input type='time' id='"+time_Cariste_h_Fin+"'/>";
    var timeDebChargeur = "<input type='time' id='"+time_Chargeur_h_Deb+"'/>";
    var timeFinChargeur = "<input type='time' id='"+time_Chargeur_h_Fin+"'/>";
   var counter =1;
        t.row.add( {
        
        
           ligne: line,
           expo_Mag: text,
           report: report,
           dpt: number,
           edi: number,
           hrev: time,
           transporteur: text,
           heure_Liv: time,
           destinataires: text,
           nb_Supp: nbPalCharg,
           quai: text,
           cariste: nomCariste,
           destock_HD: timeDebCariste,
           destock_HF: timeFinCariste,
           h_Arriv: time,
           porte: text,
           chargeur: nomChargeur,
           charg_H_Deb: timeDebChargeur,
           charg_H_Fin: timeFinChargeur,
           nb_Supp_Charg: nbPalCariste,
           nb_Raq: raq,
           nb_pal_leg: raq,
           site: text
 
// to 23 , i cut the code here just for put the code here
       } ).draw( false );
        counter++;
 //       $('#addRow').click();
}
</script>
 <!-- document.getElementById('1').id='2'; -->
<!-- function addLine() {
      //compte le nombre de ligne deja presente dans le ficher
        var nbLigne = 1;
       
        while (document.getElementById(nbLigne) !== null) {
            nbLigne++;
        }	

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

    var t = $('#d ata-planning').DataTable();
    var counter = 1;
    var line = "<input type='number' id='"+nbLigne+"' value='"+nbLigne+"'/>";
    var time = "<input type='time'/>";
    var number = "<input type='number' style='width: 100px'/>";
    var text = "<input type='text'/>";
        t.row.add( {
        
        
           ligne: line ,
           expo_Mag: counter +'.2',
           report: counter +'.3',
           dpt: counter +'.4',
           edi: counter +'.5',
           hrev: counter +'.6',
           transporteur: counter +'.7',
           heure_Liv: counter +'.8',
           destinataires: counter +'.9',
           nb_Supp: counter +'.10',
           quai: counter +'.11',
           cariste: counter +'.12',
           destock_HD: counter +'.13',
           destock_HF: counter +'.14',
           h_Arriv: counter +'.15',
           porte: counter +'.16',
           chargeur: counter +'.17',
           charg_H_Deb: counter +'.18',
           charg_H_Fin: counter +'.19',
           nb_Supp_Charg: counter +'.20',
           nb_Raq: counter +'.21',
           nb_pal_leg: counter +'.22',
           site: counter +'.23'
 
// to 23 , i cut the code here just for put the code here
       } ).draw( false );
        counter++;
 //       $('#addRow').click();
}-->