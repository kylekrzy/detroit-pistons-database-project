<?php
include("db_connect.php");

$message = "";
$messageClass = "";

if (isset($_POST["delete_id"])) {
    $stmt = $conn->prepare("DELETE FROM Merchandise WHERE merch_id = ?");
    $stmt->bind_param("i", $_POST["delete_id"]);

    if ($stmt->execute()) {
        $message = "Merchandise deleted successfully.";
        $messageClass = "success";
    } else {
        $message = "Error deleting merchandise: " . $stmt->error;
        $messageClass = "error";
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare("INSERT INTO Merchandise (merch_id, item_name, category, price, quantity) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "issdi",
        $_POST["merch_id"],
        $_POST["item_name"],
        $_POST["category"],
        $_POST["price"],
        $_POST["quantity"]
    );

    if ($stmt->execute()) {
        $message = "Merchandise added successfully.";
        $messageClass = "success";
    } else {
        $message = "Error: " . $stmt->error;
        $messageClass = "error";
    }

    $stmt->close();
}

$result = $conn->query("SELECT * FROM Merchandise ORDER BY merch_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Merchandise</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <a href="index.php">Home</a>
    <a href="staff.php">Staff</a>
    <a href="players.php">Players</a>
    <a href="games.php">Games</a>
    <a href="tickets.php">Tickets</a>
    <a href="merchandise.php">Merchandise</a>
    <a href="finance.php">Finance Records</a>
    <a href="analytics.php">Analytics</a>
</div>

<div class="page">
    <div class="section">
        <h2>Merchandise</h2>

        <?php if ($message): ?>
            <div class="message <?php echo $messageClass; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <table>
            <tr>
                <th>Merchandise ID</th>
                <th>Item Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row["merch_id"]; ?></td>
                <td><?php echo $row["item_name"]; ?></td>
                <td><?php echo $row["category"]; ?></td>
                <td><?php echo $row["price"]; ?></td>
                <td><?php echo $row["quantity"]; ?></td>
                <td>
                    <form method="POST" class="inline-form">
                        <input type="hidden" name="delete_id" value="<?php echo $row["merch_id"]; ?>">
                        <button class="btn delete-btn" type="submit" onclick="return confirm('Delete this merchandise item?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div class="section">
        <h2>Add Merchandise</h2>
        <form method="POST">
            <div class="form-grid">
                <input type="number" name="merch_id" placeholder="Merch ID" required>
                <input type="text" name="item_name" placeholder="Item Name" required>
                <input type="text" name="category" placeholder="Category" required>
                <input type="number" step="0.01" name="price" placeholder="Price" required>
                <input type="number" name="quantity" placeholder="Quantity" required>
            </div>
            <button class="btn" type="submit">Add Merchandise</button>
        </form>
    </div>
</div>

</body>
</html>