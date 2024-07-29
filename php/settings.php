<?php

    //Checks if the user is logged in - [ALREADY STARTS SESSION]
    include "utilities/checkSession.php";

    //Function that treats a date putting it on the DD/MM/YYYY format
    include "utilities/treatDate.php";

    //Loads user information and stores it
    include "utilities/mysqlConnect.php";
    $id = $_SESSION['id'];
    $user_info = mysqli_fetch_assoc(mysqli_query($connection, "select user_id, user_name, user_email, theme_preference, account_created from users where user_id = $id;"));

    mysqli_close($connection);

    $account_created = treatDate(explode(" ", $user_info['account_created'])[0]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/settings.css">
    <link rel="shortcut icon" href="../images/logo.ico" type="image/x-icon">
    <title>Settings</title>
</head>
<body <?php if($_SESSION['theme'] == 'dark'){ echo "class='dark-theme'"; } ?>>

<div class="navbar">
        <h1>Wealthier</h1>
        <div class="menu">

            <div id="theme">

            <?php
                if($_SESSION['theme'] == 'dark'){
                    echo '<svg onclick="toggle_darkmode()" id="dark" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Zm0-80q88 0 158-48.5T740-375q-20 5-40 8t-40 3q-123 0-209.5-86.5T364-660q0-20 3-40t8-40q-78 32-126.5 102T200-480q0 116 82 198t198 82Zm-10-270Z"/></svg>
                        <svg style="display: none;" onclick="toggle_darkmode()" id="light" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M480-360q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Zm0 80q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Zm326-268Z"/></svg>';
                
                }else{
                    echo '<svg style="display: none;" onclick="toggle_darkmode()" id="dark" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Zm0-80q88 0 158-48.5T740-375q-20 5-40 8t-40 3q-123 0-209.5-86.5T364-660q0-20 3-40t8-40q-78 32-126.5 102T200-480q0 116 82 198t198 82Zm-10-270Z"/></svg>
                        <svg onclick="toggle_darkmode()" id="light" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M480-360q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Zm0 80q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Zm326-268Z"/></svg>';
                }
            
            ?>

            </div>

            <?php if($_SESSION['permissions'] == 'a'){ echo '<a href=""><button class="secondary">See all users</button></a>'; }?>

            <a href="user_dashboard.php"><button class="secondary">Home</button></a>
            <a href="utilities/sessionDestroy.php" id="logout"> Log Out <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg></a>
        </div>
    </div>

    <div class="container">
        <div class="grid">
            <div class="sidebar">
                <h3>Settings</h3>
                <hr>
                <ul>
                    <li class="tab" onclick="showSection('user-settings', this)">User Settings</li>
                    <li class="tab" onclick="showSection('general-settings', this)">General Settings</li>
                    <li class="del-account" onclick="showSection('delete-account',this)">Delete my account <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg></li>
                </ul>
            </div>

            <form action="utilities/updateUserInfo.php" method="post">
                <div class="content">
                    <section id="user-settings">
                        <h1>User</h1>
                        <hr>
                        <div class="row">
                            <p>Username</p>
                            <input type="text" id="username" name="username" value="<?php echo $user_info['user_name']; ?>">
                            <input type="hidden" id="username-expected" name="username-expected" value="<?php echo $user_info['user_name']; ?>">
                        </div>
                        
                        <div class="row">
                            <p>Email</p>
                            <input type="text" id="email" name="email" value="<?php echo $user_info['user_email']; ?>">
                            <input type="hidden" id="email-expected" name="email-expected" value="<?php echo $user_info['user_email']; ?>">
                        </div>
                    
                        <div class="row">
                            <p>Password</p>
                            <button type="button">Redefine Password</button>
                        </div>
                    </section>
                
                    <section id="general-settings">
                        <h1>General</h1>
                        <hr>
                        <div class="row">
                            <p>Theme preferences</p>
                        
                            <select name="theme" id="theme">
                                <option value="light" <?php if($_SESSION['theme'] == 'light'){ echo "selected"; } ?>>Light Theme</option>
                                <option value="dark" <?php if($_SESSION['theme'] == 'dark'){ echo "selected"; } ?>>Dark Theme</option>
                            </select>
                        
                            <input type="hidden" id="theme-expected" name="theme-expected" value="<?php echo $user_info['theme_preference']; ?>">
                        </div>
                    </section>
                
                    <section id="delete-account">
                        <h1>Delete your account</h1>
                        <hr>
                        <p>Be careful! Deleting your account is a permanent action.</p>
                        <div style="width: 100%; display: flex; justify-content: end;">
                            <button class="delete" type="button">Delete my account</button>
                        </div>
                    </section>
                
                    <div id='save-form'>
                        <button id="save" type="submit">Save Changes</button>
                        <button id="cancel" type="button">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
<script src="../js/darkMode.js"></script>
<script src="../js/showSections.js"></script>
<script src="../js/handleFormUpdates.js"></script>
</html>