<?php
include "dbconn.php";
$CarID = $_REQUEST["CarID"];

$sql = "DELETE FROM CarRental WHERE CarID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $CarID);

if ($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'CarRental.php'</script>";
} 
else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>