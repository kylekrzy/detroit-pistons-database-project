<?php
include("db_connect.php");
$result = $conn->query("SELECT * FROM Tickets");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tickets</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Tickets</h1>

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
            <th>Ticket ID</th>
            <th>Game ID</th>
            <th>Section</th>
            <th>Row</th>
            <th>Seat</th>
            <th>Price</th>
            <th>Status</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row["ticket_id"]; ?></td>
            <td><?php echo $row["game_id"]; ?></td>
            <td><?php echo $row["section"]; ?></td>
            <td><?php echo $row["row_num"]; ?></td>
            <td><?php echo $row["seat_num"]; ?></td>
            <td><?php echo $row["price"]; ?></td>
            <td><?php echo $row["sale_status"]; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>