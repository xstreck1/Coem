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
            window.onbeforeunload = coemConnection(0);
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
