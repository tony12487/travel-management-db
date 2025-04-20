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
<th>Flight ID</th><th>User</th><th>Booking ID</th><th>Flight Number</th><th>Flight Departure</th><th>Flight Arrival</th><th>Price</th><th>
</tr>
</thead>
<tbody>";

$sql = "SELECT Flights.FlightID, Flights.FlightNumber, Flights.FlightDeparture, Flights.FlightArrival, Flights.Price, 
               Users.FirstName, Users.LastName, Flights.Bookings_BookingID, Destinations.DestinationID
        FROM Flights
        JOIN Bookings ON Flights.Bookings_BookingID = Bookings.BookingID
        JOIN Users ON Bookings.Users_UserID = Users.UserID
        JOIN Destinations ON Flights.Destinations_DestinationID = Destinations.DestinationID";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row["FlightID"]}</td>
        <td>{$row["FirstName"]} {$row["LastName"]}</td>
        <td>{$row["Bookings_BookingID"]}</td>
        <td>{$row["FlightNumber"]}</td>
        <td>{$row["FlightDeparture"]}</td>
        <td>{$row["FlightArrival"]}</td>
        <td>\${$row["Price"]}</td>
        <td>
        <a href='editflight.php?FlightID={$row["FlightID"]}' class='btn btn-warning btn-sm'>Edit</a>
        <a href='delflight.php?FlightID={$row["FlightID"]}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
        <a href='addflight.php?BookingID={$row["Bookings_BookingID"]}&DestinationID={$row["DestinationID"]}' class='btn btn-primary btn-sm'>Add Flight</a>
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
