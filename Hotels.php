<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travel Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✈️ Travel Management</h2>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "dbconn.php";
echo "<table class='table table-bordered table-striped'><thead class='table-dark'>
<tr>
<th>Hotel ID</th><th>User</th><th>Booking ID</th><th>Hotel Name</th><th>Hotel Address</th><th>Price</th><th>Description</th><th>
</tr>
</thead>
<tbody>";

$sql = "SELECT Hotels.HotelID, Hotels.HotelName, Hotels.HotelAddress, Hotels.Price, Hotels.Description, 
               Users.FirstName, Users.LastName, Hotels.Bookings_BookingID, Destinations.DestinationID
        FROM Hotels
        JOIN Bookings ON Hotels.Bookings_BookingID = Bookings.BookingID
        JOIN Users ON Bookings.Users_UserID = Users.UserID
        JOIN Destinations ON Hotels.Destinations_DestinationID = Destinations.DestinationID";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row["HotelID"]}</td>
        <td>{$row["FirstName"]} {$row["LastName"]}</td>
        <td>{$row["Bookings_BookingID"]}</td>
        <td>{$row["HotelName"]}</td>
        <td>{$row["HotelAddress"]}</td>
        <td>\${$row["Price"]}</td>
        <td>{$row["Description"]}</td>
        <td>
        <a href='edithotel.php?HotelID={$row["HotelID"]}' class='btn btn-warning btn-sm'>Edit</a>
        <a href='delhotel.php?HotelID={$row["HotelID"]}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
        <a href='addhotel.php?BookingID={$row["Bookings_BookingID"]}&DestinationID={$row["DestinationID"]}' class='btn btn-primary btn-sm'>Add Hotel</a>
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
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
