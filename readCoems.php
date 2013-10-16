<?php
$link = connect_database();

$query = "SELECT * FROM coems";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_array($result)) {
    if ($row['finished'] >= 8) {
        echo "<HR />";
        for ($i = 1; $i <= 8; $i++) {
            $line = "line".$i;
            echo $row[$line] . "<BR />";
        }
    }
}

mysqli_close($link);
?>
