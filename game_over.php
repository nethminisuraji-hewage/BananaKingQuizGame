<?php
session_start();
require 'config.php';

$finalScore = $_SESSION['score'] ?? 0; // Handle case where score might not exist
$username = $_SESSION['username'];

// Reset session variables for a new game
//session_destroy();

// Update player's score and games played
$query = "UPDATE player_form 
          SET score = GREATEST(score, ?), games_played = games_played + 1 
          WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $finalScore, $username);
$stmt->execute();

// Update rank for all players
$rankQuery = "SET @rank := 0;
              UPDATE player_form
              SET rank = (@rank := @rank + 1) 
              ORDER BY score DESC;";
$conn->multi_query($rankQuery);

$stmt->close();

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
        <form method="POST" action="menu.php">
            <button class="ex-btn">Return to Menu</button>
        </form>
    </div>
</body>
</html>
