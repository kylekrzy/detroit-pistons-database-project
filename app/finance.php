<?php
include("db_connect.php");

$message = "";
$messageClass = "";

if (isset($_POST["delete_id"])) {
    $stmt = $conn->prepare("DELETE FROM FinanceRecords WHERE fin_id = ?");
    $stmt->bind_param("i", $_POST["delete_id"]);

    if ($stmt->execute()) {
        $message = "Finance record deleted successfully.";
        $messageClass = "success";
    } else {
        $message = "Error deleting finance record: " . $stmt->error;
        $messageClass = "error";
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare("INSERT INTO FinanceRecords (fin_id, dept_id, record_type, amount, record_date, description, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "iisdsss",
        $_POST["fin_id"],
        $_POST["dept_id"],
        $_POST["record_type"],
        $_POST["amount"],
        $_POST["record_date"],
        $_POST["description"],
        $_POST["status"]
    );

    if ($stmt->execute()) {
        $message = "Finance record added successfully.";
        $messageClass = "success";
    } else {
        $message = "Error: " . $stmt->error;
        $messageClass = "error";
    }

    $stmt->close();
}

$result = $conn->query("SELECT * FROM FinanceRecords ORDER BY fin_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Finance Records</title>
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
        <h2>Finance Records</h2>

        <?php if ($message): ?>
            <div class="message <?php echo $messageClass; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <table>
            <tr>
                <th>Financial ID</th>
                <th>Dept ID</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row["fin_id"]; ?></td>
                <td><?php echo $row["dept_id"]; ?></td>
                <td><?php echo $row["record_type"]; ?></td>
                <td><?php echo $row["amount"]; ?></td>
                <td><?php echo $row["record_date"]; ?></td>
                <td><?php echo $row["description"]; ?></td>
                <td><?php echo $row["status"]; ?></td>
                <td>
                    <form method="POST" class="inline-form">
                        <input type="hidden" name="delete_id" value="<?php echo $row["fin_id"]; ?>">
                        <button class="btn delete-btn" type="submit" onclick="return confirm('Delete this finance record?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div class="section">
        <h2>Add Finance Record</h2>
        <form method="POST">
            <div class="form-grid">
                <input type="number" name="fin_id" placeholder="Finance ID" required>
                <input type="number" name="dept_id" placeholder="Dept ID" required>
                <input type="text" name="record_type" placeholder="Record Type" required>
                <input type="number" step="0.01" name="amount" placeholder="Amount" required>
                <input type="date" name="record_date" required>
                <input type="text" name="description" placeholder="Description" required>
                <select name="status" required>
                    <option value="">Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Approved">Approved</option>
                    <option value="Canceled">Canceled</option>
                </select>
            </div>
            <button class="btn" type="submit">Add Finance Record</button>
        </form>
    </div>
</div>

</body>
</html>