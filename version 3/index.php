
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
        <div class="container">
            <br />
            <h3 align="center">Import CSV File into Jquery Datatables using PHP Ajax</h3>
            <br />
            <form id="upload_csv" method="post" enctype="multipart/form-data">
                <div class="col-md-3">
                    <br />
                    <label>Add More Data</label>
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
<!--                <table class="table table-striped table-bordered" id="data-table">
                     <caption>Planning</caption>
                    <thead>
                        <tr>
                            <th id="ligne1"></th>
                            <th id="ligne2">numero de Dossier</th>  
                            <th id="ligne3">Ville Enl</th>
                            <th id="ligne4">Cp Liv</th>
                            <th id="ligne5">Date Enl</th>
                            <th id="ligne6">Heure Enl</th>
                            <th id="ligne7">Date Liv</th>
                            <th id="ligne8">Trp</th>
                            <th id="ligne9">Ref chargement</th>
                            <th id="ligne10">Code Dest</th>
                            <th id="ligne11">Date Liv</th>
                            <th id="ligne12">Destinateire</th>
                            <th id="ligne13">Ville Liv</th>
                            <th id="ligne14">Heure Liv</th>
                            <th id="ligne15">Palette</th>
                            <th id="ligne16">Mt Transport</th>
                        </tr>
                    </thead>
                </table>-->
                
                    <table class="table table-striped table-bordered" id="data-planning">
                         <caption>Planning final</caption>
                    <thead>
                   
                        <tr>
                            <th>Ligne</th>
                            <th>Expe Mag-Transfert-reverse</th>  
                            <th>report</th>
                            <th>DPT</th>
                            <th>N° EDI</th>
                            <th>H REV</th>
                            <th>Trasporteur</th>
                            <th>Destinataire</th>
                            <th>nb supp</th>
                        </tr>
                    </thead>
                </table>
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
//                    $('#data-table').DataTable({
//                        data: jsonData,
//                        columns: [
//                            {data: "vide"},
//                            {data: "numero_De_Dossier"},
//                            {data: "ville_Enl"},
//                            {data: "cp_Liv"},
//                            {data: "date_Enl"},
//                            {data: "heure_Enl"},
//                            {data: "date_Liv"},
//                            {data: "trp"},
//                            {data: "ref_Chargement"},
//                            {data: "code_Dest"},
//                            {data: "date_Liv"},
//                            {data: "destinataire"},
//                            {data: "ville_Liv"},
//                            {data: "heure_Liv"},
//                            {data: "palette"},
//                            {data: "mt_Transport"}
//                        ]
//                    });
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
                            {data: "destinataires"},
                            {data: "nb_Supp"}
                        ]
                    });
                }
            });
        });
    });

</script>

