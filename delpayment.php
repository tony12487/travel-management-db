<?php
include "dbconn.php";
$PaymentID = $_REQUEST["PaymentID"];

$sql = "DELETE FROM Payments WHERE PaymentID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $PaymentID);

if ($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'Payments.php'</script>";
} 
else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>