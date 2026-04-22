<?php
include("db_connect.php");
$result = $conn->query("SELECT * FROM Players");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Players</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Players</h1>

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
            <th>Player ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Position</th>
            <th>Jersey #</th>
            <th>Salary</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row["player_id"]; ?></td>
            <td><?php echo $row["f_name"]; ?></td>
            <td><?php echo $row["l_name"]; ?></td>
            <td><?php echo $row["position"]; ?></td>
            <td><?php echo $row["jersey_num"]; ?></td>
            <td><?php echo $row["salary"]; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>