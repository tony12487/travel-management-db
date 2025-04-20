<?php
include "dbconn.php";

if (!isset($_REQUEST["BookingID"]) || !isset($_REQUEST["BookingDate"]) || !isset($_REQUEST["TravelDate"])) {
    die("Error: Missing required parameters.");
}

$BookingID = $_REQUEST["BookingID"];
$BookingDate = $_REQUEST["BookingDate"];
$TravelDate = $_REQUEST["TravelDate"];

$sql = "UPDATE Bookings SET BookingDate = ?, TravelDate = ? WHERE BookingID = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ssi", $BookingDate, $TravelDate, $BookingID);

if ($stmt->execute()) {
    header("Location: Bookings.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>