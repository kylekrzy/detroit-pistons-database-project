<?php
include("db_connect.php");

$message = "";
$messageClass = "";

if (isset($_POST["delete_id"])) {
    $stmt = $conn->prepare("DELETE FROM Staff WHERE staff_id = ?");
    $stmt->bind_param("i", $_POST["delete_id"]);

    if ($stmt->execute()) {
        $message = "Staff member deleted successfully.";
        $messageClass = "success";
    } else {
        $message = "Error deleting staff member: " . $stmt->error;
        $messageClass = "error";
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sup_id = ($_POST["sup_id"] === "") ? null : (int)$_POST["sup_id"];

    $stmt = $conn->prepare("INSERT INTO Staff (staff_id, f_name, l_name, dob, sex, email, job_title, salary, dept_id, sup_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "issssssdii",
        $_POST["staff_id"],
        $_POST["f_name"],
        $_POST["l_name"],
        $_POST["dob"],
        $_POST["sex"],
        $_POST["email"],
        $_POST["job_title"],
        $_POST["salary"],
        $_POST["dept_id"],
        $sup_id
    );

    if ($stmt->execute()) {
        $message = "Staff member added successfully.";
        $messageClass = "success";
    } else {
        $message = "Error: " . $stmt->error;
        $messageClass = "error";
    }

    $stmt->close();
}

$result = $conn->query("SELECT * FROM Staff ORDER BY staff_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Staff</title>
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
        <h2>Staff</h2>

        <?php if ($message): ?>
            <div class="message <?php echo $messageClass; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <table>
            <tr>
                <th>ID</th>
                <th>First</th>
                <th>Last</th>
                <th>DOB</th>
                <th>Sex</th>
                <th>Email</th>
                <th>Job Title</th>
                <th>Salary</th>
                <th>Dept ID</th>
                <th>Supervisor ID</th>
                <th>Actions</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row["staff_id"]; ?></td>
                <td><?php echo $row["f_name"]; ?></td>
                <td><?php echo $row["l_name"]; ?></td>
                <td><?php echo $row["dob"]; ?></td>
                <td><?php echo $row["sex"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["job_title"]; ?></td>
                <td><?php echo $row["salary"]; ?></td>
                <td><?php echo $row["dept_id"]; ?></td>
                <td><?php echo $row["sup_id"]; ?></td>
                <td>
                    <form method="POST" class="inline-form">
                        <input type="hidden" name="delete_id" value="<?php echo $row["staff_id"]; ?>">
                        <button class="btn delete-btn" type="submit" onclick="return confirm('Delete this staff member?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div class="section">
        <h2>Add Staff Member</h2>
        <form method="POST">
            <div class="form-grid">
                <input type="number" name="staff_id" placeholder="Staff ID" required>
                <input type="text" name="f_name" placeholder="First Name" required>
                <input type="text" name="l_name" placeholder="Last Name" required>
                <input type="date" name="dob" required>
                <select name="sex" required>
                    <option value="">Sex</option>
                    <option value="M">M</option>
                    <option value="F">F</option>
                </select>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="job_title" placeholder="Job Title" required>
                <input type="number" step="0.01" name="salary" placeholder="Salary" required>
                <input type="number" name="dept_id" placeholder="Dept ID" required>
                <input type="number" name="sup_id" placeholder="Supervisor ID (optional)">
            </div>
            <button class="btn" type="submit">Add Staff Member</button>
        </form>
    </div>
</div>

</body>
</html>