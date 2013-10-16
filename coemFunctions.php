<?php

include './globals.php';

function get_coem_id($link, $session) {
    $ceomid = -1;
    $query = "SELECT coemid FROM " . constant("sessions_table") . " WHERE ID='$session'";
    $stmt = mysqli_prepare($link, $query);
    mysqli_execute($stmt);
    mysqli_stmt_bind_result($stmt, $ceomid);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    return $ceomid;
}

function get_finished($link, $coemid) {
    $query = "SELECT * FROM " . constant("coems_table") . " WHERE coemid='$coemid'";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) == 0)
        return -1;

    $row = mysqli_fetch_array($result);
    return $row['finished'];
}

function get_line($link, $coemid, $line_no) {
    $query = "SELECT * FROM " . constant("coems_table") . " WHERE coemid='$coemid'";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) == 0)
        return "";

    $row = mysqli_fetch_array($result);
    return $row['line' . $line_no];
}

function connect_database() {
    $con = mysqli_connect(constant("sql_address"), constant("sql_username"), constant("sql_password"), constant("sql_database_name"));

    if (mysqli_connect_errno($con))
        echo "Failed to connect to MySQL: " . mysqli_connect_error();

    return $con;
}

function open_coem($link, $session) {
// Check if is not already opened. If so, finish.
    $coemid = get_coem_id($link, $session);
    if (get_finished($link, $coemid) >= 8 || $coemid == null)
        $coemid = -1;

    mysqli_query("LOCK TABLES " . constant("coems_table") . " WRITE");

    if ($coemid == -1) {
        // Find an available coem
        $query = "SELECT coemid, finished, time FROM " . constant("coems_table");
        $result = mysqli_query($link, $query);
        $coemid = -1;
        while ($row = mysqli_fetch_array($result)) {
            if ($row['finished'] < 8) {
                if ($row['time'] != 0 && time() - $row['time'] <= constant("timeout"))
                    continue;
                else if ($row['time'] != 0)
                    close_coem($link, $row['coemid']);

                $found = true;
                $coemid = $row['coemid'];
                break;
            }
        }
        if (!$found) {
            $coemid = mysqli_num_rows($result) + 1;
        }
    } else {
        $found = true;
    }

    if ($found) {
        $query = "UPDATE " . constant("coems_table") . " SET time=" . time() . " WHERE coemid=$coemid";
        mysqli_query($link, $query);
    } else {
        $query = "INSERT INTO " . constant("coems_table") . " VALUES($coemid,0,'','','','','','','',''," . time() . ")";
        mysqli_query($link, $query);
    }

    // Assign the coem to the session
    $query = "INSERT INTO sessions VALUES('$session',$coemid)";
    mysqli_query($link, $query);

    mysqli_query("UNLOCK TABLES");
}

function close_coem($link, $coemid) {
    $query = "UPDATE " . constant("coems_table") . " SET time=0 WHERE coemid=$coemid";
    mysqli_query($link, $query);

    $query = "DELETE FROM " . constant("sessions_table") . " WHERE coemid=$coemid";
    mysqli_query($link, $query);
}

function get_last_line($link, $session) {
    $coemid = get_coem_id($link, $session);
    $finished = get_finished($link, $coemid);
    return get_line($link, $coemid, $finished);
}

function exit_database($session) {
    $link = connect_database();
    $coemid = get_coem_id($link, $session);
    close_coem($link, $session);
    mysqli_close($link);
}

?>
