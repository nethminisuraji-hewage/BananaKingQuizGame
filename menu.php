<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Extra Title Container -->
    <div class="extratitle-container">
        <h1 class="extra">Welcome to BANANA KING, <?php echo htmlspecialchars($username); ?>!</h1>
    </div>

    <div class="menu-container">
        <form method="POST" action="choose_level.php">
            <button class="menu-btn play-btn">Play Game</button>
        </form>
        <form method="POST" action="top_players.php">
            <button class="menu-btn">Top Players</button>
        </form>
        <form method="POST" action="leaderboard.php">
            <button class="menu-btn">Leaderboard</button>
        </form>
        <form method="POST" action="my_profile.php">
            <button class="menu-btn">My Profile</button>
        </form>
        <form method="POST" action="logout.php">
            <button class="menu-btn logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>
