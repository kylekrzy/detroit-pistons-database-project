<?php
include("db_connect.php");

$message = "";
$messageClass = "";

if (isset($_POST["delete_id"])) {
    $stmt = $conn->prepare("DELETE FROM Games WHERE game_id = ?");
    $stmt->bind_param("i", $_POST["delete_id"]);

    if ($stmt->execute()) {
        $message = "Game deleted successfully.";
        $messageClass = "success";
    } else {
        $message = "Error deleting game: " . $stmt->error;
        $messageClass = "error";
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare("INSERT INTO Games (game_id, game_date, opponent, venue_id, home_away, result, score, attendance) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "ississsi",
        $_POST["game_id"],
        $_POST["game_date"],
        $_POST["opponent"],
        $_POST["venue_id"],
        $_POST["home_away"],
        $_POST["result"],
        $_POST["score"],
        $_POST["attendance"]
    );

    if ($stmt->execute()) {
        $message = "Game added successfully.";
        $messageClass = "success";
    } else {
        $message = "Error: " . $stmt->error;
        $messageClass = "error";
    }

    $stmt->close();
}

$result = $conn->query("SELECT * FROM Games ORDER BY game_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Games</title>
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
        <h2>Games</h2>

        <?php if ($message): ?>
            <div class="message <?php echo $messageClass; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <table>
            <tr>
                <th>Game ID</th>
                <th>Date</th>
                <th>Opponent</th>
                <th>Venue ID</th>
                <th>Home/Away</th>
                <th>Result</th>
                <th>Score</th>
                <th>Attendance</th>
                <th>Actions</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row["game_id"]; ?></td>
                <td><?php echo $row["game_date"]; ?></td>
                <td><?php echo $row["opponent"]; ?></td>
                <td><?php echo $row["venue_id"]; ?></td>
                <td><?php echo $row["home_away"]; ?></td>
                <td><?php echo $row["result"]; ?></td>
                <td><?php echo $row["score"]; ?></td>
                <td><?php echo $row["attendance"]; ?></td>
                <td>
                    <form method="POST" class="inline-form">
                        <input type="hidden" name="delete_id" value="<?php echo $row["game_id"]; ?>">
                        <button class="btn delete-btn" type="submit" onclick="return confirm('Delete this game?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div class="section">
        <h2>Add Game</h2>
        <form method="POST">
            <div class="form-grid">
                <input type="number" name="game_id" placeholder="Game ID" required>
                <input type="date" name="game_date" required>
                <input type="text" name="opponent" placeholder="Opponent" required>
                <input type="number" name="venue_id" placeholder="Venue ID" required>
                <select name="home_away" required>
                    <option value="">Home/Away</option>
                    <option value="Home">Home</option>
                    <option value="Away">Away</option>
                </select>
                <select name="result" required>
                    <option value="">Result</option>
                    <option value="Win">Win</option>
                    <option value="Loss">Loss</option>
                </select>
                <input type="text" name="score" placeholder="Score" required>
                <input type="number" name="attendance" placeholder="Attendance" required>
            </div>
            <button class="btn" type="submit">Add Game</button>
        </form>
    </div>
</div>

</body>
</html>