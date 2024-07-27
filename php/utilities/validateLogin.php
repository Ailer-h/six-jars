<?php

    include "mysqlConnect.php";

    $email = $_POST['email'];
    $password = $_POST['password'];

    $info = mysqli_fetch_array(mysqli_query($connection, "select user_password, user_id, user_permissions, user_name from users where user_email like '$email';"));

    
    if(empty($info)){ //No info returned thus, the user doesn't exist

        mysqli_close($connection);

        echo"<form action='../login.php' method='post' id='error'><input type='hidden' id='err' name='err' value='100'></form>";
        echo"<script>document.getElementById('error').submit();</script>";

    }else if(!password_verify($password, $info[0])){ //Wrong password

        mysqli_close($connection);

        echo"<form action='../login.php' method='post' id='error'><input type='hidden' id='err' name='err' value='200'></form>";
        echo"<script>document.getElementById('error').submit();</script>";

    }else{ //Login succeeded

        //Starts the user session and saves their information
        session_start();

        $_SESSION['id'] = $info[1];
        $_SESSION['permissions'] = $info[2];
        $_SESSION['username'] = $info[3];

        mysqli_close($connection);

        //Redirects user to the dashboard
        header("Location: ../user_dashboard.php");
        
    }

?>