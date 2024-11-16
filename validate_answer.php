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

    // Redirect back to the game
    header("Location: play_game.php");
    exit();
}
?>
