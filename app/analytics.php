<?php
include("db_connect.php");

$q1 = $conn->query("SELECT player_id, f_name, l_name, salary FROM Players ORDER BY salary DESC");
$q2 = $conn->query("SELECT game_id, game_date, opponent, score, result FROM Games WHERE home_away = 'Home'");
$q3 = $conn->query("SELECT perf_id, game_id, player_id, pts, rebounds, assists FROM PlayerPerformance WHERE pts >= 20");
$q4 = $conn->query("SELECT ticket_id, game_id, section, row_num, seat_num, price FROM Tickets WHERE sale_status = 'Available'");
$q5 = $conn->query("SELECT fin_id, dept_id, record_type, amount, record_date, status FROM FinanceRecords WHERE status = 'Pending'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Analytics</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Analytics Queries</h1>

    <nav>
        <a href="index.php">Home</a>
        <a href="players.php">Players</a>
        <a href="games.php">Games</a>
        <a href="tickets.php">Tickets</a>
        <a href="merchandise.php">Merchandise</a>
        <a href="finance.php">Finance Records</a>
        <a href="analytics.php">Analytics</a>
    </nav>

    <h2>1. Players Ordered by Salary</h2>
    <table>
        <tr><th>Player ID</th><th>First Name</th><th>Last Name</th><th>Salary</th></tr>
        <?php while($row = $q1->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row["player_id"]; ?></td>
            <td><?php echo $row["f_name"]; ?></td>
            <td><?php echo $row["l_name"]; ?></td>
            <td><?php echo $row["salary"]; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>2. Home Games</h2>
    <table>
        <tr><th>Game ID</th><th>Date</th><th>Opponent</th><th>Score</th><th>Result</th></tr>
        <?php while($row = $q2->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row["game_id"]; ?></td>
            <td><?php echo $row["game_date"]; ?></td>
            <td><?php echo $row["opponent"]; ?></td>
            <td><?php echo $row["score"]; ?></td>
            <td><?php echo $row["result"]; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>3. Player Performances with 20+ Points</h2>
    <table>
        <tr><th>Performance ID</th><th>Game ID</th><th>Player ID</th><th>Points</th><th>Rebounds</th><th>Assists</th></tr>
        <?php while($row = $q3->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row["perf_id"]; ?></td>
            <td><?php echo $row["game_id"]; ?></td>
            <td><?php echo $row["player_id"]; ?></td>
            <td><?php echo $row["pts"]; ?></td>
            <td><?php echo $row["rebounds"]; ?></td>
            <td><?php echo $row["assists"]; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>4. Available Tickets</h2>
    <table>
        <tr><th>Ticket ID</th><th>Game ID</th><th>Section</th><th>Row</th><th>Seat</th><th>Price</th></tr>
        <?php while($row = $q4->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row["ticket_id"]; ?></td>
            <td><?php echo $row["game_id"]; ?></td>
            <td><?php echo $row["section"]; ?></td>
            <td><?php echo $row["row_num"]; ?></td>
            <td><?php echo $row["seat_num"]; ?></td>
            <td><?php echo $row["price"]; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>5. Pending Finance Records</h2>
    <table>
        <tr><th>Finance ID</th><th>Dept ID</th><th>Type</th><th>Amount</th><th>Date</th><th>Status</th></tr>
        <?php while($row = $q5->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row["fin_id"]; ?></td>
            <td><?php echo $row["dept_id"]; ?></td>
            <td><?php echo $row["record_type"]; ?></td>
            <td><?php echo $row["amount"]; ?></td>
            <td><?php echo $row["record_date"]; ?></td>
            <td><?php echo $row["status"]; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>