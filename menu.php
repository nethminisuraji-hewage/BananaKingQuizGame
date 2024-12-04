<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

$username = $_SESSION['username'];

// Cookie to store the last visit time
$lastVisit = date("Y-m-d H:i:s");
setcookie("last_visit", $lastVisit, time() + (86400 * 30), "/"); // Store for 30 days

// Fallback for new users
$displayVisitMessage = isset($_COOKIE['last_visit']) ? $_COOKIE['last_visit'] : $lastVisit;
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

        <!-- Display last visit message -->
        <?php
        if (isset($_COOKIE['last_visit'])) {
            echo "<p>Welcome Back! Your last visit was on: " . $_COOKIE['last_visit'] . "</p>";
        } else {
            echo "<p>Hey there, let's crack the code for Banana!</p>";
        }
        ?>
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
