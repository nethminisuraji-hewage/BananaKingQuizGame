<?php
session_start();
$username = $_SESSION['username'];

// Connect to the database
require 'config.php';

// Retrieve player information
$query = "SELECT username, score, rank, games_played, games_won FROM player_form WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>My Profile</title>
</head>
<body>
    <div class="extratitle-container">
        <h1>My Profile</h1>
    </div>
    <div class="menu-container">
        <?php
        if ($result->num_rows > 0) {
            $player = $result->fetch_assoc();
            echo "<p><strong>Username:</strong> {$player['username']}</p>";
            echo "<p><strong>Final Highest Score:</strong> {$player['score']}</p>";
            echo "<p><strong>Rank:</strong> {$player['rank']}</p>";
            echo "<p><strong>Games Played:</strong> {$player['games_played']}</p>";
            echo "<p><strong>Games Won:</strong> {$player['games_won']}</p>";
        } else {
            echo "<p>No data found for this user.</p>";
        }
        ?>
    </div>
    <div class="button-container">
        <button class="back-home-button" onclick="window.location.href='menu.php';">Back to Menu</button>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
