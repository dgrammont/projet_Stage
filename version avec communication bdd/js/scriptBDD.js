//function send(event)
//{
//    //ne pas envoyer les données du formulaire  (sinon il y aura un changement de page)
//    event.preventDefault();
//    //recupéré le contenu du champ test   
//    var donnee = $('#test').val();
//    $.ajax({
//        url: "controleur.php",
//        data: {
//            'commande': 'ajoutLigne',
//            'ligne': donnee
//        },
//        dataType: 'json',
//        method: "GET",
//        success: function (donnees, status, xhr) {
//            //metre le text de la réponse ajax dans le champs div ayant pour id yes
//            $("#yes").text(donnees);
//        },
//        error: function (xhr, status, error) {
//            console.log("param : " + JSON.stringify(xhr));
//            console.log("status : " + status);
//            console.log("error : " + error);
//        }
//    });
//}

//$(document).ready(function () {
//    //associer l'envois du formulaire à la fonction send
//    $("#formulaire").submit(send);
//});
//
