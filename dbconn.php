<?php
header("Cache-Control: no-cache");
$servername = "localhost";
$username = "root";
$password = ""; // Default is empty for XAMPP
$dbname = "Travel_Management_DB";
$conn = new mysqli($servername,$username,$password,$dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
?>