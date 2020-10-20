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
                <th><input id="time" placeholder="Time" type="time" name="time" onchange="diffTime()" /></th>
                <th><input id="time2" placeholder="Time" type="time" name="time" onchange="diffTime()"/></th>
                <th><input id="nbPalette" placeholder="nombre de palette" type="number" name="nbp" onchange="diffTime()"></th>
               
                <th><span id="prod"></span></th>
            </tr>
        </thead>
    </table>

    <?php
    // put your code here
    ?>
    <script>
        function diffTime() {
            var time = document.getElementById('time').value;
            var time2 = document.getElementById('time2').value;
            var pmoy =25/60;
            var nbPallete = document.getElementById('nbPalette').value;
            var hours = time.split(":")[0];
            var minutes = time.split(":")[1];
            var hours2 = time2.split(":")[0];
            var minutes2 = time2.split(":")[1];
            hours = hours < 10 ? +hours : hours;
            hours2 = hours2 < 10 ? +hours2 : hours2;
            var hDiff = hours2 - hours;
            var mDiff = minutes2 - minutes;
            
           
            var tempEnMinutes = (hDiff *60) + mDiff;
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
            if(production < pmoy){
                document.getElementById("prod").style.backgroundColor = "#FF0000"; 
                document.getElementById("prod").innerHTML = "Negative";
            }
            else{
                if(production === pmoy){
                    document.getElementById("prod").style.backgroundColor = "#FFFFFF";
                    document.getElementById("prod").innerHTML = "normal";
                }
                else{
                    document.getElementById("prod").style.backgroundColor = "#00FF00"; 
                    document.getElementById("prod").innerHTML = "Supérieur a la moyenne";
                }
                
            }
           // document.getElementById("display_time").innerHTML = displayTime;
           


        }



    </script>
</body>
</html>
<!-- cariste  25 pallete par heure 
    <char gement 57 palette par heure-->