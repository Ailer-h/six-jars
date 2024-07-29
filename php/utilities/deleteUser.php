<?php

    if(isset($_GET['del'])){

        session_start();
        $id = $_SESSION['id'];

        include "mysqlConnect.php";
        mysqli_query($connection, "delete from users where user_id = $id;");
        mysqli_close($connection);

        header("Location: sessionDestroy.php");

    }else{
        //Checks if the user is logged in
        session_start();

        if(!isset($_SESSION['username'])){
            header('Location: ../login.php');
        
        }else{
            header('Location: ../user_dashboard.php');
        }
    }

?>