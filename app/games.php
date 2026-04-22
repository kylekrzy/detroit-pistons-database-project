<?php
include("db_connect.php");
$result = $conn->query("SELECT * FROM Games");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Games</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Games</h1>

    <nav>
        <a href="index.php">Home</a>
        <a href="players.php">Players</a>
        <a href="games.php">Games</a>
        <a href="tickets.php">Tickets</a>
        <a href="merchandise.php">Merchandise</a>
        <a href="finance.php">Finance Records</a>
        <a href="analytics.php">Analytics</a>
    </nav>

    <table>
        <tr>
            <th>Game ID</th>
            <th>Date</th>
            <th>Opponent</th>
            <th>Home/Away</th>
            <th>Result</th>
            <th>Score</th>
            <th>Attendance</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row["game_id"]; ?></td>
            <td><?php echo $row["game_date"]; ?></td>
            <td><?php echo $row["opponent"]; ?></td>
            <td><?php echo $row["home_away"]; ?></td>
            <td><?php echo $row["result"]; ?></td>
            <td><?php echo $row["score"]; ?></td>
            <td><?php echo $row["attendance"]; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>