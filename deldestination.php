<?php
include "dbconn.php";
$DestinationID = $_REQUEST["DestinationID"];

$sql = "DELETE FROM Destinations WHERE DestinationID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $DestinationID);

if ($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'Destinations.php'</script>";
} 
else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>