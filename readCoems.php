<?php
$connection = connect_coem();

$select = "SELECT * FROM coems";
$result_set = mysqli_query($connection, $select);

while ($row = mysqli_fetch_array($result_set)) {
    if ($row['finished'] >= 8) {
        echo "<HR />";
        for ($i = 1; $i <= 8; $i++) {
            $line = "line".$i;
            echo $row[$line] . "<BR />";
        }
    }
}
?>
