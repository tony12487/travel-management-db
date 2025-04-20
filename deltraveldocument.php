<?php
include "dbconn.php";
$DocumentID = $_REQUEST["DocumentID"];

$sql = "DELETE FROM TravelDocuments WHERE DocumentID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $DocumentID);

if ($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'TravelDocuments.php'</script>";
} 
else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
