<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travel Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✈️ Bookings</h2>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "dbconn.php";
echo "<table class='table table-bordered table-striped'><thead class='table-dark'>
<tr>
<th>Booking ID</th><th>User</th><th>Booking Date</th><th>Travel Date</th><th>Booking Paid</th><th>Actions</th>
</tr>
</thead>
<tbody>";

$sql = "SELECT Bookings.BookingID, Users.UserID, Users.FirstName, Users.LastName, Bookings.BookingDate, Bookings.TravelDate, Bookings.Payment_Status
        FROM Bookings
        JOIN Users ON Bookings.Users_UserID = Users.UserID";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row["BookingID"]}</td>
                <td>{$row["FirstName"]}</td>
                <td>{$row["BookingDate"]}</td>
                <td>{$row["TravelDate"]}</td>
                <td>{$row["Payment_Status"]}</td>
                <td>
                <a href='editbooking.php?BookingID={$row["BookingID"]}' class='btn btn-warning btn-sm'>Edit</a>
                <a href='delbooking.php?BookingID={$row["BookingID"]}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                <a href='addpayment.php?BookingID={$row["BookingID"]}&UserID={$row["UserID"]}' class='btn btn-success btn-sm'>Add Payment</a>
                </td>
              </tr>";
    }
}
echo "</tbody></table>";
$conn->close();
?>
<div class="text-center mt-4">
            <!-- <a href="adduser.htm" class="btn btn-book btn-lg">🏝️ Select a Destination</a> -->
            <a href="Users.php" class="btn btn-book btn-lg">✈️ Main Menu</a>
            <a href="TravelDocuments.php" class="btn btn-book btn-lg">🛂 View Travel Documents</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
