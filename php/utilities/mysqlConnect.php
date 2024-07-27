<?php

    //Connects to the database

    $server = "127.0.0.1";
    $user = "root";
    $password = "";
    $database = "wealthier";

    $connection = mysqli_connect($server,$user,$password,$database) or die ("Ran into connection issues! Please verify the server")

?>