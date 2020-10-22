
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
                                <th id="test">Ligne</th>
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

        var nbligne = "nbLigne";
        var nb = 1;
        let x = nbligne + nb;

        while (x !== null) {

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

        var nbligne = "nbLigne";
        var nb = 1;
        let x = nbligne + nb;

        while (x !== null) {

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
<!-- le script pour rajouter des ligne -->
<!--<script>
    //s'active avec le buton rajouté ligne
    function newLigne() {
//compte le nombre de ligne deja present dans le fichier
        var nbLigne = 1;
        while (document.getElementById(nbLigne) !== null) {
            nbLigne++;
        }
        var formData = new FormData();
        formData.append('file', $('input[type=file]')[0].files[0]);
       
        event.preventDefault();
        $.ajax({
            url: "newLigne.php",
            method: "POST",
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function (jsonData)
            {
                //envoy du tableau + du nomrbe de ligne 
                $(nbLigne);
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

    }


</script>   -->
<script>
   function addLine(){
      
      var nbLigne = 1;
        while (document.getElementById(nbLigne) !== null) {
            nbLigne++;
        }
        
    var t = $('#data-planning').DataTable();
    var counter = 1;
 
   
        t.row.add( [
    "<span id='$nbligne'>$nbligne</span>",
     "<input type='text'/>",
    "<input type='text' style='width: 40px; height: 10px'/>",
    "<input type='number' style='width: 80px; height: 10px'/>",
    "<input type='time' />",
    "<input type='text'/>",
    "<input type='number' style='width: 80px; height: 10px'/>",
    "<input type='text'/>",
    "<input type='time' />",
    "<input type='number' id='$destock_nb_pal' style='width: 80px; height: 10px' onchange='diffTimeCarist()'/>",
    "<input type='text'/>",
    "<input type='text' id='$destock_nom_Cariste'/>",
    "<input type='time' id='$destock_deb' onchange='diffTimeCarist()'/>",
    "<input type='time' id='$destock_fin' onchange='diffTimeCarist()'/>",
    "<input type='time'/>",
    "<input type='text'/>",
    "<input type='text' id='$charg_nomChargeur'/>",
    "<input type='time' id='$charg_deb' onchange='diffTimeCharg()'/>",
    "<input type='time' id='$charg_fin' onchange='diffTimeCharg()'/>",
    "<input type='number' id='$charg_nb_pal' style='width: 100px' onchange='diffTimeCharg()'/>",
    "<input type='number' style='width: 100px'/>",
    "<input type='number' style='width: 100px'/>",
    "<input type='text'/>"
        ] ).draw( false );
 
        counter++;
     
 
    // Automatically add a first row of data
    $('#addRow').click();
}
</script>

<!--    function addLine(){
      
    var t = $('#data-planning').DataTable();
    var counter = 1;
 
   
        t.row.add( [
            counter +'.1',
            counter +'.2',
            counter +'.3',
            counter +'.4',
            counter +'.5'
        ] ).draw( false );
 
        counter++;
     
 
    // Automatically add a first row of data
    $('#addRow').click();
}-->
<!--
    function addLine(){
        var table = $('#data-planning').DataTable();

        table.row.add({
            "Ligne": "Tiger Nixon",
            "test": "System Architect",
            "salary": "$3,120",
            "start_date": "2011/04/25",
            "office": "Edinburgh",
            "extn": "5421"
        }).draw();
    }-->
