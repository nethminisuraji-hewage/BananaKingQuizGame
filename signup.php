<?php

@include 'config.php';

if(isset($_POST['submit'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);
    $confirmPassword = md5($_POST['confirmPassword']);

    $select = " SELECT * FROM player_form WHERE username = '$username' && password = '$password' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $error[] = 'User already exist!';
    }else{
        if($password != $confirmPassword){
            $error[] = 'Password not matched!';
        }else{
            $insert = "INSERT INTO player_form(username, password) VALUES('$username', '$password')";
            mysqli_query($conn, $insert);
            header('location:login.php');
        }
    }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Sign Up Title Container -->
    <div class="logintitle-container">
        <h1 class="login">SIGN UP to BANANA KING</h1>
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
                <input type="text" id="username" name="username" required placeholder="Enter Your Name">
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required placeholder="Enter a Password">
            </div>
            <div class="input-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required placeholder="Confirm Your Password">
            </div>

            <!-- Sihn Up and Back to Home buttons -->
            <div class="loginbutton-container">
                <button type="submit" class="login-button" name="submit">Sign Up</button>
                <button type="button" class="back-home-button" onclick="window.location.href='index.html'">Back</button>
            </div>
        </form>
    </div>
</body>
</html>
