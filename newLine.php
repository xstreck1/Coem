<?php
include './coemFunctions.php';

$session = htmlspecialchars($_GET['session']);
$text = htmlspecialchars($_GET['text']);
$no_space = str_replace(' ', '', $text);
if (!ctype_alpha($no_space)) {
    echo "The input had forbidden characters.";
    return;
}

$link = connect_database();

$coemid = get_coem_id($link, $session);
$finished = get_finished($link, $coemid);
$new_finished = $finished + 1;

// Add the new linew
$query = "UPDATE coems SET finished=$new_finished, line$new_finished='$text' WHERE coemid=$coemid";
while(!mysqli_query($link, $query))
	wait(1);

close_coem($link, $session);
mysqli_close($link);
?>