
<!DOCTYPE html>
<html>
    <head>
        <title>Planning</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>         
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
        <script src="js/myscript.js" type="text/javascript"></script>

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
            <h3 align="center">Planning du <div id="date"> </div></h3>
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
                <input type="button" value="ajouté ligne" id="ajoute_ligne" onclick="addLine()" style="display: none">
                <table class="table table-striped table-bordered" id="data-planning">
                    <input type="button" value="delte Talbe"  id="del_Talbe" onclick="deleteTable()" style="display: none">
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
    </body>
</html>



