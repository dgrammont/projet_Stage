
<?php
//index.php
?>
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
            </div>
        </div>
        <span id="display_time"></span>
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

<script>
    function ampm() {
        var id = document.getElementById(id).value;
        console.log(id);
        if (id.value !== "") {
            var hours = id.split(":")[0];
            var minutes = id.split(":")[1];
            hours = hours < 10 ? +hours : hours;
            var displayTime = hours + ":" + minutes;
            document.getElementById("display_time").innerHTML = displayTime;
            if
                    var elem = document.getElementById(id).value;

            document.getElementById(id).style.backgroundColor = "#FF0000";
        }
    }



</script>


