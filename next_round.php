<?php
session_start();

// Check if the maximum rounds are reached
if ($_SESSION['round'] < 5) {
    $_SESSION['round'] += 1;
} else {
    // End the game after 5 rounds
    header("Location: game_over.php");
    exit();
}

// Redirect to the game
header("Location: play_game.php");
exit();
?>
