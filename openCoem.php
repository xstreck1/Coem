<?php
include './coemFunctions.php';

$session = htmlspecialchars($_GET['session']);

// Open Mysql
$link = connect_database();
open_coem($link, $session);
$line = get_last_line($link, $session);

if ($line == "") {
    echo "You start a new coem. Write a fresh line to start a new coem!<br />";
} else {
    echo "Last line: ";
    echo "<span class=\"coem\">" . $line . "</span><br />";
} 

mysqli_close($link);
?>
