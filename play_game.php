<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

// Initialize session variables for gameplay
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['level'])) {
    $_SESSION['level'] = $_POST['level'];
    $_SESSION['timer'] = $_SESSION['level'] === 'easy' ? 60 : ($_SESSION['level'] === 'medium' ? 40 : 20);

    // Re-initialize gameplay variables when the level changes
    $_SESSION['score'] = 0;
    $_SESSION['lives'] = 5; 
    $_SESSION['round'] = 1;
}

// Check if session variables are properly set
if (!isset($_SESSION['score']) || !isset($_SESSION['timer']) || !isset($_SESSION['level'])) {
    $_SESSION['score'] = 0;
    $_SESSION['lives'] = 5;
    $_SESSION['round'] = 1;
    $_SESSION['level'] = 'easy';
    $_SESSION['timer'] = 60; 
}

// Check if the round limit is reached
if ($_SESSION['round'] > 5 || $_SESSION['lives'] <= 0) {
    header("Location: game_over.php");
    exit();
}

// Fetch question from the API
$apiUrl = "https://marcconrad.com/uob/banana/api.php";
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);

$questionImage = $data['question'];
$solution = $data['solution'];
$_SESSION['solution'] = $solution;

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Round <?php echo $_SESSION['round']; ?></title>
    <link rel="stylesheet" href="game.css">
    <script>
        let timer = <?php echo $_SESSION['timer']; ?>;
        let interval;

        function startTimer() {
            const timerElement = document.getElementById('timer');
            interval = setInterval(() => {
                if (timer <= 0) {
                    clearInterval(interval);
                    alert(`Time's up! Your score: <?php echo $_SESSION['score']; ?>`);
                    window.location.href = 'menu.php';
                } else {
                    timerElement.innerHTML = `Timer: ${timer}s`;
                    timer--;
                }
            }, 1000);
        }
    </script>
</head>
<body onload="startTimer()">
    <div class="game-container">
        <header>
            <div class="player-name">Player: <?php echo htmlspecialchars($username); ?></div>
            <div class="lives">
                <?php for ($i = 0; $i < $_SESSION['lives']; $i++): ?>
                    ❤️ <!--got the idea from ChatGPT and got the emoji from emojipedia-->
                <?php endfor; ?>
            </div>
        </header>
        <div class="score">Score: <?php echo $_SESSION['score']; ?></div>
        <div class="round">Round: <?php echo $_SESSION['round']; ?></div>
        <div class="question">
            <img src="<?php echo $questionImage; ?>" alt="Question">
        </div>
        <div class="answers">
            <?php for ($i = 0; $i <= 10; $i++): ?> 
                <form method="POST" action="validate_answer.php">
                    <button 
                        name="answer" 
                        value="<?php echo $i; ?>" 
                        class="answer-button">
                        data-answer="<?php echo $i; ?>" 
                        data-correct="<?php echo $i == $solution ? 'true' : 'false'; ?>">
                        <?php echo $i; ?>
                    </button>
                </form>
            <?php endfor; ?>
        </div>
        <div id="timer" class="timer"></div>
        <div class="controls">
            <form method="POST" action="menu.php">
                <button class="exit-button">Exit</button>
            </form>
            <form method="POST" action="next_round.php">
                <button class="next-button">Next</button>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('.answer-button').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault(); // Prevent immediate form submission

                const correctAnswer = document.querySelector('[data-correct="true"]');
                const selectedAnswer = e.target;

                // Highlight selected answer
                if (selectedAnswer.dataset.correct === 'true') {
                    selectedAnswer.style.backgroundColor = 'green'; // Correct answer
                } else {
                    selectedAnswer.style.backgroundColor = 'red'; // Wrong answer
                    correctAnswer.style.backgroundColor = 'green'; // Highlight the correct answer
                }

                // Delay form submission to display the result
                setTimeout(() => {
                    selectedAnswer.closest('form').submit();
                }, 2000);
            });
        });
    </script>

</body>
</html>
