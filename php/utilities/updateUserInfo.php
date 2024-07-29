<?php

    if(isset($_POST['email'])){

        session_start();
        $id = $_SESSION['id'];

        $email = $_POST['email'];
        $email_expected = $_POST['email-expected'];

        $username = $_POST['username'];
        $username_expected = $_POST['username-expected'];

        $theme = $_POST['theme'];
        $theme_expected = $_POST['theme-expected'];

        $update = "set ";

        //Checks which info must be updated
        if($email != $email_expected){
            $update .= "user_email = '$email',";
        }

        if($username != $username_expected){
            $update .= "user_name = '$username',";
            $_SESSION['username'] = $username;
        }

        if($theme != $theme_expected){
            $update .= "theme_preference = '$theme',";
            $_SESSION['theme'] = $theme;
        }

        $update = substr($update, 0, -1);

        //Updates the necessary info
        include "mysqlConnect.php";
        mysqli_query($connection, "update users $update where user_id = $id;");
        mysqli_close($connection);

        header("Location: ../settings.php");

    }else{
        //Checks if the user is logged in
        session_start();

        if(!isset($_SESSION['username'])){
            header('Location: login.php');
        
        }else{
            header('Location: ../user_dashboard.php');
        }
    }

?>