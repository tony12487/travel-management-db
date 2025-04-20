<?php
include "dbconn.php";
$UserID = $_REQUEST["UserID"];

$sql = "DELETE FROM  Hotels WHERE Bookings_BookingID IN (SELECT BookingID FROM Bookings WHERE Users_UserID=?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $UserID);
$stmt->execute();

$sql = "DELETE FROM  CarRental WHERE Bookings_BookingID IN (SELECT BookingID FROM Bookings WHERE Users_UserID=?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $UserID);
$stmt->execute();

$sql = "DELETE FROM  Flights WHERE Bookings_BookingID IN (SELECT BookingID FROM Bookings WHERE Users_UserID=?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $UserID);
$stmt->execute();

$sql = "DELETE FROM  Destinations WHERE Bookings_BookingID IN (SELECT BookingID FROM Bookings WHERE Users_UserID=?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $UserID);
$stmt->execute();

$sql = "DELETE FROM TravelDocuments WHERE Bookings_BookingID IN (SELECT BookingID FROM Bookings WHERE Users_UserID=?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $UserID);
$stmt->execute();

$sql = "DELETE FROM Payments WHERE Bookings_BookingID IN (SELECT BookingID FROM Bookings WHERE Users_UserID=?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $UserID);
$stmt->execute();

$sql = "DELETE FROM Bookings WHERE Users_UserID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $UserID);
$stmt->execute();

$sql = "DELETE FROM Users WHERE UserID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $UserID);
$stmt->execute();

if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'Users.php'</script>";
} 
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}    
$conn->close();
?>