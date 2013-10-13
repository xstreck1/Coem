/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function get_data_async(command, tag_id) {
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
            document.getElementById(tag_id).innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", command, true);
    xmlhttp.send();
}

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