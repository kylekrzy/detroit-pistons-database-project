<?php
$host = "localhost";
$user = "root";
$password = "root";   // change if your MAMP password is different
$dbname = "DetroitPistonsDB";
$port = 8889;

$conn = new mysqli($host, $user, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>