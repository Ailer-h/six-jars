<?php

    //Checks if the user is logged in and redirects them if so
    session_start();

    if(isset($_SESSION["username"])){
        header("Location: user_dashboard.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
    <title>Sign Up</title>
</head>
<body>
    
    <div class="warning" id='warning'>
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56 56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>
        <p id='warning-txt'></p>
    </div>

    <div class="container">
        <form action="utilities/registerUser.php" method="post">
            <div class="login-form">
                <h1>Welcome to Wealthier!</h1>

                <div>
                    <label for="name">What's your name?</label>
                    <input type="text" name="name" id="name" required>
                </div>

                <div>
                    <label for="email">What's your email?</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div>
                    <label for="password" id="pass_label">Create a password:</label>
                    <input type="password" name="password_create" id="password" required>
                </div>

                <div>
                    <label for="password" id="confirm_label">Comfirm your password:</label>
                    <input type="password" name="password_confirm" id="password" required>

                    <span id='view-pass' onclick="showPassword('password')">Show Password 
                        <svg id="hidden" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/></svg>
                        <svg id="shown" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                    </span>
                </div>

                <select name='theme' onchange="document.body.classList.toggle('dark-theme')" required>
                    <option value="light">Light Theme</option>
                    <option value="dark">Dark Theme</option>
                </select>

                <input type="submit" value="Sign Up">
            </div>
        </form>
    </div>

</body>
<script src="../js/showPassword.js" ></script>
</html>

<?php

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['err'])){

        $err = $_POST['err'];

        echo gettype($err);

        echo"<script>
            console.log('Credentials Error | Code =". gettype($err) ."');
        </script>";

        if($err == '100'){

            echo"<script>
                document.getElementById('warning').style.display = 'grid';
                document.getElementById('warning-txt').textContent = 'Wrong email';
            </script>";

        }else if($err == '200'){
            echo"<script>
                document.getElementById('warning').style.display = 'grid';
                document.getElementById('warning-txt').textContent = 'Wrong password';
            </script>";
        }


    }

?>