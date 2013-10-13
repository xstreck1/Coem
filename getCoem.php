<?php
include './globals.php';

function open_coem($connection, $session) {
    $used_id = -1;
    $open_id = -1;
    
    // Check if is not already opened.
    $select_sessions = "SELECT * FROM sessions WHERE ID='$session'";
    $session_entry = mysqli_query($connection, $select_sessions);
    $session_row = mysqli_fetch_array($session_entry);
    if ($session_row) {
        $open_id = $session_row["coemid"];
    }
    
    // Find an available coem
    $select_coems = "SELECT * FROM coems";
    $result_set = mysqli_query($connection, $select_coems);
    while ($row = mysqli_fetch_array($result_set)) {
        if ($open_id == $row['coemid'] & $row['finished'] >= 8 ) {
            close_coem($connection, $session);
            $open_id = -1;
        }
        else if (($row['in_use'] == "0" & $row['finished'] < 8 ) | ($open_id == $row['coemid'])) {
            $used_id = $row['coemid'];
            break;
        }
    }

    // Disable the current coem if not already displayed.
    if ($open_id == -1) {
        $disable_chosen = "UPDATE coems SET in_use='1' WHERE coemid=$used_id";
        mysqli_query($connection, $disable_chosen);

        // Assign the coem to the session
        $assign_session = "INSERT INTO sessions VALUES('$session',$used_id)";
        mysqli_query($connection, $assign_session);
    }
    
    // Return the respective part
    echo "Last line is:<br />";
    echo $row["line" . $row["finished"]] . "<br />";
}

function close_coem($connection, $session) {
    $select = "SELECT * FROM sessions WHERE ID='$session'";
    $result_set = mysqli_query($connection, $select);
    $row = mysqli_fetch_array($result_set);
    if ($row) {
        // Disable the current coem
        $coemid = $row["coemid"];
        $enable_chosen = "UPDATE coems SET in_use='0' WHERE coemid=$coemid";
        mysqli_query($connection, $enable_chosen);

        // Assign the coem to the session
        $delete_session = "DELETE FROM sessions WHERE ID='$session'";
        mysqli_query($connection, $delete_session);
    } else {
        // echo "Session not in the database.";
    }   
}

// Get the parameters
$open = intval($_GET['open']);
$session = htmlspecialchars($_GET['session']);

// Open Mysql
$connection = connect_coem();

// Manipulate the coem
if ($open == "1") {
    open_coem($connection, $session);
} else {
    close_coem($connection, $session);
}

mysqli_close($connection);
?>
