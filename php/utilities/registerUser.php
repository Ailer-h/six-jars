<?php

    if(isset($_POST['email'])){

        
        include "mysqlConnect.php";
        
        $email = $_POST['email'];
        $name = $_POST['name'];
        $password = $_POST['password_create'];
        $confirmation = $_POST['password_confirm'];
        $theme = $_POST['theme'];
        
        $info = mysqli_fetch_array(mysqli_query($connection, "select user_id from users where user_email like '$email';"));
        
        if(!empty($info)){ //Info returned thus, email already exists
            
            mysqli_close($connection);
            
            echo"<form action='../signup.php' method='post' id='error'><input type='hidden' id='err' name='err' value='100'></form>";
            echo"<script>document.getElementById('error').submit();</script>";
            
        }else if($password != $confirmation){ //Passwords don't match
            
            mysqli_close($connection);
            
            echo"<form action='../signup.php' method='post' id='error'><input type='hidden' id='err' name='err' value='200'></form>";
            echo"<script>document.getElementById('error').submit();</script>";
            
        }else if(strlen($password) < 8){ //Password too short 
            
            mysqli_close($connection);
            
            echo"<form action='../signup.php' method='post' id='error'><input type='hidden' id='err' name='err' value='300'></form>";
            echo"<script>document.getElementById('error').submit();</script>";
            
        }else{ //Register succeeded
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($connection, "insert into users(user_name, user_email, user_password, theme_preference) values ('$name','$email','$hashed_password','$theme');");
            $extra_info = mysqli_fetch_array(mysqli_query($connection, "select user_id, user_permissions from users where user_email like '$email';"));
            
            //Registers user and initiates his session
            session_start();
            
            $_SESSION['id'] = $extra_info[0];
            $_SESSION['permissions'] = $extra_info[1];
            $_SESSION['username'] = $name;
            $_SESSION['theme'] = $theme;
            
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