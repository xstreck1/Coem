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