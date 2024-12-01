<?php
session_start();
$finalScore = $_SESSION['score'];

// Reset session variables for a new game
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Over</title>
    <link rel="stylesheet" href="game.css">
</head>
<body>
    <div class="game-container">
        <h1>Game Over!</h1>
        <p>Your Final Score: <?php echo $finalScore; ?></p>
<<<<<<< HEAD
        <button id="return-home-button" class="ex-btn">Return to Home</button>
=======
        <button id="return-home-button" class="exit-button">Return to Home</button>
>>>>>>> eabaa4fe4f2374b8f9db1452c7ae6a5654b80496
    </div>

    <script>
        document.getElementById('return-home-button').addEventListener('click', function() {
            window.location.href = 'menu.php';
        });
    </script>
</body>
</html>
