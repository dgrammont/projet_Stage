
<html>
    <head>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <title>test htmljs to bdd</title>
    </head>
    <body>
    <form id="formulaire">
        <input type="text" id="test" name="test" placeholder="Donnez un numero de ligne">
        <input type="submit" value="send">
    </form>
        <div id="yes"></div>


        <script>
            function send(event) {
                event.preventDefault();
                //la val
                var donnee = $('#test').val();
                $.ajax({
                    url: "controleur.php",
                    data: {
                        'commande': 'ajoutLigne',
                        'ligne': donnee
                    },
                    dataType: 'json',
                    method: "GET",
                    success: function (donnees, status, xhr) {

                        $("#yes").text(donnees);
                    },
                    error: function (xhr, status, error) {
                        console.log("param : " + JSON.stringify(xhr));
                        console.log("status : " + status);
                        console.log("error : " + error);
                    }
                });
            }

            $(document).ready(function () {
                $("#formulaire").submit(send);
            });


        </script>
<?php 
//require_once './bddRequete.php';
//mise_jour_ligne();
?>
    </body>
</html>