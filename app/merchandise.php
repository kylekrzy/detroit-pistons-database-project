<?php
include("db_connect.php");
$result = $conn->query("SELECT * FROM Merchandise");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Merchandise</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Merchandise</h1>

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
            <th>Merch ID</th>
            <th>Item Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row["merch_id"]; ?></td>
            <td><?php echo $row["item_name"]; ?></td>
            <td><?php echo $row["category"]; ?></td>
            <td><?php echo $row["price"]; ?></td>
            <td><?php echo $row["quantity"]; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>