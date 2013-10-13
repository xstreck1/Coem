<?php
    define("sql_address", "localhost");
    define("sql_username", "root");
    define("sql_password", "FIMonkey89");
    define("sql_database_name", "coem");
    define("coems_table", "coems");
    define("sessions_table", "sessions");
    
    function connect_coem() {
        $con = mysqli_connect(constant("sql_address"), constant("sql_username"), constant("sql_password"), constant("sql_database_name"));
        
        if (mysqli_connect_errno($con)) 
            echo "Failed to connect to MySQL: " . mysqli_connect_error();

        return $con;
    }
?>
