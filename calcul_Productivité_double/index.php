<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>


        <!--This is the input field where a user selects a time-->
        <table>
            <thead>
                <tr>
                    <th>Heure debut</th>
                    <th>Heure Fin</th>  
                    <th>Nb pallette</th>                
                    <th>Produtivité</th>
                <tr>
                <tr>
                    <th><input id="timePlus1" placeholder="Time" type="time" name="time" onchange="diffTime()" /></th>
                    <th><input id="timeSous1" placeholder="Time" type="time" name="time" onchange="diffTime()"/></th>
                    <th><input id="nbPalette1" placeholder="nombre de palette" type="number" name="nbp" onchange="diffTime()"></th>
                    <th><input id="text1" type="text"/></th>          
                    <th><span id="prod1"></span></th>
                </tr>
                <tr>
                    <th><input id="timePlus2" placeholder="Time" type="time" name="time" onchange="diffTime()" /></th>
                    <th><input id="timeSous2" placeholder="Time" type="time" name="time" onchange="diffTime()"/></th>
                    <th><input id="nbPalette2" placeholder="nombre de palette" type="number" name="nbp" onchange="diffTime()"></th>
                    <th><input id="text2" type="text"/></th>          
                    <th><span id="prod2"></span></th>
                </tr>
            </thead>
        </table>

        <?php
        // put your code here
        ?>
        <script>
            function diffTime() {
                var nbligne = 2;
                var timeP = "timePlus";
                var timeM = "timeSous";
                var nbPal = "nbPalette";
                var prod = "prod";
                var text = "text";
                var nb = 1;
//                let o = prod + nb;
//                let x = timeP + nb;
//                let y = timeM + nb;
//                let z = nbPal + nb;

               // document.getElementById(x).innerHTML = "oui";

                for (i = 0; i < nbligne; i++) {
                    
                    let o = prod + nb;
                    let x = timeP + nb;
                    let y = timeM + nb;
                    let z = nbPal + nb;
                    let p = text + nb;
                    
                    var time = document.getElementById(x).value;
                    var time2 = document.getElementById(y).value;
                    var pmoy = 25 / 60;
                    var nbPallete = document.getElementById(z).value;
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
    //            if(mDiff < 0){
    //                mDiff=(hDiff*60)-mDiff;
    //                hDiff=hDiff-1;
    //                if(mDiff>=60){
    //                    mDiff=mDiff-60;
    //                    hDiff=hDiff+1;
    //                }
    //            }
                    var displayTime = hDiff + ":" + mDiff;
                    if (production < pmoy) {
                        document.getElementById(p).style.backgroundColor = "#FF0000";
                        document.getElementById(o).innerHTML = "Negative";
                    } else {
                        if (production === pmoy) {
                            document.getElementById(p).style.backgroundColor = "#FFFFFF";
                            document.getElementById(o).innerHTML = "normal";
                        } else {
                            document.getElementById(p).style.backgroundColor = "#00FF00";
                            document.getElementById(o).innerHTML = "Supérieur a la moyenne";
                        }

                    }
                    // document.getElementById("display_time").innerHTML = displayTime;

                    nb = nb + 1;

                }
            }


        </script>
    </body>
</html>
<!-- cariste  25 pallete par heure 
    <chargement 57 palette par heure-->