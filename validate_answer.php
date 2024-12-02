<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userAnswer = $_POST['answer'];
    $correctAnswer = $_SESSION['solution'];

    // Debug session data
    // var_dump($_SESSION); die();

    // Validate the answer
    if ($userAnswer == $correctAnswer) {
        $_SESSION['score'] += 5; // Increment score if correct
    } else {
        $_SESSION['lives'] -= 1; // Deduct a life if incorrect
    }

    // Check for game over conditions
    if ($_SESSION['lives'] <= 0 || $_SESSION['round'] >= 5) {
        header("Location: game_over.php");
        exit();
    }

    // Redirect back to the game for the next round
    header("Location: next_round.php");
    exit();
}
?>