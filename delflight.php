<?php
include "dbconn.php";
$FlightID = $_REQUEST["FlightID"];

$sql = "DELETE FROM Flights WHERE FlightID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $FlightID);

if ($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'Flights.php'</script>";
} 
else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>