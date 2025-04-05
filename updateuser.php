<?php
include "dbconn.php";

$sql = "update Users set firstname = ?, lastname = ?, email = ?, phone = ?, address = ? where userid = ?";

$userid = $_REQUEST["userid"];
$fname = $_REQUEST["fname"];
$lname = $_REQUEST["lname"];
$email = $_REQUEST["email"];
$phone = $_REQUEST["phone"];
$address = $_REQUEST["address"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $fname, $lname, $email, $phone, $address, $userid);
if($stmt->execute() === TRUE) {
    header("Location: Users.php");
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}    
$conn->close();
?>