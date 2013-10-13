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
                    var span = document.createElement("SPAN");
                    var span_text = document.createTextNode("New line: ");
                    span.appendChild(span_text);

                    var btn = document.createElement("BUTTON");
                    var btn_text = document.createTextNode("Submit");
                    btn.setAttribute('onClick', 'sendLine();');
                    btn.appendChild(btn_text);

                    var input = document.createElement("INPUT");
                    input.setAttribute('size', 80);
                    input.setAttribute('id', 'input_line');

                    input_div = document.getElementById("user_input");
                    input_div.innerHTML = '';
                    input_div.appendChild(span);
                    input_div.appendChild(input);
                    input_div.appendChild(document.createElement("BR"));
                    input_div.appendChild(btn);
                }
            }
        </script>
        <script>
            window.onbeforeunload = coemConnection(0);
        </script>
        <script>
            function sendLine() {
                document.getElementById("error").innerHTML = "";
                var text = String(document.getElementById("input_line").value);
                var length = text.length;
                if (length < 10 || length > 80) {
                    document.getElementById("error").innerHTML = "The text \"" + text + "\" is not valid. The number of characters must be in the range [10,80].";
                } else if (!isAlpha(text)) {
                    document.getElementById("error").innerHTML = "The text \"" + text + "\" is not valid. Only letters and spaces are allowed.";
                } else {
                    text = text.toLowerCase();
                    get_data_async("newLine.php?session=" + '<?php echo session_id(); ?>' + "&text=" + text, "coem_container");
                    // Hide the user input.
                    document.getElementById("user_input").innerHTML = '';
                }
            }
            function isAlpha(xStr) {
                var regEx = /^[a-zA-Z \-]+$/;
                return xStr.match(regEx);
            }
        </script>
    </head>
    <body>
        <button value="Open a coem" onclick="coemConnection(1);" >Open a coem</button><br />
        <div id="coem_container"></div>
        <div id="user_input"></div>
        <div id="error"></div>
        <br />

        Finished Coems: <br />
<?php include 'readCoems.php'; ?>


    </body>
</html>
