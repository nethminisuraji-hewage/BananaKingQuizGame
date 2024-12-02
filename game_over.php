<?php
session_start();
$finalScore = $_SESSION['score'] ?? 0; // Handle case where score might not exist

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
    <div class="game-container game-over">
        <h1>Game Over!</h1>
        <p>Your Final Score: <strong><?php echo $finalScore; ?></strong></p>
        <a href="menu.php" class="ex-btn">Return to Home</a>
    </div>
</body>
</html>
