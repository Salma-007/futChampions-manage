<?php
    define("HOSTNAME","localhost");
    define("USERNAME","root");
    define("PASSWORD","");
    define("DATABASE","fut_champions_db");

    $conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>