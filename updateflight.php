<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "dbconn.php";

if (!isset($_REQUEST["FlightID"]) || !isset($_REQUEST["FlightNumber"]) || !isset($_REQUEST["FlightDeparture"]) || !isset($_REQUEST["FlightArrival"]) || !isset($_REQUEST["Price"])) {
    die("Error: Missing required parameters.");
}

$FlightID = $_REQUEST["FlightID"];
$FlightNumber = $_REQUEST["FlightNumber"];
$FlightDeparture = $_REQUEST["FlightDeparture"];
$FlightArrival = $_REQUEST["FlightArrival"];
$Price = $_REQUEST["Price"];

$sql = "UPDATE Flights SET FlightNumber = ?, FlightDeparture = ?, FlightArrival = ?, Price = ? WHERE FlightID = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sssdi", $FlightNumber, $FlightDeparture, $FlightArrival, $Price, $FlightID);

if ($stmt->execute()) {
    header("Location: Flights.php?FlightID=" . $FlightID);
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
