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
                var open_cmd = "getCoem.php?session=" + '<?php echo session_id(); ?>' + "&open=" + open;
                xmlhttp.open("GET", open_cmd, true);
                xmlhttp.send();

                if (open == 1) {
                    var btn = document.createElement("BUTTON");
                    var t = document.createTextNode("New line");
                    var input = document.createElement("INPUT");
                    input.setAttribute('id', 'input_line');
                    btn.setAttribute('onClick', 'sendLine();');
                    btn.appendChild(t);
                    z = document.getElementById("tag");
                    z.innerHTML = '';
                    z.appendChild(btn);
                    z.appendChild(input);
                }
            }
        </script>
        <script>
            window.onbeforeunload = openCoem(0);
        </script>
        <script>
            function sendLine() {
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
                var text = document.getElementById("input_line").value;
                var open_cmd = "newLine.php?session=" + '<?php echo session_id(); ?>' + "&text=" + text;
                xmlhttp.open("GET", open_cmd, true);
                xmlhttp.send();
                document.getElementById("tag").innerHTML = '';
            }
        </script>
    </head>
    <body>
        <button value="Open a coem" onclick="openCoem(1);" >Open a coem</button><br />
        <div id="coem_container"></div>
        <div id="tag"></div>
        <br />


        Finished Coems: <br />
        <?php include 'readCoems.php'; ?>


    </body>
</html>
