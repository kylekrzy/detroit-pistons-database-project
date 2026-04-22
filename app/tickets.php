<?php
include("db_connect.php");

$message = "";
$messageClass = "";

if (isset($_POST["delete_id"])) {
    $stmt = $conn->prepare("DELETE FROM Tickets WHERE ticket_id = ?");
    $stmt->bind_param("i", $_POST["delete_id"]);

    if ($stmt->execute()) {
        $message = "Ticket deleted successfully.";
        $messageClass = "success";
    } else {
        $message = "Error deleting ticket: " . $stmt->error;
        $messageClass = "error";
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $purchase_date = ($_POST["purchase_date"] === "") ? null : $_POST["purchase_date"];
    $purchaser_fname = ($_POST["purchaser_fname"] === "") ? null : $_POST["purchaser_fname"];
    $purchaser_lname = ($_POST["purchaser_lname"] === "") ? null : $_POST["purchaser_lname"];
    $purchaser_email = ($_POST["purchaser_email"] === "") ? null : $_POST["purchaser_email"];

    $stmt = $conn->prepare("INSERT INTO Tickets (ticket_id, game_id, seat_num, row_num, section, price, purchase_date, purchaser_fname, purchaser_lname, purchaser_email, ticket_type, sale_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "iisssdssssss",
        $_POST["ticket_id"],
        $_POST["game_id"],
        $_POST["seat_num"],
        $_POST["row_num"],
        $_POST["section"],
        $_POST["price"],
        $purchase_date,
        $purchaser_fname,
        $purchaser_lname,
        $purchaser_email,
        $_POST["ticket_type"],
        $_POST["sale_status"]
    );

    if ($stmt->execute()) {
        $message = "Ticket added successfully.";
        $messageClass = "success";
    } else {
        $message = "Error: " . $stmt->error;
        $messageClass = "error";
    }

    $stmt->close();
}

$result = $conn->query("SELECT * FROM Tickets ORDER BY ticket_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tickets</title>
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
        <h2>Tickets</h2>

        <?php if ($message): ?>
            <div class="message <?php echo $messageClass; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <table>
            <tr>
                <th>Ticket ID</th>
                <th>Game ID</th>
                <th>Section</th>
                <th>Row</th>
                <th>Seat</th>
                <th>Price</th>
                <th>Purchase Date</th>
                <th>Purchaser</th>
                <th>Type</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row["ticket_id"]; ?></td>
                <td><?php echo $row["game_id"]; ?></td>
                <td><?php echo $row["section"]; ?></td>
                <td><?php echo $row["row_num"]; ?></td>
                <td><?php echo $row["seat_num"]; ?></td>
                <td><?php echo $row["price"]; ?></td>
                <td><?php echo $row["purchase_date"]; ?></td>
                <td><?php echo trim(($row["purchaser_fname"] ?? "") . " " . ($row["purchaser_lname"] ?? "")); ?></td>
                <td><?php echo $row["ticket_type"]; ?></td>
                <td><?php echo $row["sale_status"]; ?></td>
                <td>
                    <form method="POST" class="inline-form">
                        <input type="hidden" name="delete_id" value="<?php echo $row["ticket_id"]; ?>">
                        <button class="btn delete-btn" type="submit" onclick="return confirm('Delete this ticket?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div class="section">
        <h2>Add Ticket</h2>
        <form method="POST">
            <div class="form-grid">
                <input type="number" name="ticket_id" placeholder="Ticket ID" required>
                <input type="number" name="game_id" placeholder="Game ID" required>
                <input type="text" name="seat_num" placeholder="Seat #" required>
                <input type="text" name="row_num" placeholder="Row" required>
                <input type="text" name="section" placeholder="Section" required>
                <input type="number" step="0.01" name="price" placeholder="Price" required>
                <input type="date" name="purchase_date">
                <input type="text" name="purchaser_fname" placeholder="Purchaser First Name">
                <input type="text" name="purchaser_lname" placeholder="Purchaser Last Name">
                <input type="email" name="purchaser_email" placeholder="Purchaser Email">
                <input type="text" name="ticket_type" placeholder="Ticket Type" required>
                <select name="sale_status" required>
                    <option value="">Sale Status</option>
                    <option value="Sold">Sold</option>
                    <option value="Available">Available</option>
                    <option value="Reserved">Reserved</option>
                </select>
            </div>
            <button class="btn" type="submit">Add Ticket</button>
        </form>
    </div>
</div>

</body>
</html>