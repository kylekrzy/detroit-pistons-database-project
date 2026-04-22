<?php
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "DetroitPistonsDB";
$port = 8889;         // MAMP MySQL port

$conn = new mysqli($host, $user, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>