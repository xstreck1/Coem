<?php

$session = htmlspecialchars($_GET['session']);
$text = htmlspecialchars($_GET['text']);

$connection = connect_coem();

$select_sess = "SELECT * FROM " . constant(sessions_table) . " WHERE ID='$session'";
$result_sess = mysqli_query($connection, $select_sess);
$row_sess = mysqli_fetch_array($result_sess);
$coemid = $row_sess["coemid"];
$select_coem = "SELECT * FROM " . constant(coems_table) . " WHERE coemid=$coemid";
$result_coem = mysqli_query($connection, $select_coem);
$row_coem = mysqli_fetch_array($result_coem);

$finished = $row_coem['finished'];
$new_finished = $finished + 1;
$addword = "UPDATE coems SET finished=$new_finished, line$new_finished='$text' WHERE coemid=$coemid";
mysqli_query($connection, $addword);
mysqli_close($connection);
?>