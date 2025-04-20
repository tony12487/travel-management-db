<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "dbconn.php";
$BookingID = $_REQUEST["BookingID"];

$sql = "DELETE FROM Flights WHERE Bookings_BookingID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $BookingID);
$stmt->execute();

$sql = "DELETE FROM CarRental WHERE Bookings_BookingID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $BookingID);
$stmt->execute();

$sql = "DELETE FROM Hotels WHERE Bookings_BookingID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $BookingID);
$stmt->execute();

$sql = "DELETE FROM Destinations WHERE Bookings_BookingID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $BookingID);
$stmt->execute();

$sql = "DELETE FROM Payments WHERE Bookings_BookingID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $BookingID);
$stmt->execute();

$sql = "DELETE FROM TravelDocuments WHERE Bookings_BookingID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $BookingID);
$stmt->execute();

$sql = "DELETE FROM Bookings WHERE BookingID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $BookingID);
$stmt->execute();

if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'Bookings.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}    
$conn->close();
?>