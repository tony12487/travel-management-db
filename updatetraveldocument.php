<?php
include "dbconn.php";

if (!isset($_REQUEST["BookingID"]) || !isset($_REQUEST["DocumentType"]) || !isset($_REQUEST["DocumentNumber"]) || !isset($_REQUEST["CountryIssued"]) || !isset($_REQUEST["IssuedDate"]) || !isset($_REQUEST["ExpirationDate"])) {
    die("Error: Missing required parameters.");
}

$BookingID = $_REQUEST["BookingID"];
$DocumentType = $_REQUEST["DocumentType"];
$DocumentNumber = $_REQUEST["DocumentNumber"];
$CountryIssued = $_REQUEST["CountryIssued"];
$IssuedDate = $_REQUEST["IssuedDate"];
$ExpirationDate = $_REQUEST["ExpirationDate"];

$sql = "UPDATE TravelDocuments 
        SET DocumentType = ?, DocumentNumber = ?, CountryIssued = ?, IssuedDate = ?, ExpirationDate = ? 
        WHERE Bookings_BookingID = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sssssi", $DocumentType, $DocumentNumber, $CountryIssued, $IssuedDate, $ExpirationDate, $BookingID);

if ($stmt->execute()) {
    header("Location: TravelDocuments.php?BookingID=" . $BookingID);
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
