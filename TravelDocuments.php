<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travel Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✈️ Travel Documents</h2>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "dbconn.php";
echo "<table class='table table-bordered table-striped'><thead class='table-dark'>
<tr>
<th>Document ID</th><th>User</th><th>Booking ID</th><th>Document Type</th><th>Document Number</th><th>Country Issued</th><th>Issued Date</th><th>Expiration Date</th><th>Actions</th>
</tr>
</thead>
<tbody>";

$sql = "SELECT TravelDocuments.DocumentID, Users.FirstName, Users.LastName, Bookings.BookingID, 
               TravelDocuments.DocumentType, TravelDocuments.DocumentNumber, TravelDocuments.CountryIssued, 
               TravelDocuments.IssuedDate, TravelDocuments.ExpirationDate, Users.UserID
        FROM TravelDocuments
        JOIN Users ON TravelDocuments.Users_UserID = Users.UserID
        JOIN Bookings ON TravelDocuments.Bookings_BookingID = Bookings.BookingID";

$result = $conn->query($sql);
if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row["DocumentID"]}</td>
        <td>{$row["FirstName"]} {$row["LastName"]}</td>
        <td>{$row["BookingID"]}</td>
        <td>{$row["DocumentType"]}</td>
        <td>{$row["DocumentNumber"]}</td>
        <td>{$row["CountryIssued"]}</td>
        <td>{$row["IssuedDate"]}</td>
        <td>{$row["ExpirationDate"]}</td>
        <td>
        <a href='edittraveldocument.php?DocumentID={$row["DocumentID"]}' class='btn btn-warning btn-sm'>Edit</a>
        <a href='deltraveldocument.php?DocumentID={$row["DocumentID"]}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
        <a href='addtraveldocument.php?BookingID={$row["BookingID"]}&UserID={$row["UserID"]}' class='btn btn-primary btn-sm'>Add Document</a>
        </td>
      </tr>";
    }
}
echo "</tbody></table>";
$conn->close();
?>
<div class="text-center mt-4">
            <a href="Users.php" class="btn btn-book btn-lg">✈️ Main Menu</a>
            <a href="Destinations.php" class="btn btn-book btn-lg">✈️ View Destinations</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
