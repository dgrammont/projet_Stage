
<html>
    <head>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <title>test htmljs to bdd</title>
    </head>
    <body>

        <input type="text" id="test">
        <input type="submit" id="send" value="click" onclick="send()">
        <div id="yes"></div>


        <script>
            function send() {
                //event.preventDefault();
                //la val
                var donnee = $('#test').value;
                $.ajax({
                    url: "./controleur.php",
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
                $("#send").submit(send);
            });


        </script>

    </body>
</html>

