<?php
include "dbconn.php";
$HotelID = $_REQUEST["HotelID"];

$sql = "DELETE FROM Hotels WHERE HotelID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $HotelID);

if ($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'Hotels.php'</script>";
} 
else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>