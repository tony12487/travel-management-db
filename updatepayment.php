<?php
include "dbconn.php";

if (!isset($_REQUEST["PaymentID"]) || !isset($_REQUEST["PaymentDate"]) || !isset($_REQUEST["Amount"])) {
    die("Error: Missing required parameters.");
}

$PaymentID = $_REQUEST["PaymentID"];
$PaymentDate = $_REQUEST["PaymentDate"];
$Amount = $_REQUEST["Amount"];

if (DateTime::createFromFormat('Y-m-d', $PaymentDate) === false) {
    die("Error: Invalid date format. Expected format is YYYY-MM-DD.");
}

if (!is_numeric($Amount)) {
    die("Error: Amount must be a numeric value.");
}

$sql = "UPDATE Payments SET PaymentDate = ?, Amount = ? WHERE PaymentID = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sdi", $PaymentDate, $Amount, $PaymentID);

if ($stmt->execute()) {
    header("Location: Payments.php?PaymentID=" . $PaymentID);
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
