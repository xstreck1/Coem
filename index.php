<!DOCTYPE html>
<?php session_start(); ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script>
            function openCoem(open)
            {
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        document.getElementById("coem_container").innerHTML = xmlhttp.responseText;
                    }
                }
                var open_cmd = "getCoem.php?session="+'<?php echo session_id(); ?>'+"&open="+open;
                xmlhttp.open("GET", open_cmd, true);
                xmlhttp.send();
            }
        </script>
        <script>
            window.onbeforeunload = openCoem(0);
        </script>
    </head>
    <body>
        <button value="Open a coem" onclick="openCoem(1);" >Open a coem</button><br />
        <div id="coem_container"></div>
        <br />
        <?php
        $file = fopen("coem1", "r") or exit("Unable to open file!");
        while (!feof($file)) {
            echo fgets($file) . "<br>";
        }
        fclose($file);
        ?>
    </body>
</html>
