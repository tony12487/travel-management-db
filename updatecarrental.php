<?php
include "dbconn.php";

if (!isset($_REQUEST["CarID"]) || !isset($_REQUEST["RentalStart"]) || !isset($_REQUEST["RentalEnd"]) || !isset($_REQUEST["Price"]) || !isset($_REQUEST["Description"])) {
    die("Error: Missing required parameters.");
}

$CarID = $_REQUEST["CarID"];
$RentalStart = $_REQUEST["RentalStart"];
$RentalEnd = $_REQUEST["RentalEnd"];
$Price = $_REQUEST["Price"];
$Description = $_REQUEST["Description"];

$sql = "UPDATE CarRental SET RentalStart = ?, RentalEnd = ?, Price = ?, Description = ? WHERE CarID = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ssdsi", $RentalStart, $RentalEnd, $Price, $Description, $CarID);

if ($stmt->execute()) {
    header("Location: CarRental.php?CarID=" . $CarID);
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
