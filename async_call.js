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

function post_data_async(command) {
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.open("POST", command, true);
    xmlhttp.send();
}

function coemConnection(session) {
    get_data_async("openCoem.php?session=" + session, "coem_container");

    // If there is a request to open the file (and not to close the session.
    var span = document.createElement("SPAN");
    var span_text = document.createTextNode("New line: ");
    span.appendChild(span_text);

    var btn = document.createElement("BUTTON");
    var btn_text = document.createTextNode("Submit");
    btn.setAttribute('onClick', 'sendLine(\"' + session + '\");');
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
    
    resetTimeout();
}

function resetTimeout() {
    clearTimeout(timeout);
    timeout = setTimeout("location.reload(true);", 300000);
}

function sendLine(session) {
    document.getElementById("error").innerHTML = "";
    var text = String(document.getElementById("input_line").value);
    var length = text.length;
    if (length < 10 || length > 80) {
        document.getElementById("error").innerHTML = "The text \"" + text + "\" is not valid. The number of characters must be in the range [10,80].";
    } else if (!isAlpha(text)) {
        document.getElementById("error").innerHTML = "The text \"" + text + "\" is not valid. Only letters and spaces are allowed.";
    } else {
        text = text.toLowerCase();
        post_data_async("newLine.php?session=" + session + "&text=" + text);
        // Hide the user input.
        location.reload();
    }
}
function isAlpha(xStr) {
    var regEx = /^[a-zA-Z \-]+$/;
    return xStr.match(regEx);
}