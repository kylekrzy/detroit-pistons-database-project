<?php
include("db_connect.php");
$result = $conn->query("SELECT * FROM FinanceRecords");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Finance Records</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Finance Records</h1>

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
            <th>Finance ID</th>
            <th>Department ID</th>
            <th>Record Type</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Status</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
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