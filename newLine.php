<?php
$my_session = htmlspecialchars($_GET['session']);
$text = htmlspecialchars($_GET['text']);

$con = mysqli_connect("localhost", "root", "FIMonkey89", "coem");
if (mysqli_connect_errno($con)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$select_sess = "SELECT * FROM sessions WHERE ID='$my_session'";
$result_sess = mysqli_query($con, $select_sess);
$row_sess = mysqli_fetch_array($result_sess);
$coemid = $row_sess["coemid"];
$select_coem = "SELECT * FROM coems WHERE coemid=$coemid";
$result_coem = mysqli_query($con, $select_coem);
$row_coem = mysqli_fetch_array($result_coem);

$finished = $row_coem['finished'];
$new_finished = $finished + 1;
$addword = "UPDATE coems SET finished=$new_finished, line$new_finished='$text' WHERE coemid=$coemid";
mysqli_query($con, $addword);
mysqli_close($con);
?>