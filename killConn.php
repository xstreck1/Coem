<?php
include './coemFunctions.php';

$session = htmlspecialchars($_GET['session']);

exit_database($session);
?>
