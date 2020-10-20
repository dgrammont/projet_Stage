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
        <input id="time" placeholder="Time" type="time" name="time" onchange="ampm()" />
        <span id="display_time"></span>
        <?php
        // put your code here
        ?>
        <script>
            function ampm() {
                var test = document.getElementById('time').value;
                console.log(test);
                if (test.value !== "") {
                    var hours = test.split(":")[0];
                    var minutes = test.split(":")[1];
                    hours = hours < 10 ? +hours : hours;
                    var displayTime = hours + ":" + minutes;
                    document.getElementById("display_time").innerHTML = displayTime;
                }
            }
            
           

        </script>
    </body>
</html>
