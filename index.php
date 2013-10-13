<!DOCTYPE html>
<?php
session_start();
include './globals.php';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script src="async_call.js"></script>
        <script>
            function coemConnection(open)
            {
                get_data_async("getCoem.php?session=" + '<?php echo session_id(); ?>' + "&open=" + open, "coem_container");

                // If there is a request to open the file (and not to close the session.
                if (open == 1) {
                    var btn = document.createElement("BUTTON");
                    var t = document.createTextNode("New line");
                    var input = document.createElement("INPUT");
                    input.setAttribute('id', 'input_line');
                    btn.setAttribute('onClick', 'sendLine();');
                    btn.appendChild(t);
                    z = document.getElementById("user_input");
                    z.innerHTML = '';
                    z.appendChild(btn);
                    z.appendChild(input);
                }
            }
        </script>
        <script>
            window.onbeforeunload = coemConnection(0);
        </script>
        <script>
            function sendLine() {
                var text = document.getElementById("input_line").value;
                console.log("text: " + text);
                get_data_async("newLine.php?session=" + '<?php echo session_id(); ?>' + "&text=" + text, "coem_container");
                // Hide the user input.
                document.getElementById("user_input").innerHTML = '';
            }
        </script>
    </head>
    <body>
        <button value="Open a coem" onclick="coemConnection(1);" >Open a coem</button><br />
        <div id="coem_container"></div>
        <div id="user_input"></div>
        <br />

        Finished Coems: <br />
        <?php include 'readCoems.php'; ?>


    </body>
</html>
