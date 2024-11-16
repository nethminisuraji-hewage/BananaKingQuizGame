<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $select = " SELECT * FROM player_form WHERE username = '$username' && password = '$password' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);

        $_SESSION['username'] = $row['username'];
        
        header('Location: menu.php');
        exit();
    }else{
        $error[] = 'Incorrect Username or Password!';
    }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Login Title Container -->
    <div class="logintitle-container">
        <h1 class="login">LOG IN to BANANA KING</h1>
    </div>

    <div class="login-container">
        <form action="" method="post">
        <?php
            
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            
            ?>
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required placeholder="Enter Your Username">
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required placeholder="Enter Your Password">
            </div>

            <!-- Log In and Back to Home buttons -->
            <div class="loginbutton-container">
                <button type="submit" class="login-button" name="submit">Log In</button>
                <button type="button" class="back-home-button" onclick="window.location.href='index.html'">Back</button>
            </div>
        </form>
    </div>
</body>
</html>