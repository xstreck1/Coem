<?php

// Get the parameters
$open = intval($_GET['open']);
$my_session = htmlspecialchars($_GET['session']);

// Open Mysql
$con = mysqli_connect("localhost", "root", "FIMonkey89", "coem");
if (mysqli_connect_errno($con)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
    // echo "Connected to the database.";
}

// Requesting to open a coem 
if ($open == "1") {
    $select = "SELECT * FROM coems";
    $result_set = mysqli_query($con, $select);

    // Find an available coem
    $used_id = -1;
    while ($row = mysqli_fetch_array($result_set)) {
        if ($row['in_use'] == "0") {
            $used_id = $row['coemid'];
            break;
        }
    }

    // Disable the current coem
    $disable_chosen = "UPDATE coems SET in_use='1' WHERE coemid=$used_id";
    mysqli_query($con, $disable_chosen);

    // Assign the coem to the session
    $assign_session = "INSERT INTO sessions VALUES('$my_session',$used_id)";
    mysqli_query($con, $assign_session);

    // Return the respective part
    echo "Last line is:<br />";
    echo $row["line" . $row["finished"]] . "<br />";
} else {
    $select = "SELECT * FROM sessions WHERE ID='$my_session'";
    $result_set = mysqli_query($con, $select);
    if ($row = mysqli_fetch_array($result_set)) {
        // Disable the current coem
        $coemid = $row["coemid"];
        $enable_chosen = "UPDATE coems SET in_use='0' WHERE coemid=$coemid";
        mysqli_query($con, $enable_chosen);

        // Assign the coem to the session
        $delete_session = "DELETE FROM sessions WHERE ID='$my_session'";
        mysqli_query($con, $delete_session);
    } else {
        echo "Session not in the database.";
    }
}



mysqli_close($con);
?>
