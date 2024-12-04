<?php
session_start();

// Connect to the database
require 'config.php';

// Retrieve the top 10 players
$query = "SELECT username, score, rank FROM player_form ORDER BY score DESC LIMIT 10";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Leaderboard</title>
</head>
<body>
    <div class="extratitle-container">
        <h1>Leaderboard</h1>
    </div>
    <div class="menu-container">
        <table border="2" style="width: 100%; text-align: center; border-collapse: collapse;">
            <tr>
                <th>Rank</th>
                <th>Username</th>
                <th>Final Highest Score</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['rank']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['score']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <div class="button-container">
        <button class="back-home-button" onclick="window.location.href='menu.php';">Back to Menu</button>
    </div>
</body>
</html>
<?php
$conn->close();
?>
