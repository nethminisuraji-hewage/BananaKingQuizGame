<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userAnswer = $_POST['answer'];
    $correctAnswer = $_SESSION['solution'];

    // Check if the answer is correct
    if ($userAnswer >= 0 && $userAnswer <= 10) {
        if ($userAnswer == $correctAnswer) {
            $_SESSION['score'] += 5; // Increment score
        } else {
            $_SESSION['lives'] -= 1; // Deduct a life
        }
    }

    // Check for game end conditions
    if ($_SESSION['lives'] <= 0 || $_SESSION['round'] >= 5) {
        // Game over: redirect to the game over page
        header("Location: game_over.php");
        exit();
    }

    // Increment round if the game is not over
    $_SESSION['round']++;

    // Redirect back to the game
    header("Location: play_game.php");
    exit();
}
?>

