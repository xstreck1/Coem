<?php

include './globals.php';

$session = htmlspecialchars($_GET['session']);
$text = htmlspecialchars($_GET['text']);

$connection = connect_coem();

$select_sess = "SELECT * FROM " . constant("sessions_table") . " WHERE ID='$session'";
$result_sess = mysqli_query($connection, $select_sess);
$row_sess = mysqli_fetch_array($result_sess);
$coemid = $row_sess["coemid"];

$select_coem = "SELECT * FROM " . constant("coems_table") . " WHERE coemid=$coemid";
$result_coem = mysqli_query($connection, $select_coem);
// Line already present
if (mysqli_num_rows($result_coem ) != 0) {
    $row_coem = mysqli_fetch_array($result_coem);
    $finished = $row_coem['finished'];
    $new_finished = $finished + 1;
    $addword = "UPDATE coems SET finished=$new_finished, line$new_finished='$text' WHERE coemid=$coemid";
    mysqli_query($connection, $addword);

}
// Creating a new line
else {
    $select_coems = "SELECT * FROM " . constant("coems_table");
    $coemid = mysqli_num_rows(mysqli_query($connection, $select_coems)) + 1;
    $addword = "INSERT INTO " . constant("coems_table") . " VALUES($coemid,1,'none','$text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1)";
    mysqli_query($connection, $addword);
}

    mysqli_close($connection);
?>