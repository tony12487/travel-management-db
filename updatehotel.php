<?php
include "dbconn.php";

if (!isset($_REQUEST["HotelID"]) || !isset($_REQUEST["HotelName"]) || !isset($_REQUEST["HotelAddress"]) || !isset($_REQUEST["Price"]) || !isset($_REQUEST["Description"])) {
    die("Error: Missing required parameters.");
}

$HotelID = $_REQUEST["HotelID"];
$HotelName = $_REQUEST["HotelName"];
$HotelAddress = $_REQUEST["HotelAddress"];
$Price = $_REQUEST["Price"];
$Description = $_REQUEST["Description"];

$sql = "UPDATE Hotels SET HotelName = ?, HotelAddress = ?, Price = ?, Description = ? WHERE HotelID = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ssdsi", $HotelName, $HotelAddress, $Price, $Description, $HotelID);

if ($stmt->execute()) {
    header("Location: Hotels.php?HotelID=" . $HotelID);
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
