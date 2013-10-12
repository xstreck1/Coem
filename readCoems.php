<?php

$con = mysqli_connect("localhost", "root", "FIMonkey89", "coem");
if (mysqli_connect_errno($con)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$select = "SELECT * FROM coems";
$result_set = mysqli_query($con, $select);

while ($row = mysqli_fetch_array($result_set)) {
    if ($row['finished'] >= 8) {
        echo "<HR />";
        for ($i = 1; $i <= 8; $i++) {
            $line = "line".$i;
            echo $row[$line] . "<BR />";
        }
        echo "<HR />";
    }
}
?>
