<?php

    if(isset($_POST['email'])){

        include "mysqlConnect.php";
        
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $info = mysqli_fetch_array(mysqli_query($connection, "select user_password, user_id, user_permissions, user_name, theme_preference from users where user_email like '$email';"));
        
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
            $_SESSION['theme'] = $info[4];
            
            mysqli_close($connection);
            
            //Makes the session last for 30 days
            $params = session_get_cookie_params();
            setcookie(session_name(), $_COOKIE[session_name()], time() + 60*60*24*30, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
            
            //Redirects user to the dashboard
            header("Location: ../user_dashboard.php");
            
        }
        
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