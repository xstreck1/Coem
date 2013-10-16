<?php
include './coemFunctions.php';

$session = htmlspecialchars($_GET['session']);
$text = htmlspecialchars($_GET['text']);

$link = connect_database();

$coemid = get_coem_id($link, $session);
$finished = get_finished($link, $coemid);
$new_finished = $finished + 1;

// Add the new linew
$query = "UPDATE coems SET finished=$new_finished, line$new_finished='$text' WHERE coemid=$coemid";
mysqli_execute(mysqli_prepare($link, $query));

close_coem($link, $session);
mysqli_close($link);
?>