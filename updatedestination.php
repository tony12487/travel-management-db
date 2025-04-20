<?php
include "dbconn.php";

if (!isset($_REQUEST["DestinationID"]) || !isset($_REQUEST["DestinationName"]) || !isset($_REQUEST["Country"]) || !isset($_REQUEST["Description"])) {
    die("Error: Missing required parameters.");
}

$DestinationID = $_REQUEST["DestinationID"];
$DestinationName = $_REQUEST["DestinationName"];
$Country = $_REQUEST["Country"];
$Description = $_REQUEST["Description"];

$sql = "UPDATE Destinations SET DestinationName = ?, Country = ?, Description = ? WHERE DestinationID = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sssi", $DestinationName, $Country, $Description, $DestinationID);

if ($stmt->execute()) {
    header("Location: Destinations.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
